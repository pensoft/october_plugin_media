<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaFlyers extends Migration
{
    public function up()
    {
        Schema::table('pensoft_media_flyers', function($table)
        {
            $table->string('file_language_versions')->nullable();
        });
    }
    
    public function down()
    {
        if (Schema::hasTable('pensoft_media_flyers')) {
            Schema::table('pensoft_media_flyers', function($table)
            {
                $table->dropColumn('file_language_versions');
            });
        }
    }
}
