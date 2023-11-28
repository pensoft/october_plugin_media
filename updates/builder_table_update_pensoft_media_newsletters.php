<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaNewsletters extends Migration
{
    public function up()
    {
        Schema::table('pensoft_media_newsletters', function($table)
        {
            $table->string('url')->nullable();
        });
    }

    public function down()
    {
        Schema::table('pensoft_media_newsletters', function($table)
        {
            $table->dropColumn('url');
        });
    }
}