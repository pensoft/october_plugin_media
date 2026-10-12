<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaNewsletters2 extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('pensoft_media_newsletters', 'file_language_versions')) {
            return;
        }

        Schema::table('pensoft_media_newsletters', function(Blueprint $table)
        {
            $table->text('file_language_versions')->nullable();
        });
    }

    public function down(): void
    {
        if (!Schema::hasColumn('pensoft_media_newsletters', 'file_language_versions')) {
            return;
        }

        Schema::table('pensoft_media_newsletters', function(Blueprint $table)
        {
            $table->dropColumn('file_language_versions');
        });
    }
}