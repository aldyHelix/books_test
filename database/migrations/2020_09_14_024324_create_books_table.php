<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->integer('total_page')->nullable();
            $table->integer('rating')->default(0);
            $table->string('isbn');
            $table->string('publisher');
            $table->date('available_from')->nullable();
            $table->date('available_until')->nullable();
            $table->date('published_date');
            $table->integer('price')->default(0);
            $table->boolean('is_available')->default(1); //sold out = 0 / available = 1
            $table->text('description')->nullable();
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
        Schema::dropIfExists('books');
    }
}
