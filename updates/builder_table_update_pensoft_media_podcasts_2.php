<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaPodcasts2 extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('pensoft_media_podcasts', 'description')) {
            return;
        }

        Schema::table('pensoft_media_podcasts', function(Blueprint $table)
        {
            $table->text('description')->nullable();
        });
    }

    public function down(): void
    {
        if (!Schema::hasColumn('pensoft_media_podcasts', 'description')) {
            return;
        }

        Schema::table('pensoft_media_podcasts', function(Blueprint $table)
        {
            $table->dropColumn('description');
        });
    }
}
