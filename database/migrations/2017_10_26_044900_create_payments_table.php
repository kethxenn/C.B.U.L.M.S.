<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payments', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('billing_header_id')->index('bill_header_idx');
			$table->string('code', 45);
			$table->integer('mode')->comment('0-cash 1-pdc');
			$table->date('date_issued');
			$table->date('date_collected');
			$table->integer('user_id')->index('user_id_header_idx');
			$table->float('payment', 10, 0);
			$table->boolean('status')->default(0);
			$table->string('pdf', 60);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('payments');
	}

}
