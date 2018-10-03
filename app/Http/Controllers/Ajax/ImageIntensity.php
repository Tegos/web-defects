<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 28.08.2017
 * Time: 23:05
 */

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;

use \App\Image as ImageModel;
use \App\Image\ImageCharacteristic;

class ImageIntensity extends Controller
{
    public function get($id, $m, $n)
    {
        $algorithms = ImageCharacteristic::getAlgorithms();

        $image_data = ImageModel::find($id);
        $m = (int)$m;
        $n = (int)$n;
        $threshold = (int)$image_data->threshold;
        $algorithm = (int)$image_data->algorithm;
        $algorithmData = $algorithms[$algorithm];

        $imageCharacteristic = new ImageCharacteristic();
        $file_path_crop = "/uploads/{$id}_{$m}_{$n}_grid_crop.png";

        //var_dump($file_path_crop);

        $imageCharacteristic->setImageByPath(public_path() . $file_path_crop);
        //$intensityByRow = $imageCharacteristic->getIntensityByRow($threshold);

        // based data on selected feature
        if (is_callable([$imageCharacteristic, $algorithmData['feature_method']])) {
            $featureData = $imageCharacteristic->$algorithmData['feature_method']($threshold);
        } else {
            $featureData = $imageCharacteristic->getIntensityByRow($threshold);
        }

        return response()->json($featureData);
    }
}