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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            // $table->text('employee_name');
            // $table->text('department_name');
            // $table->text('designation_name');
            $table->string('employee_id', 10);
            $table->unsignedBigInteger('leave_type_id');
            $table->date('from_date');
            $table->date('to_date');
            $table->integer('total_days')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
