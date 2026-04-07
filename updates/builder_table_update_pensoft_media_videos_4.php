<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaVideos4 extends Migration
{
    public function up(): void
    {
        Schema::table('pensoft_media_videos', function(Blueprint $table)
        {
            $table->integer('country_id')->nullable()->default(3);
            $table->dropColumn('country');
        });
    }

    public function down(): void
    {
        Schema::table('pensoft_media_videos', function(Blueprint $table)
        {
            $table->dropColumn('country_id');
            $table->integer('country')->nullable();
        });
    }
}