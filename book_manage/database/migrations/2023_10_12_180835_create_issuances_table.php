<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssuancesTable extends Migration
{
    public function up()
    {
        Schema::create('issuances', function (Blueprint $table) {
            $table->id();
            $table->string('book_title');
            $table->string('username');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('issuances');
    }
}
