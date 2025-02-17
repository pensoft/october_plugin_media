<?php namespace Pensoft\Media\Updates;

use Pensoft\Media\Models\Galleries;
use Schema;
use October\Rain\Database\Updates\Migration;

class UpdatePensoftMediaGalleries extends Migration
{
	public function up()
	{
		if (!Schema::hasTable('pensoft_media_galleries')) {
			Schema::table('pensoft_media_galleries', function ($table) {
				$table->integer('sort_order')->default(0)->change();
			});
		}

		$galleries = Galleries::all();
		foreach($galleries as $gallery) {
			$gallery->sort_order = 0;
			$gallery->save();
		}
	}

	public function down()
	{
		Schema::table('pensoft_media_galleries', function ($table) {
			$table->integer('sort_order')->default(0)->nullable()->change();
		});
	}
}
