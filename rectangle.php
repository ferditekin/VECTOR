<?php

function drawRating($rating) {
    $image = imagecreate(202,202);
    $back = ImageColorAllocate($image,255,255,255);
    $border = ImageColorAllocate($image,0,0,0);
    $red = ImageColorAllocate($image,255,0,0);
    $fill = ImageColorAllocate($image,rand(0,256),rand(0,256),rand(0,256));
    ImageFilledRectangle($image,0,0,10,9,$fill);
    imagePNG($image);
    imagedestroy($image);
}

Header("Content-type: image/png");
drawRating($rating);

?>
