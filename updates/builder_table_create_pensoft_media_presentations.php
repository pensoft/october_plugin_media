<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreatePensoftMediaPresentations extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('pensoft_media_presentations')) {
            Schema::create('pensoft_media_presentations', function($table)
            {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->timestamp('created_at')->nullable();
                $table->timestamp('updated_at')->nullable();
                $table->string('name');
            });
        }
    }
    
    public function down()
    {
        if (Schema::hasTable('pensoft_media_presentations')) {
            Schema::dropIfExists('pensoft_media_presentations');
        }
    }
}
