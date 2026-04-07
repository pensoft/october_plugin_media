<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaWebinars3 extends Migration
{
    public function up(): void
    {
        Schema::table('pensoft_media_webinars', function(Blueprint $table)
        {
            $table->integer('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('pensoft_media_webinars_categories')->onDelete('SET NULL');
        });
    }

    public function down(): void
    {
        Schema::table('pensoft_media_webinars', function(Blueprint $table)
        {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
}