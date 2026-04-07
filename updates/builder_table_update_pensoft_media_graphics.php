<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaGraphics extends Migration
{
    public function up(): void
    {
        if(!Schema::hasColumn('pensoft_media_graphics', 'sort_order')) {
            Schema::table('pensoft_media_graphics', function (Blueprint $table) {
                $table->integer('sort_order')->nullable()->default(1);
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('pensoft_media_graphics', 'sort_order')) {
            Schema::table('pensoft_media_graphics', function (Blueprint $table) {
                $table->dropColumn('sort_order');
            });
        }
    }
}