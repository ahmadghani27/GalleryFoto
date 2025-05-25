<?php
// database/migrations/2025_05_23_194603_create_photos_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('archive_id');
            $table->text('file_path');
            $table->text('caption')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('archive_id')->references('id')->on('archives')->onDelete('cascade');
            $table->index('user_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('photos');
    }
};