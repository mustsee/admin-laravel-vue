<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonumentTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monument_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('monument_id')->unsigned();
            $table->integer('language_id')->unsigned();
            $table->string('name')->unique();
            $table->longText('content');
            $table->string('city');
            $table->string('country');
            $table->timestamps();
        });

        Schema::table('monument_translations', function(Blueprint $table) {
            $table->foreign('monument_id')->references('id')->on('monuments')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('monument_translations', function(Blueprint $table) {
            $table->foreign('language_id')->references('id')->on('languages')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('monument_translations', function (Blueprint $table) {
            $table->dropForeign('monument_translations_monument_id_foreign');
            $table->dropForeign('monument_translations_language_id_foreign');
        });

        Schema::dropIfExists('monument_translations');
    }
}
