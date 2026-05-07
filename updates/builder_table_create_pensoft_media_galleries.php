<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreatePensoftMediaGalleries extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('pensoft_media_galleries')) {
            return;
        }

        Schema::create('pensoft_media_galleries', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('name')->nullable();
            $table->boolean('related')->default(0);
            $table->integer('article_id')->unsigned()->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pensoft_gallery_article_pivot');
        Schema::dropIfExists('pensoft_gallery_entry_pivot');
        Schema::dropIfExists('pensoft_media_galleries');
    }
}