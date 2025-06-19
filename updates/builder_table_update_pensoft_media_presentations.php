<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaPresentations extends Migration
{
    public function up()
    {
        Schema::table('pensoft_media_presentations', function($table)
        {
            $table->integer('sort_order')->nullable()->default(1);
        });
    }
    
    public function down()
    {
        Schema::table('pensoft_media_presentations', function($table)
        {
            $table->dropColumn('sort_order');
        });
    }
}
