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

            $table->string('name', 255);
            $table->string('surname', 255);
            $table->string('phone_number', 255);
            $table->string('image_path', 255)->default('img/user/dummy-profile-picture.png');
            $table->text('description')->nullable();

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();

            $table->string('password');
            $table->rememberToken();
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
