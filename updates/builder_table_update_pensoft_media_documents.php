<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaDocuments extends Migration
{
    public function up(): void
    {
        Schema::table('pensoft_media_documents', function(Blueprint $table)
        {
            if (!Schema::hasColumn('pensoft_media_documents', 'category_id')) {
                $table->integer('category_id')->unsigned()->nullable()->index();
            }
        });
    }

    public function down(): void
    {
        Schema::table('pensoft_media_documents', function(Blueprint $table)
        {
            if (Schema::hasColumn('pensoft_media_documents', 'category_id')) {
                $table->dropColumn('category_id');
            }
        });
    }
}
