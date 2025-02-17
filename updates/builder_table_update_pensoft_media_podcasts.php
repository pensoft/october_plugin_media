<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaPodcasts extends Migration
{
    public function up()
    {
        Schema::table('pensoft_media_podcasts', function($table)
        {
            $table->smallInteger('sort_order')->default(1);
        });
    }
    
    public function down()
    {
        Schema::table('pensoft_media_podcasts', function($table)
        {
            $table->dropColumn('sort_order');
        });
    }
}
