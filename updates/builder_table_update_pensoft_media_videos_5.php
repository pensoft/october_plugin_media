<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaVideos5 extends Migration
{
    public function up()
    {
        Schema::table('pensoft_media_videos', function($table)
        {
            $table->integer('category_id')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('pensoft_media_videos', function($table)
        {
            $table->dropColumn('category_id');
        });
    }
}
