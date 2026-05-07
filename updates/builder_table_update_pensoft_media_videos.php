<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaVideos extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('pensoft_media_videos', 'published_at')) {
            return;
        }

        Schema::table('pensoft_media_videos', function(Blueprint $table)
        {
            $table->timestamp('published_at')->default('now()');
        });
    }

    public function down(): void
    {
        if (!Schema::hasColumn('pensoft_media_videos', 'published_at')) {
            return;
        }

        Schema::table('pensoft_media_videos', function(Blueprint $table)
        {
            $table->dropColumn('published_at');
        });
    }
}