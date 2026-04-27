<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaFlyers4 extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('pensoft_media_flyers', 'category_id')) {
            return;
        }

        Schema::table('pensoft_media_flyers', function(Blueprint $table)
        {
            $table->integer('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('pensoft_media_categories')->onDelete('SET NULL');
        });
    }

    public function down(): void
    {
        if (!Schema::hasColumn('pensoft_media_flyers', 'category_id')) {
            return;
        }

        Schema::table('pensoft_media_flyers', function(Blueprint $table)
        {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
}