<?php
// database/migrations/2025_05_23_194602_create_archives_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('archives', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_username');
            $table->string('password');
            $table->text('file_path');
            $table->timestamps();

            $table->foreign('user_username')->references('username')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
                
            $table->index('user_username','password');
        });
    }

    public function down()
    {
        Schema::dropIfExists('archives');
    }
};
