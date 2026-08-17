<?php

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

	if ($number > 5) ;
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

	// number count total if divition by 3 with out 3 
	$number2  = array_map('intval', str_split($number));
	$ncountfor3 = 0;
	$ncountfor5 = 0;
	$ncountfor2 = 0;
	
	foreach($number2 as $key => $value )
	{
		$ncountfor3 += $value;
	}

	$ncountfor5 = $ncountfor2 = $number2[$key];
	
	if( ($ncountfor3 % 3) == 0 && $ncount != 3)
	{
		return false;
	}
	else if( $ncountfor5 == 5 || $ncountfor5 == 0 )
	{
		return false;
	}
	else if( $ncountfor2 == 2 || $ncountfor2 == 4 || $ncountfor2 == 6 || $ncountfor2 == 8)
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

$tax = array (1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1);
$AX = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
$superb = 0;
$end = 18;
$begin  = 0;
$beginrange = $begin;
$endcount = 0;
$jarray = 3;

if (isset($_POST["axvalue"]))
{
	$tax[0] = $_POST["axvalue"];
	$tax[1] = $_POST["axvalue"];
	$tax[2] = $_POST["axvalue"];
	$tax[3] = $_POST["axvalue"];
	$tax[4] = $_POST["axvalue"];
	$tax[5] = $_POST["axvalue"];
	$tax[6] = $_POST["axvalue"];
	$tax[7] = $_POST["axvalue"];
	$tax[8] = $_POST["axvalue"];
	$tax[9] = $_POST["axvalue"];
	$tax[10] = $_POST["axvalue"];
	$tax[11] = $_POST["axvalue"];
	$tax[12] = $_POST["axvalue"];
	$tax[13] = $_POST["axvalue"];
	$tax[14] = $_POST["axvalue"];
	$tax[15] = $_POST["axvalue"];
	$tax[16] = $_POST["axvalue"];
	$tax[17] = $_POST["axvalue"];
	$tax[18] = $_POST["axvalue"];
	$tax[19] = $_POST["axvalue"];
	$tax[20] = $_POST["axvalue"];
	$tax[21] = $_POST["axvalue"];
	$tax[22] = $_POST["axvalue"];
	$tax[23] = $_POST["axvalue"];
	$tax[24] = $_POST["axvalue"];
	$tax[25] = $_POST["axvalue"];
	$tax[26] = $_POST["axvalue"];
	$tax[27] = $_POST["axvalue"];
	$tax[28] = $_POST["axvalue"];
	$tax[29] = $_POST["axvalue"];
	$tax[30] = $_POST["axvalue"];
	$tax[31] = $_POST["axvalue"];
	$tax[32] = $_POST["axvalue"];
	$tax[33] = $_POST["axvalue"];
	$tax[34] = $_POST["axvalue"];
	$tax[35] = $_POST["axvalue"];
	$tax[36] = $_POST["axvalue"];
	$tax[37] = $_POST["axvalue"];
	$tax[38] = $_POST["axvalue"];
	$tax[39] = $_POST["axvalue"];
	$tax[40] = $_POST["axvalue"];
	$tax[41] = $_POST["axvalue"];
	$tax[42] = $_POST["axvalue"];
	$tax[43] = $_POST["axvalue"];
	$tax[44] = $_POST["axvalue"];
	$tax[45] = $_POST["axvalue"];
	$tax[46] = $_POST["axvalue"];
	$tax[47] = $_POST["axvalue"];	
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
	
	if($_POST["visual"] == "true") { $visualchecked = "checked"; $jarray = 48;}
}

echo "Prime number finding...<br/><br/><br/>\n";
echo '<form name="htmlform" method="post" action="">';
echo '<hr/><br/><strong>ax</strong> start value : <input value="'.$tax[0].'" type="text" name="axvalue" maxlength="20" size="6"> ';
echo '<strong>..0</strong> range : <input value="'.$begin.'" type="text" name="brange" maxlength="15" size="6"> ';
echo '<strong>..n</strong> range : <input value="'.$end.'" type="text" name="nrange" maxlength="15" size="6"> ';
echo '<input type="submit" value="Calculate primes">';
echo '<input type="checkbox" name="visual" '.$visualchecked.' value="true">show with detailed visual representation</input><br/><br/>';
echo '</form>';


