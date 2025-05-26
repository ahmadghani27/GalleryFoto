<?php
// database/migrations/2025_05_23_194601_create_folders_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('folders', function (Blueprint $table) {
            $table->bigIncrements('id_folder');
            $table->unsignedBigInteger('user_id');

            $table->string('name_folder');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->index(['name_folder', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('folders');
    }
};
