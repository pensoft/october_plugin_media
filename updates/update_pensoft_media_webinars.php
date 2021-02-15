<?php namespace Pensoft\Media\Updates;

use Pensoft\Media\Models\Webinars;
use Pensoft\Media\Models\Videos;
use Schema;
use October\Rain\Database\Updates\Migration;
use System\Models\File;

class UpdatePensoftMediaWebinars extends Migration
{
	public function up()
	{
		$videos = Videos::all();

		foreach($videos as $video) {
			$webinar = new Webinars();
			$webinar->parent_id = 0;
			$webinar->name = $video->name;
			$webinar->youtube_url = $video->youtube_url;
			$webinar->vimeo_url = $video->vimeo_url;
			$webinar->nest_left = $video->nest_left;
			$webinar->nest_right = $video->nest_right;
			$webinar->nest_depth = $video->nest_depth;
			$webinar->save();

			$videoFiles = File::where('attachment_id', (string)$video->id)->where('attachment_type', 'Pensoft\Media\Models\Videos')->get();
			if(count($videoFiles)){
				foreach ($videoFiles as $videoFile){
					$file =  new File();
					$file->disk_name = $videoFile->disk_name;
					$file->file_name = $videoFile->file_name;
					$file->file_size = $videoFile->file_size;
					$file->content_type = $videoFile->content_type;
					$file->title = $videoFile->title;
					$file->description = $videoFile->description;
					$file->field = $videoFile->field;
					$file->attachment_id = $webinar->id;
					$file->attachment_type = 'Pensoft\Media\Models\Webinars';
					$file->is_public = true;
					$file->sort_order = $videoFile->sort_order;
					$file->user_id = $videoFile->user_id;
					$file->save();
				}
			}

		}
	}

	public function down()
	{

	}
}
