<?php
/*********************************************************************************************
 * Prime Vector Codex Example Code.
 * PHP 8.4 Compatible Presentation Layer
 *********************************************************************************************
 */

include_once ('/home/ferditekin/public_html/include/primeVectorClass/primeVectorClass.php');

function rand_color( )
{
	return '#' . str_pad( dechex( mt_rand( 0, 0xFFFFFF ) ), 6, '0', STR_PAD_LEFT );
}

$form_ax = isset($_POST['axvalue']) && $_POST['axvalue'] !== '' ? (int)$_POST['axvalue'] : 1;
$form_end = isset($_POST['nrange']) && $_POST['nrange'] > 0 && $_POST['nrange'] < 999999 ? (int)$_POST['nrange'] : 36;
$form_begin = isset($_POST['brange']) && $_POST['brange'] < $form_end ? (int)$_POST['brange'] : 0;
$form_visualchecked = isset($_POST['visual']) && $_POST['visual'] == 'true' ? 'checked' : '';
$form_XXA = isset($_POST['Xrange']) && $_POST['Xrange'] > 3 ? (int)$_POST['Xrange'] : 60;

if( isset( $_POST['axvalue'] ) && !isset( $_POST['visual'] ) )
{
	$form_visualchecked = '';
	$form_XXA = 3;
}
else if( !isset( $_POST['axvalue'] ) && !isset( $_POST['visual'] ) )
{
	$form_visualchecked = 'checked';
}

echo '<div><b>Prime number finding...</b>';
echo '<form name="htmlform" method="post" id="prime.number" action="">';
echo '<div><hr><br /><b><a title="ax start value : -n to n">ax</a></b> : <input value="'.$form_ax.'" type="text" name="axvalue" maxlength="20" size="5"> ';
echo '<b><a title="..0 vertical range">..0</a></b> : <input value="'.$form_begin.'" type="text" name="brange" maxlength="15" size="5"> ';
echo '<b><a title="..n vertical range">..n</a></b> : <input value="'.$form_end.'" type="text" name="nrange" maxlength="15" size="5"> ';
echo ' <input type="submit" value="Calculate Primes"> ';
echo '<b><a title="X horizontal range"> X</a></b> : <input value="'.$form_XXA.'" type="text" name="Xrange" maxlength="15" size="3"> ';
echo '<input type="checkbox" id="visual" name="visual" '.$form_visualchecked.' value="true">show with detailed visual representation</input><br /><br />';
echo '</div></form>';
echo "<hr><font face='arial,helvetica' size='3'><b>Prime = ( ax:$form_ax )+( ( ( 0..n:$form_begin..$form_end )+1 )*2 )+( ( ( ( 0..n:$form_begin..$form_end )*2 )-1 )*2 ) = Ax, Ay or Az</b></font><hr>";
echo '</div>';

$primeclass = new PrimeVector( $form_ax, $form_begin, $form_end, $form_XXA, 0, 0 );

if($form_visualchecked != 'checked')
{
	$primeclass->startPrimeVector( );
	$rawprime = $primeclass->getPrimeVectorRaw( );
	
	echo '<div>';

	if (isset($rawprime['XPRIME']) && is_array($rawprime['XPRIME'])) {
		foreach ($rawprime['XPRIME'] as $key => $value)
		{
			$label = htmlspecialchars($rawprime['XAREA'][$key] ?? '');
			if($value == 1) {
				echo '<font face="arial,helvetica" size="3" color="'.rand_color().'"><b><a title="'.$label.' is a prime number.">'.$label.'</a></b> </font>';
			} else {
				echo '<font face="arial,helvetica" size="3" color="lightgrey"><a title="'.$label.' is not a prime number.">'.$label.'</a> </font>';
			}
		}
	}
	echo "<br />";

	while( $primeclass->setNextPrimeVector( ) )
	{
		$rawprime = $primeclass->getPrimeVectorRaw( );
		if (isset($rawprime['XPRIME']) && is_array($rawprime['XPRIME'])) {
			foreach ($rawprime['XPRIME'] as $key => $value)
			{
				$label = htmlspecialchars($rawprime['XAREA'][$key] ?? '');
				if($value == 1) {
					echo '<font face="arial,helvetica" size="3" color="'.rand_color().'"><b><a title="'.$label.' is a prime number.">'.$label.'</a></b> </font>';
				} else {
					echo '<font face="arial,helvetica" size="3" color="lightgrey"><a title="'.$label.' is not a prime number.">'.$label.'</a> </font>';
				}
			}
		}
		echo "<br />";
	}
	echo '</div>';
}
else
{
	$primeclass->startPrimeVector( );
	$rawprime = $primeclass->getPrimeVectorRaw( );
	
	echo '<div>';

	if (isset($rawprime['XPRIME']) && is_array($rawprime['XPRIME'])) {
		foreach ($rawprime['XPRIME'] as $key => $value)
		{
			$label = htmlspecialchars($rawprime['XAREA'][$key] ?? '');
			if($value == 1) {
				echo '<font face="arial,helvetica" size="2" color="'.rand_color().'"><b><a title="'.$label.' is a prime number.">&empty;</a></b></font>';
			} else {
				echo '<font face="arial,helvetica" size="2" color="#F0F0F0"><b><a title="'.$label.' is not a prime number.">&empty;</a></b></font>';
			}
		}
	}
	echo "<br />";

	while( $primeclass->setNextPrimeVector( ) )
	{
		$rawprime = $primeclass->getPrimeVectorRaw( );
		if (isset($rawprime['XPRIME']) && is_array($rawprime['XPRIME'])) {
			foreach ($rawprime['XPRIME'] as $key => $value)
			{
				$label = htmlspecialchars($rawprime['XAREA'][$key] ?? '');
				if($value == 1) {
					echo '<font face="arial,helvetica" size="2" color="'.rand_color().'"><b><a title="'.$label.' is a prime number.">&empty;</a></b></font>';
				} else {
					echo '<font face="arial,helvetica" size="2" color="#F0F0F0"><b><a title="'.$label.' is not a prime number.">&empty;</a></b></font>';
				}
			}
		}
		echo "<br />";
	}
	echo '</div>';
}
echo '<div><hr><br /><br /> Total prime count : <font face="arial,helvetica" size="3" color="red"><b>'.$primeclass->getRatio().'</b></font> , <b>'.$primeclass->getPercentage().'</b> percentage, executed in <b>'.$primeclass->getTime().'</b> seconds<br /></div>';
echo "<div><br /><br /><img src='http://website.local/~ferditekin/include/primeVectorClass/primeVectorImageClass.php?xresolution=10&yresolution=10&border=10&random=1&urlax=".$form_ax."&urlb0x=".$form_begin."&urlbnx=".$form_end."&urlXXA=".$form_XXA."&urlYYA=0&urlZZA=0' title='Prime Vector Image Class Colored' alt='Prime Vector Image Class Colored' /></div>";
echo "<div><br /><br /><img src='http://website.local/~ferditekin/include/primeVectorClass/primeVectorImageClass.php?xresolution=10&yresolution=10&border=10&random=0&urlax=".$form_ax."&urlb0x=".$form_begin."&urlbnx=".$form_end."&urlXXA=".$form_XXA."&urlYYA=0&urlZZA=0' title='Prime Vector Image Class Black/White' alt='Prime Vector Image Class Black/White' />";
echo "<br /><br /></div>";
?>
