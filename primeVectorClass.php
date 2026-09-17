<?php
/*********************************************************************************************
 * Prime Vector Codex Class Source Code.
 * PHP 8.4 Compatible Version
 *********************************************************************************************
 */

class PrimeVector
{
	 protected $areax = [];
	 protected $XAREA = [];
	 protected $XPRIME = [];
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

	// PHP 8.4 uyumlu constructor
	public function __construct( $ax, $b0x, $bnx, $XA, $YA, $ZA )
	{
		$this->icreaseAmount	= $b0x;
		$this->XXA		= $XA;
		$this->YYA		= $YA;
		$this->ZZA		= $ZA;
		$this->begin		= $b0x;
		$this->end		= $bnx;
		$this->endcount		= 0;
		$this->superb		= 0; // Yazım hatası düzeltildi: suberb -> superb
		$this->percentage	= 0;
		$this->imageData	= "";

		if( $this->begin == 0 ) $this->icreaseAmount = 1;
		else if( $this->begin >= 1 ) $this->icreaseAmount = 1;
		else if( $this->begin <= -1 ) $this->icreaseAmount = 1;
		else if( $this->begin > -1 && $this->begin < 0 ) $this->icreaseAmount *= -1;

		if( $ax === null ) $ax = 1;
		if( $b0x === null ) $b0x = 0;
		if( $bnx === null ) $bnx = 36;
		if( $XA === null ) $XA = 60;
		if( $YA === null ) $YA = 0;
		if( $ZA === null ) $ZA = 0;

		if( $bnx < 999999 && $bnx > 0 ) $this->end = $bnx;
		else $this->end = 36;

		for( $i = 0; $i < $this->XXA; $i++ )
		{
			$this->areax[$i] = $ax;
			$this->XAREA[$i] = 0;
			$this->XPRIME[$i] = 0;
		}
	}

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

		$number2 = array_map( 'intval', str_split( (string)$number ) );
		$ncountfor3 = 0;
		$key = 0;
	
		foreach( $number2 as $key => $value )
		{
			$ncountfor3 += $value;
		}

		$ncountfor9 = $ncountfor3;
		$ncountfor5 = $ncountfor2 = $number2[$key];
	
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
		else if( ( $ncountfor9 % 9 ) == 0 )
		{
			return false;
		}

		$x = sqrt( $number );
		$x = floor( $x );
		$i = 2;
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
		$this->starttime = microtime(true);
	}

	protected function _timeEnd( )
	{
		$this->endtime = microtime(true);
		$this->imageData = 'Image Header,X:'.$this->XXA.',Y:'.$this->endcount.',Execution Time:'.$this->getTime().',Date:'.date('Y-m-d').',Time:'.date('H:i:s').',Time Zone:'.date('c').'; '.$this->imageData;
	}

	public function getTime( )
	{
		if(empty($this->endtime) || $this->endtime <= 0) $this->_timeEnd( );
		return ( $this->endtime - $this->starttime );
	}

	public function getPercentage( )
	{
		if ($this->endcount == 0) return "% 0";
		$c = $this->endcount / 100;
		$this->percentage = floor( $this->superb / $c );
		return "% " . $this->percentage;
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
		$this->imageData .= $this->imageRaw . "; ";
	}

	public function getPrimeVectorRaw( )
	{
		$tempprimeraw = ['XAREA' => null, 'XPRIME' => null];
		if( !( $this->begin >= $this->end ) )
		{	
			$tempprimeraw['XAREA'] = $this->XAREA;
			$tempprimeraw['XPRIME'] = $this->XPRIME;
		}
		else if( ( $this->begin == $this->end ) )
		{
			$tempprimeraw['XAREA'] = $this->XAREA;
			$tempprimeraw['XPRIME'] = $this->XPRIME;
			$this->begin = $this->begin + $this->icreaseAmount;
		}
		else
		{
			if(empty($this->endtime) || $this->endtime <= 0) $this->_timeEnd( );
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
			$this->XAREA[$ipush] = $this->areax[$ipush] - ( ( $i + $ipop ) * 2 ) - ( ( ( ( $i + $ipop ) * 2 ) - 1 ) * 2 ); $ipush++;
			$this->XAREA[$ipush] = $this->areax[$ipush] - ( ( $i + $ipop ) * 2 ) ; $ipush++;
			$this->XAREA[$ipush] = $this->areax[$ipush] - ( ( ( ( $i + $ipop ) * 2 ) - 1 ) * 2 ); $ipush++;

			$ipop++;

			$this->XAREA[$ipush] = $this->areax[$ipush] + ( ( ( $i + $ipop ) + 1 ) * 2 ) + ( ( ( ( $i + $ipop ) * 2 ) - 1 ) * 2 ); $ipush++;
			$this->XAREA[$ipush] = $this->areax[$ipush] + ( ( ( $i + $ipop ) + 1 ) * 2 ) ; $ipush++;
			$this->XAREA[$ipush] = $this->areax[$ipush] + ( ( ( ( $i + $ipop ) * 2 ) - 1 ) * 2 ); $ipush++;
		
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
				$this->XAREA[$ipush] = $this->areax[$ipush] - ( ( $i + $ipop ) * 2 ) - ( ( ( ( $i + $ipop ) * 2 ) - 1 ) * 2 ); $ipush++;
				$this->XAREA[$ipush] = $this->areax[$ipush] - ( ( $i + $ipop ) * 2 ) ; $ipush++;
				$this->XAREA[$ipush] = $this->areax[$ipush] - ( ( ( ( $i + $ipop ) * 2 ) - 1 ) * 2 ); $ipush++;

				$ipop++;

				$this->XAREA[$ipush] = $this->areax[$ipush] + ( ( ( $i + $ipop ) + 1 ) * 2 ) + ( ( ( ( $i + $ipop ) * 2 ) - 1 ) * 2 ); $ipush++;
				$this->XAREA[$ipush] = $this->areax[$ipush] + ( ( ( $i + $ipop ) + 1 ) * 2 ) ; $ipush++;
				$this->XAREA[$ipush] = $this->areax[$ipush] + ( ( ( ( $i + $ipop ) * 2 ) - 1 ) * 2 ); $ipush++;
		
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

	public function getPrimeVectorImageData()
	{
		return $this->imageData;
	}

	public function __destruct( )
	{
		// Destructor
	}
}
?>
