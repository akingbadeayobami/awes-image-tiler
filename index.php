 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Awes Photo Tiler</title>
	<style>
		/*.img-responsive{
			margin: 4px;
		}*/
		.img-class{

		}
		.row-class{

		}
		body{
			background-color: #9d2e81;
		}
	</style>
</head>
<body>

	<?php

	 require_once "Sphider.php";

	  foreach(range(1,25) as $index){

			$images[] = $index . ".png";

		}

	 $images = implode(',', $images);

	 $width = 500;

	 $height = 700;

	 $rows = 5;

	 $AwesPhotoTiler = new AwesPhotoTiler();

	 $AwesPhotoTiler->setRows($rows)->setHeight($height)->setWidth($width)->setImages($images)->tile();

?>
</body>
</html>
