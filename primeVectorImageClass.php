<?php

require_once("primeVectorClass.php");

class PrimeVectorImageClass
{
	var $randomColora;
	var $randomColorb;

	public function generateColor()
	{
		return mt_rand($this->randomColora, $this->randomColorb);
	}

	public function PrimeVectorImageClass($xresolution = 10, $yresolution = 10, $border = 10, $randcolor = 1, $imageData = "")
	{

		if( $randcolor != 0 ){ $this->randomColora = $randcolor; $this->randomColorb = 255;}
		else { $this->randomColora = 20; $this->randomColorb = 100; }

		$queryString = explode(';', $imageData);

		$queryStringImageHeader = explode (',', $queryString[0]);

		foreach ($queryStringImageHeader as $key=>$value)
		{
			$strremoved = str_replace(" ", "", $value);
			
			$colmnvalue = null;
			$colmnvalue = explode (":", $strremoved);
			if($colmnvalue[0] == "ImageHeader") $imageheader = $colmnvalue[0];
			else if($colmnvalue[0] == "X") $weight = $colmnvalue[1]+0;
			else if($colmnvalue[0] == "Y") $height = $colmnvalue[1]+0;
		}

		if($weight <= 0) $weight = 1;
		if($height <= 0) $height = 1;

		$image = imagecreatetruecolor($xresolution * $weight + $border, $yresolution * $height + $border ) or die('Cannot initialize new GD image stream');
		$background_color = imagecolorallocate($image, 255, 255, 255);
		imagecolorallocate($image, 255, 255, 255);
		imagefill($image, 0, 0, $background_color);

		for( $yy = 0 ; $yy < $height ; $yy++ )
		{
			$strremoved =  str_replace(" ", "", $queryString[($yy+1)] );
			$queryStringImageRaw  = null;
			$queryStringImageRaw = explode ("," ,$strremoved);
			for( $xx = 0; $xx < $weight; $xx++ )
			{
				$queryStringImageRaw[$xx] = $queryStringImageRaw[$xx] + 0;
				if($queryStringImageRaw[$xx] == 1 )$colorfill = imagecolorallocate($image, $this->generateColor(), $this->generateColor(), $this->generateColor());
				else if($queryStringImageRaw[$xx] == 0 )$colorfill = imagecolorallocate($image, 255, 255, 255 );
				else $colorfill = imagecolorallocate($image, $this->generateColor(), $this->generateColor(), $this->generateColor());
			
				imagefilledrectangle($image,
				( $xx * $xresolution + 1.5 + $border/2 ),
				( $yy * $yresolution + 1.5 + $border/2 ),
				( $xx * $xresolution + $xresolution - 1.5 + $border/2 ),
				( $yy * $yresolution + $yresolution - 1.5 + $border/2 ),
				$colorfill);
			} 
		}

		$yborder = $yresolution * $height + $border - $border/4;
		$xborder = $xresolution * $weight + $border - $border/4;
		$colorfill = imagecolorallocate($image, $this->generateColor(), $this->generateColor(), $this->generateColor());
		imageline($image, $border/4, $border/4, $xborder, $border/4, $colorfill);
		imageline($image, $border/4, $border/4, $border/4, $yborder, $colorfill);
		imageline($image, $xborder, $yborder,  $xborder, $border/4, $colorfill);
		imageline($image, $xborder, $yborder,  $border/4, $yborder, $colorfill);

		
		header('Content-type: image/png');
		header("Content-Type: application/force-download");
		header('Content-Disposition: attachment; filename="primeVectorImageClass.'.rand(111111,999999).'.png"');
		imagepng($image);
		imagedestroy($image);
	}

	function __destruct( ){}
}



if (isset($_GET[xresolution])) $xresolution = str_replace(array('<', ' ', '>'), "", $_GET[xresolution] );
if (isset($_GET[yresolution])) $yresolution = str_replace(array('<', ' ', '>'), "", $_GET[yresolution] );
if (isset($_GET[border])) $border = str_replace(array('<', ' ', '>'), "", $_GET[border] );
if (isset($_GET[random])) $random = str_replace(array('<', ' ', '>'), "", $_GET[random] );
if($random >= 1)$random = rand(25,50);
if($random < 1)$random = 0;
if (isset($_GET[urlax])) $urlax = str_replace(array('<', ' ', '>'), "", $_GET[urlax] );
if (isset($_GET[urlb0x])) $urlb0x = str_replace(array('<', ' ', '>'), "", $_GET[urlb0x] );
if (isset($_GET[urlbnx])) $urlbnx = str_replace(array('<', ' ', '>'), "", $_GET[urlbnx] );
if (isset($_GET[urlXXA])) $urlXXA = str_replace(array('<', ' ', '>'), "", $_GET[urlXXA] );
if (isset($_GET[urlYYA])) $urlYYA = str_replace(array('<', ' ', '>'), "", $_GET[urlYYA] );
if (isset($_GET[urlZZA])) $urlZZA = str_replace(array('<', ' ', '>'), "", $_GET[urlZZA] );

$primeclass2 = new PrimeVector( $urlax, $urlb0x, $urlbnx, $urlXXA, $urlYYA, $urlZZA );
$primeclass2->startPrimeVector( );
$primeclass2->getPrimeVectorRaw( );
while( $primeclass2->setNextPrimeVector( ))
{
	$primeclass2->getPrimeVectorRaw( );
}
$primeclass2->getTime();
$imageData2 = $primeclass2->getPrimeVectorImageData();

$primeimage = new PrimeVectorImageClass($xresolution,$yresolution, $border, $random, $imageData2);
?>
