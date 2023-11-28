<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaGalleries extends Migration
{
    public function up()
    {
        Schema::table('pensoft_media_galleries', function($table)
        {
            $table->boolean('event_related')->default(0);
            $table->integer('event_id')->unsigned()->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('pensoft_media_galleries', function($table)
        {
            $table->dropColumn('event_related');
            $table->dropColumn('event_id');
        });
    }
}
