<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaPresentations extends Migration
{
    public function up(): void
    {
        Schema::table('pensoft_media_presentations', function(Blueprint $table)
        {
            $table->integer('sort_order')->nullable()->default(1);
        });
    }

    public function down(): void
    {
        Schema::table('pensoft_media_presentations', function(Blueprint $table)
        {
            $table->dropColumn('sort_order');
        });
    }
}