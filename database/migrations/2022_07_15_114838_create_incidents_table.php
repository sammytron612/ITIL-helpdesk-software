<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->integer('sla');
            $table->integer('status');
            $table->json('status_history')->nullable();
            $table->string('title');
            $table->string('priority');
            $table->integer('category');
            $table->integer('sub_category')->nullable();
            $table->string('assigned_to')->nullable();
            $table->integer('requestor');
            $table->integer('site')->nullable();
            $table->integer('department')->nullable();
            $table->integer('re_assignments')->nullable();
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
        Schema::dropIfExists('incidents');
    }
};