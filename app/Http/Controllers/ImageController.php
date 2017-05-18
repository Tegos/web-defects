<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input as Input;
use Illuminate\Support\Facades\Redirect;
use \App\Image as ImageModel;
use Intervention\Image\ImageManagerStatic as Image;

class ImageController extends Controller
{
	public function index($id)
	{
		$id = (int)$id;
		$image_data = ImageModel::find($id);

		$file_path = public_path() . $image_data->image;

		$img = Image::make($file_path);

		$img->invert();
		$new_file_path = public_path() . '/uploads/' . $id . '.png';
		$img->save($new_file_path);

		//dd($id);
		//dd($image_data);
		$data = [];
		$data['image'] = $image_data;
		$data['image_edit'] = \Storage::url($new_file_path, 'public');

		$url = \Storage::disk('public')->url($new_file_path);
		$path = public_path($url);

		//dd($path);

		return view('image', $data);
	}

	public function upload()
	{
		if (Input::hasFile('image')) {
			$file = Input::file('image');
			$file->move('uploads', $file->getClientOriginalName());

			$image_model = new ImageModel;

			$image_model->image = '/uploads/' . $file->getClientOriginalName();

			$image_model->save();
			return Redirect::to('image/' . $image_model->id);
		} else {
			return Redirect::to('/');
		}

	}
}
