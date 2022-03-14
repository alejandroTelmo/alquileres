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
        Schema::create('departamentos', function (Blueprint $table) {
            $table->id();
            $table->string('address',50);
            $table->string('city',50);
            $table->string('description');
            $table->string('rooms',1);
            $table->string('toillete',1);
            $table->string('grill',1);
            $table->string('pets',1);
            $table->string('pool',1);
            $table->string('garage_description');
            $table->date('check-in')->nullable();
            $table->date('check-out')->nullable();
            $table->binary('img');
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
        Schema::dropIfExists('departamentos');
    }
};
