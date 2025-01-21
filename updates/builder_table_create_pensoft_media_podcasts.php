<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreatePensoftMediaPodcasts extends Migration
{
    public function up()
    {
        Schema::create('pensoft_media_podcasts', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->string('title');
            $table->string('url');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('pensoft_media_podcasts');
    }
}
