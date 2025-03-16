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
        Schema::create('sys_info', function (Blueprint $table) {
            $table->unsignedInteger('id', true);
            $table->string('cpu')->default('')->comment('CPU名称');
            $table->string('hostname')->default('')->comment('设备名称');
            $table->string('device_id')->default('')->comment('设备ID')->index();
            $table->string('memory')->default('')->comment('内存');
            $table->string('os')->default('')->comment('系统名称');
            $table->string('uuid')->default('')->comment('uuid')->index();
            $table->string('version')->default('')->comment('版本');
            $table->dateTime('created_at')->useCurrent();

            $table->comment('设备信息表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sys_info');
    }
};
