<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreatePensoftMediaGraphics extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('pensoft_media_graphics')) {
            return;
        }

        Schema::create('pensoft_media_graphics', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('name')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pensoft_media_graphics');
    }
}