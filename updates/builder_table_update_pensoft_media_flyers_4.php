<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaFlyers4 extends Migration
{
    public function up()
    {
        Schema::table('pensoft_media_flyers', function($table)
        {
            $table->integer('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('pensoft_media_categories')->onDelete('SET NULL');
        });
    }

    public function down()
    {
        if (Schema::hasTable('pensoft_media_flyers')) {
            Schema::table('pensoft_media_flyers', function($table)
            {
                $table->dropForeign(['category_id']);
                $table->dropColumn('category_id');
            });
        }
    }
}
