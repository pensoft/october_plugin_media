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
            if (!Schema::hasColumn('pensoft_media_videos', 'country_id')) {
                $table->integer('country_id')->nullable()->default(3);
            }
            if (Schema::hasColumn('pensoft_media_videos', 'country')) {
                $table->dropColumn('country');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pensoft_media_videos', function(Blueprint $table)
        {
            if (Schema::hasColumn('pensoft_media_videos', 'country_id')) {
                $table->dropColumn('country_id');
            }
            if (!Schema::hasColumn('pensoft_media_videos', 'country')) {
                $table->integer('country')->nullable();
            }
        });
    }
}