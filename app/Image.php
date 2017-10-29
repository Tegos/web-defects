<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
	public $incrementing = true;

	public static function find($key)
	{
		$obj = Image::where('id', $key)->limit(1);

		if ($obj->count() == 0)
			throw new \Exception('Image not found.');

		$imageData = $obj->first();

		$n = $imageData->divide_n; // cols
		$m = $imageData->divide_m; // rows
		$threshold = (int)$imageData->threshold;
		$algorithm = (int)$imageData->algorithm;

		if ($n < 1 || $n > 20) {
			$imageData->divide_n = 1;
		}

		if ($m < 1 || $m > 20) {
			$imageData->divide_m = 1;
		}

		if ($threshold < 1 || $threshold > 255) {
			$imageData->threshold = 255;
		}


		return $imageData;
	}
}
