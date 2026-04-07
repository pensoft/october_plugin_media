<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaWebinars5 extends Migration
{
    public function up(): void
    {
        Schema::table('pensoft_media_webinars', function(Blueprint $table)
        {
            $table->text('description')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('pensoft_media_webinars', function(Blueprint $table)
        {
            $table->dropColumn('description');
        });
    }
}