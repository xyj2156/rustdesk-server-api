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
        Schema::create('peers', function (Blueprint $table) {
            $table->unsignedInteger('id')->comment('ID')->primary();
            $table->unsignedInteger('user_id')->comment('用户ID')->index();
            $table->char('peer_id', 16)->default('')->comment('设备ID')->unique();
            $table->string('hash', 128)->nullable()->default('')->comment('设备连接密码');
            $table->string('username', 128)->default('')->comment('操作系统用户名');
            $table->string('hostname', 128)->default('')->comment('操作系统名');
            $table->char('platform', 20)->default('')->comment('平台');
            $table->char('alias', 20)->default('')->comment('别名');
            $table->string('tags')->default('')->comment('标签');

            $table->comment('远程设备表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peers');
    }
};
