<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model {
    protected $table = 'room';

    protected $fillable = [
        'room',
        'location',
        'status',
        'created_at',
        'updated_at',
    ];
}