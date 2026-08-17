<?php
for($i=0;$i<9999;$i++)
{
	
	$number = $i * 7;
	
	if( ($i%2)==0)$number = $number + rand(0,5);

	$numbertext = "".$number."";
	$numbertext = strrev("".$numbertext."");
	$num7array = array(1,3,2,6,4,5);

	$num = 0;
	$numbertext2 = str_split ($numbertext);

	foreach($numbertext2 as $key => $value)
	{
		$num7 = ($key % 6);		
		$num += $value * ( $num7array[$num7] ) ;
	}

	$check = ( $num % 7 );

	if($check == 0) print "<br>OK => ".$numbertext." ".$number.", div factor ".$num.", mod ".$check;
	else print "<br>NOT => ".$numbertext." ".$number." div facor ".$num.", mod ".$check; 
}
?>
