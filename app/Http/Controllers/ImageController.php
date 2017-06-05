<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input as Input;
use Illuminate\Support\Facades\Redirect;
use \App\Image as ImageModel;
use Intervention\Image\ImageManagerStatic as Image;
use \App\Image\ImageGrid;

class ImageController extends Controller
{
	public function index($id)
	{
		$id = (int)$id;
		$image_data = ImageModel::find($id);

		$file_path = public_path() . $image_data->image;

		$img = Image::make($file_path);
		$relative_path = '/uploads/' . $id . '.png';

		$img->greyscale();
		$new_file_path = public_path() . $relative_path;
		$img->save($new_file_path);

		$imageGrid = new ImageGrid (
			$new_file_path, $image_data->divide_n, $image_data->divide_m
		);
		$imageGrid->addGridToImage();
		$file_path_with_grid = '/uploads/' . $id . '_grid.png';
		$imageGrid->saveImageToFile(public_path() . $file_path_with_grid);


		//dd($id);
		//dd($image_data);
		$data = [];
		$data['image'] = $image_data;
		$data['image_edit'] = $relative_path;
		$data['image_grid'] = $file_path_with_grid;

		$p = substr(str_replace('\\', '/',
			realpath(dirname(__FILE__))),
			strlen(str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT']))));
		//$url = \Storage::disk('public')->url($new_file_path);
		//$path = public_path($url);

		//var_dump($new_file_path);
		//var_dump($p);
		//var_dump($path);


		return view('image', $data);
	}

	public function upload()
	{
		if (Input::hasFile('image')) {
			$file = Input::file('image');
			$file->move('uploads', $file->getClientOriginalName());
			$divide_n = (int)Input::get('divide_n', 10);
			$divide_m = (int)Input::get('divide_m', 10);

			$image_model = new ImageModel;

			$image_model->image = '/uploads/' . $file->getClientOriginalName();
			$image_model->divide_n = $divide_n;
			$image_model->divide_m = $divide_m;

			$image_model->save();
			return Redirect::to('image/' . $image_model->id);
		} else {
			return Redirect::to('/');
		}

	}

	public function demoGrid()
	{
		$id = (int)9;
		$image_data = ImageModel::find($id);

		$file_path = public_path() . $image_data->image;


		exit;

	}
}
