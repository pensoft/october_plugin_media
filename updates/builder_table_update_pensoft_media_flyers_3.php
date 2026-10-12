<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaFlyers3 extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('pensoft_media_flyers', 'stakeholder_insights')) {
            return;
        }

        Schema::table('pensoft_media_flyers', function(Blueprint $table)
        {
            $table->boolean('stakeholder_insights')->nullable();
        });
    }

    public function down(): void
    {
        if (!Schema::hasColumn('pensoft_media_flyers', 'stakeholder_insights')) {
            return;
        }

        Schema::table('pensoft_media_flyers', function(Blueprint $table)
        {
            $table->dropColumn('stakeholder_insights');
        });
    }
}