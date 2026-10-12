<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaGalleries2 extends Migration
{
    public function up(): void
    {
        Schema::table('pensoft_media_galleries', function(Blueprint $table)
        {
            if (!Schema::hasColumn('pensoft_media_galleries', 'show_on_homepage')) {
                $table->boolean('show_on_homepage')->default(false);
            }
            if (!Schema::hasColumn('pensoft_media_galleries', 'show_on_ecological')) {
                $table->boolean('show_on_ecological')->default(false);
            }
        });
    }

    public function down(): void
    {
        Schema::table('pensoft_media_galleries', function(Blueprint $table)
        {
            if (Schema::hasColumn('pensoft_media_galleries', 'show_on_homepage')) {
                $table->dropColumn('show_on_homepage');
            }
            if (Schema::hasColumn('pensoft_media_galleries', 'show_on_ecological')) {
                $table->dropColumn('show_on_ecological');
            }
        });
    }
}