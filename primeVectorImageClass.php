<?php
/*********************************************************************************************
 * Prime Vector Image Class Source Code.
 * PHP 8.4 Compatible Version
 *********************************************************************************************
 */

require_once("primeVectorClass.php");

class PrimeVectorImageClass
{
	public $randomColora;
	public $randomColorb;

	public function generateColor()
	{
		return mt_rand($this->randomColora, $this->randomColorb);
	}

	// PHP 8.4 uyumlu constructor
	public function __construct($xresolution = 10, $yresolution = 10, $border = 10, $randcolor = 1, $imageData = "")
	{
		if( $randcolor != 0 ){ $this->randomColora = $randcolor; $this->randomColorb = 255;}
		else { $this->randomColora = 20; $this->randomColorb = 100; }

		$queryString = explode(';', $imageData);
		$queryStringImageHeader = explode (',', $queryString[0]);

		$weight = 1;
		$height = 1;

		foreach ($queryStringImageHeader as $key=>$value)
		{
			$strremoved = str_replace(" ", "", $value);
			$colmnvalue = explode (":", $strremoved);
			if($colmnvalue[0] == "X") $weight = ((int)$colmnvalue[1]) ?: 1;
			else if($colmnvalue[0] == "Y") $height = ((int)$colmnvalue[1]) ?: 1;
		}

		$image = imagecreatetruecolor($xresolution * $weight + $border, $yresolution * $height + $border ) or die('Cannot initialize new GD image stream');
		$background_color = imagecolorallocate($image, 255, 255, 255);
		imagefill($image, 0, 0, $background_color);

		for( $yy = 0 ; $yy < $height ; $yy++ )
		{
			if (!isset($queryString[$yy+1])) break;
			$strremoved =  str_replace(" ", "", $queryString[($yy+1)] );
			$queryStringImageRaw = explode ("," ,$strremoved);
			for( $xx = 0; $xx < $weight; $xx++ )
			{
				$val = isset($queryStringImageRaw[$xx]) ? (int)$queryStringImageRaw[$xx] : 0;
				if($val == 1 )$colorfill = imagecolorallocate($image, $this->generateColor(), $this->generateColor(), $this->generateColor());
				else $colorfill = imagecolorallocate($image, 255, 255, 255 );
			
				imagefilledrectangle($image,
					(int)( $xx * $xresolution + 1.5 + $border/2 ),
					(int)( $yy * $yresolution + 1.5 + $border/2 ),
					(int)( $xx * $xresolution + $xresolution - 1.5 + $border/2 ),
					(int)( $yy * $yresolution + $yresolution - 1.5 + $border/2 ),
					$colorfill
				);
			} 
		}

		$yborder = $yresolution * $height + $border - $border/4;
		$xborder = $xresolution * $weight + $border - $border/4;
		$colorfill = imagecolorallocate($image, $this->generateColor(), $this->generateColor(), $this->generateColor());
		imageline($image, (int)($border/4), (int)($border/4), (int)$xborder, (int)($border/4), $colorfill);
		imageline($image, (int)($border/4), (int)($border/4), (int)($border/4), (int)$yborder, $colorfill);
		imageline($image, (int)$xborder, (int)$yborder, (int)$xborder, (int)($border/4), $colorfill);
		imageline($image, (int)$xborder, (int)$yborder, (int)($border/4), (int)$yborder, $colorfill);

		header('Content-Type: image/png');
		header('Content-Disposition: attachment; filename="primeVectorImageClass.'.rand(111111,999999).'.png"');
		imagepng($image);
		imagedestroy($image);
	}

	public function __destruct( ){}
}

// GET Parametrelerinin Güvenli Alınması
$xresolution = isset($_GET['xresolution']) ? (int)str_replace(['<', ' ', '>'], "", $_GET['xresolution']) : 10;
$yresolution = isset($_GET['yresolution']) ? (int)str_replace(['<', ' ', '>'], "", $_GET['yresolution']) : 10;
$border = isset($_GET['border']) ? (int)str_replace(['<', ' ', '>'], "", $_GET['border']) : 10;
$random = isset($_GET['random']) ? (int)str_replace(['<', ' ', '>'], "", $_GET['random']) : 1;

if($random >= 1) $random = rand(25,50);
if($random < 1) $random = 0;

$urlax = isset($_GET['urlax']) ? (int)str_replace(['<', ' ', '>'], "", $_GET['urlax']) : 1;
$urlb0x = isset($_GET['urlb0x']) ? (int)str_replace(['<', ' ', '>'], "", $_GET['urlb0x']) : 0;
$urlbnx = isset($_GET['urlbnx']) ? (int)str_replace(['<', ' ', '>'], "", $_GET['urlbnx']) : 36;
$urlXXA = isset($_GET['urlXXA']) ? (int)str_replace(['<', ' ', '>'], "", $_GET['urlXXA']) : 60;
$urlYYA = isset($_GET['urlYYA']) ? (int)str_replace(['<', ' ', '>'], "", $_GET['urlYYA']) : 0;
$urlZZA = isset($_GET['urlZZA']) ? (int)str_replace(['<', ' ', '>'], "", $_GET['urlZZA']) : 0;

$primeclass2 = new PrimeVector( $urlax, $urlb0x, $urlbnx, $urlXXA, $urlYYA, $urlZZA );
$primeclass2->startPrimeVector( );
$primeclass2->getPrimeVectorRaw( );
while( $primeclass2->setNextPrimeVector( ))
{
	$primeclass2->getPrimeVectorRaw( );
}
$primeclass2->getTime();
$imageData2 = $primeclass2->getPrimeVectorImageData();

$primeimage = new PrimeVectorImageClass($xresolution, $yresolution, $border, $random, $imageData2);
?>
