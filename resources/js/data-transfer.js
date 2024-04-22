let img = document.getElementById('img');

let file = new File([], img.dataset.src + ' {old}');
let dt = new DataTransfer();
dt.items.add(file);
img.files = dt.files;
