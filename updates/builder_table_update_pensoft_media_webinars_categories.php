<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaWebinarsCategories extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('pensoft_media_webinars_categories', 'category_intro')) {
            return;
        }

        Schema::table('pensoft_media_webinars_categories', function(Blueprint $table)
        {
            $table->text('category_intro')->nullable();
        });
    }

    public function down(): void
    {
        if (!Schema::hasColumn('pensoft_media_webinars_categories', 'category_intro')) {
            return;
        }

        Schema::table('pensoft_media_webinars_categories', function(Blueprint $table)
        {
            $table->dropColumn('category_intro');
        });
    }
}