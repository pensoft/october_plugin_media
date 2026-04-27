<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaNewsletters2 extends Migration
{
    public function up(): void
    {
        Schema::table('pensoft_media_newsletters', function(Blueprint $table)
        {
            $table->text('file_language_versions')->nullable();
        });
    }

    public function down(): void
    {
        if( Schema::hasTable('pensoft_media_newsletters')){
            Schema::table('pensoft_media_newsletters', function(Blueprint $table)
            {
                $table->dropIfExists('file_language_versions');
            });
        }
    }
}