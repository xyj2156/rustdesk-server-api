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
        Schema::create('connections', function (Blueprint $table) {
            $table->id();
            $table->char('uuid', 64)->index()->comment('uuid');
            $table->unsignedBigInteger('conn_id')->comment('连接ID');
            $table->string('ip')->comment('用户ID');
            $table->unsignedBigInteger('session_id')->comment('session ID');
            $table->dateTime('created_at')->comment('创建时间');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('connections');
    }
};
