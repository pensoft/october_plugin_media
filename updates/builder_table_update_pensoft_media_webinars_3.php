<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaWebinars3 extends Migration
{
    public function up()
    {
        Schema::table('pensoft_media_webinars', function($table)
        {
            $table->integer('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('pensoft_media_webinars_categories')->onDelete('SET NULL');
        });
    }
    
    public function down()
    {
        Schema::table('pensoft_media_webinars', function($table)
        {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
}
