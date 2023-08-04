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
            $table->string('refId');
            $table->foreignId('localisationemplacement_id')->constrained()->nullable();
            $table->foreignId('affectation_id')->constrained()->nullable();
            $table->string('modele');
            $table->string('type')->nullable();
            $table->string('fabricant')->nullable();
            $table->string('etat')->nullable();
            $table->string('designation')->nullable();
            $table->integer('quantite');
            $table->string('emplacement')->nullable();
            $table->string('provenance')->nullable();
            $table->date('date_designation');
            $table->string('observation')->nullable();
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
