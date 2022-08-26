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
        Schema::create('agent_groups', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('new')->default(0);
            $table->boolean('auto_assign')->default(0);
            $table->string('assign_method')->default('round_robin');
            $table->integer('counter')->nullable();
            $table->string('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agent_groups');
    }
};
