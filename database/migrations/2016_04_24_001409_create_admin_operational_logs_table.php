<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminOperationalLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
        Schema::drop('admin_operational_logs');
    }
}
