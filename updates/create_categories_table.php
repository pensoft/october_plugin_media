<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateCategoriesTable Migration
 */
class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('pensoft_media_categories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamps();
            $table->string('name')->nullable();
            $table->integer('sort_order')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pensoft_media_categories');
    }
}
