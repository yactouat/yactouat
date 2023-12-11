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
            $table->dropColumn('revoked');
            $table->integer('open_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('persisted_signed_routes', function (Blueprint $table) {
            $table->dropColumn('open_count');
            $table->boolean('revoked')->default(false);
        });
    }
};
