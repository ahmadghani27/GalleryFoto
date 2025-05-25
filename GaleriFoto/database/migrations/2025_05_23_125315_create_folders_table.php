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
            $table->bigIncrements('id');
            $table->string('user_username');
            $table->string('name');
            $table->timestamps();

            $table->foreign('user_username')->references('username')->on('users')->onDelete('cascade');
            $table->index('name');
        });
    }

    public function down()
    {
        Schema::dropIfExists('folders');
    }
};
