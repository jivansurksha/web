<?php

namespace Database\Seeders;

use App\Models\City;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;

class CitySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Schema::disableForeignKeyConstraints();
		City::truncate();
		Schema::enableForeignKeyConstraints();

		$cities = Arr::map(cities(), function ($item) {
			$item['created_at'] = now();
			$item['updated_at'] = now();
			return $item;
		});
		$collection =  collect($cities);
		$chunks = $collection->chunk(5000);
		$array = $chunks->all();
		foreach ($array as $cities) {
			City::insert($cities->toArray());
		}
	}
}
