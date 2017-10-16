<?php
/**
 * User: Ivan
 * Date: 30.09.2017
 * Time: 14:35
 */

namespace App\Image;


class Matrix
{
	const NUM_IN_GROUP = 3;

	public static function findDistance($i, $j, array $dataGraphIdentification, array $data)
	{
		$sum = 0;
		$row1 = $data[$dataGraphIdentification[$i][0]][$dataGraphIdentification[$i][1]];
		$row2 = $data[$dataGraphIdentification[$j][0]][$dataGraphIdentification[$j][1]];
		$num = count($row1);

		for ($k = 0; $k < $num; $k++) {
			$diff = $row1[$k] - $row2[$k];

			$sqr = pow($diff, 2);
			$sum += $sqr;
		}

		return round($sum / $num, 2);
	}

	public static function getGroups($distanceMatrix)
	{
		$group = [];

		$num = count($distanceMatrix);

		while (count($group) < self::NUM_IN_GROUP * 2) {
			var_dump(count($group));
			$localMins = [];
			for ($i = 0; $i < $num; $i++) {
				if (!in_array($i, $group)) {
					$localMins[$i] = min(array_filter($distanceMatrix[$i]));
				}
			}

			$minimum = min($localMins);
			$graphCounter = $num;

			for ($graphI = 0; $graphI < $graphCounter; $graphI++) {
				for ($graphJ = 0; $graphJ < $graphCounter; $graphJ++) {
					if ($distanceMatrix[$graphI][$graphJ] === $minimum) {
						$group[] = $graphI;
						$group[] = $graphJ;
						break;
					}
				}
			}

			$group = array_unique($group);
			if (count($group) > self::NUM_IN_GROUP) {
				//$group = array_slice($group, 0, self::NUM_IN_GROUP);
			}
		}


		//dd($minimum);
		dd($group);
		//dd($position);
		//dd($localMins);
		//dd($distanceMatrix);
		return $group;

	}


}