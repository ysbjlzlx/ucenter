<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tokens', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->default(0)->comment('用户 ID');
            $table->string('access_token',64)->default('')->comment('access_token');
            $table->timestamp('deleted_at')->default(null)->nullable()->comment('删除时间');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate()->comment('更新时间');
            $table->timestamp('created_at')->useCurrent()->comment('创建时间');
            $table->index('user_id','idx_user_id');
            $table->index('access_token','idx_access_token');
            $table->index('deleted_at', 'idx_deleted_at');
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
        Schema::dropIfExists('tokens');
    }
}
