<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaFlyers6 extends Migration
{
    public function up()
    {
        Schema::table('pensoft_media_flyers', function($table)
        {
            $table->integer('sort_order')->default(1)->change();
        });
    }
    
    public function down()
    {
        Schema::table('pensoft_media_flyers', function($table)
        {
            $table->integer('sort_order')->default(null)->change();
        });
    }
}
