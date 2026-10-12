<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaPressreleases extends Migration
{
    public function up(): void
    {
        Schema::table('pensoft_media_pressreleases', function(Blueprint $table)
        {
            if (!Schema::hasColumn('pensoft_media_pressreleases', 'parent_id')) {
                $table->integer('parent_id')->nullable();
            }
            if (!Schema::hasColumn('pensoft_media_pressreleases', 'nest_left')) {
                $table->integer('nest_left')->nullable();
            }
            if (!Schema::hasColumn('pensoft_media_pressreleases', 'nest_right')) {
                $table->integer('nest_right')->nullable();
            }
            if (!Schema::hasColumn('pensoft_media_pressreleases', 'nest_depth')) {
                $table->integer('nest_depth')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('pensoft_media_pressreleases', function(Blueprint $table)
        {
            if (Schema::hasColumn('pensoft_media_pressreleases', 'parent_id')) {
                $table->dropColumn('parent_id');
            }
            if (Schema::hasColumn('pensoft_media_pressreleases', 'nest_left')) {
                $table->dropColumn('nest_left');
            }
            if (Schema::hasColumn('pensoft_media_pressreleases', 'nest_right')) {
                $table->dropColumn('nest_right');
            }
            if (Schema::hasColumn('pensoft_media_pressreleases', 'nest_depth')) {
                $table->dropColumn('nest_depth');
            }
        });
    }
}