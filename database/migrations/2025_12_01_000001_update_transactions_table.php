<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('type')->default('credit')->after('user_id'); // credit, debit
            $table->string('description')->nullable()->after('coins');
            $table->string('txnid')->nullable()->change(); // Make nullable for internal transactions
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['type', 'description']);
            $table->string('txnid')->nullable(false)->change();
        });
    }
};
