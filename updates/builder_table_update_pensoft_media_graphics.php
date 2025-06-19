<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaGraphics extends Migration
{
    public function up()
    {
        if(!Schema::hasColumn('pensoft_media_graphics', 'sort_order')) {
            Schema::table('pensoft_media_graphics', function ($table) {
                $table->integer('sort_order')->nullable()->default(1);
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('pensoft_media_graphics', 'sort_order')) {
            Schema::table('pensoft_media_graphics', function ($table) {
                $table->dropColumn('sort_order');
            });
        }
    }
}
