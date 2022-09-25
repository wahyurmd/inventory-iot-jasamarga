<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowTable extends Migration{
    
    public function up(){
        Schema::create('borrow', function (Blueprint $table) {
            $table->id();
            $table->string('borrower_name');
            $table->string('borrower_unit');
            $table->string('borrower_number');
            $table->unsignedBigInteger('inventory_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('status');
            $table->timestamp('borrow_date')->nullable();
            $table->timestamp('date_return')->nullable();

            $table->foreign('inventory_id')->references('id')->on('inventory');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down(){
        Schema::dropIfExists('borrow');
    }
}