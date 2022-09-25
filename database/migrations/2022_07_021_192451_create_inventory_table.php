<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryTable extends Migration{
    
    public function up(){
        Schema::create('inventory', function (Blueprint $table) {
            $table->id();
            $table->string('inventory_code');
            $table->string('inventory_name');
            $table->string('inventory_picture');
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('user_id');
            $table->string('description');
            $table->string('stock_status');
            $table->integer('status');
            $table->timestamps();
            
            $table->foreign('room_id')->references('id')->on('room');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down(){
        Schema::dropIfExists('inventory');
    }
}