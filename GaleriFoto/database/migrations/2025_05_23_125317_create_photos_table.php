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
            $table->string('user_username');
            $table->unsignedBigInteger('archive_id')->nullable(); // Ubah menjadi nullable
            $table->string('file_path');
            $table->string('file_name');
            $table->string('mime_type');
            $table->unsignedBigInteger('file_size');
            $table->text('caption')->nullable();
            $table->timestamps();

            $table->index('user_username');
            $table->index('file_name');
        });
    }

    public function down()
    {
        Schema::dropIfExists('photos');
    }
};
