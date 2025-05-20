<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('folders', function (Blueprint $table) {
        $table->id('folder_id');
        $table->unsignedBigInteger('account_id');
        $table->char('folder_name', 20);
        $table->timestamps();

        $table->foreign('account_id')->references('account_id')->on('accounts')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('folders');
    }
};
