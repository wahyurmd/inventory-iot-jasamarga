<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model {
    protected $table = 'log';

    protected $fillable = [
        'inventory_id',
        'previous_room',
        'transfer_room',
        'user_id',
        'status',
        'created_at',
        'updated_at',
    ];
}