<?php

class AwesPhotoTiler{

	protected $_images = [];

	protected $_containerWidth = 500;

	protected $_rowHeight = 100;

	protected $_rawImageSizes = [];

	protected $_processedImageSizes = [];

	protected $_initialTiling = [];

	protected $_minMargin = 3;

	public function tile(){

	//	$this->assignImagesPerRow();

		$this->getImagesSize();

		$this->tileTheRows();

		$this->alignContainerWidthByMargin();

		$this->showMe();

	}

	protected function alignContainerWidthByMargin(){

		$largestWidth = 0;

		foreach($this->_initialTiling as $row){

			$largestWidth = ($row[2] > $largestWidth) ? $row[2] : $largestWidth ;

		}

		foreach($this->_initialTiling as $row ){

			$marginNeededToAlign = $largestWidth - $row[2];

			$fittingMargin = ($marginNeededToAlign != 0) ? $this->_minMargin + floor($marginNeededToAlign / (count($row[0]) * 2)  )  : $this->_minMargin;

			$this->_processedImageSizes[] = [$row[0], $fittingMargin];

		}

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

		$imageRow = [];

		$resizedRowWidth = 0;

		foreach($this->_rawImageSizes as $image){

			$newWidth = floor($this->_rowHeight * $image[2]);

			$resizedRowWidth += ($newWidth + (2 * $this->_minMargin));

			$imageRow[] = [$newWidth, $this->_rowHeight ];

			if($resizedRowWidth > $this->_containerWidth ){

				$this->_initialTiling[] = [$imageRow,$this->_minMargin,$resizedRowWidth];

				$resizedRowWidth = 0;

				$imageRow = [];

			}

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
	//
	// protected function assignImagesPerRow(){
	//
	// 	// calculate the number of images each row will hold
	// 	$imagesEachRowWillHold = floor( count($this->_images) / $this->_rows );
	//
	// 	// need to know the extra columns that will be remaining
	// 	$extraImagesToBeRemaining = count($this->_images) % $this->_rows;
	//
	// 	// looping to assign the number of images each row will contain
	// 	for($i = 1; $i <= $this->_rows; $i++){
	//
	// 			// check if image as extra image to possess
	// 			$thisRowtoHold = ($i <= $extraImagesToBeRemaining ) ? $imagesEachRowWillHold + 1 : $imagesEachRowWillHold;
	//
	// 			$this->_rowsImages['row' . $i] = $thisRowtoHold;
	//
	// 	}
	//
	// }

	public function showMe(){

		$i = 0;

		foreach($this->_processedImageSizes as $processedRow){

			$imageRow = $processedRow[0];

			$margin = $processedRow[1];

			echo '<div class="">';

				foreach($imageRow as $image){

					echo '<img style="margin:0 ' . $margin . 'px" src="' . $this->_images[$i++] . '" width="' . $image[0] .  'px" height="' . $image[1]. 'px" >';

				}

			echo "</div>";

		}

	}

	public function arraylize($input){

		return explode(',',$input);

	}

	// Setters

	public function setRowHeight($height){

		$this->_rowHeight = $height;

		return $this;

	}

	public function setContainerWidth($width){

		$this->_containerWidth = $width;

		return $this;

	}

	public function setImages($images){

		$this->_images = $this->arraylize($images);

		return $this;

	}

	public function setMinMargin($minMargin){

		$this->_minMargin = $minMargin;

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
