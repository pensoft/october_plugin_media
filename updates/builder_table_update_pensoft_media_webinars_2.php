<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaWebinars2 extends Migration
{
    public function up(): void
    {
        Schema::table('pensoft_media_webinars', function(Blueprint $table)
        {
            $table->integer('parent_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('pensoft_media_webinars', function(Blueprint $table)
        {
            $table->integer('parent_id')->nullable(false)->change();
        });
    }
}