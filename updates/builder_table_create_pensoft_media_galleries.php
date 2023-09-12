<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreatePensoftMediaGalleries extends Migration
{
    public function up()
    {
        Schema::create('pensoft_media_galleries', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('name')->nullable();
            $table->boolean('related')->default(0);
            $table->integer('article_id')->unsigned()->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pensoft_media_galleries');
    }
}
