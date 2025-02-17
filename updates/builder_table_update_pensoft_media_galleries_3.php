<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaGalleries3 extends Migration
{
    public function up()
    {
        Schema::table('pensoft_media_galleries', function($table)
        {
            $table->integer('sort_order')->nullable();
            $table->boolean('related')->default(false)->change();
            $table->boolean('event_related')->default(false)->change();
            $table->boolean('show_on_homepage')->default(false)->change();
            $table->boolean('show_on_ecological')->default(false)->change();
        });
    }
    
    public function down()
    {
        Schema::table('pensoft_media_galleries', function($table)
        {
            $table->dropColumn('sort_order');
            $table->boolean('related')->default(null)->change();
            $table->boolean('event_related')->default(null)->change();
            $table->boolean('show_on_homepage')->default(null)->change();
            $table->boolean('show_on_ecological')->default(null)->change();
        });
    }
}
