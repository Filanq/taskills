import firebase from "firebase/app";
import 'firebase/firestore';
import $ from 'jquery';

const firebaseConfig = {
    apiKey: "AIzaSyAij6gzfKWnxqvKgegnvDfz-yLvHKfTtxI",
    authDomain: "webcamera-4617c.firebaseapp.com",
    projectId: "webcamera-4617c",
    storageBucket: "webcamera-4617c.appspot.com",
    messagingSenderId: "211813729170",
    appId: "1:211813729170:web:32e7160f90506252a6f74b",
    measurementId: "G-X4PDJCQEHZ"
};

if (!firebase.apps.length) {
    firebase.initializeApp(firebaseConfig);
}
const firestore = firebase.firestore();

const servers = {
    iceServers: [
        {
            urls: ['stun:stun1.l.google.com:19302', 'stun:stun2.l.google.com:19302'],
        },
    ],
    iceCandidatePoolSize: 10,
};

const pc = new RTCPeerConnection(servers);
let localStream = null;
let remoteStream = null;

window.Echo.leave('callCreated.' + $('#user').text());

const webcamVideo = document.getElementById('local');
const remoteVideo = document.getElementById('remote')
// const remoteVideo = document.getElementById('remote');
// const remoteVideo = document.getElementById('remote');
const quitBtn = $('#quitBtn')[0];

(async () => {
            localStream = await navigator.mediaDevices.getUserMedia({video: true, audio: true});
            remoteStream = new MediaStream();

            localStream.getTracks().forEach((track) => {
                pc.addTrack(track, localStream);
            });

            pc.ontrack = (event) => {
                event.streams[0].getTracks().forEach((track) => {
                    remoteStream.addTrack(track);
                });
            };

            webcamVideo.srcObject = localStream;
            remoteVideo.srcObject = remoteStream;

            let calldoc_id = null;

            if ($('#callId').val() === '0') {
                calldoc_id = await for_offer();
            } else {
                let id = $('#callId').val();
                calldoc_id = await for_answer(id);
            }


            async function quit(e) {
                await $.ajax({
                    method: 'post',
                    url: window.origin + '/call/quit',
                    data: {
                        '_token': $("#csrf").val(),
                        'call_id': calldoc_id
                    }
                });
            }

            window.addEventListener('beforeunload', async function (e) {
                await quit(e);
                return null;
            });

            window.addEventListener('close', async function (e) {
                await quit(e);
                return null;
            });

            quitBtn.addEventListener('click', async function (e) {
                e.preventDefault();
                if (confirm('Вы хотите завершить звонок?')) {
                    quit(e);
                }
            });
            window.Echo.channel('callQuit.' + calldoc_id).listen('callQuitEvent', function (data) {
                alert('Звонок окончен');
                window.location.href = '/';
            });
    })();

async function for_offer(){
    const callDoc = firestore.collection('calls').doc();
    const offerCandidates = callDoc.collection('offerCandidates');
    const answerCandidates = callDoc.collection('answerCandidates');

    await $.ajax({
        method: 'post',
        url: window.origin + '/call/create',
        data: {
            '_token': $("#csrf").val(),
            'call_id': callDoc.id,
            'answer_id': $("#answer_id").val(),
            'offer_id': $("#offer_id").val()
        }
    });

    // Get candidates for caller, save to db
    pc.onicecandidate = (event) => {
        event.candidate && offerCandidates.add(event.candidate.toJSON());
    };

    // Create offer
    const offerDescription = await pc.createOffer();
    await pc.setLocalDescription(offerDescription);

    const offer = {
        sdp: offerDescription.sdp,
        type: offerDescription.type,
    };

    await callDoc.set({ offer });

    // Listen for remote answer
    callDoc.onSnapshot((snapshot) => {
        const data = snapshot.data();
        if (!pc.currentRemoteDescription && data?.answer) {
            const answerDescription = new RTCSessionDescription(data.answer);
            pc.setRemoteDescription(answerDescription);
        }
    });

    // When answered, add candidate to peer connection
    answerCandidates.onSnapshot((snapshot) => {
        snapshot.docChanges().forEach((change) => {
            if (change.type === 'added') {
                const candidate = new RTCIceCandidate(change.doc.data());
                pc.addIceCandidate(candidate);
            }
        });
    });

    return callDoc.id;
}

// 3. Answer the call with the unique ID
async function for_answer(id){
    const callDoc = firestore.collection('calls').doc(id);
    const answerCandidates = callDoc.collection('answerCandidates');
    const offerCandidates = callDoc.collection('offerCandidates');

    // await $.ajax({
    //     method: 'post',
    //     url: window.origin + '/call/answer',
    //     data: {
    //         '_token': $("#csrf").val(),
    //         'call_id': callDoc.id,
    //         'answer_id': $("#answerId").val()
    //     }
    // });

    pc.onicecandidate = (event) => {
        event.candidate && answerCandidates.add(event.candidate.toJSON());
    };

    const callData = (await callDoc.get()).data();

    const offerDescription = callData.offer;
    await pc.setRemoteDescription(new RTCSessionDescription(offerDescription));

    const answerDescription = await pc.createAnswer();
    await pc.setLocalDescription(answerDescription);

    const answer = {
        type: answerDescription.type,
        sdp: answerDescription.sdp,
    };

    await callDoc.update({ answer });

    offerCandidates.onSnapshot((snapshot) => {
        snapshot.docChanges().forEach((change) => {
            console.log(change);
            if (change.type === 'added') {
                let data = change.doc.data();
                pc.addIceCandidate(new RTCIceCandidate(data));
            }
        });
    });

    return callDoc.id;
}
