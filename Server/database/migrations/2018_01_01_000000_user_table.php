<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class UserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        
        //Inserir usuario para logar
        DB::table('users')->insert(
            array(
                'email' => 'admin@bancocap.com.br',
                'name' => 'admin',
                'password' => '$2y$10$/UB25CPnTCFmQhO0xOnM5elHuMVeNA2AGFha6Qdih1dv/69uqi7hG', //password
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
        Schema::dropIfExists('users');
    }
}