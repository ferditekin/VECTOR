<?php
/*********************************************************************************************
 * Prime Vector Codex Class Source Code.
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
 * @time 14:12 
 *********************************************************************************************
 */



class PrimeVector
{
	 protected $areax;
	 protected $XAREA;
	 protected $XPRIME;
	 protected $XXA;
	 protected $YYA;
	 protected $ZZA;
	 protected $icreaseAmount;
	 protected $begin;
	 protected $end;
	 protected $superb;
	 protected $superb2;
	 protected $endcount;
	 protected $starttime;
	 protected $endtime;
	 protected $percentage;
	 protected $imageRaw;
	 protected $imageData;


	protected function _isPrime( $number )
	{
		if ( $number < 0 ) $number *= -1 ;

		if ( $number > 7 ) ;
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

		// number count total if division by 
		// 2 ( 4, 6, 8, 10 ), 3, 4, 5 ( 10 ), 
		// 6, 8, 9, 10
		$number2 = array_map( 'intval', str_split( $number ) );
		$ncountfor2 = 0;
		$ncountfor3 = 0;
		$ncountfor5 = 0;
		//$ncountfor7 = 0;
		//$ncountfor7_left = 0;
		//$ncountfor7_right = "";
		$ncountfor9 = 0;
	
		foreach( $number2 as $key => $value )
		{
			$ncountfor3 		+= $value;
			//$ncountfor7_right 	.= $number2[( $key + 1 )].$ncountfor7_right;
		}

		$ncountfor9		= $ncountfor3;
		$ncountfor5 		= $ncountfor2 = $number2[$key];
		//$ncountfor7_right 	= $number2[0];
		//$ncountfor7 		= $ncountfor7_right - ( $ncountfor7_left * 2 );
	
		if( ( $ncountfor2 % 2 ) == 0 )
		{
			return false;
		}
		else if( ( $ncountfor3 % 3 ) == 0 )
		{
			return false;
		}
		else if( ( $ncountfor5 % 5 ) == 0 )
		{
			return false;
		}
		//else if( ( $ncountfor7 % 7 ) == 0 && $ncountfor7 > 7 )
		//{
		//	return false;
		//}
		else if( ( $ncountfor9 % 9 ) == 0 )
		{
			return false;
		}


		// square root algorithm speeds up testing of bigger prime numbers
		$x = sqrt( $number );
		$x = floor( $x );
		for ( $i = 2 ; $i <= $x ; ++$i ) {
			if ( $number % $i == 0 ) {
				break;
			}
		}
	
		if( $x == $i-1 )
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	protected function _timeStart( )
	{
		//****************************
		//Time execution for algoritm start time
		//****************************
		$mtime = microtime( );
		$mtime = explode( " ",$mtime );
		$mtime = $mtime[1] + $mtime[0];
		$this->starttime = $mtime;
		//****************************
	}

	protected function _timeEnd( )
	{
		//****************************
		//Time execution for algoritm end time
		//****************************
		$mtime = microtime( );
		$mtime = explode( " ",$mtime );
		$mtime = $mtime[1] + $mtime[0];
		$this->endtime = $mtime;

		$this->imageData = "Image Header,X:$this->XXA,Y:$this->endcount,Execution Time:".$this->getTime().",Date:".date("Y-m-d").",Time:".date("H:i:s").",Time Zone:".date("c")."; ".$this->imageData;
		//****************************
	}

	public function getTime( )
	{
		if($this->endtime <= 0)$this->_timeEnd( );

		//****************************
		//Get total work time difference between end and start
		//****************************
		return ( $this->endtime - $this->starttime );
		//****************************
	}

	public function getPercentage( )
	{
		$c = $this->endcount / 100;
		$this->percentage = floor( $this->superb / $c );
		return "% ".$this->percentage;
	}

	public function getRatio( )
	{
		return $this->superb." / ".$this->endcount;
	}

	public function getWeight( )
	{
		return $this->XXA;
	}

	public function getHeight( )
	{
		return $this->endcount;
	}

	public function PrimeVector( $ax, $b0x, $bnx, $XA, $YA, $ZA )
	{
		if( !isset( $this->$areax[0] ) )
		{
			$this->icreaseAmount	= $b0x;
			$this->XXA		= $XA;
			$this->YYA		= $YA;
			$this->ZZA		= $ZA;
			$this->begin		= $b0x;
			$this->end		= $bnx;
			$this->endcount		= 0;
			$this->suberb		= 0;
			$this->percentage	= 0;
			$this->imageData	= "";

			if( $this->begin == 0 ) $this->icreaseAmount = 1;
			else if( $this->begin >= 1 ) $this->icreaseAmount = 1;
			else if( $this->begin <= -1 ) $this->icreaseAmount = 1;
			else if( $this->begin > -1 && $this->begin < 0 ) $this->icreaseAmount *= -1;

			if( $ax == null ) $ax = 1;
			if( $b0x == null ) $b0x = 0;
			if( $bnx == null ) $bnx = 36;
			if( $AX == null ) $AX = 60;
			if( $AY == null ) $AY = 0;
			if( $AZ == null ) $AZ = 0;

			if( $bnx < 99999999999999999999 && $bnx > 0 ) $this->end = $bnx;
			else $this->end = 36;

			for( $i = 0; $i < $this->XXA; $i++ )
			{
				if( $ax == null ) $ax = 0;
				$this->areax[$i] = $ax;
				$this->XAREA[$i] = 0;
				$this->XPRIME[$i] = 0;
			}
		}
	}

	protected function setPrimeVectorRaw( )
	{
		$this->imageRaw = "";
		$ipush = 0;
		while( $ipush < $this->XXA )
		{
			if( $this->_isPrime( $this->XAREA[$ipush] ) )
			{
				$this->XPRIME[$ipush] = 1;
				$this->imageRaw .= "1,";
				$this->superb++;
			}
			else
			{
				$this->XPRIME[$ipush] = 0;
				$this->imageRaw .= "0,";
			}

			
			$ipush++;
		}
		$this->imageData .= $this->imageRaw .= "; ";
	}


	public function getPrimeVectorRaw( )
	{
		$tempprimeraw[XAREA] = null;
		$tempprimeraw[XPRIME] = null;
		if( !( $this->begin >= $this->end ) )
		{	
			$tempprimeraw[XAREA] = $this->XAREA;
			$tempprimeraw[XPRIME] = $this->XPRIME;
		}
		else if( ( $this->begin == $this->end ) )
		{
			$tempprimeraw[XAREA] = $this->XAREA;
			$tempprimeraw[XPRIME] = $this->XPRIME;
			$this->begin = $this->begin + $this->icreaseAmount;
		}
		else
		{
			$tempprimeraw[XAREA] = null;
			$tempprimeraw[XPRIME] = null;
			if($$this->endtime <= 0) $this->_timeEnd( );
		}

		return $tempprimeraw;
	}

	public function startPrimeVector( )
	{
		$this->_timeStart( );

		$ipop = 0;
		$ipush = 0;
		$i = $this->begin;
		while( $ipush < $this->XXA )
		{
			$this->XAREA[$ipush] = $this->areax[$ipush] + ( ( ( $i + $ipop ) + 1 ) * 2 ) + ( ( ( ( $i + $ipop ) * 2 ) - 1 ) * 2 ); $ipush++;
			$this->XAREA[$ipush] = $this->areax[$ipush] + ( ( ( $i + $ipop ) + 1 ) * 2 ) ; $ipush++;
			$this->XAREA[$ipush] = $this->areax[$ipush] + ( ( ( ( $i + $ipop ) * 2 ) - 1 ) * 2 ); $ipush++;
		
			$ipop++; 

			$this->XAREA[$ipush] = $this->areax[$ipush] - ( ( $i + $ipop ) * 2 ) - ( ( ( ( $i + $ipop ) * 2 ) - 1 ) * 2 ); $ipush++;
			$this->XAREA[$ipush] = $this->areax[$ipush] - ( ( $i + $ipop ) * 2 ) ; $ipush++;
			$this->XAREA[$ipush] = $this->areax[$ipush] - ( ( ( ( $i + $ipop ) * 2 ) - 1 ) * 2 ); $ipush++;

			$ipop++;
		}

		$this->begin = $this->begin + $this->icreaseAmount;

		$ipush = $ipop = 0;
		while( $ipush < $this->XXA )
		{
			$this->areax[$ipush] = $this->XAREA[$ipop]; $ipush++;
			$this->areax[$ipush] = $this->XAREA[$ipop]; $ipush++;
			$this->areax[$ipush] = $this->XAREA[$ipop]; $ipush++;
			$ipop = $ipop + 3;
		}

		$this->endcount++;
		$this->setPrimeVectorRaw( );
		return 1;
	}

	public function setNextPrimeVector( )
	{
		if( $this->begin < $this->end )
		{
			$i = $this->begin;

			$ipop = 0;
			$ipush = 0;
			while( $ipush < $this->XXA )
			{
				$this->XAREA[$ipush] = $this->areax[$ipush] + ( ( ( $i + $ipop ) + 1 ) * 2 ) + ( ( ( ( $i + $ipop ) * 2 ) - 1 ) * 2 ); $ipush++;
				$this->XAREA[$ipush] = $this->areax[$ipush] + ( ( ( $i + $ipop ) + 1 ) * 2 ) ; $ipush++;
				$this->XAREA[$ipush] = $this->areax[$ipush] + ( ( ( ( $i + $ipop ) * 2 ) - 1 ) * 2 ); $ipush++;
		
				$ipop++; 

				$this->XAREA[$ipush] = $this->areax[$ipush] - ( ( $i + $ipop ) * 2 ) - ( ( ( ( $i + $ipop ) * 2 ) - 1 ) * 2 ); $ipush++;
				$this->XAREA[$ipush] = $this->areax[$ipush] - ( ( $i + $ipop ) * 2 ) ; $ipush++;
				$this->XAREA[$ipush] = $this->areax[$ipush] - ( ( ( ( $i + $ipop ) * 2 ) - 1 ) * 2 ); $ipush++;

				$ipop++;
			}

			$this->begin = $this->begin + $this->icreaseAmount;

			$ipush = $ipop = 0;
			while( $ipush < $this->XXA )
			{
				$this->areax[$ipush] = $this->XAREA[$ipop]; $ipush++;
				$this->areax[$ipush] = $this->XAREA[$ipop]; $ipush++;
				$this->areax[$ipush] = $this->XAREA[$ipop]; $ipush++;
				$ipop = $ipop + 3;
			}

			$this->endcount++;
			$this->setPrimeVectorRaw( );
			$next_ok = 1;
		}
		else
		{
			$next_ok = 0;
		}
		return $next_ok;
	}

	function getPrimeVectorImageData()
	{
		return $this->imageData;
	}

	public function __destruct( )
	{
		;
	}
}

?>
