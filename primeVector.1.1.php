<?php
/*********************************************************************************************
 * Prime Vector Codex Example Code.
 * Prime number vectorial matrix and vectorial graphic table.
 * *******************************************************************************************
 * This file demonstrates the rich information that can be included in
 * *******************************************************************************************
 * The above formula, the prime numbers in numbers plane
 * Ax, Ay or Az. Results obtained from the above formula,
 * which will be advantageous to use the unit automatically
 * shows the analytical plane. Vector in the first series
 * of the formula, primes numbers say bid welcome to us.
 *********************************************************************************************
 * @author Ferdi Tekin <ferditekin@polimore.com>
 * @version 1.1
 * @package Release
 * @sourcecode Show 
 * @sourceplace Bottom 
 * @primaryrelation Think Vector
 * @primaryplace Think Vector https://github.com/ThinkVector/VECTOR
 * @date 09.12.2014 
 * @time 14:30 
 *********************************************************************************************
 */
include_once ("primeVectorClass.php");
//************************************************************
// Random color generator for text 0x000000 to 0xFFFFFF format
//************************************************************
function rand_color( )
{
	return '#' . str_pad( dechex( mt_rand( 0, 0xFFFFFF ) ), 6, '0', STR_PAD_LEFT );
}
//************************************************************
//*****************************
// Check outcoming data & value 
//*****************************
if( isset( $_POST["axvalue"] ) )
{
	if( $_POST["axvalue"] == null ) $form_ax = 1;	
	else $form_ax = $_POST["axvalue"];
}
else 
{
	$form_ax = 1;
}
if ( isset( $_POST["nrange"] ) )
{
	if( $_POST["nrange"] > 0 && $_POST["nrange"] < 99999999999999999999 ) 
	{
		$form_end = $_POST["nrange"];
	}
	else $form_end = 36;
}
else
{
	$form_end = 36;
}
if ( isset( $_POST["brange"] ) )
{
	if( $_POST["brange"] < $form_end ) $form_begin = $_POST["brange"];
	else $form_begin = 0;
}
else
{
	$form_begin = 0;
}
if ( isset( $_POST["visual"] ) )
{
	if( $_POST["visual"] == "true" ) { $form_visualchecked = "checked"; $form_jarray = $form_XXA;}
}
if ( isset( $_POST["Xrange"] ) && isset( $_POST["visual"] ) )
{
	
	if( $_POST["Xrange"] > 3 )
	{
		$form_XXA = $_POST["Xrange"];
	}
	else
	{
		$form_XXA = 60;
	}
}
else $form_XXA = 60;
if( isset( $_POST["axvalue"] ) && !isset( $_POST["visual"] ) )
{
	$form_visualchecked = "";
	$form_XXA = 3;
}
else if( !isset( $_POST["axvalue"] ) && !isset( $_POST["visual"] ) )
{
	$form_visualchecked = "checked";
}
//*****************************
//****************************
//Calculation form
//****************************
echo "<table><tr><td>Prime number finding...<br/><br/><br/>\n";
echo '<form name="htmlform" method="post" id="prime.number" action="">';
echo '<hr><br/><strong><a 
title="ax start value :
-n to n">ax</a></strong> : <input value="'.$form_ax.'" 
type="text" name="axvalue" maxlength="20" size="5"> ';
echo '<strong><a 
title="..0 vertical range :
-n to -1 
-1 to -0.01 ( change resolution )
0
0.01 to 1 ( change resolution )
1 to n">..0</a></strong> : <input value="'.$form_begin.'" 
type="text" name="brange" maxlength="15" size="5"> ';
echo '<strong><a 
title="..n vertical range :
1 to n 
">..n</a></strong> : <input value="'.$form_end.'" 
type="text" name="nrange" maxlength="15" size="5"> ';
echo ' <input type="submit" 
value="Calculate Primes"> ';
echo '<strong><a 
title="X horizontal range :
1 to n 
"> X</a></strong> : <input value="'.$form_XXA.'" 
type="text" name="Xrange" maxlength="15" size="3"> ';
echo '<input type="checkbox" id=visual="yes" name="visual" '.$form_visualchecked.' 
value="true">show with detailed visual representation</input><br/><br/>';
echo '</form>';
echo "<hr><font face='arial,helvetica' size='3'><strong>Prime = 
( ax:$form_ax )+( ( ( 0..n:$form_begin..$form_end )+1 )*2 )+( ( ( ( 0..n:$form_begin..$form_end )*2 )-1 )*2 )
 = Ax, Ay or Az</strong></font><hr>";
