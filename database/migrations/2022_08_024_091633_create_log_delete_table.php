<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogDeleteTable extends Migration{
    
    public function up(){
        Schema::create('log_delete', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inventory_id');
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamp('deleted_at')->nullable();

            $table->foreign('inventory_id')->references('id')->on('inventory');
            $table->foreign('room_id')->references('id')->on('room');
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    public function down(){
        Schema::dropIfExists('log_delete');
    }
}