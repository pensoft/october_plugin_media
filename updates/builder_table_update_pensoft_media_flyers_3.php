<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaFlyers3 extends Migration
{
    public function up()
    {
        Schema::table('pensoft_media_flyers', function($table)
        {
            $table->boolean('stakeholder_insights')->nullable();
        });
    }
    
    public function down()
    {
        if (Schema::hasTable('pensoft_media_flyers')){
            Schema::table('pensoft_media_flyers', function($table)
            {
                $table->dropIfExists('stakeholder_insights');
            });
        }
    }
}
