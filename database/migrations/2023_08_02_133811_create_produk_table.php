<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('toko_id');
            $table->string('nama');
            $table->text('detail');
            $table->bigInteger('harga');
            $table->foreignId('bahan_kategori_produk_id');
            $table->bigInteger('stok')->default(0);
            $table->timestamps();

            $table->foreign('toko_id')->references('id')
                ->on('toko')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('bahan_kategori_produk_id')->references('id')
                ->on('bahan_kategori_produk')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk');
    }
}
