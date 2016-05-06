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
            $table->bigIncrements('id');
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
            $table->bigIncrements('id');
            $table->integer('operator_id')->nullable()->comment('操作者 ID');
            $table->string('level')->comment('日志级别');
            $table->string('message', 2048)->comment('日志信息');
            $table->timestamps();
        });
        
        Schema::create('content_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->default(0)->comment('父节点 ID');
            $table->string('name')->nullable()->unique()->comment('分类节点名，唯一标识符');
            $table->string('display_name')->index()->comment('分类名');
            $table->text('description')->comment('分类描述');
            $table->string('keywords')->nullable()->comment('分类关键字');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('node_id')->unsigned()->comment('节点 ID，全局唯一存储节点');
            $table->string('node_type')->comment('节点类型');
            $table->bigInteger('content_model_id')->unsigned()->comment('内容模型 ID');
            $table->string('content_model_type')->comment('内容模型类型');
            $table->bigInteger('publisher_id')->unsgined()->nullable()->comment('发布者 ID');
            $table->string('publisher_type')->nullable()->comment('发布者类型');
            $table->string('title')->index()->nullable()->comment('内容标题');
            $table->text('description')->comment('内容描述');
            $table->string('keywords')->index()->nullable()->comment('内容关键字');
            $table->string('name')->unique()->nullable()->comment('内容名称，唯一标识');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cover')->nullable()->comment('封面');
            $table->string('author')->nullable()->comment('作者名称');
            $table->mediumText('content')->comment('内容');
            $table->string('source')->nullable()->comment('内容来源');
            $table->string('source_name')->nullable()->comment('内容来源名称');
            $table->timestamp('published_at')->nullable()->comment('发布时间')->useCurrent(true);
            $table->timestamp('expired_at')->nullable()->comment('过期时间');
            $table->timestamps();
            $table->softDeletes();
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
        Schema::drop('content_categories');
        Schema::drop('contents');
        Schema::drop('articles');
    }
}
