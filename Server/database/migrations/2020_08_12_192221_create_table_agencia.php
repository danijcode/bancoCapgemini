<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateTableAgencia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agencia', function (Blueprint $table) {
            $table->increments('id');
            $table->string('desc_agencia',50);
            $table->integer('numero_agencia');
            $table->unsignedInteger('id_banco');
            $table->timestamps();
            $table->foreign('id_banco')->references('id')->on('banco');
        });

        //Inserção do Banco Capgemini
        DB::table('agencia')->insert(
            array(
                'desc_agencia' => 'Agencia 01',
                'numero_agencia' => '0001',
                'id_banco' => 1,
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
        Schema::dropIfExists('agencia');
    }
}
