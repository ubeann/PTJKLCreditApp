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
        Schema::create('approvals', function (Blueprint $table) {
            Schema::create('approvals', function (Blueprint $table) {
                $table->id();
                $table->foreignId('application_id')->constrained()->onDelete('cascade');
                $table->foreignId('approver_id')->constrained('users');
                $table->string('status');
                $table->text('remarks')->nullable();
                $table->timestamps();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approvals');
    }
};
