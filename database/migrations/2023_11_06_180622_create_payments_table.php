<?php

use App\Enums\Currency;
use App\Enums\Status;
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
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->nullable(false)->autoIncrement()->unique()->primary();
            $table->text('payer_name')->nullable(false);
            $table->text('payer_email')->nullable(false);
            $table->text('payer_address')->nullable(false);
            $table->enum('status', Status::toArray())->nullable(false)->default(Status::Processing->value);
            $table->unsignedInteger('amount')->nullable(false);
            $table->enum('currency', Currency::toArray())->nullable(false)->default(Currency::EUR->value);
            $table->string('provider')->nullable(false);
            $table->timestamp('created_at')->nullable(false)->useCurrent();
            $table->timestamp('updated_at')->nullable(false)->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
