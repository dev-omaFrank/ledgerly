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
        if (!Schema::hasTable('payments')) {
            Schema::create('payments', function (Blueprint $table) {
                $table->id();

                $table->foreignId('user_id')->constrained()->cascadeOnDelete();

                $table->integer('amount'); // kobo
                $table->string('currency')->default('NGN');

                $table->string('status'); // success, failed

                $table->string('paystack_reference')->unique();
                $table->string('paystack_transaction_id')->nullable()->unique()->after('id');
                $table->string('paystack_event')->nullable();
                $table->string('paystack_customer_code')->nullable();
                $table->string('paystack_subscription_code')->nullable()->unique();
                $table->string('paystack_plan_code')->nullable();

                $table->string('channel')->nullable();
                $table->integer('fees')->nullable();

                $table->timestamp('paid_at')->nullable();

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
