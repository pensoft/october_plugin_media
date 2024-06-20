<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaWebinars2 extends Migration
{
    public function up()
    {
        Schema::table('pensoft_media_webinars', function($table)
        {
            $table->integer('parent_id')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('pensoft_media_webinars', function($table)
        {
            $table->integer('parent_id')->nullable(false)->change();
        });
    }
}
