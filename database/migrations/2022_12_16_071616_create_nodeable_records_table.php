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
    Schema::create('nodeable_records', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->unsignedBigInteger('node_id');

      $table->unsignedBigInteger('nodeable_id');
      $table->string('nodeable_type');

      $table->softDeletes();
      $table->timestamps();

      $table->foreign('node_id')->references('id')->on('nodes');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('nodeable_records');
  }
};
