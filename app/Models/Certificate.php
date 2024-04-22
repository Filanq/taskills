<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;
    protected $table = 'certificates';
    public $timestamps = false;
    protected $fillable = [
        'title',
        'date',
        'file',
        'user_id',
        'medic_id'
    ];
}
