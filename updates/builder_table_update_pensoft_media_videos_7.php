<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaVideos7 extends Migration
{
    public function up()
    {
        Schema::table('pensoft_media_videos', function($table)
        {
            $table->timestamp('published_at')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('pensoft_media_videos', function($table)
        {
            $table->timestamp('published_at')->nullable(false)->change();
        });
    }
}
