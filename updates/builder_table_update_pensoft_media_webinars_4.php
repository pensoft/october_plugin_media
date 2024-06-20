<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaWebinars4 extends Migration
{
    public function up()
    {
        Schema::table('pensoft_media_webinars', function($table)
        {
            $table->text('category_intro')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('pensoft_media_webinars', function($table)
        {
            $table->dropColumn('category_intro');
        });
    }
}
