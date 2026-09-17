<?php
declare(strict_types=1);

class primeVector3DClass 
{
    // PHP 8.4 dinamik özellik hatası vermemesi için tüm değişkenleri önceden tanımlıyoruz
    private array $mexPrimes = [];
    private array $fexPrimes = [];
    private array $moxPrimes = [];
    private array $foxPrimes = [];
    
    // Periyot tanımlamaları
    private array $periods = [-8, -7, -6, -5, -4, -3, -2, -1, 0, 1, 2, 3, 4, 5, 6, 7, 8];

    public function __construct() 
    {
        // Sınıf başladığında protokol kurallarına göre kümeleri hazırlar
        $this->initializeProtocol();
    }

    /**
     * Protokole göre 0 ile 50 arasındaki sayıları sınıflandırır.
     * Bu mantık dinamik limitler için genişletilebilir.
     */
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

    /**
     * Bir sayının protokoldeki tipini (HEDEF durumunu) belirler.
     */
    public function evaluateNumber(int $number): string 
    {
        if ($number === 2) {
            return 'P_mox'; // 2 = N2P (P_mox)
        }
        
        if ($number % 2 === 0 && $number > 0) {
            return 'P_fox'; // 2 x n = (P_fox)
        }
        
        // 0, 1 ve Tek Asal kontrolü (Protokoldeki mex kümesi)
        if ($number === 0 || $number === 1 || $this->isOddPrime($number)) {
            return 'P_mex';
        }
        
        // Geriye kalan tek bileşik sayılar (3x3, 3x5, 5x5 vb.)
        return 'P_fex';
    }

    /**
     * Sayının tek asal olup olmadığını doğrular
     */
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

    /**
     * 1 / Prime periyot kök kontrolü kuralı
     * (1: N ortak kök, 2: N sayı kökü, 5: N periyot kökü hariç)
     */
    public function checkPeriodRoot(int $prime, int $rootType): ?float 
    {
        if (in_array($rootType, [1, 2, 5], true)) {
            return null; // Tanımsız / Hariç tutulan kökler
        }
        
        if ($prime === 0) {
            return null; // Sıfıra bölünme hatası engelleme
        }

        return 1 / $prime;
    }

    // --- GETTER METOTLARI (Host ve Callback mekanizmaları için) ---

    public function getMexPrimes(): array { return $this->mexPrimes; }
    public function getFexPrimes(): array { return $this->fexPrimes; }
    public function getMoxPrimes(): array { return $this->moxPrimes; }
    public function getFoxPrimes(): array { return $this->foxPrimes; }
    public function getPeriods(): array { return $this->periods; }
}

$data = new primeVector3DClass();
print_r($data);
?>