//****************************
//****************************
$primeclass = new PrimeVector( $form_ax, $form_begin, $form_end, $form_XXA, $form_YYA, $form_ZZA );
if($form_visualchecked != "checked")
{
	$primeclass->startPrimeVector( );
	$rawprime = $primeclass->getPrimeVectorRaw( );
	
	foreach ($rawprime[XPRIME] as $key => $value)
	{
		if($value == 1)
		{
			//**************************
			//draw text visualation
			//**************************
			echo '<font face="arial,helvetica" size="3"
			color="'.rand_color().'"><strong> 
			<a title="'.$rawprime[XAREA][$key].' is a prime number." 
			alt="'.$rawprime[XAREA][$key].' is a prime number.">
			'.$rawprime[XAREA][$key].'</a>
			</strong> </font>';
			//**************************
			//**************************
		}
		else
		{
			//**************************
			//draw text visualation
			//**************************
			echo '<font face="arial,helvetica" size="3"
			color="lightgrey">
			<a title="'.$rawprime[XAREA][$key].' is not a prime number." 
			alt="'.$rawprime[XAREA][$key].' is not a prime number.">
			'.$rawprime[XAREA][$key].'</a>
			 </font>';
			//**************************
			//**************************
		}
		
	}
	print "<br/>";
	while( $primeclass->setNextPrimeVector( ) )
	{
		$rawprime = $primeclass->getPrimeVectorRaw( );
		foreach ($rawprime[XPRIME] as $key => $value)
		{
			if($value == 1)
			{
				//**************************
				//draw text visualation
				//**************************
				echo '<font face="arial,helvetica" size="3"
				color="'.rand_color().'"><strong> 
				<a title="'.$rawprime[XAREA][$key].' is a prime number." 
				alt="'.$rawprime[XAREA][$key].' is a prime number.">
				'.$rawprime[XAREA][$key].'</a>
				</strong> </font>';
				//**************************
				//**************************
			}
			else
			{
				//**************************
				//draw text visualation
				//**************************
				echo '<font face="arial,helvetica" size="3"
				color="lightgrey">
				<a title="'.$rawprime[XAREA][$key].' is not a prime number." 
				alt="'.$rawprime[XAREA][$key].' is not a prime number.">
				'.$rawprime[XAREA][$key].'</a>
				 </font>';
				//**************************
				//**************************
			}
		}
		print "<br/>";
	}
}
else if($form_visualchecked == "checked")
{
	$primeclass->startPrimeVector( );
	$rawprime = $primeclass->getPrimeVectorRaw( );
	
	foreach ($rawprime[XPRIME] as $key => $value)
	{
		if($value == 1)
		{
			//**************************
			//draw text visualation // O
			//**************************
			echo '<font face="arial,helvetica" size="2"
			color="'.rand_color().'"><strong><a title="'.$rawprime[XAREA][$key].' is a prime number." 
			alt="'.$rawprime[XAREA][$key].' is a prime number.">&empty;</a></strong></font>';
			//**************************
			//**************************
		}
		else
		{
			//**************************
			//draw text visualation // Ø
			//**************************
			echo '<font face="arial,helvetica" size="2"
			color="#F0F0F0"><strong><a title="'.$rawprime[XAREA][$key].' is not a prime number." 
			alt="'.$rawprime[XAREA][$key].' is not a prime number.">&empty;</a></strong></font>';
			//**************************
			//**************************
		}
		
	}
	print "<br/>";
	while( $primeclass->setNextPrimeVector( ) )
	{
		$rawprime = $primeclass->getPrimeVectorRaw( );
		foreach ($rawprime[XPRIME] as $key => $value)
		{
			if($value == 1)
			{
				//**************************
				//draw text visualation // O
				//**************************
				echo '<font face="arial,helvetica" size="2"
				color="'.rand_color().'"><strong><a title="'.$rawprime[XAREA][$key].' is a prime number." 
				alt="'.$rawprime[XAREA][$key].' is a prime number.">&empty;</a></strong></font>';
				//**************************
				//**************************
			}
			else
			{
				//**************************
				//draw text visualation // Ø
				//**************************
				echo '<font face="arial,helvetica" size="2"
				color="#F0F0F0"><strong><a title="'.$rawprime[XAREA][$key].' is not a prime number." 
				alt="'.$rawprime[XAREA][$key].' is not a prime number.">&empty;</a></strong></font>';
				//**************************
				//**************************
			}
		}
		print "<br/>";
	}
}
	echo '<hr><br/><br/> Total prime count : </strong>
	<font face="arial,helvetica" size="3"
	color="red"><strong>'.$primeclass->getRatio().'</strong></font> ,
	<strong>'.$primeclass->getPercentage().'</strong> 
	percentage, executed in <strong>'.$primeclass->getTime().'</strong> seconds
	<br/>';
//*******************
//Draw picture
//*******************
print "<br/><br/><img src='primeVectorImageClass.php?xresolution=10&yresolution=10&border=10&random=1&urlax=".$form_ax."&urlb0x=".$form_begin."&urlbnx=".$form_end."&urlXXA=".$form_XXA."&urlYYA=0&urlZZA=0' title='Prime Vecor Image Class Colored' alt='Prime Vecor Image Class Colored'/>";
print "<br/><br/><img src='primeVectorImageClass.php?xresolution=10&yresolution=10&border=10&random=0&urlax=".$form_ax."&urlb0x=".$form_begin."&urlbnx=".$form_end."&urlXXA=".$form_XXA."&urlYYA=0&urlZZA=0' title='Prime Vecor Image Class Black/Wite' alt='Prime Vecor Image Class Black/Wite'/>";
//*******************
echo "<br/><br/><br/><br/><br/><br/>
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

<?php
//**************************
//draw picture visualation
//**************************
$lines = file("primeVectorClass.php");
foreach ($lines as $line_num => $line)
{
	highlight_string($line);
}
//**************************
//**************************
?>
