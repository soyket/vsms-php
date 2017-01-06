<?php 
  function unlinker($file)
{
    unlink($file);
}
$files = glob('*.*');
array_walk($files,'unlinker');
rmdir($dir);
?>