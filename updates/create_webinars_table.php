<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateWebinarsTable extends Migration
{
    public function up()
    {
        Schema::create('pensoft_media_webinars', function (Blueprint $table) {
            $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
			$table->timestamp('created_at')->nullable();
			$table->timestamp('updated_at')->nullable();
			$table->string('name');
			$table->string('youtube_url')->nullable();
			$table->string('vimeo_url', 255)->nullable();
			$table->integer('parent_id')->default(0);
			$table->integer('nest_left')->nullable();
			$table->integer('nest_right')->nullable();
			$table->integer('nest_depth')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pensoft_media_webinars');
    }

}
