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
        Schema::create('followers', function (Blueprint $table) {
            $table->id();
            // Internamente debido a las convenciones, laravel busca la tabla users (en plural) y lo vincula con la columna id
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            // En este caso la columna follower_id debe almacenar un id de usuario, pero según las convenciones sí no se
            // le especificaría la columna intentaría buscar en la tabla followers, lo cual sería parajodico en este caso
            // Entonces para poder setear manualmente con que tabla va a hacer la lalve foranea, se coloca el nombre
            // de la tabla (en plural) como argumento en el constrained
            $table->foreignId('follower_id')->constrained('users')->onDelete('cascade'); 

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
        Schema::dropIfExists('followers');
    }
};
