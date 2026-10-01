<?php namespace Pensoft\Media\Updates;

use Db;
use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class UpdatePensoftMediaVideos extends Migration
{
	public function up(): void
	{
		if (!Schema::hasTable('pensoft_media_videos')) {
			return;
		}

		// Query builder, not the Videos model: the model's Sortable trait orders
		// by sort_order, which doesn't exist yet at this point in the history.
		Db::table('pensoft_media_videos')->update(['parent_id' => 0]);

		Schema::table('pensoft_media_videos', function (Blueprint $table) {
			$table->integer('parent_id')->default(0)->change();
		});
	}

	public function down(): void
	{
		if (!Schema::hasTable('pensoft_media_videos')) {
			return;
		}

		Schema::table('pensoft_media_videos', function (Blueprint $table) {
			$table->integer('parent_id')->nullable()->change();
		});
	}
}
