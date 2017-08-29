<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBillingDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('billing_details', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('billing_header_id')->index('fk_bill_bill_idx');
			$table->integer('billing_item_id')->index('fk_bill_item_idx');
			$table->string('description', 45);
			$table->float('price', 10, 0);
			$table->integer('status')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('billing_details');
	}

}
