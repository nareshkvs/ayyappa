<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temples', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('slug', 200)->unique();
            $table->string('photo', 2048)->nullable();
            $table->string('visibility', 10)->default('public');
            $table->boolean('status')->default(1);
            $table->boolean('featured')->default(0);
            $table->text('address');
            $table->text('city');
            $table->text('state');
            $table->text('zipcode');
            $table->integer('created_by');
            $table->integer('updated_by');
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
        Schema::dropIfExists('temples');
    }
}
