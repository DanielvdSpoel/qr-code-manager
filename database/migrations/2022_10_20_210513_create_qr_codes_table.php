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
        Schema::create('qr_codes', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->string('type');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('size');
            $table->string('color');
            $table->string('background_color');
            $table->string('style');
            $table->string('eye_style');
            $table->string('error_correction_level');
            $table->string('image')->nullable();
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
        Schema::dropIfExists('qr_codes');
    }
};
