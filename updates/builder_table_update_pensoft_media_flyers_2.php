<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaFlyers2 extends Migration
{
    public function up()
    {
        Schema::table('pensoft_media_flyers', function($table)
        {
            $table->text('file_language_versions')->nullable()->unsigned(false)->default(null)->comment(null)->change();
        });
    }
    
    public function down()
    {
        // Schema::table('pensoft_media_flyers', function($table)
        // {
        //     $table->string('file_language_versions', 255)->nullable()->unsigned(false)->default(null)->comment(null)->change();
        // });
    }
}
