<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProjectInitializeMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique()->comment('用户名称，唯一值，一般不建议作为登录凭据');
            $table->string('email')->unique()->comment('用户邮件箱，唯一值，可作为登录凭据');
            $table->string('password')->nullable()->comment('密码');
            $table->timestamp('last_login')->comment('最后登录时间');
            $table->integer('login_times')->unsigned()->default(0)->comment('登录次数');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index()->comment('密码重置邮箱');
            $table->string('token')->index()->comment('密码重置 token');
            $table->timestamp('created_at');
        });

        Schema::create('administrators', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->comment('管理组 ID');
            $table->string('name')->unique()->comment('用户名');
            $table->string('email')->nullable()->comment('管理员邮件箱');
            $table->string('password')->comment('密码');
            $table->timestamp('last_login')->comment('最后登录时间');
            $table->integer('login_times')->unsigned()->default(0)->comment('登录次数');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('admin_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique()->nullable()->comment('组唯一标识名称');
            $table->string('display_name')->comment('组名称');
            $table->text('description')->comment('组描述');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('admin_operational_logs', function (Blueprint $table) {
            $table->engine = 'ARCHIVE';
            $table->increments('id');
            $table->integer('administrator_id')->comment('操作者 ID');
            $table->string('level')->comment('日志级别');
            $table->string('message', 2048)->comment('日志信息');
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
        Schema::drop('users');
        Schema::drop('password_resets');
        Schema::drop('administrators');
        Schema::drop('admin_groups');
        Schema::drop('admin_operational_logs');
    }
}
