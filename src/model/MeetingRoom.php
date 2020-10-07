<?php
declare(strict_types=1);
//Noch Raum Name hinzufügen
class MeetingRoom
{
  static $roomCounter = 1;
  public function __construct(int $maxSpaces, string $name = "Raum") //Name, stnadartmäßig tisch 1, 2, 3, ...
  {
    $this->maxSpaces = $maxSpaces;
    $this->name = ($name === "Raum") ? ("Raum" . self::$roomCounter) : $name;
    self::$roomCounter++;
  }

}

 ?>
