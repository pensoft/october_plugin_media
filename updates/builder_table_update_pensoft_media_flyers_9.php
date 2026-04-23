<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaFlyers9 extends Migration
{
    public function up(): void
    {
        Schema::table('pensoft_media_flyers', function(Blueprint $table)
        {
            $table->string('url')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('pensoft_media_flyers', function(Blueprint $table)
        {
            $table->dropColumn('url');
        });
    }
}
