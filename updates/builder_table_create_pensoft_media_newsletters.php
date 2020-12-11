<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreatePensoftMediaNewsletters extends Migration
{
    public function up()
    {
        Schema::create('pensoft_media_newsletters', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->date('date')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('name');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('pensoft_media_newsletters');
    }
}
