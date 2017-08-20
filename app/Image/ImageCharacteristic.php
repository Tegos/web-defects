<?php

namespace App\Image;
class ImageCharacteristic extends AbstractImage
{

	public function __construct()
	{

	}

	public function getIntensity()
	{
		$image = $this->image;
		$width = imagesx($image);
		$height = imagesy($image);
		$concentration_sum = 0;
		for ($hi = 0; $hi < $height; $hi++) {
			for ($we = 0; $we < $width; $we++) {
				$color_index = imagecolorat($image, $we, $hi);
				$color = imagecolorsforindex($image, $color_index); //колір пікселя
				$concentration = round(($color['red'] + $color['green'] + $color['blue']) / 3); //концентрація
				$concentration_sum += $concentration; //загальна концентрація
			}
		}
		$intensity = round($concentration_sum / ($width * $height)); //інтенсивність

		return $intensity;

	}


}