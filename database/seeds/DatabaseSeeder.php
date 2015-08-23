<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();


        $this->call('UserSeeder');
		$this->call('ConfigSeeder');
        $this->call('TagSeeder');
        $this->call('CategorySeeder');
        $this->call('PostSeeder');

	}
}