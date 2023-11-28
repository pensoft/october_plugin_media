<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaVideos2 extends Migration
{
    public function up()
    {
        Schema::table('pensoft_media_videos', function($table)
        {
            $table->integer('type')->default(1);
        });
    }
    
    public function down()
    {
        Schema::table('pensoft_media_videos', function($table)
        {
            $table->dropColumn('type');
        });
    }
}
