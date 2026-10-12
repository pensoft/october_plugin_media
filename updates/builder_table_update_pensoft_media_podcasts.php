<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaPodcasts extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('pensoft_media_podcasts', 'sort_order')) {
            return;
        }

        Schema::table('pensoft_media_podcasts', function(Blueprint $table)
        {
            $table->smallInteger('sort_order')->default(1);
        });
    }

    public function down(): void
    {
        if (!Schema::hasColumn('pensoft_media_podcasts', 'sort_order')) {
            return;
        }

        Schema::table('pensoft_media_podcasts', function(Blueprint $table)
        {
            $table->dropColumn('sort_order');
        });
    }
}