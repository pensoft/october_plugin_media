<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaNewsletters2 extends Migration
{
    public function up()
    {
        Schema::table('pensoft_media_newsletters', function($table)
        {
            $table->text('file_language_versions')->nullable();
        });
    }

    public function down()
    {
        Schema::table('pensoft_media_newsletters', function($table)
        {
            $table->text('file_language_versions');
        });
    }
}