<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaWebinars5 extends Migration
{
    public function up()
    {
        Schema::table('pensoft_media_webinars', function($table)
        {
            $table->text('description')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('pensoft_media_webinars', function($table)
        {
            $table->dropColumn('description');
        });
    }
}
