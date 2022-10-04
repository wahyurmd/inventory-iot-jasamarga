<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogTable extends Migration{
    
    public function up(){
        Schema::create('log', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inventory_id');
            $table->string('previous_room');
            $table->string('transfer_room');
            $table->unsignedBigInteger('user_id');
            $table->integer('status');
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down(){
        Schema::dropIfExists('log');
    }
}