<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaWebinars4 extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('pensoft_media_webinars', 'category_intro')) {
            return;
        }

        Schema::table('pensoft_media_webinars', function(Blueprint $table)
        {
            $table->text('category_intro')->nullable();
        });
    }

    public function down(): void
    {
        if (!Schema::hasColumn('pensoft_media_webinars', 'category_intro')) {
            return;
        }

        Schema::table('pensoft_media_webinars', function(Blueprint $table)
        {
            $table->dropColumn('category_intro');
        });
    }
}