echo "<hr/><font size='3'><strong>Prime = (ax:$tax[0])+(((0..n:$begin..$end)+1)*2)+((((0..n:$begin..$end)*2)-1)*2) = Ax, Ay or Az</strong></font><hr>";

if($beginrange == 0)$beginrange = 1;
else if($beginrange >= 1)$beginrange = 1;
else if($beginrange <= -1)$beginrange = 1;
else if($beginrange > -1 && $beginrange < 0)$beginrange *= -1;

for($i = $begin; $i <= $end; $i=$i+$beginrange)
{
	$superb2 = 0;
	$AX[0] = $tax[0] + ( ( $i + 1 ) * 2 ) + ( ( ( $i * 2 ) - 1 ) * 2 );
	$AX[1] = $tax[1] + ( ( $i + 1 ) * 2 ) ;
	$AX[2] = $tax[2] + ( ( ( $i * 2 ) - 1 ) * 2 );
	
	if($visualchecked == "checked")
	{
		$AX[3] = $tax[3] + ( ( ( $i + 3 ) + 1 ) * 2 ) + ( ( ( ( $i + 3 ) * 2 ) - 1 ) * 2 );
		$AX[4] = $tax[4] + ( ( ( $i + 3 ) + 1 ) * 2 ) ;
		$AX[5] = $tax[5] + ( ( ( ( $i + 3 ) * 2 ) - 1 ) * 2 );
		$AX[6] = $tax[6] + ( ( ( $i + 5 ) + 1 ) * 2 ) + ( ( ( ( $i + 5 ) * 2 ) - 1 ) * 2 );
		$AX[7] = $tax[7] + ( ( ( $i + 5 ) + 1 ) * 2 ) ;
		$AX[8] = $tax[8] + ( ( ( ( $i + 5 ) * 2 ) - 1 ) * 2 );
		$AX[9] = $tax[9] + ( ( ( $i + 6 ) + 1 ) * 2 ) + ( ( ( ( $i + 6 ) * 2 ) - 1 ) * 2 );
		$AX[10] = $tax[10] + ( ( ( $i + 6 ) + 1 ) * 2 ) ;
		$AX[11] = $tax[11] + ( ( ( ( $i + 6 ) * 2 ) - 1 ) * 2 );
		$AX[12] = $tax[12] + ( ( ( $i + 7 ) + 1 ) * 2 ) + ( ( ( ( $i + 7 ) * 2 ) - 1 ) * 2 );
		$AX[13] = $tax[13] + ( ( ( $i + 7 ) + 1 ) * 2 ) ;
		$AX[14] = $tax[14] + ( ( ( ( $i + 7 ) * 2 ) - 1 ) * 2 );
		$AX[15] = $tax[15] + ( ( ( $i + 8 ) + 1 ) * 2 ) + ( ( ( ( $i + 8 ) * 2 ) - 1 ) * 2 );
		$AX[16] = $tax[16] + ( ( ( $i + 8 ) + 1 ) * 2 ) ;
		$AX[17] = $tax[17] + ( ( ( ( $i + 8 ) * 2 ) - 1 ) * 2 );
		$AX[18] = $tax[18] + ( ( ( $i + 9 ) + 1 ) * 2 ) + ( ( ( ( $i + 9 ) * 2 ) - 1 ) * 2 );
		$AX[19] = $tax[19] + ( ( ( $i + 9 ) + 1 ) * 2 ) ;
		$AX[20] = $tax[20] + ( ( ( ( $i + 9 ) * 2 ) - 1 ) * 2 );
		$AX[21] = $tax[21] - ( ( $i + 1 ) * 2 ) - ( ( ( $i * 2 ) - 1 ) * 2 );
		$AX[22] = $tax[22] - ( ( $i + 1 ) * 2 ) ;
		$AX[23] = $tax[23] - ( ( ( $i * 2 ) - 1 ) * 2 );
		$AX[24] = $tax[24] - ( ( ( $i + 3 ) + 1 ) * 2 ) - ( ( ( ( $i + 3 ) * 2 ) - 1 ) * 2 );
		$AX[25] = $tax[25] - ( ( ( $i + 3 ) + 1 ) * 2 ) ;
		$AX[26] = $tax[26] - ( ( ( ( $i + 3 ) * 2 ) - 1 ) * 2 );
		$AX[27] = $tax[27] - ( ( ( $i + 5 ) + 1 ) * 2 ) - ( ( ( ( $i + 5 ) * 2 ) - 1 ) * 2 );
		$AX[28] = $tax[28] - ( ( ( $i + 5 ) + 1 ) * 2 ) ;
		$AX[29] = $tax[29] - ( ( ( ( $i + 5 ) * 2 ) - 1 ) * 2 );
		$AX[30] = $tax[30] - ( ( ( $i + 6 ) + 1 ) * 2 ) - ( ( ( ( $i + 6 ) * 2 ) - 1 ) * 2 );
		$AX[31] = $tax[31] - ( ( ( $i + 6 ) + 1 ) * 2 ) ;
		$AX[32] = $tax[32] - ( ( ( ( $i + 6 ) * 2 ) - 1 ) * 2 );
		$AX[33] = $tax[33] - ( ( ( $i + 7 ) + 1 ) * 2 ) - ( ( ( ( $i + 7 ) * 2 ) - 1 ) * 2 );
		$AX[34] = $tax[34] - ( ( ( $i + 7 ) + 1 ) * 2 ) ;
		$AX[35] = $tax[35] - ( ( ( ( $i + 7 ) * 2 ) - 1 ) * 2 );
		$AX[36] = $tax[36] - ( ( ( $i + 8 ) + 1 ) * 2 ) - ( ( ( ( $i + 8 ) * 2 ) - 1 ) * 2 );
		$AX[37] = $tax[37] - ( ( ( $i + 8 ) + 1 ) * 2 ) ;
		$AX[38] = $tax[38] - ( ( ( ( $i + 8 ) * 2 ) - 1 ) * 2 );
		$AX[39] = $tax[39] - ( ( ( $i + 9 ) + 1 ) * 2 ) - ( ( ( ( $i + 9 ) * 2 ) - 1 ) * 2 );
		$AX[40] = $tax[40] - ( ( ( $i + 9 ) + 1 ) * 2 ) ;
		$AX[41] = $tax[41] - ( ( ( ( $i + 9 ) * 2 ) - 1 ) * 2 );
		$AX[42] = $tax[42] - ( ( ( $i + 2 ) + 1 ) * 2 ) - ( ( ( ( $i + 2 ) * 2 ) - 1 ) * 2 );
		$AX[43] = $tax[43] - ( ( ( $i + 2 ) + 1 ) * 2 ) ;
		$AX[44] = $tax[44] - ( ( ( ( $i + 2 ) * 2 ) - 1 ) * 2 );
		$AX[45] = $tax[45] + ( ( $i + 2 ) * 2 ) + ( ( ( ($i+1) * 2 ) - 1 ) * 2 );
		$AX[46] = $tax[46] + ( ( $i + 2 ) * 2 ) ;
		$AX[47] = $tax[47] + ( ( ( ($i + 1) * 2 ) - 1 ) * 2 );
	}
	
	if($visualchecked != "checked")
	{
		if(is_prime($tax[0]))
		{
			echo "<font color='#FFD801'><strong>".$tax[0]."</strong></font>
			+ ( ( $i + 1 ) * 2 ) + ( ( ( $i * 2 ) - 1 ) * 2 ) = ";
		}
		else
		{
			echo "$tax[0] + ( ( $i + 1 ) * 2 ) + ( ( ( $i * 2 ) - 1 ) * 2 ) = ";
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
					$prexfix = " ";
					$color = rand_color();
				}
				break;
			}	
		
		$prime_check = $AX[($j)];
		if(is_prime($prime_check))
		{
			if($visualchecked == "checked")
			{
				if($prime_check < 0)$prime_check *= -1;
				echo $prexfix.'<font size="2"
				color="'.$color.'"><strong><a title="'.$prime_check.' is a prime number." 
				alt="'.$prime_check.' is a prime number.">O</a></strong></font>';
			}
			else
			{
				if($prime_check < 0)$prime_check2 = -1 * $prime_check;
				else $prime_check2 = $prime_check;
				echo $prexfix.'<font size="3"
				color="'.$color.'"><strong> <a title="'.$prime_check2.' is a prime number." 
				alt="'.$prime_check2.' is a prime number.">'.$prime_check.'</a>
				</strong> </font>';
			}
			$superb++;
			$superb2++;
		}
		else
		{
			if($visualchecked == "checked")
			{
				echo $prexfix.'<font size="2"
				color="white"><strong>Ø</strong></font>';
			}
			else
			{
				echo $prexfix.'<font size="2"
				color="black"> '.$prime_check.'
				</font> ';
			}
		}
	}
	echo "<br/>\n";
	
	$tax[0] = $AX[0];
	$tax[1] = $AX[0];
	$tax[2] = $AX[0];
	$tax[3] = $AX[3];
	$tax[4] = $AX[3];
	$tax[5] = $AX[3];
	$tax[6] = $AX[6];
	$tax[7] = $AX[6];
	$tax[8] = $AX[6];
	$tax[9] = $AX[9];
	$tax[10] = $AX[9];
	$tax[11] = $AX[9];
	$tax[12] = $AX[12];
	$tax[13] = $AX[12];
	$tax[14] = $AX[12];
	$tax[15] = $AX[15];
	$tax[16] = $AX[15];
	$tax[17] = $AX[15];
	$tax[18] = $AX[18];
	$tax[19] = $AX[18];
	$tax[20] = $AX[18];
	$tax[21] = $AX[21];
	$tax[22] = $AX[21];
	$tax[23] = $AX[21];
	$tax[24] = $AX[24];
	$tax[25] = $AX[24];
	$tax[26] = $AX[24];
	$tax[27] = $AX[27];
	$tax[28] = $AX[27];
	$tax[29] = $AX[27];
	$tax[30] = $AX[30];
	$tax[31] = $AX[30];
	$tax[32] = $AX[30];
	$tax[33] = $AX[33];
	$tax[34] = $AX[33];
	$tax[35] = $AX[33];
	$tax[36] = $AX[36];
	$tax[37] = $AX[36];
	$tax[38] = $AX[36];
	$tax[39] = $AX[39];
	$tax[40] = $AX[39];
	$tax[41] = $AX[39];
	$tax[42] = $AX[42];
	$tax[43] = $AX[42];
	$tax[44] = $AX[42];
	$tax[45] = $AX[45];
	$tax[46] = $AX[45];
	$tax[47] = $AX[45];
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

	echo '<hr/><br/><br/><strong> Total prime count : </strong><font size="3"
	color="red"><strong>'.$superb.' / '.$endcount.'
	</strong></font> , %'.$percentage.' percentage</font>, executed in '.$totaltime.' seconds<br/><br/><br/><br/><br/><br/>';

