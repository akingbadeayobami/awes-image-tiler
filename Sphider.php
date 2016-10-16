<?php

class AwesPhotoTiler{

	protected $_images = [];

	protected $_container = [700,700];

	protected $_rows = 5;

	protected $_rowsImages = [];

	protected $_rawImageSizes = [];

	protected $_processedImageSizes = [];

	public function tile(){

		$this->assignImagesPerRow();

		$this->getImagesSize();

		$this->tileTheRows();

		$this->showMe();

	}

	protected function processImageRow($rowImages,$amountOfImages){

		$processed = [];

		$totalWidth = 0;

		foreach($rowImages as $eachImage){

			$totalWidth += $eachImage[0];

		}

		$scale = $this->_container[0] / $totalWidth;

		foreach($rowImages as $eachImage){

			$newWidth = $eachImage[0] * $scale;

			$newHeight = $newWidth / $eachImage[2];
   	// 	$aspectRatio = $width/$height;
			// recalculate the width again so that it fits
    // make sur each width equal container width
			$processed[] = [floor($newWidth), floor($newHeight)];

		}

		return $processed;

	}

	protected function tileTheRows(){

		$imagesTaken = 0;

		foreach($this->_rowsImages as $amountOfImages){

			$rowImages = array_slice($this->_rawImageSizes,$imagesTaken,$amountOfImages);

			$this->_processedImageSizes[] = $this->processImageRow($rowImages,$amountOfImages);

			$imagesTaken += $amountOfImages;

		}

	}

	protected function getImagesSize(){

		foreach($this->_images as $index => $image){

			list($width,$height) = getimagesize($image);

			$aspectRatio = $width/$height;

			$this->_rawImageSizes[] = [$width,$height,$aspectRatio];

		}

			//self::$desiredHeight[] = self::$height;


	 	//	self::$desiredWidth[] = round($aspectRatio * self::$height);

			//$rowWidth += round($aspectRatio * self::$height);

	}

	protected function assignImagesPerRow(){

		// calculate the number of images each row will hold
		$imagesEachRowWillHold = floor( count($this->_images) / $this->_rows );

		// need to know the extra columns that will be remaining
		$extraImagesToBeRemaining = count($this->_images) % $this->_rows;

		// looping to assign the number of images each row will contain
		for($i = 1; $i <= $this->_rows; $i++){

				// check if image as extra image to possess
				$thisRowtoHold = ($i <= $extraImagesToBeRemaining ) ? $imagesEachRowWillHold + 1 : $imagesEachRowWillHold;

				$this->_rowsImages['row' . $i] = $thisRowtoHold;

		}

	}

	public function showMe(){

		foreach($this->_processedImageSizes as $imageRow){

			echo '<div class="">';

				foreach($imageRow as $image){

					echo '<img src="' . . '" width="' . .  '" height=" ' . . '" >';

				}

			echo "</div>";

		}

	}

	public function arraylize($input){

		return explode(',',$input);

	}

	// Setters

	public function setRows($rows){

		$this->_rows = $rows;

		return $this;

	}

	public function setHeight($height){

		$this->_container[1] = $height;

		return $this;

	}

	public function setWidth($width){

		$this->_container[0] = $width;

		return $this;

	}

	public function setImages($images){

		$this->_images = $this->arraylize($images);

		return $this;

	}


}



/*
class Sphider{

	public static $images = [];

	public static $align = "H"; // Vertical

	public static $height = "100"; // pixels

	public static $width = "100";

	public static $class = "img-reponsive";

	public static $arranged = "";

	public static $desiredHeight = [];

	public static $desiredWidth = [];

	public static function loadImages ($images){

		self::$images = explode(',',$images);

	}

	public static function arrange(){



		switch(self::$align){

			case "H":

				$rowWidth = 0;

				$maxWidthRow = 700;

				foreach(self::$images as $index => $image){

					list($width,$height) = getimagesize($image);

					self::$desiredHeight[] = self::$height;

					$aspectRatio = $width/$height;

					self::$desiredWidth[] = round($aspectRatio * self::$height);

					$rowWidth += round($aspectRatio * self::$height);

					// SAVE COUNT FOR THE IMAGES rOW

					//if ($rowWidth > $maxWidth){

						//INITIALIZE NEW ROW

						// DISTRIUTE TH REMAINING WIDTH WITH ALL THE IMAGES IN THIS ROW // jUSTIFYS



					//}

				}

			break;

			case "V":

				$height = self::$height; //to be calculated

				$width = self::$width;

			break;
		}






	}

	public static function showArranged(){

			foreach(self::$images as $index => $image){

			self::$arranged .= '<img width="' . self::$desiredWidth[$index] . 'px" height="' . self::$desiredHeight[$index] . 'px" src="' . $image . '" class="' . self::$class . '">';

		}

		echo self::$arranged;

	}

} */
