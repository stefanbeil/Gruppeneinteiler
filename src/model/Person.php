<?php
declare(strict_types=1);
class Person
{
  static $uniqueId = 1;   //nur zur Übersicht während Entwicklungsphase

  public function __construct(string $name)
  {
    $this->name = $name;
    $this->id = "ID" . self::$uniqueId++;
    // $this->id = uniqid(rand(), true);     //später wieder einkommentieren
    $this->metPersonsIds = [];  //key entspricht IDs getroffeneer Personen, value entspricht wie of getroffen
  }

  public function alreadyMet(string $personId): bool { //howManyTimesMet wäre besser
    $bool = false;
    foreach ($this->metPersonsIds as $metPersonId => $howOftenMet) {
      if ($personId == $metPersonId)
      {
        $bool = true;
        break;
      }
    }
    return $bool;
  }

  public function howOftenMet(string $personId): int {
    if ($this->alreadyMet($personId)) {
      return $this->metPersonsIds[$personId];
    } else {
      return 0;
    }
  }

  public function meetPerson(string $personId): void
  {
    if (array_key_exists($personId, $this->metPersonsIds)) {
      $this->metPersonsIds[$personId] += 1;
    } else {
      $this->metPersonsIds[$personId] = 1;
    }
  }

}

 ?>
