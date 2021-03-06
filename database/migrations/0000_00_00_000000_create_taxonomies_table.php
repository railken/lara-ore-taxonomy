<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class CreateTaxonomiesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(Config::get('amethyst.taxonomy.data.taxonomy.table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->string('code')->nullable();
            $table->text('description')->nullable();
            $table->boolean('enabled')->default(1);
            $table->integer('weight')->default(0);
            $table->string('icon')->nullable();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->foreign('parent_id')->references('id')->on(Config::get('amethyst.taxonomy.data.taxonomy.table'));
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(Config::get('amethyst.taxonomy.data.taxonomy.table'));
    }
}
