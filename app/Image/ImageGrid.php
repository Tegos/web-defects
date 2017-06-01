<?php

namespace App\Image;
class ImageGrid
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
		//$this->image = imagecreatetruecolor($realWidth, $realHeight);
		$this->image = $image;

		// set image default background
		$white = imagecolorallocate($this->image, 255, 255, 255);
		imagefill($this->image, 0, 0, $white);
	}

	public function __destruct()
	{
		imagedestroy($this->image);
	}

	public function demoGrid()
	{
		$black = imagecolorallocate($this->image, 0, 0, 0);
		imagesetthickness($this->image, 3);
		$cellWidth = ($this->realWidth - 1) / $this->gridWidth;   // note: -1 to avoid writting
		$cellHeight = ($this->realHeight - 1) / $this->gridHeight; // a pixel outside the image
		for ($x = 0; ($x <= $this->gridWidth); $x++) {
			for ($y = 0; ($y <= $this->gridHeight); $y++) {
				imageline($this->image, ($x * $cellWidth), 0, ($x * $cellWidth), $this->realHeight, $black);
				imageline($this->image, 0, ($y * $cellHeight), $this->realWidth, ($y * $cellHeight), $black);
			}
		}
	}

	public function getImage()
	{
		return $this->image;
	}

	public function display()
	{
		header("Content-type: image/png");
		imagepng($this->image);
	}

}