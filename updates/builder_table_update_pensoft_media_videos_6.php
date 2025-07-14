<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaVideos6 extends Migration
{
    public function up()
    {
        Schema::table('pensoft_media_videos', function($table)
        {
            $table->text('description')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('pensoft_media_videos', function($table)
        {
            $table->dropColumn('description');
        });
    }
}
