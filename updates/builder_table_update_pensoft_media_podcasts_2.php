<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaPodcasts2 extends Migration
{
    public function up()
    {
        Schema::table('pensoft_media_podcasts', function($table)
        {
            $table->text('description')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('pensoft_media_podcasts', function($table)
        {
            $table->dropColumn('description');
        });
    }
}
