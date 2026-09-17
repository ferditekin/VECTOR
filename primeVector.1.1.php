<?php
include_once ('/home/ferditekin/public_html/include/primeVectorClass/primeVectorClass.php');

function rand_color( )
{
	return '#' . str_pad( dechex( mt_rand( 0, 0xFFFFFF ) ), 6, '0', STR_PAD_LEFT );
}

$form_ax = isset($_POST['axvalue']) && $_POST['axvalue'] !== '' ? (int)$_POST['axvalue'] : 1;
$form_end = isset($_POST['nrange']) && $_POST['nrange'] > 0 && $_POST['nrange'] < 999999 ? (int)$_POST['nrange'] : 32;
$form_begin = isset($_POST['brange']) && $_POST['brange'] < $form_end ? (int)$_POST['brange'] : 0;
$form_visualchecked = isset($_POST['visual']) && $_POST['visual'] == 'true' ? 'checked' : '';
$form_XXA = isset($_POST['Xrange']) && $_POST['Xrange'] > 3 ? (int)$_POST['Xrange'] : 32;


$form_visualchecked = 'checked="checked"';

if( isset( $_POST['axvalue'] ) && !isset( $_POST['visual'] ) )
{
	$form_visualchecked = '';
	$form_XXA = 3;
}
else if( !isset( $_POST['axvalue'] ) && !isset( $_POST['visual'] ) )
{
	$form_visualchecked = 'checked="checked"';
}


echo '<div><b>Prime number finding...</b>';
echo '<form name="htmlform" method="post" id="prime.number" action="">';
echo '<div><hr /><br /><b><a title="ax start value : -n to n">ax</a></b> : <input value="'.$form_ax.'" type="text" name="axvalue" maxlength="20" size="5" /> ';
echo '<b><a title="..0 vertical range">..0</a></b> : <input value="'.$form_begin.'" type="text" name="brange" maxlength="15" size="5" /> ';
echo '<b><a title="..n vertical range">..n</a></b> : <input value="'.$form_end.'" type="text" name="nrange" maxlength="15" size="5" /> ';
echo ' <input type="submit" value="Calculate Primes" /> ';
echo '<b><a title="X horizontal range"> X</a></b> : <input value="'.$form_XXA.'" type="text" name="Xrange" maxlength="15" size="3" /> ';
echo '<input type="checkbox" id="visual" name="visual" '.$form_visualchecked.' value="true" />';
echo '<label for="visual"> show with detailed visual representation</label> <br /><br />';
echo '</div></form>';
echo '<hr /><b>Prime = ( ax:'.$form_ax.' )+( ( ( 0..n:'.$form_begin.'..'.$form_end.' )+1 )*2 )+( ( ( ( 0..n:'.$form_begin.'..'.$form_end.' )*2 )-1 )*2 ) = Ax, Ay or Az</b><hr />';
echo '</div>';

$primeclass = new PrimeVector( $form_ax, $form_begin, $form_end, $form_XXA, 0, 0 );

if($form_visualchecked != 'checked="checked"')
{
	$primeclass->startPrimeVector( );
	$rawprime = $primeclass->getPrimeVectorRaw( );
	
	echo '<table cellpadding="8" cellspacing="0" style=" border: 1px solid grey; border-collapse: collapse;"><tr><td><div>';

	if (isset($rawprime['XPRIME']) && is_array($rawprime['XPRIME'])) {
		foreach ($rawprime['XPRIME'] as $key => $value)
		{
			$label = htmlspecialchars($rawprime['XAREA'][$key] ?? '');
			if($value == 1) {
				echo '<a title="'.$label.' is a prime number." style="color: black;"><b>'.$label.'</b></a>';
			} else {
				echo '<a title="'.$label.' is not a prime number." style="color: lightgrey;">'.$label.'</a>';
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
					echo '<a title="'.$label.' is a prime number." style="color: black;"><b>'.$label.'</b></a>';
				} else {
					echo '<a title="'.$label.' is not a prime number." style="color: lightgrey;"><b>'.$label.'</b></a>';
				}
			}
		}
		echo "<br />";
	}
	echo '</td></tr></table></div>';
}
else
{
	$primeclass->startPrimeVector( );
	$rawprime = $primeclass->getPrimeVectorRaw( );
	
	echo '<table cellpadding="8" cellspacing="0" style="border: 1px solid grey; border-collapse: collapse;"><tr><td><div><code>';

	if (isset($rawprime['XPRIME']) && is_array($rawprime['XPRIME'])) {
		foreach ($rawprime['XPRIME'] as $key => $value)
		{
			$label = htmlspecialchars($rawprime['XAREA'][$key] ?? '');
			if($value == 1) {
				echo '<a title="'.$label.' is a prime number." style="color: '.rand_color().';"><b>H </b></a>';
			} else {
				echo '<a title="'.$label.' is not a prime number." style="color: lightgrey;">. </a>';
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
					echo '<a title="'.$label.' is a prime number." style="color: '.rand_color().';"><b>H </b></a>';
				} else {
					echo '<a title="'.$label.' is not a prime number." style="color: lightgrey;"><b>. </b></a>';
				}
			}
		}
		echo "<br />";
	}
	echo '</code></div></td></tr></table>';
}

$img_src_color = "http://website.local/~ferditekin/include/primeVectorClass/primeVectorImageClass.php?xresolution=10&amp;yresolution=10&amp;border=10&amp;random=1&amp;urlax=".$form_ax."&amp;urlb0x=".$form_begin."&amp;urlbnx=".$form_end."&amp;urlXXA=".$form_XXA."&amp;urlYYA=0&amp;urlZZA=0";
$img_src_black = "http://website.local/~ferditekin/include/primeVectorClass/primeVectorImageClass.php?xresolution=10&amp;yresolution=10&amp;border=10&amp;random=0&amp;urlax=".$form_ax."&amp;urlb0x=".$form_begin."&amp;urlbnx=".$form_end."&amp;urlXXA=".$form_XXA."&amp;urlYYA=0&amp;urlZZA=0";

echo '<div><hr /><br /><br /> Total prime count : <a style="color: red" title="'.$primeclass->getRatio().'"><b>'.$primeclass->getRatio().'</b></a> , <b>'.$primeclass->getPercentage().'</b> percentage, executed in <b>'.$primeclass->getTime().'</b> seconds<br /></div>';
echo '<div><br /><br /><img src="'.$img_src_color.'" title="Prime Vector Image Class Colored" alt="Prime Vector Image Class Colored" /></div>';
echo '<div><br /><br /><img src="'.$img_src_black.'" title="Prime Vector Image Class Black/White" alt="Prime Vector Image Class Black/White" />';
echo "<br /><br /></div>";
?>
