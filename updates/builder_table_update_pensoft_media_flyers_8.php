<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaFlyers8 extends Migration
{
    public function up()
    {
        Schema::table('pensoft_media_flyers', function(Blueprint $table)
        {
            $table->integer('sort_order')->default(1)->change();
        });
    }

    public function down()
    {
        Schema::table('pensoft_media_flyers', function(Blueprint $table)
        {
            $table->integer('sort_order')->default(0)->change();
        });
    }
}
