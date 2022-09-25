<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogDelete extends Model {
    protected $table = 'log_delete';

    protected $fillable = [
        'inventory_id',
        'room_id',
        'user_id',
        'deleted_at',
    ];

    public $timestamps = false;
}