<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'posters',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('title')->comment('标题');
                $table->string('subheading')->comment('副标题');
                $table->string('qrcode_img')->comment('二维码图片');
                $table->text('poster_bg_str')->comment('base64背景图片');
                $table->string('poster_image')->default('')->comment('生成的图');
                $table->string('desc')->comment('备注');
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posters');
    }
}
