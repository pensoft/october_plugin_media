<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreatePensoftMediaPodcasts extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('pensoft_media_podcasts')) {
            return;
        }

        Schema::create('pensoft_media_podcasts', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->string('title');
            $table->string('url');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pensoft_media_podcasts');
    }
}