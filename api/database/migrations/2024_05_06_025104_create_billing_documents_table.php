<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('billing_documents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('billing_id')->index();
            $table->string('name');
            $table->string('government_id');
            $table->string('email');
            $table->integer('debt_amount');
            $table->date('debt_due_date');
            $table->uuid('debt_id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billing_documents');
    }
};
