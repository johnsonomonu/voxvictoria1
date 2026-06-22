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
        Schema::table('general_settings', function (Blueprint $table) {
            $table->tinyInteger('whatsapp_status')->unsigned()->default(1)->after('product_review');
            $table->string('whatsapp_number', 40)->nullable()->after('whatsapp_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('general_settings', function (Blueprint $table) {
            $table->dropColumn(['whatsapp_status', 'whatsapp_number']);
        });
    }
};
