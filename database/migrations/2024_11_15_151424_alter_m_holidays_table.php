<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_holidays', function (Blueprint $table) {
            $table->id();
            $table->string('subject')->nullable() ;
            $table->text('description') ;
            $table->date('date') ;
            $table->enum('action', ['pending', 'accept','cancel'])->default("pending") ;
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Foreign key to the teams table

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_holidays');
    }
};
