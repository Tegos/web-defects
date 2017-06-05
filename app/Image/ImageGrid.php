<?php

namespace App\Image;
class ImageGrid extends \App\Image\AbstractImage
{

	private $gridWidth;
	private $gridHeight;

	public function __construct($image_path, $gridWidth, $gridHeight)
	{
		$this->gridWidth = $gridWidth;
		$this->gridHeight = $gridHeight;

		parent::__construct($image_path);


	}


	public function addGridToImage()
	{
		$black = imagecolorallocate($this->image, 0, 0, 0);
		imagesetthickness($this->image, 2);
		$cellWidth = ($this->realWidth - 1) / $this->gridWidth;   // note: -1 to avoid writting
		$cellHeight = ($this->realHeight - 1) / $this->gridHeight; // a pixel outside the image
		for ($x = 0; ($x <= $this->gridWidth); $x++) {
			for ($y = 0; ($y <= $this->gridHeight); $y++) {
				imageline($this->image, ($x * $cellWidth), 0, ($x * $cellWidth), $this->realHeight, $black);
				imageline($this->image, 0, ($y * $cellHeight), $this->realWidth, ($y * $cellHeight), $black);
			}
		}
	}

}