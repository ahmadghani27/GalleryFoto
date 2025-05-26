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
            $table->bigIncrements('id_photo');
            $table->unsignedBigInteger('user_id');

            $table->unsignedBigInteger('folder')->nullable(); // Ubah menjadi nullable
            $table->boolean('is_archive')->default(false); // Ubah menjadi nullable
            $table->boolean('is_favorite')->default(false);
            $table->text('file_path');
            $table->string('photo_title');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('folder')->references('id_folder')->on('folders')
                ->onUpdate('cascade');

            $table->index(['user_id', 'photo_title', 'folder']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('photos');
    }
};
