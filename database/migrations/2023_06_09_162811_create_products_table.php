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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kategori')->constrained('categories');
            $table->foreignId('id_subkategori')->constrained('subcategories');
            $table->string('nama_produk');
            $table->string('deskripsi');
            $table->string('gambar');
            $table->string('harga');
            $table->string('diskon');
            $table->string('bahan');
            $table->string('tags');
            $table->string('sku');
            $table->string('ukuran');
            $table->string('warna');
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
        Schema::dropIfExists('products');
    }
};
