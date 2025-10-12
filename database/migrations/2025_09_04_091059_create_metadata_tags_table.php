<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('metadata_tags')) {
            Schema::create('metadata_tags', function (Blueprint $table) {
                $table->id('metadata_id');
                $table->unsignedBigInteger('document_id');
                $table->string('tag');
                $table->string('value')->nullable();

                $table->foreign('document_id')
                      ->references('document_id')
                      ->on('documents')
                      ->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('metadata_tags');
    }
};
