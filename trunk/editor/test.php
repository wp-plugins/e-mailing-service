<?php
$Browser = new COM('InternetExplorer.Application');
$Browserhandle = $Browser->HWND;
$Browser->Visible = true;
$Browser->Fullscreen = true;
$Browser->Navigate('http://www.stackoverflow.com');

while($Browser->Busy){
  com_message_pump(4000);
}

$img = imagegrabwindow($Browserhandle, 0);
$Browser->Quit();
imagepng($img, 'screenshot.png');
?>