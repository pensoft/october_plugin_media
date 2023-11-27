<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaGalleries2 extends Migration
{
    public function up()
    {
        Schema::table('pensoft_media_galleries', function($table)
        {
            $table->boolean('show_on_homepage')->default(false);
            $table->boolean('show_on_ecological')->default(false);
        });
    }
    
    public function down()
    {
        Schema::table('pensoft_media_galleries', function($table) {
            $table->dropColumn(['show_on_homepage', 'show_on_ecological']);
        });
    }
}
