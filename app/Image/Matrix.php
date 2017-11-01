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
		$num = count($row1);

		for ($k = 0; $k < $num; $k++) {
			$diff = $row1[$k] - $row2[$k];

			$sqr = pow($diff, 2);
			$sum += $sqr;
		}

		return round($sum / $num, 2);
	}

	/**
	 * @param $distanceMatrix
	 * @param int $numOfGroup кількість груп
	 * @return array
	 */
	public static function getGroups($distanceMatrix, $numOfGroup = 4)
	{
		$group = [];

		$num = count($distanceMatrix);
		$elementInGroup = (int)($num / $numOfGroup);
		//dd($elementInGroup);

		$countIteration = 1;
		while (count($group) < $numOfGroup) {
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

			$countGroup = count($group);
//			if (($countGroup % 2)) {
//				if (count($group) > $numInGroup * ($numInGroup - 1)) {
//					//$group = array_slice($group, 0, self::NUM_IN_GROUP * $countIteration);
//					$group = array_slice($group, 0, $numInGroup * ($numInGroup - 1));
//				}
//			}


			$group = array_values($group);
		}

		//dd($group);

		$lastGroup = [];
		for ($i = 0; $i < $num; $i++) {
			if (!in_array($i, $group)) {
				$lastGroup[] = $i;
			}
		}

		$group = array_merge($group, $lastGroup);

		$chunk = [];

		$usedElement = [];
		for ($i = 0; $i < $numOfGroup + $elementInGroup; $i += $elementInGroup) {
			$offset = $i;
			$length = $elementInGroup;

			$part = array_slice($group, $offset, $length);
			$chunk[] = $part;
			$usedElement = array_merge($usedElement, $part);
		}

		$diff = array_diff($group, $usedElement);
		$chunk[] = $diff;

		//dd($diff);
		//dd($usedElement);
		//dd($chunk);
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

	public static function getMaxElementInGroup($groups)
	{
		$groupElements = [];
		foreach ($groups as $groupData) {
			$groupElements[] = count($groupData);
		}
		$max = max($groupElements);
		return $max;
	}

	public static function transpose($array)
	{
		return array_map(null, ...$array);
	}


}