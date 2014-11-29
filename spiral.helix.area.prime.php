<?php
/*********************************************************************************************
 * Prime Vector Codex Source Code.
 * Prime number vectorial matrix and vectorial graphic table.
 * *******************************************************************************************
 * This file demonstrates the rich information that can be included in
 * *******************************************************************************************
 *  The above formula, the prime numbers in numbers plane
 *  Ax, Ay or Az. Results obtained from the above formula,
 *  which will be advantageous to use the unit automatically
 *  shows the analytical plane. Vector in the first series
 *  of the formula, primes numbers say bid welcome to us.
 *********************************************************************************************
 * @author Ferdi Tekin <ferditekin@polimore.com>
 * @version 1.0
 * @package Release
 * @sourcecode Show  
 * @sourceplace Bottom  
 * @primaryrelation Think Vector
 * @primaryplace Think Vector https://github.com/ThinkVector/VECTOR
 * @date 27.12.2014 
 * @time 21.18 
 *********************************************************************************************
 */

//****************************
//Time exucution for algoritm start time
//****************************
$mtime = microtime();
$mtime = explode(" ",$mtime);
$mtime = $mtime[1] + $mtime[0];
$starttime = $mtime;
//****************************

function is_prime($number)
{
	if ($number < 0) $number *= -1 ;

	if ($number > 7) ;
	else if ( $number == 1 ) {
		return true;
	}
	else if ( $number == 2 ) {
		return false;
	}
	else if ( $number == 3 ) {
		return true;
	}
	else if ( $number == 5 ) {
		return true;
	}
	else if ( $number == 7 ) {
		return true;
	}

	// number count total if division by 2, 3, 4, 5, 6, 7, 8, 9, 10
	$number2  = array_map('intval', str_split($number));
	$ncountfor2 = 0;
	$ncountfor3 = 0;
	$ncountfor5 = 0;
	$ncountfor7 = 0;
	$ncountfor7_left = 0;
	$ncountfor7_right = "";
	$ncountfor9 = 0;
	
	foreach($number2 as $key => $value )
	{
		$ncountfor3 += $value;
		$ncountfor7_right .= $number2[($key + 1)].$ncountfor7_right;
	}

	$ncountfor7_right = $number2[0];
	$ncountfor5 = $ncountfor2 = $number2[$key];
	$ncountfor7  = $ncountfor7_right - ( $ncountfor7_left * 2 );
	
	if( ( $ncountfor5 % 5 ) == 0 || ( $ncountfor2 % 2 ) == 0 )
	{
		return false;
	}
	else if( ($ncountfor3 % 3) == 0 )
	{
		return false;
	}
	else if( ($ncountfor3 % 9) == 0 )
	{
		return false;
	}
	else if( ($ncountfor7 % 7) == 0 && $ncountfor7 > 7)
	{
		return false;
	}

	// square root algorithm speeds up testing of bigger prime numbers
	$x = sqrt($number);
	$x = floor($x);
	for ( $i = 2 ; $i <= $x ; ++$i ) {
		if ( $number % $i == 0 ) {
			break;
		}
	}
	
	if( $x == $i-1 ) {
		return true;
	} else {
		return false;
	}
}

function rand_color() {
    return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
}

$areax = array (
		1,1,1,1,1,1,1,1,1,1,1,1,
		1,1,1,1,1,1,1,1,1,1,1,1,
		1,1,1,1,1,1,1,1,1,1,1,1,
		1,1,1,1,1,1,1,1,1,1,1,1,
		1,1,1,1,1,1,1,1,1,1,1,1,
		1,1,1,1,1,1,1,1,1,1,1,1,
		1,1,1,1,1,1,1,1,1,1,1,1,
		1,1,1,1,1,1,1,1,1,1,1,1,
		1,1,1,1,1,1,1,1,1,1,1,1,
		1,1,1,1,1,1,1,1,1,1,1,1,
		1,1,1,1,1,1,1,1,1,1,1,1,
		1,1,1,1,1,1,1,1,1,1,1,1
		);
$XAREA = array (
		0,0,0,0,0,0,0,0,0,0,0,0,
		0,0,0,0,0,0,0,0,0,0,0,0,
		0,0,0,0,0,0,0,0,0,0,0,0,
		0,0,0,0,0,0,0,0,0,0,0,0,
		0,0,0,0,0,0,0,0,0,0,0,0,
		0,0,0,0,0,0,0,0,0,0,0,0,
		0,0,0,0,0,0,0,0,0,0,0,0,
		0,0,0,0,0,0,0,0,0,0,0,0,
		0,0,0,0,0,0,0,0,0,0,0,0,
		0,0,0,0,0,0,0,0,0,0,0,0,
		0,0,0,0,0,0,0,0,0,0,0,0,
		0,0,0,0,0,0,0,0,0,0,0,0
		);
$superb = 0;
$end = 36;
$begin  = 0;
$beginrange = $begin;
$endcount = 0;
$jarray = 3; // first 3 vector shows
$visualchecked = "checked";

