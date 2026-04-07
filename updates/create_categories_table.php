<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateCategoriesTable Migration
 */
class CreateCategoriesTable extends Migration
{
    public function up(): void
    {
        Schema::create('pensoft_media_categories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamps();
            $table->string('name')->nullable();
            $table->integer('sort_order')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pensoft_media_categories');
    }
}