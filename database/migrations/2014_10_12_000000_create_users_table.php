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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('birthday')->nullable();
            $table->string('image')->default('https://static.vecteezy.com/system/resources/previews/009/292/244/large_2x/default-avatar-icon-of-social-media-user-vector.jpg');
            $table->string('address')->nullable();
            $table->string('role')->default('employee');
            
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
        Schema::dropIfExists('users');
    }
};
