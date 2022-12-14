<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name',250);
            $table->string('slug',250);
            $table->text('desc')->nullable();
            $table->string('type')->nullable()->default('free');
            $table->json('columns')->nullable();
            $table->string('service_name',250)->nullable();
            $table->text('auth_token')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('categories')->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('categories');
    }
}
