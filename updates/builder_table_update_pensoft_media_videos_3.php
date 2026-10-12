<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaVideos3 extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('pensoft_media_videos', 'country')) {
            return;
        }

        Schema::table('pensoft_media_videos', function(Blueprint $table)
        {
            $table->integer('country')->nullable();
        });
    }

    public function down(): void
    {
        if (!Schema::hasColumn('pensoft_media_videos', 'country')) {
            return;
        }

        Schema::table('pensoft_media_videos', function(Blueprint $table)
        {
            $table->dropColumn('country');
        });
    }
}