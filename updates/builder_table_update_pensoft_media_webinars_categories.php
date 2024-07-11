<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaWebinarsCategories extends Migration
{
    public function up()
    {
        Schema::table('pensoft_media_webinars_categories', function($table)
        {
            $table->text('category_intro')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('pensoft_media_webinars_categories', function($table)
        {
            $table->dropColumn('category_intro');
        });
    }
}