//*********************
//*Vector Tables Value
//*********************
$XXA = 60;
$YYA = 0;
$ZZA = 0;
//*********************
//*********************

if (isset($_POST["axvalue"]))
{
	for($i = 0; $i < $XXA; $i++)
	{
		$areax[$i] = $_POST["axvalue"];
	}
}

if (isset($_POST["nrange"]))
{
	if($_POST["nrange"] > 0) $end = $_POST["nrange"];
	if($end > 99999999999999999999) $end = 18;
}

if (isset($_POST["brange"]))
{
	if($_POST["brange"] < $end) $begin = $_POST["brange"];
	else $begin = 0;
}

if (isset($_POST["visual"]))
{
	if($_POST["visual"] == "true") { $visualchecked = "checked"; $jarray = $XXA;}
}

if(isset($_POST["axvalue"]) && !isset($_POST["visual"]))
{
	$visualchecked = "";
	$jarray = 3; 	// limited visual view
}
else if(!isset($_POST["axvalue"]) && !isset($_POST["visual"]))
{
	$visualchecked = "checked";
	$jarray = $XXA;
}


//****************************
//Calculation form
//****************************
echo "<table><tr><td>Prime number finding...<br/><br/><br/>\n";
echo '<form name="htmlform" method="post" id="prime.number" action="">';
echo '<hr><br/><strong><a title="-n to n">ax</a></strong> start value : <input value="'.$areax[0].'" 
type="text" name="axvalue" maxlength="20" size="6"> ';
echo '<strong><a 
title="-n to -1 
-1 to -0.01 (change resolution)
0
0.01 to 1 (change resolution)
1 to n">..0</a></strong> range : <input value="'.$begin.'" 
type="text" name="brange" maxlength="15" size="6"> ';
echo '<strong><a 
title="1 to n 
">..n</a></strong> range : <input value="'.$end.'" 
type="text" name="nrange" maxlength="15" size="6"> ';
echo '<input type="submit" value="Calculate primes">';
echo '<input type="checkbox" id=visual="yes" name="visual" '.$visualchecked.' 
value="true">show with detailed visual representation</input><br/><br/>';
echo '</form>';
echo "<hr><font face='arial,helvetica' size='3'><strong>Prime = 
(ax:$areax[0])+(((0..n:$begin..$end)+1)*2)+((((0..n:$begin..$end)*2)-1)*2)
 = Ax, Ay or Az</strong></font><hr>";
//****************************
//****************************


if($beginrange == 0)$beginrange = 1;
else if($beginrange >= 1)$beginrange = 1;
else if($beginrange <= -1)$beginrange = 1;
else if($beginrange > -1 && $beginrange < 0)$beginrange *= -1;

for( $i = $begin; $i <= $end; $i = $i + $beginrange )
{
	$superb2 = 0;

	$ipop = 0;
	$ipush = 0;
	while( $ipush < $XXA )
	{
		$XAREA[$ipush] = $areax[$ipush] + ( ( ( $i + $ipop ) + 1 ) * 2 ) + ( ( ( ( $i + $ipop ) * 2 ) - 1 ) * 2 ); $ipush++;
		$XAREA[$ipush] = $areax[$ipush] + ( ( ( $i + $ipop ) + 1 ) * 2 ) ; $ipush++;
		$XAREA[$ipush] = $areax[$ipush] + ( ( ( ( $i + $ipop ) * 2 ) - 1 ) * 2 ); $ipush++;
		
		$ipop++; 

		$XAREA[$ipush] = $areax[$ipush] - ( ( $i + $ipop ) * 2 ) - ( ( ( ( $i + $ipop) * 2 ) - 1 ) * 2 ); $ipush++;
		$XAREA[$ipush] = $areax[$ipush] - ( ( $i + $ipop ) * 2 ) ; $ipush++;
		$XAREA[$ipush] = $areax[$ipush] - ( ( ( ( $i + $ipop ) * 2 ) - 1 ) * 2 ); $ipush++;

		$ipop++;
	}
	
	if($visualchecked != "checked")
	{
		if(is_prime($areax[0]))
		{
			echo "<font face='arial,helvetica' color='#FFD801'><strong>".$areax[0]."</strong></font>
			+ ( ( $i + 1 ) * 2 ) + ( ( ( $i * 2 ) - 1 ) * 2 ) = ";
		}
		else
		{
			echo "$areax[0] + ( ( $i + 1 ) * 2 ) + ( ( ( $i * 2 ) - 1 ) * 2 ) = ";
		}
	}

	for($j = 0 ; $j < $jarray; $j++)
	{
		for($jcolor = 0; $jcolor < $jarray; $jcolor++)
			if($j == $jcolor)
			{
				if($visualchecked != "checked")
				{
					if( ($j % 3) == 0){ $color = "red"; $prexfix = " AX: ";}
					else if( ($j % 3) == 1){ $color = "lightgreen"; $prexfix = " AY: ";}
					else if( ($j % 3) == 2){ $color = "blue"; $prexfix = " AZ: ";}
					
				}
				else
				{
					$prexfix = "";
					$color = rand_color();
				}
				break;
			}	
		
		$prime_check = $XAREA[($j)];
		if(is_prime($prime_check))
		{
			if($visualchecked == "checked")
			{
				//**************************
				//draw text visualation
				//**************************
				if($prime_check < 0)$prime_check *= -1;
				echo $prexfix.'<font face="arial,helvetica" size="2"
				color="'.$color.'"><strong><a title="'.$prime_check.' is a prime number." 
				alt="'.$prime_check.' is a prime number.">O</a></strong></font>'; // O
				//**************************
				//**************************

				//**************************
				//draw picture visualation
				//**************************
				//
				//**************************
				//**************************
			}
			else
			{
				//**************************
				//draw text visualation
				//**************************
				if($prime_check < 0)$prime_check2 = -1 * $prime_check;
				else $prime_check2 = $prime_check;
				echo $prexfix.'<font face="arial,helvetica" size="2"
				color="'.$color.'"><strong> <a title="'.$prime_check2.' is a prime number." 
				alt="'.$prime_check2.' is a prime number.">'.$prime_check.'</a>
				</strong> </font>';
				//**************************
				//**************************
			}
			$superb++;
			$superb2++;
		}
		else
		{
			if($visualchecked == "checked")
			{
				echo $prexfix.'<font face="arial,helvetica" size="2"
				color="white"><strong>Ø</strong></font>'; // Ø

				//**************************
				//draw picture visualation
				//**************************
				//
				//**************************
				//**************************
			}
			else
			{
				echo $prexfix.'<font face="arial,helvetica" size="2"
				color="black"> '.$prime_check.'
				</font> ';
			}
		}
	}
	echo "<br/>\n";

	$ipush = $ipop = 0;
	while( $ipush < $XXA)
	{
		$areax[$ipush] = $XAREA[$ipop]; $ipush++;
		$areax[$ipush] = $XAREA[$ipop]; $ipush++;
		$areax[$ipush] = $XAREA[$ipop]; $ipush++;
		$ipop = $ipop + 3;
	}

	$endcount++;

}

