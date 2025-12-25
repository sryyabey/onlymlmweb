<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('doc_content_doc_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doc_content_id')->constrained('doc_contents')->cascadeOnDelete();
            $table->foreignId('doc_tag_id')->constrained('doc_tags')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['doc_content_id', 'doc_tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doc_content_doc_tag');
    }
};
