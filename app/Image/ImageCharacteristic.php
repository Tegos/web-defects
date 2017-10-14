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


	public function getIntensityByRow($threshold = 255)
	{
		$image = $this->image;
		$width = imagesx($image);
		$height = imagesy($image);
		$intensity_rows = [];

		for ($row = 0; $row < $height; $row++) {
			$concentration_sum_row = 0;
			for ($column = 0; $column < $width; $column++) {
				$color_index = imagecolorat($image, $column, $row);
				$color = imagecolorsforindex($image, $color_index); //колір пікселя
				$concentration = round(($color['red'] + $color['green'] + $color['blue']) / 3); //концентрація
				if ($concentration > $threshold) {
					$concentration = self::MAX_INTENSITY;
				}

				$concentration_sum_row += $concentration;
			}
			$intensity = round($concentration_sum_row / $width);
			
			$intensity_rows[$row] = $intensity;
		}

		return $intensity_rows;

	}


}