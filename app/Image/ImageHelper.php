<?php
/**
 * Created by PhpStorm.
 * User: tegos
 * Date: 25.07.2017
 * Time: 9:12
 */

namespace App\Image;

class ImageHelper
{
    /**
     * Convert RGB colors array into HSL array
     *
     * @param array $rgb colors set, each color component with range 0 to 255
     * @return array HSL set, each color component with range 0 to 1
     */
    public function rgb2hsl($rgb)
    {
        $clrR = ($rgb[0]);
        $clrG = ($rgb[1]);
        $clrB = ($rgb[2]);

        $clrMin = min($clrR, $clrG, $clrB);
        $clrMax = max($clrR, $clrG, $clrB);
        $deltaMax = $clrMax - $clrMin;

        $L = ($clrMax + $clrMin) / 510;

        if (0 == $deltaMax) {
            $H = 0;
            $S = 0;
        } else {
            if (0.5 > $L) {
                $S = $deltaMax / ($clrMax + $clrMin);
            } else {
                $S = $deltaMax / (510 - $clrMax - $clrMin);
            }

            if ($clrMax == $clrR) {
                $H = ($clrG - $clrB) / (6.0 * $deltaMax);
            } else if ($clrMax == $clrG) {
                $H = 1 / 3 + ($clrB - $clrR) / (6.0 * $deltaMax);
            } else {
                $H = 2 / 3 + ($clrR - $clrG) / (6.0 * $deltaMax);
            }

            if (0 > $H) $H += 1;
            if (1 < $H) $H -= 1;
        }
        return array($H, $S, $L);
    }

    public static function getAlgorithms()
    {
        return [
            1 =>
                [
                    'name' => 'Інтенсивність по рядках',
                    'feature_method' => 'getIntensityByRow',
                    'feature' => 'Інтенсивність',
                    'y_feature_text' => 'Середня інтенсивність',
                    'text' => 'по рядках',
                ],
            2 =>
                [
                    'name' => 'Інтенсивність по стовпцях',
                    'feature_method' => 'getIntensityByColumn',
                    'feature' => 'Інтенсивність',
                    'y_feature_text' => 'Середня інтенсивність',
                    'text' => 'по стовпцях',
                ],

            3 =>
                [
                    'name' => 'Силует по рядках',
                    'feature_method' => 'getSilhouetteByRowMax',
                    'feature' => 'Силует',
                    'y_feature_text' => 'Силует',
                    'text' => 'по рядках',
                ],
            4 =>
                [
                    'name' => 'Силует по стовпцях',
                    'feature_method' => 'getSilhouetteByColumnMax',
                    'feature' => 'Силует',
                    'y_feature_text' => 'Силует',
                    'text' => 'по стовпцях',
                ],
        ];
    }
}