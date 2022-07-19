<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukuKasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buku_kas', function (Blueprint $table) {
            $table->id();
            $table->string('no_transaksi', 50)->unique()->index()->comment("no transaksi");
            $table->date('tanggal');
            $table->enum('jenis', ['Kas Masuk', 'Kas Keluar', 'Saldo Kas']);
            $table->double('masuk', 15, 2);
            $table->double('keluar', 15, 2);
            $table->string('keterangan');
            $table->integer('user');
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
        Schema::dropIfExists('buku_kas');
    }
}
