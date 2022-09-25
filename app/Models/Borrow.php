<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model {
    protected $table = 'borrow';

    protected $fillable = [
        'borrower_name',
        'borrower_unit',
        'borrower_number',
        'inventory_id',
        'user_id',
        'status',
        'borrow_date',
        'date_return',
    ];

    public $timestamps = false;

}