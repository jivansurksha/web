<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Speciality;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;

class SpecialitySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Schema::disableForeignKeyConstraints();
		Speciality::truncate();
		Schema::enableForeignKeyConstraints();

		$specialities = Arr::map(specialities(), function ($item) {
			$item['created_at'] = now();
			$item['updated_at'] = now();
			return $item;
		});
		$collection =  collect($specialities);
		$chunks = $collection->chunk(5000);
		$array = $chunks->all();
		foreach ($array as $specialities) {
			Speciality::insert($specialities->toArray());
		}
	}
}
