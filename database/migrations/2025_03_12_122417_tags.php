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
        Schema::create('tags', function (Blueprint $table) {
            $table->unsignedInteger('id', true)->comment('标签ID');
            $table->unsignedInteger('user_id')->comment('用户ID')->index('user_id');
            $table->string('tag', 24)->default('')->comment('标签名称');
            $table->unsignedInteger('color')->default(4280391411)->comment('标签颜色');
            $table->datetimes();

            $table->comment('标签表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
};
