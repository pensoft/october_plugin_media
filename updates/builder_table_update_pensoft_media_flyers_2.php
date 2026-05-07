<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaFlyers2 extends Migration
{
    public function up(): void
    {
        Schema::table('pensoft_media_flyers', function(Blueprint $table)
        {
            $table->text('file_language_versions')->nullable()->unsigned(false)->default(null)->comment(null)->change();
        });
    }

    public function down(): void
    {
        // Schema::table('pensoft_media_flyers', function(Blueprint $table)
        // {
        //     $table->string('file_language_versions', 255)->nullable()->unsigned(false)->default(null)->comment(null)->change();
        // });
    }
}