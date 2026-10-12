<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

/**
 * Adds a transcript column to videos.
 *
 * WCAG 1.2.2 asks for captions; the caption track itself is an attachment
 * (Videos::$attachOne['captions']) and needs no column, but the text
 * alternative shown under the player does.
 */
class BuilderTableUpdatePensoftMediaVideos8 extends Migration
{
    public function up()
    {
        Schema::table('pensoft_media_videos', function($table)
        {
            if (!Schema::hasColumn('pensoft_media_videos', 'transcript')) {
                $table->text('transcript')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('pensoft_media_videos', function($table)
        {
            if (Schema::hasColumn('pensoft_media_videos', 'transcript')) {
                $table->dropColumn('transcript');
            }
        });
    }
}
