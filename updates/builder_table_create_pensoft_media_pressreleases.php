<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreatePensoftMediaPressreleases extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('pensoft_media_pressreleases')) {
            Schema::create('pensoft_media_pressreleases', function($table)
            {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->timestamp('created_at')->nullable();
                $table->timestamp('updated_at')->nullable();
                $table->string('name');
                $table->date('date')->nullable();
                $table->text('description')->nullable();
                $table->text('link')->nullable();
                $table->text('link_cordis')->nullable();
            });
        }
    }
    
    public function down()
    {
        if (Schema::hasTable('pensoft_media_pressreleases')) {
            Schema::dropIfExists('pensoft_media_pressreleases');
        }
    }
}
