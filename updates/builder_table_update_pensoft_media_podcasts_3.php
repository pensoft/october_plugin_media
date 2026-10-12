<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaPodcasts3 extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('pensoft_media_podcasts', 'youtube_url')) {
            return;
        }

        Schema::table('pensoft_media_podcasts', function(Blueprint $table)
        {
            $table->string('youtube_url')->nullable();
        });
    }

    public function down(): void
    {
        if (!Schema::hasColumn('pensoft_media_podcasts', 'youtube_url')) {
            return;
        }

        Schema::table('pensoft_media_podcasts', function(Blueprint $table)
        {
            $table->dropColumn('youtube_url');
        });
    }
}
