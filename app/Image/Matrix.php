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
//	public static function findDistance($i, $j, $num, array $data)
//	{
//
//		$sum = 0;
//		for ($k = 0; $k < $num; $k++) {
//			var_dump($data[$i][$k]);
//			var_dump($data[$j][$k]);
//			//$diff = $data[$i][$k] - $data[$j][$k];
//
//			$sqr = pow(4, 2);
//			$sum += $sqr;
//		}
//
//		return ($sum / $num);
//	}
}