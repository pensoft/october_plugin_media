<?php namespace Pensoft\Media\Updates;

use Pensoft\Media\Models\Videos;
use Schema;
use October\Rain\Database\Updates\Migration;

class UpdatePensoftMediaVideos extends Migration
{
	public function up()
	{
		if (!Schema::hasTable('pensoft_media_videos')) {
			Schema::table('pensoft_media_videos', function ($table) {
				$table->integer('parent_id')->default(0)->change();
			});
		}

		$videos = Videos::all();
		foreach($videos as $video) {
			$video->parent_id = 0;
			$video->save();
		}
	}

	public function down()
	{
		Schema::table('pensoft_media_videos', function ($table) {
			$table->integer('parent_id')->nullable()->change();
		});
	}
}
