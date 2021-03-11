<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->string('username')->default('')->comment('用户名');
            $table->string('password')->default('')->comment('密码');
            $table->string('nickname')->default('')->comment('昵称');
            $table->string('avatar')->default('')->comment('头像');
            $table->string('email')->default('')->comment('邮箱');
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate()->comment('更新时间');
            $table->timestamp('created_at')->useCurrent()->comment('创建时间');
            $table->index('username', 'idx_username');
            $table->index('email', 'idx_email');
            $table->index('updated_at', 'idx_updated_at');
            $table->index('created_at', 'idx_created_at');
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
}
