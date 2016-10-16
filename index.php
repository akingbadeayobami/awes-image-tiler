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
    img{
      margin: 4px;
    }
		body{
			background-color: #9d2e81;
		}
    .wrapper{
      margin: 0 auto;
      width: 900px;
      border: 2px solid #fff;
    }
	</style>
</head>
<body>

  <div class="wrapper">

	<?php

	 require_once "Sphider.php";

	  foreach(range(1,37) as $index){

			$images[] = $index . ".png";

		}

	 $images = implode(',', $images);

	 $width = 700;

	 $height = 70;

	 $minMargin = 4;

	 $AwesPhotoTiler = new AwesPhotoTiler();

	 $AwesPhotoTiler->setRowHeight($height)->setContainerWidth($width)->setImages($images)->setMinMargin($minMargin)->tile();

?>
</div>
</body>
</html>
