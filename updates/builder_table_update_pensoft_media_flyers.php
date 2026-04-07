<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaFlyers extends Migration
{
    public function up(): void
    {
        Schema::table('pensoft_media_flyers', function(Blueprint $table)
        {
            $table->string('file_language_versions')->nullable();
        });
    }

    public function down(): void
    {
        if (Schema::hasTable('pensoft_media_flyers')) {
            Schema::table('pensoft_media_flyers', function(Blueprint $table)
            {
                $table->dropColumn('file_language_versions');
            });
        }
    }
}