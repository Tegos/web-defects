<?php

namespace App\Image;

class ImageCharacteristic extends AbstractImage
{
	public function getIntensity()
	{
		$image = $this->image;
		$width = imagesx($image);
		$height = imagesy($image);
		$intensity_sum = 0;
		for ($hi = 0; $hi < $height; $hi++) {
			for ($we = 0; $we < $width; $we++) {
				$color_index = imagecolorat($image, $we, $hi);
				$color = imagecolorsforindex($image, $color_index); //колір пікселя
				$intensity_one = round(($color['red'] + $color['green'] + $color['blue']) / 3);
				$intensity_sum += $intensity_one; //загальна концентрація
			}
		}
		$intensity = round($intensity_sum / ($width * $height)); //інтенсивність

		return $intensity;

	}

	/**
	 * Return intensity of image by row
	 * @param int $threshold
	 * @return array
	 */
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

	/**
	 * Return intensity of image by column
	 * @param int $threshold
	 * @return array
	 */
	public function getIntensityByColumn($threshold = 255)
	{
		$image = $this->image;
		$width = imagesx($image);
		$height = imagesy($image);
		$intensity_columns = [];

		for ($column = 0; $column < $width; $column++) {
			$concentration_sum_column = 0;
			for ($row = 0; $row < $height; $row++) {
				$color_index = imagecolorat($image, $column, $row);
				$color = imagecolorsforindex($image, $color_index); //колір пікселя
				$concentration = round(($color['red'] + $color['green'] + $color['blue']) / 3); //концентрація
				if ($concentration > $threshold) {
					$concentration = self::MAX_INTENSITY;
				}

				$concentration_sum_column += $concentration;
			}
			$intensity = round($concentration_sum_column / $height);

			$intensity_columns[$column] = $intensity;
		}
		return $intensity_columns;
	}

	/**
	 * Return silhouette of image by column
	 * @param int $threshold
	 * @return array
	 */
	public function getSilhouetteByColumnMax($threshold = 255)
	{
		$image = $this->image;
		$width = imagesx($image);
		$height = imagesy($image);
		$silhouetteColumns = [];

		for ($column = 0; $column < $width; $column++) {
			$concentrationArray = [];
			for ($row = 0; $row < $height; $row++) {
				$color_index = imagecolorat($image, $column, $row);
				$color = imagecolorsforindex($image, $color_index); //колір пікселя
				$concentration = round(($color['red'] + $color['green'] + $color['blue']) / 3); //концентрація
				if ($concentration > $threshold) {
					$concentration = self::MAX_INTENSITY;
				}

				$concentrationArray[] = $concentration;
			}
			$silhouette = max($concentrationArray);

			$silhouetteColumns[$column] = $silhouette;
		}
		return $silhouetteColumns;
	}

	/**
	 * Return silhouette of image by row
	 * @param int $threshold
	 * @return array
	 */
	public function getSilhouetteByRowMax($threshold = 255)
	{
		$image = $this->image;
		$width = imagesx($image);
		$height = imagesy($image);
		$silhouetteColumns = [];

		for ($row = 0; $row < $height; $row++) {
			$concentrationArray = [];
			for ($column = 0; $column < $width; $column++) {
				$color_index = imagecolorat($image, $column, $row);
				$color = imagecolorsforindex($image, $color_index); //колір пікселя
				$concentration = round(($color['red'] + $color['green'] + $color['blue']) / 3); //концентрація
				if ($concentration > $threshold) {
					$concentration = self::MAX_INTENSITY;
				}

				$concentrationArray[] = $concentration;
			}
			$silhouette = max($concentrationArray);

			$silhouetteColumns[$row] = $silhouette;
		}
		return $silhouetteColumns;
	}

}