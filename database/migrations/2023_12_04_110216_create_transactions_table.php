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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('transfer_id')->autoIncrement(); // Assuming a foreign key relationship for transfers
            $table->foreignId('sender')->nullable()->constrained('accounts', 'account_id');
            $table->foreignId('receiver')->nullable()->constrained('accounts', 'account_id');
            $table->string('senderNumber')->nullable();
            $table->string('receiverNumber')->nullable();
            $table->string('amount');
            $table->string('date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->unsignedTinyInteger('type'); // 1: deposit, 2: withdrawal, 3: transfer
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
