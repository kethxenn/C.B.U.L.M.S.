<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInquiryHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquiry_headers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name',45);
            $table->string('middle_name',45)->nullable();
            $table->string('last_name',45);
            $table->string('email',45);
            $table->string('contract_num',15);
            $table->string('remarks',255)->nullable();
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
        Schema::dropIfExists('inquiry_headers');
    }
}
