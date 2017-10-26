<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRegistrationRequirementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('registration_requirements', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('registration_header_id')->index('regi_req_idx');
			$table->integer('requirement_id')->index('req_regi_idx');
			$table->boolean('is_fulfilled')->default(0)->comment('0-unverified
1-fulfilled
2-needs revision');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('registration_requirements');
	}

}
