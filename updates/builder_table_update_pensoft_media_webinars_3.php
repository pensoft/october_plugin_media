<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaWebinars3 extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('pensoft_media_webinars', 'category_id')) {
            return;
        }

        Schema::table('pensoft_media_webinars', function(Blueprint $table)
        {
            $table->integer('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('pensoft_media_webinars_categories')->onDelete('SET NULL');
        });
    }

    public function down(): void
    {
        if (!Schema::hasColumn('pensoft_media_webinars', 'category_id')) {
            return;
        }

        Schema::table('pensoft_media_webinars', function(Blueprint $table)
        {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
}