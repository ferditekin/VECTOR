<?php
declare(strict_types=1);

class primeVector3DClass 
{
    private array $mexPrimes = [];
    private array $fexPrimes = [];
    private array $moxPrimes = [];
    private array $foxPrimes = [];
    
    private array $periods = [-8, -7, -6, -5, -4, -3, -2, -1, 0, 1, 2, 3, 4, 5, 6, 7, 8];

    public function __construct() 
    {
        $this->initializeProtocol();
    }

    private function initializeProtocol(): void 
    {
        for ($n = 0; $n <= 50; $n++) {
            $type = $this->evaluateNumber($n);
            
            match($type) {
                'P_mex' => $this->mexPrimes[] = $n,
                'P_fex' => $this->fexPrimes[] = $n,
                'P_mox' => $this->moxPrimes[] = $n,
                'P_fox' => $this->foxPrimes[] = $n,
                default => null
            };
        }
    }

    public function evaluateNumber(int $number): string 
    {
        if ($number === 2) {
            return 'P_mox'; // 2 = N2P (P_mox)
        }
        
        if ($number % 2 === 0 && $number > 0) {
            return 'P_fox'; // 2 x n = (P_fox)
        }
        
        if ($number === 0 || $number === 1 || $this->isOddPrime($number)) {
            return 'P_mex';
        }
        
        return 'P_fex';
    }

    private function isOddPrime(int $number): bool 
    {
        if ($number <= 1 || $number % 2 === 0) {
            return false;
        }
        for ($i = 3; $i * $i <= $number; $i += 2) {
            if ($number % $i === 0) {
                return false;
            }
        }
        return true;
    }

    public function checkPeriodRoot(int $prime, int $rootType): ?float 
    {
        if (in_array($rootType, [1, 2, 5], true)) {
            return null; 
        }
        
        if ($prime === 0) {
            return null; 
        }

        return 1 / $prime;
    }

    public function getMexPrimes(): array { return $this->mexPrimes; }
    public function getFexPrimes(): array { return $this->fexPrimes; }
    public function getMoxPrimes(): array { return $this->moxPrimes; }
    public function getFoxPrimes(): array { return $this->foxPrimes; }
    public function getPeriods(): array { return $this->periods; }
}

$data = new primeVector3DClass();
print_r($data);
?>