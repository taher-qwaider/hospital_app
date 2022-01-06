<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 45);
            $table->string('last_name', 45);
            $table->string('email')->unique();
            $table->integer('phone')->unique();
            $table->enum('teach_level', ['A', 'B', 'C']);
            $table->enum('gender', ['M', 'F']);
            $table->string('address')->nullable();
            $table->string('password');
//            $table->timestamp('email_verified_at')->nullable();
            $table->foreignId('city_id');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->softDeletes();
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
        Schema::dropIfExists('teachers');
    }
}
