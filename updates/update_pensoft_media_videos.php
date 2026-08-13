<?php namespace Pensoft\Media\Updates;

use DB;
use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class UpdatePensoftMediaVideos extends Migration
{
	public function up(): void
	{
		if (Schema::hasTable('pensoft_media_videos')) {
			Schema::table('pensoft_media_videos', function (Blueprint $table) {
				$table->integer('parent_id')->default(0)->change();
			});

			DB::table('pensoft_media_videos')->update(['parent_id' => 0]);
		}
	}

	public function down(): void
	{
		if (Schema::hasTable('pensoft_media_videos')) {
			Schema::table('pensoft_media_videos', function (Blueprint $table) {
				$table->integer('parent_id')->nullable()->change();
			});
		}
	}
}
