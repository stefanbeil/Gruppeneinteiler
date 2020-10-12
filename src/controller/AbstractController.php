<?php
include_once __Dir__ . "/../model/findBest/FindBestRound.php";


abstract class AbstractController
{
  public function render(String $file, $data)
  {
    extract($data);
    include_once __DIR__ . "/../view/$file";
  }

}
?>
