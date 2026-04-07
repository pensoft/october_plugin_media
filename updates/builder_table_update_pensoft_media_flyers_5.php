<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaFlyers5 extends Migration
{
    public function up(): void
    {
        Schema::table('pensoft_media_flyers', function(Blueprint $table)
        {
            $table->integer('sort_order')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('pensoft_media_flyers', function(Blueprint $table)
        {
            $table->dropColumn('sort_order');
        });
    }
}