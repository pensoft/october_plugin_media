<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreatePensoftMediaDocumentsCategories extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('pensoft_media_documents_categories')) {
            return;
        }

        Schema::create('pensoft_media_documents_categories', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('title');
            $table->integer('sort_order')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pensoft_media_documents_categories');
    }
}
