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
        if (Schema::hasColumn('pensoft_media_newsletters', 'url')){
            Schema::table('pensoft_media_newsletters', function($table)
            {
                $table->dropColumn('url');
            });
        }
    }
}