//****************************
//Time exucution for algoritm end time
//****************************
$mtime = microtime();
$mtime = explode(" ",$mtime);
$mtime = $mtime[1] + $mtime[0];
$endtime = $mtime;
$totaltime = ($endtime - $starttime);
//echo "Executed in ".$totaltime." seconds";
//****************************

$c = $endcount / 100;
$percentage = floor($superb / $c);

	echo '<hr><br/><br/><strong> Total prime count : </strong><font face="arial,helvetica" size="3"
	color="red"><strong>'.$superb.' / '.$endcount.'
	</strong></font> , %'.$percentage.' percentage, executed in '.$totaltime.' seconds<br/>';

echo "<br/><br/>

*******************************************************<br/>
****** About Formula ********************************<br/>
*******************************************************<br/>
*****  The above formula, the prime numbers in numbers plane<br/>
*****  Ax, Ay or Az. Results obtained from the above formula,<br/>
*****  which will be advantageous to use the unit automatically<br/>
*****  shows the analytical plane. Vector in the first series<br/>
*****  of the formula, primes numbers say bid welcome to us.<br/>
*****  <br/>
****** 3L+4L tangential<br/>
****** 4L+3L tangential<br/>
****** 3L+2L+3L semicircle<br/>
****** 3L+4L+3L+4L rectangle<br/>
****** 5L + in center 4L perpendicular<br/>
********************************************************<br/>
<br/>
Prime numbers that can be called to create a unique geometric <br/>
shapes and planes. Therefore, it is difficult to find<br/>
the prime numbers with a simple method. As consisting of <br/>
prime numbers, numbers, geometric shapes, and the plane can be<br/>
divided into only their coats. Therefore, you should look at <br/>
a number can create unique geometric shapes to create a unique<br/>
checking the inertness. Primes are special, try to understand it <br/>
helps to understand the math, and even provides even of<br/>
mathematical development. For example, to invent systems that <br/>
can be found prime numbers of its number in numeretical system.<br/>
<br/>
Important topics in this so primality:<br/>
* Lack of self divisor other numbers.<br/>
* Unique dimentional plane that can be created.<br/>
* Unique geometric shape that can be created.<br/>
* Angular, linear, area measurement accuracy.<br/>
<br/>
Sample:<br/>
34 numbers divisible only 17 and 2, and unique heptadecagon, <br/>
17 is no integer divisor in lower group. 38 numbers<br/>
divisible only 19 and 2, and unique enneadecagon, 19 is no integer <br/>
divisor in lower group.<br/><br/><a alt='Prime Numbers Methodology' 
title='Prime Numbers Methodology' target='_blank' 
href='img/template/design1/spiral.helix.area.prime.png'>Show methodology
 of analysis is how it works...</a> and source code<br/><br/><br/><br/>
</td></tr></table>";

?>
