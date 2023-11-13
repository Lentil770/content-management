<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReadingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('readings', function (Blueprint $table) {
            $table->id('reading_id');
            $table->foreignId('location_id');
            $table->text('reading_text');
            $table->text('translation')->nullable();
            $table->string('english_location_full')->nullable();
            $table->string('hebrew_location_full')->nullable();
            $table->foreignID('org_book_id')->nullable();
            $table->string('org_book_page')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('readings');
    }
}
