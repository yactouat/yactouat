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
        Schema::table('tags', function (Blueprint $table) {
            // deleting all tags containing capital letters
            DB::table('tags')->delete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // TODO
    }
};
