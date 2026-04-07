<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaNewsletters extends Migration
{
    public function up(): void
    {
        Schema::table('pensoft_media_newsletters', function(Blueprint $table)
        {
            $table->string('url')->nullable();
        });
    }

    public function down(): void
    {
        if (Schema::hasColumn('pensoft_media_newsletters', 'url')){
            Schema::table('pensoft_media_newsletters', function(Blueprint $table)
            {
                $table->dropColumn('url');
            });
        }
    }
}