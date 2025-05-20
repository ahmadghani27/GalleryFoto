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
    Schema::create('photos', function (Blueprint $table) {
        $table->id('image_id');
        $table->unsignedBigInteger('account_id');
        $table->unsignedBigInteger('folder_id')->nullable();
        $table->char('image_name', 20);
        $table->string('file_image');
        $table->string('url_image', 255);
        $table->date('date_image');
        $table->boolean('is_arsiped')->default(false);
        $table->boolean('is_favorite')->default(false);
        

        $table->foreign('account_id')->references('account_id')->on('accounts')->onDelete('cascade');
        $table->foreign('folder_id')->references('folder_id')->on('folders')->onDelete('set null');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
