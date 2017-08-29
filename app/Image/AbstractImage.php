<?php

namespace App\Image;
abstract class AbstractImage extends ImageHelper
{

	protected $realWidth;
	protected $realHeight;
	protected $image;

	public function __construct($image_path)
	{
		$image = imagecreatefromstring(file_get_contents($image_path));
		$realWidth = imagesx($image);
		$realHeight = imagesy($image);
		$this->realWidth = $realWidth;
		$this->realHeight = $realHeight;

		// create destination image
		$this->image = $image;

		// set image default background
		$white = imagecolorallocate($this->image, 255, 255, 255);
		imagefill($this->image, 0, 0, $white);
	}

	public function __destruct()
	{
		if (!is_null($this->image)) {
			imagedestroy($this->image);
		}
	}

	public function getImage()
	{
		return $this->image;
	}

	public function setImage($image)
	{
		if (mb_strtolower(get_resource_type($image)) === 'gd') {
			$this->image = $image;
			$this->updateDimension();
		}
	}

	public function setImageByPath($image_path)
	{
		$image = imagecreatefromstring(file_get_contents($image_path));
		if (mb_strtolower(get_resource_type($image)) === 'gd') {
			$this->image = $image;
			$this->updateDimension();
		}
	}

	public function updateDimension()
	{
		$image = $this->image;
		$realWidth = imagesx($image);
		$realHeight = imagesy($image);
		$this->realWidth = $realWidth;
		$this->realHeight = $realHeight;
	}

	public function displayImage($image = null)
	{
		header("Content-type: image/png");
		if ($image) {
			imagepng($image);
		} else {
			imagepng($this->getImage());
		}

	}

	public function saveImageToFile($path, $image = null, $quality = 9)
	{
		if (!$image) {
			$image = $this->getImage();
		}
		imagepng($image, $path, $quality);
	}


}