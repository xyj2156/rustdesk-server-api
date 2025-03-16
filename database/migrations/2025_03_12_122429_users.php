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
        Schema::create('users', function (Blueprint $table) {
            $table->unsignedInteger('id', true)->comment('用户ID');
            $table->string('username', 32)->default('')->comment('用户名')->unique();
            $table->string('password', 128)->default('')->comment('密码');
            $table->unsignedTinyInteger('admin')->default(0)->comment('管理员');
            $table->string('name')->default('')->comment('姓名');
            $table->string('email', 64)->default('')->comment('邮箱');
            $table->string('note')->default('')->comment('备注');

            $table->datetimes();
            $table->softDeletesDatetime();
            $table->comment('用户表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
