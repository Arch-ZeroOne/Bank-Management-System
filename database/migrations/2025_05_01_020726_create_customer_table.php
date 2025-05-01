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
        Schema::create('customer', function (Blueprint $table) {
            $table -> id();
            $table -> string('first_name');
            $table -> string("last_name");
            $table -> date('date_of_birth');
            $table -> string('email');
            $table -> integer('phone_number');
            $table -> string('adddress');
            $table -> date('date_joined');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer');
    }
};
