<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('token', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->comment('用户id')->index();
            $table->string('my_id');
            $table->string('uuid');
            $table->char('token', 64)->comment('token');
            $table->dateTime('expired');
            $table->dateTimes();

            $table->comment('登录token表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('token');
    }
};
