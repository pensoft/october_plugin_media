<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaGalleries extends Migration
{
    public function up(): void
    {
        Schema::table('pensoft_media_galleries', function(Blueprint $table)
        {
            $table->boolean('event_related')->default(0);
            $table->integer('event_id')->unsigned()->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('pensoft_media_galleries', function(Blueprint $table)
        {
            $table->dropColumn('event_related');
            $table->dropColumn('event_id');
        });
    }
}