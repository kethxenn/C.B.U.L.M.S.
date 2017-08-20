<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCurrentContractsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('current_contracts', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('contract_header')->index('contract_header_curretn_idx');
			$table->string('code', 45);
			$table->integer('user_id')->index('user_id_idx');
			$table->date('date_issued');
			$table->date('date_of_billing');
			$table->date('end_of_contract');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('current_contracts');
	}

}
