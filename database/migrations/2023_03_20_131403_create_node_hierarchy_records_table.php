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
    Schema::create('node_hierarchy_records', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->unsignedBigInteger('node_hierarchy_id');
      $table->unsignedBigInteger('nodeable_record_id');

      $table->softDeletes();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('node_hierarchy_records');
  }
};
