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
        if ($number === 2) return 'P_mox';
        if ($number % 2 === 0 && $number > 0) return 'P_fox';
        if ($number === 0 || $number === 1 || $this->isOddPrime($number)) return 'P_mex';
        return 'P_fex';
    }

    private function isOddPrime(int $number): bool 
    {
        if ($number <= 1 || $number % 2 === 0) return false;
        for ($i = 3; $i * $i <= $number; $i += 2) {
            if ($number % $i === 0) return false;
        }
        return true;
    }

    public function getMexPrimes(): array { return $this->mexPrimes; }
    public function getFexPrimes(): array { return $this->fexPrimes; }
    public function getMoxPrimes(): array { return $this->moxPrimes; }
    public function getFoxPrimes(): array { return $this->foxPrimes; }
}

// Sınıfı örnekle ve verileri hazırla
$engine = new primeVector3DClass();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PrimeVector3D Real-Time 3D Rendering</title>
    <style>
        body { margin: 0; background-color: #0d1117; color: #c9d1d9; font-family: monospace; overflow: hidden; }
        #canvas3d { display: block; margin: 0 auto; background: #070a0e; }
        .ui-panel { position: absolute; top: 10px; left: 10px; background: rgba(22, 27, 34, 0.9); padding: 15px; border-radius: 6px; border: 1px solid #30363d; pointer-events: none; }
        .legend-item { display: flex; align-items: center; margin: 5px 0; }
        .color-box { width: 12px; height: 12px; margin-right: 8px; border-radius: 2px; }
    </style>
</head>
<body>

<div class="ui-panel">
    <h3>PrimeVector3D Visualizer</h3>
    <p>PHP 8.4 Backend Data Mapped to 3D Vector Space</p>
    <div class="legend-item"><div class="color-box" style="background:#ff5555"></div>P_mex (0, 1 & Odd Primes) [X-Axis]</div>
    <div class="legend-item"><div class="color-box" style="background:#55ff55"></div>P_fex (Odd Composites) [Y-Axis]</div>
    <div class="legend-item"><div class="color-box" style="background:#5555ff"></div>P_mox (Number 2) [Z-Axis]</div>
    <div class="legend-item"><div class="color-box" style="background:#ffff55"></div>P_fox (Even Numbers) [Diagonal]</div>
    <p style="font-size:11px; color:#8b949e; margin-top:15px;">* Drag mouse to rotate 3D viewport</p>
</div>

<canvas id="canvas3d"></canvas>

<script>
// PHP dizilerini güvenli şekilde JavaScript nesnelerine eşliyoruz
const datasets = {
    mex: <?php echo json_encode($engine->getMexPrimes()); ?>,
    fex: <?php echo json_encode($engine->getFexPrimes()); ?>,
    mox: <?php echo json_encode($engine->getMoxPrimes()); ?>,
    fox: <?php echo json_encode($engine->getFoxPrimes()); ?>
};

// 3D Noktalar listesi oluşturma (Her kümeye uzayda farklı bir vektör yönü veriyoruz)
const points3D = [];

// 1. P_mex: X ekseni boyunca yayılır
datasets.mex.forEach(v => points3D.push({x: v * 6, y: 0, z: 0, color: '#ff5555', val: v, label: 'mex'}));
// 2. P_fex: Y ekseni boyunca yayılır
datasets.fex.forEach(v => points3D.push({x: 0, y: v * 6, z: 0, color: '#55ff55', val: v, label: 'fex'}));
// 3. P_mox: Z ekseni boyunca yayılır
datasets.mox.forEach(v => points3D.push({x: 0, y: 0, z: v * 6, color: '#5555ff', val: v, label: 'mox'}));
// 4. P_fox: Tüm eksenlerde dengeli bir sarmal/diyagonal oluşturur
datasets.fox.forEach(v => points3D.push({x: v * 3, y: v * 3, z: v * 3, color: '#ffff55', val: v, label: 'fox'}));

// Canvas Kurulumu
const canvas = document.getElementById('canvas3d');
const ctx = canvas.getContext('2d');
function resize() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
}
window.addEventListener('resize', resize);
resize();

// 3D Dönüşüm ve Kamera Açı Değişkenleri
let angleX = 0.5;
let angleY = 0.5;
let isDragging = false;
let previousMousePosition = { x: 0, y: 0 };

// Fare Etkileşimi Kontrolleri
window.addEventListener('mousedown', e => { isDragging = true; });
window.addEventListener('mousemove', e => {
    const deltaMove = { x: e.offsetX - previousMousePosition.x, y: e.offsetY - previousMousePosition.y };
    if (isDragging) {
        angleY += deltaMove.x * 0.005;
        angleX += deltaMove.y * 0.005;
    }
    previousMousePosition = { x: e.offsetX, y: e.offsetY };
});
window.addEventListener('mouseup', e => { isDragging = false; });

// 3D Projeksiyon Fonksiyonu (Matris rotasyonu ve perspektif)
function project(x, y, z) {
    // X ekseni etrafında döndürme
    let cosX = Math.cos(angleX), sinX = Math.sin(angleX);
    let y1 = y * cosX - z * sinX;
    let z1 = y * sinX + z * cosX;

    // Y ekseni etrafında döndürme
    let cosY = Math.cos(angleY), sinY = Math.sin(angleY);
    let x2 = x * cosY + z1 * sinY;
    let z2 = -x * sinY + z1 * cosY;

    // Perspektif ölçeklemesi
    const fov = 400;
    const distance = 300;
    const scale = fov / (fov + z2 + distance);
    
    return {
        x: (x2 * scale) + canvas.width / 2,
        y: (y1 * scale) + canvas.height / 2,
        visible: (z2 + distance) > 0,
        depth: z2
    };
}

// Render Döngüsü
function animate() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    
    // Otomatik hafif dönüş (Kullanıcı sürüklemiyorken)
    if (!isDragging) {
        angleY += 0.002;
    }

    // Eksen Çizgilerini Çizdirme (Referans Grid)
    const center = project(0, 0, 0);
    const axisLength = 300;
    const axes = [
        {p: project(axisLength, 0, 0), c: '#ff5555'},
        {p: project(0, axisLength, 0), c: '#55ff55'},
        {p: project(0, 0, axisLength), c: '#5555ff'}
    ];
    axes.forEach(a => {
        if(center.visible && a.p.visible) {
            ctx.beginPath();
            ctx.strokeStyle = a.c;
            ctx.lineWidth = 1;
            ctx.moveTo(center.x, center.y);
            ctx.lineTo(a.p.x, a.p.y);
            ctx.stroke();
        }
    });

    // Noktaları derinliğe göre sıralama (Ressam Algoritması - Arkadaki önde kalmasın diye)
    const projectedPoints = points3D.map(p => {
        const proj = project(p.x, p.y, p.z);
        return { ...p, proj };
    }).filter(p => p.proj.visible);

    projectedPoints.sort((a, b) => b.proj.depth - a.proj.depth);

    // Noktaları ve Sayı Etiketlerini Çizme
    projectedPoints.forEach(p => {
        ctx.beginPath();
        ctx.arc(p.proj.x, p.proj.y, 4, 0, 2 * Math.PI);
        ctx.fillStyle = p.color;
        ctx.fill();

        // Sayı değerini yanına yazdır
        ctx.fillStyle = '#8b949e';
        ctx.font = '10px monospace';
        ctx.fillText(p.val, p.proj.x + 6, p.proj.y + 4);
    });

    requestAnimationFrame(animate);
}

animate();
</script>
</body>
</html>
