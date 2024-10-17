<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {

            $table->id('account_id')->autoIncrement();
            $table->string('account_number')->unique();
            $table->string('account_name');
            $table->string('date_opened')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreignId('client_id')->constrained('users', 'user_id');
            $table->string('currency');
            $table->string('amount')->default('0');
            $table->boolean('active')->default(false);
            $table->boolean('blocked')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }

};

