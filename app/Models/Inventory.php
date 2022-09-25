<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model {
    protected $table = 'inventory';

    protected $fillable = [
        'inventory_code',
        'inventory_name',
        'inventory_picture',
        'room_id',
        'user_id',
        'description',
        'stock_status',
        'status',
        'created_at',
        'updated_at',
    ];
}