<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaFlyers3 extends Migration
{
    public function up(): void
    {
        Schema::table('pensoft_media_flyers', function(Blueprint $table)
        {
            $table->boolean('stakeholder_insights')->nullable();
        });
    }

    public function down(): void
    {
        if (Schema::hasTable('pensoft_media_flyers')){
            Schema::table('pensoft_media_flyers', function(Blueprint $table)
            {
                $table->dropIfExists('stakeholder_insights');
            });
        }
    }
}