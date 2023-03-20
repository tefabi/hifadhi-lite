<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('node_hierarchies', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->unsignedBigInteger('node_id');

      $table->string('hierarchy', 60);
      $table->string('quantity_type', 10);

      $table->softDeletes();
      $table->timestamps();

      $table->foreign('node_id')->references('id')->on('nodes');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('node_hierarchies');
  }
};
