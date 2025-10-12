<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('storage')) {
            Schema::create('storage', function (Blueprint $table) {
                $table->id('storage_id');
                $table->unsignedBigInteger('document_id');
                $table->unsignedBigInteger('staff_id');
                $table->timestamp('storage_date')->useCurrent();

                $table->foreign('document_id')
                      ->references('document_id')
                      ->on('documents')
                      ->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('storage');
    }
};
