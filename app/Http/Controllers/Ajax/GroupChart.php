<?php

namespace App\Http\Controllers\Ajax;


use App\Http\Controllers\Controller;

use \App\Image as ImageModel;
use \App\Image\ImageCharacteristic;

class GroupChart extends Controller
{
	public function get()
	{
		//$featureDataOfImages, $keys

		return response()->json(['909']);
	}
}
