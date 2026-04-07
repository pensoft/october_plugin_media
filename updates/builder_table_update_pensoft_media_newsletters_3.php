<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaNewsletters3 extends Migration
{
    public function up(): void
    {
        Schema::table('pensoft_media_newsletters', function(Blueprint $table)
        {
            $table->integer('sort_order')->default(1);
        });
    }

    public function down(): void
    {
        Schema::table('pensoft_media_newsletters', function(Blueprint $table)
        {
            $table->dropColumn('sort_order');
        });
    }
}