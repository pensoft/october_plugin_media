<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreatePensoftMediaLogos extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('pensoft_media_logos')) {
            Schema::create('pensoft_media_logos', function($table)
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
        if (Schema::hasTable('pensoft_media_logos')) {
            Schema::dropIfExists('pensoft_media_logos');
        }
    }
}
