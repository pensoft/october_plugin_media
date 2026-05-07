<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreatePensoftMediaNewsletters extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('pensoft_media_newsletters')) {
            Schema::create('pensoft_media_newsletters', function(Blueprint $table)
            {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->date('date')->nullable();
                $table->timestamp('created_at')->nullable();
                $table->timestamp('updated_at')->nullable();
                $table->string('name');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('pensoft_media_newsletters')) {
            Schema::dropIfExists('pensoft_media_newsletters');
        }
    }
}