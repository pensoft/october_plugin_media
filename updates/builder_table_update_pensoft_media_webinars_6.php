<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaWebinars6 extends Migration
{
    public function up()
    {
        Schema::table('pensoft_media_webinars', function($table)
        {
            $table->integer('parent_id')->default(1)->change();
        });
    }
    
    public function down()
    {
        Schema::table('pensoft_media_webinars', function($table)
        {
            $table->integer('parent_id')->default(null)->change();
        });
    }
}
