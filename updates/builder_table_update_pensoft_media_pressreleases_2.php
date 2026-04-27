<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaPressreleases2 extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('pensoft_media_pressreleases', 'category_id')) {
            return;
        }

        Schema::table('pensoft_media_pressreleases', function(Blueprint $table)
        {
            $table->integer('category_id')->nullable();
        });
    }

    public function down(): void
    {
        if (!Schema::hasColumn('pensoft_media_pressreleases', 'category_id')) {
            return;
        }

        Schema::table('pensoft_media_pressreleases', function(Blueprint $table)
        {
            $table->dropColumn('category_id');
        });
    }
}