<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreatePensoftMediaVideosCategories extends Migration
{
    public function up(): void
    {
        Schema::create('pensoft_media_videos_categories', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->string('name')->nullable();
            $table->integer('sort_order')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pensoft_media_videos_categories');
    }
}