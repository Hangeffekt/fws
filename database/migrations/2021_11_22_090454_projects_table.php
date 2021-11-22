<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->integer("id")->autoIncrement();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('status')->nullable();
            $table->json('contacts')->nullable();
            $table->timestamp('update')->useCurrentOnUpdate()->nullable();
            $table->timestamp('create')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
