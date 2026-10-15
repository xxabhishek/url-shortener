<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('short_urls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('company_id');
            $table->text('original_url');
            $table->string('short_code', 10);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('short_urls');
    }
};
