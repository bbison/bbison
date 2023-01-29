<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folder_or_files', function (Blueprint $table) {
            $table->id();
            $table->string("role_id");
            $table->string("user_id");
            $table->string("perent");
            $table->string("name");
            $table->string("type");
            $table->text("path")->nullable();
            $table->text("ekstensi")->nullable();
            $table->string("size")->default('0 kb');
            $table->string("logo")->default('https://www.seekpng.com/png/detail/12-127264_yellow-folder-png-clipart-transparent-download-open-folder.png');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('folder_or_files');
    }
};
