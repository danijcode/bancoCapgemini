<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateTableContaCorrente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conta_corrente', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('saldo');
            $table->unsignedInteger('id_agencia');
            $table->unsignedInteger('id_cliente');
            $table->timestamps();
            $table->foreign('id_agencia')->references('id')->on('agencia');
            $table->foreign('id_cliente')->references('id')->on('users');
        });

        //Inserção  de contas correntes para teste
        DB::table('conta_corrente')->insert(
            array(
                'saldo' => '1000',
                'id_agencia' => 1,
                'id_cliente' => 1,
                'created_at' => Carbon::now()
            )
        );
        DB::table('conta_corrente')->insert(
            array(
                'saldo' => '5000',
                'id_agencia' => 1,
                'id_cliente' => 1,
                'created_at' => Carbon::now()
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conta_corrente');
    }
}
