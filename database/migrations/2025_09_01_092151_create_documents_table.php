<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    { 
        if (!Schema::hasTable('documents')) {
            Schema::create('documents', function (Blueprint $table) {
                $table->id('document_id');
                $table->unsignedBigInteger('staff_id');
                $table->string('title');
                $table->string('file_path');
                $table->string('file_type');
                $table->timestamp('upload_date')->useCurrent();
                $table->string('uploaded_by')->nullable();
                $table->string('category');
                $table->string('meeting_type')->nullable();

                $table->foreign('staff_id')->references('id')->on('staff')->onDelete('cascade');
            });
        }
    }

};

