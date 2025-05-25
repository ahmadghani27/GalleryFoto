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
            $table->unsignedBigInteger('archive_id');
            $table->string('file_path'); // Menyimpan path relatif ke file di storage
            $table->string('file_name'); // Nama asli file
            $table->string('mime_type'); // Tipe MIME (image/jpeg, image/png, dll)
            $table->unsignedBigInteger('file_size'); // Ukuran file dalam bytes
            $table->text('caption')->nullable();
            $table->timestamps();

            $table->foreign('user_username')->references('username')->on('users')->onDelete('cascade');
            $table->foreign('archive_id')->references('id')->on('archives')->onDelete('cascade');
            $table->index('user_username');
        });
    }

    public function down()
    {
        Schema::dropIfExists('photos');
    }
};
