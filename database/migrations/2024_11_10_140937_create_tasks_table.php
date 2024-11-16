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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->enum('status', ['pending', 'end'])->default('pending'); 
           
        // Add default value for team_id
        $table->unsignedBigInteger('team_id')->default(1); // Set 1 as default team ID, you can adjust this as needed
        $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade'); // Foreign key to the teams table

           
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
        Schema::dropIfExists('tasks');
    }
};
