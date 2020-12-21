<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreatePensoftMediaVideos extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('pensoft_media_videos')) {
            Schema::create('pensoft_media_videos', function($table)
            {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->timestamp('created_at')->nullable();
                $table->timestamp('updated_at')->nullable();
                $table->string('name');
                $table->string('youtube_url')->nullable();
                $table->string('vimeo_url', 255)->nullable();
                $table->integer('parent_id')->nullable();
                $table->integer('nest_left')->nullable();
                $table->integer('nest_right')->nullable();
                $table->integer('nest_depth')->nullable();
            });
        }
    }
    
    public function down()
    {
        if (Schema::hasTable('pensoft_media_videos')) {
            Schema::dropIfExists('pensoft_media_videos');
        }
    }
}
