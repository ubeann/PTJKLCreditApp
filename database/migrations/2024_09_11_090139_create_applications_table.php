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
        Schema::create('applications', function (Blueprint $table) {
            // ID
            $table->id();

            // Data Konsumen
            $table->string('consumer_name');
            $table->string('nik')->unique();
            $table->date('birthdate');
            $table->string('marital_status');
            $table->string('spouse_data')->nullable(); // Opsional, tergantung status pernikahan

            // Data Kendaraan
            $table->string('dealer');
            $table->string('vehicle_brand');
            $table->string('vehicle_model');
            $table->string('vehicle_type');
            $table->string('vehicle_color');
            $table->decimal('vehicle_price', 20, 2);

            // Data Pinjaman
            $table->string('loan_insurance');
            $table->decimal('down_payment', 20, 2);
            $table->integer('loan_term_months');
            $table->decimal('monthly_installment', 20, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
