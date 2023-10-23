<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaVideos4 extends Migration
{
    public function up()
    {
        Schema::table('pensoft_media_videos', function($table)
        {
            $table->integer('country_id')->nullable()->default(3);
            $table->dropColumn('country');
        });
    }
    
    public function down()
    {
        Schema::table('pensoft_media_videos', function($table)
        {
            $table->dropColumn('country_id');
            $table->integer('country')->nullable();
        });
    }
}
