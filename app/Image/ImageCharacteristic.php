<?php

namespace App\Image;
class ImageCharacteristic extends AbstractImage
{

	private $realWidth;
	private $realHeight;
	private $gridWidth;
	private $gridHeight;
	private $image;

	public function __construct($image_path, $gridWidth, $gridHeight)
	{
		$image = imagecreatefromstring(file_get_contents($image_path));
		$realWidth = imagesx($image);
		$realHeight = imagesy($image);
		$this->realWidth = $realWidth;
		$this->realHeight = $realHeight;
		$this->gridWidth = $gridWidth;
		$this->gridHeight = $gridHeight;

		// create destination image
		$this->image = $image;

		// set image default background
		$white = imagecolorallocate($this->image, 255, 255, 255);
		imagefill($this->image, 0, 0, $white);
	}



}