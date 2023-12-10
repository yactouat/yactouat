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
        Schema::table('persisted_signed_routes', function (Blueprint $table) {
            // deleting all persisted signed routes beforehand
            DB::table('persisted_signed_routes')->delete();

            // using Laravel's 7 restful controller actions
            $table->enum('action', ['create', 'destroy', 'edit', 'index', 'show', 'store', 'update'])->nullable();
            $table->string('resource');
            $table->string('path')->default('/');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('persisted_signed_routes', function (Blueprint $table) {
            $table->dropColumn('action');
            $table->dropColumn('resource');
        });
    }
};
