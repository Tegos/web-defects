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

		$countIteration = 1;
		while (count($group) < self::NUM_IN_GROUP - 1) {
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

			$countIteration++;

			$group = array_unique($group);
			if (count($group) > self::NUM_IN_GROUP * (self::NUM_IN_GROUP - 1)) {
				//$group = array_slice($group, 0, self::NUM_IN_GROUP * $countIteration);
				$group = array_slice($group, 0, self::NUM_IN_GROUP * (self::NUM_IN_GROUP - 1));
			}
			$group = array_values($group);
		}

		$lastGroup = [];
		for ($i = 0; $i < $num; $i++) {
			if (!in_array($i, $group)) {
				$lastGroup[] = $i;
			}
		}

		$group = array_merge($group, $lastGroup);

		$chunk = array_chunk($group, self::NUM_IN_GROUP);
		//dd($group);
		//dd($position);
		//dd($localMins);
		//dd($distanceMatrix);
		return $chunk;

	}

	public static function getTotalDistancesByGroups(array $dataGraphIdentification, array $distanceMatrix, array $groups)
	{
		$distances = [];
		foreach ($groups as $indexKey => $groupItem) {
			$distances[$indexKey] = 0;
			foreach ($groupItem as $group) {
				$i = $dataGraphIdentification[$group][0];
				$j = $dataGraphIdentification[$group][1];
				$distances[$indexKey] += $distanceMatrix[$i][$j];
				//var_dump('i', $i, 'j', $j);
				//var_dump($distanceMatrix[$i][$j]);
			}
		}
		//dd($distances);
		return $distances;
	}


}