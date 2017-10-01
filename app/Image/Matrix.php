<?php
/**
 * User: Ivan
 * Date: 30.09.2017
 * Time: 14:35
 */

namespace App\Image;


class Matrix
{
	public static function findDistance($i, $j, array $dataGraphIdentification, array $data)
	{

		$sum = 0;
		$row1 = $data[$dataGraphIdentification[$i][0]][$dataGraphIdentification[$i][1]];
		$row2 = $data[$dataGraphIdentification[$j][0]][$dataGraphIdentification[$j][1]];
		//$row2 = $data[$j][$i];
		$num = count($row1);

		for ($k = 0; $k < $num; $k++) {
			//var_dump($data[$i][$k]);
			//var_dump($data[$j][$k]);
			$diff = $row1[$k] - $row2[$k];

			$sqr = pow($diff, 2);
			$sum += $sqr;
		}

		return round($sum / $num, 2);
	}

	public static function getGroups($distanceMatrix)
	{
		$firstGroup = [];

		$num = count($distanceMatrix);

		$localMins = [];
		for ($i = 0; $i < $num; $i++) {
			$localMins[$i] = min(array_filter($distanceMatrix[$i]));
		}

		$minimum = min($localMins);
		$graphCounter = $num;

		$position = [];
		for ($graphI = 0; $graphI < $graphCounter; $graphI++) {
			for ($graphJ = 0; $graphJ < $graphCounter; $graphJ++) {
				if ($distanceMatrix[$graphI][$graphJ] === $minimum) {
					$position = [$graphI, $graphJ];
				}
			}
		}



		//dd($minimum);
		//dd($position);
		//dd($localMins);
		//dd($distanceMatrix);

	}


}