echo "<br/><br/><br/><br/><br/><br/><br/><br/>

**************************************************<br/>
* About Formula ********************************<br/>
**************************************************<br/>
The above formula, the prime numbers in numbers plane Ax, Ay or Az. Results obtained from the above formula, which will be advantageous to use the unit automatically shows the analytical plane. Vector in the first series of the formula, primes numbers say bid welcome to us.<br/>
<br/>
* 3L+4L tangential<br/>
* 4L+3L tangential<br/>
* 3L+2L+3L semicircle<br/>
* 3L+4L+3L+4L rectangle<br/>
* 5L + in center 4L perpendicular<br/>
***************************************************<br/><br/><br/><br/>
<br/>
Prime numbers that can be called to create a unique geometric shapes and planes. Therefore, it is difficult to find the prime numbers with a simple method. As consisting of prime numbers, numbers, geometric shapes, and the plane can be divided into only their coats. Therefore, you should look at a number can create unique geometric shapes to create a unique checking the inertness. Primes are special, try to understand it helps to understand the math, and even provides even of mathematical development. For example, to invent systems that can be found prime numbers of its number in numeretical system.<br/>
<br/>
Important topics in this so primality:<br/>
* Lack of self divisor other numbers.<br/>
* Unique dimentional plane that can be created.<br/>
* Unique geometric shape that can be created.<br/>
* Angular, linear, area measurement accuracy.<br/>
<br/>
Sample:<br/>
34 numbers divisible only 17 and 2, and unique heptadecagon, 17 is no integer divisor in lower group. 38 numbers divisible only 19 and 2, and unique enneadecagon, 19 is no integer divisor in lower group.<br/>
<br/><br/><br/><br/><A alt='Prime Numbers Methodology' title='Prime Numbers Methodology' target='_blank' href='img/template/design1/spiral.helix.area.prime.png'>Show methodology of analysis is how it works...</A>
";

?>
