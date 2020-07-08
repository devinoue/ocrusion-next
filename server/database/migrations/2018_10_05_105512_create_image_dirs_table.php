<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageDirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_dirs', function (Blueprint $table) {
            $table->string('book_id')->primary();
            $table->integer('user_id')->unsigned();
            $table->integer('category_id')->unsigned()->default(0);;
            $table->string('original_zip');
            $table->string('book_name')->default("");
            $table->string('description')->default("");
            $table->string('book_options')->default("");
            $table->integer('open_type')->default(0);
            $table->boolean('state')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('image_dirs');
    }
}
