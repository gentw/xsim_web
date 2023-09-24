<?php
	session_start();
	header('Content-type:image/jpg');

	$img = imagecreate(180, 50);
	$bg = imagecolorallocate($img, 255,248,220);
	$black =imagecolorallocate($img, 255, 0, 0);
	$blue = imagecolorallocate($img, 230,230,250);
	$white = imagecolorallocate($img,255,228,181);
	imagefilledrectangle($img, 0, 0, 130, 75,$bg);

	$string = generateRandomString();
	
	for ($i = 0; $i < 50; $i++) {
    imagesetthickness($img, rand(1, 5));
    imagearc(
        $img,
        rand(1, 300), // x-coordinate of the center.
        rand(1, 300), // y-coordinate of the center.
        rand(1, 300), // The arc width.
        rand(1, 300), // The arc height.
        rand(1, 300), // The arc start angle, in degrees.
        rand(1, 300), // The arc end angle, in degrees.
        (rand(0, 1) ? $blue : $white) // A color identifier.
    );
}

	if(isset($string)){
		$_SESSION['captcha'] = $string;
	}

	$font='public/fonts/captcha/Arial_Ver.ttf';
	//$font='fonts/Times_Arial.ttf';
	//$font = 'fonts/RINGPINT.ttf';
	//imagettftext(image, size, angle, x, y, color, fontfile, text)
	imagettftext($img, 28, 5, 50, 40, $black,$font,$string);
	//imagestring($img,20,25,25, $string, $black);
	//imagettftext($im,20,0,20,30,$black,$font,$string);
	//imagettftext($im, 30, 0, 115, 60, $text_color, $font);
	//imagestring($im,2,50, 25, 20,$string, $text_color);
	imagepng($img);
	imagedestroy($img);

	function generateRandomString() {
	    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $randomString = '';
	    for ($i = 0; $i < 5; $i++) {
	        $randomString .= $characters[rand(0,strlen($characters)- 1)];
	    } 
	    return $randomString;
	}

?>