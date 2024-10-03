<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreatePensoftMediaPressCategories extends Migration
{
    public function up()
    {
        Schema::create('pensoft_media_press_categories', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->integer('sort_order')->nullable()->default(1);
            $table->string('title');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('pensoft_media_press_categories');
    }
}
