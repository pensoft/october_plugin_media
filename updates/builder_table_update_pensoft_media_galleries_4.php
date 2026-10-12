<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaGalleries4 extends Migration
{
    public function up(): void
    {
        Schema::table('pensoft_media_galleries', function(Blueprint $table)
        {
            $table->boolean('related')->default(false)->change();
            $table->boolean('event_related')->default(false)->change();
            $table->boolean('show_on_homepage')->default(false)->change();
            $table->boolean('show_on_ecological')->default(false)->change();
            $table->integer('sort_order')->default(0)->change();
        });
    }

    public function down(): void
    {
        Schema::table('pensoft_media_galleries', function(Blueprint $table)
        {
            $table->boolean('related')->default(null)->change();
            $table->boolean('event_related')->default(null)->change();
            $table->boolean('show_on_homepage')->default(null)->change();
            $table->boolean('show_on_ecological')->default(null)->change();
            $table->integer('sort_order')->default(null)->change();
        });
    }
}