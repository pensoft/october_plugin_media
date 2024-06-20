<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateWebinarsCategoriesTable Migration
 */
class CreateWebinarsCategoriesTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('pensoft_media_webinars_categories')) 
        {
            Schema::create('pensoft_media_webinars_categories', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->timestamps();
                $table->string('name')->nullable();
                $table->integer('sort_order')->nullable();
            });
        }
    }

    public function down()
    {
        if (Schema::hasTable('pensoft_media_webinars_categories')) 
        {
            Schema::dropIfExists('pensoft_media_webinars_categories');
        }
    }
}
