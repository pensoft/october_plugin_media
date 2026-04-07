<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaVideos5 extends Migration
{
    public function up(): void
    {
        Schema::table('pensoft_media_videos', function(Blueprint $table)
        {
            $table->integer('category_id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('pensoft_media_videos', function(Blueprint $table)
        {
            $table->dropColumn('category_id');
        });
    }
}