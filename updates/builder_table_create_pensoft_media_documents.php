<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreatePensoftMediaDocuments extends Migration
{
    public function up()
    {
        if(!Schema::hasTable('pensoft_media_documents'))
        {
            Schema::create('pensoft_media_documents', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->integer('sort_order')->nullable();
                $table->string('title')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        if(Schema::hasTable('pensoft_media_documents'))
        {
            Schema::dropIfExists('pensoft_media_documents');
        }
    }

}
