<?php

namespace App\Http\Controllers\Ajax;


use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Input as Input;

class GroupChart extends Controller
{
	public function get()
	{
		$imageKeys = Input::get('imageKeys');
		$featureDataOfImages = json_decode(Input::get('featureDataOfImages'), true);

		$imageKeysData = [];
		foreach ($imageKeys as $key => $imageKey) {
			$imageKeysData[] = $imageKey;
		}

		$resultFeatures = [];

		foreach ($imageKeysData as $imageKey) {
			$resultFeatures[$imageKey] = $featureDataOfImages[$imageKey];
		}


		//var_dump($featureDataOfImages);
		//$featureDataOfImages, $keys

		return response()->json($resultFeatures);
	}
}
