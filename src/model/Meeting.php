<?php
declare(strict_types=1);
class Meeting
{
  static $meetingName = 1;

  public function __construct(object $meetingRoom,int $inRound)
  {
    $this->meetingRoom = $meetingRoom;
    $this->inRound = $inRound;
    $this->participants = [];
    $this->freeSpaces = $meetingRoom->maxSpaces;
    $this->name = "Meeting " . self::$meetingName++;
    $this->howKnownArray = [];
  }

  public function getBestPersonToMeeting(array $leftPersons): object  //wird in Round.php aufgerufen
  {
    $leastKnownPersons = $this->getLeastKnownPersonsToMeeting($leftPersons); //array mit ids als key und howOftenMet als value
    $bestPersonId = array_rand($leastKnownPersons);
    $bestPerson = $this->findPersonById($bestPersonId, $leftPersons);
    return $bestPerson;
  }

  private function getLeastKnownPersonsToMeeting(array $leftPersons): array
  {
    if (count($this->howKnownArray) == 0) {
      foreach($leftPersons as $person) {
        $this->howKnownArray[$person->id] = 0;
      }
    }
    //$this->howKnownArray wird in addParticipant angepasst, wenn eine Person dem Meeting hinzugefügt wird
    asort($this->howKnownArray);  //$this->howKnownArray so sortieren, dass personen, die bisher am wenigsten andere Personen (aus dem bisherigem Meeting) kennen gelernt haben oben stehen
    //alle niedrigsten Werte von $howKnownArray werden über $leastKnownPersons zurückgegeben
    $leastKnownPersons = $this->howKnownArray;
    $akf = array_key_first($leastKnownPersons);
    $lowestKnownValue = $leastKnownPersons[$akf];
    $leastKnownPersons = $this->removeToHighValues($leastKnownPersons, $lowestKnownValue);
    return $leastKnownPersons;
  }

  private function removeToHighValues(array $leastKnownPersons, int $lowestKnownValue): array
  {
    foreach ($leastKnownPersons as $key =>$value) {
      if ($value > $lowestKnownValue) {
        unset($leastKnownPersons[$key]);
      }
    }
    return $leastKnownPersons;
  }

  private function personHowKnownToGroup(string $personId): int
  {
    $countKnown = 0;
    foreach ($this->participants as $groupMember) {
      if ($groupMember->alreadyMet($personId)) {
        //$countKnown += $groupMember->howOftenMet($personId); //wie oft haben sich die leute in der Gruppe sich schon bisher insgesamt mit der Person getroffen
        $countKnown++;
      }
    }
    return $countKnown;
  }

  public function addParticipant(object $person): bool
  {
    if ($this->freeSpaces > 0) {
      $this->participants[] = $person;
      $this->freeSpaces -= 1;
      $this->updateHowKnownArray($person);
      return true;
    }  else {
      return false;
    }
  }

  private function updateHowKnownArray(object $person): void
  {
    foreach($person->metPersonsIds as $id => $count) {
      if(isset($this->howKnownArray[$id])) {
        $this->howKnownArray[$id] += $count;
        $this->howKnownArray[$id] += 1;
      }
    }
    unset($this->howKnownArray[$person->id]);
  }

  private function updateLeastKnownPersonsToMeeting(object $Person): void
  {
    if (count($this->LeastKnownPersonsToMeeting) == 0) {
      $this->LeastKnownPersonsToMeeting = $leftPersons;
    }
  }

  private static function findPersonById(string $id, array $persons): object
  {
    $searchedPerson;
    foreach ($persons as $person) {
      if ($person->id == $id) {
        $searchedPerson = $person;
        break;
      }
    }
    return $searchedPerson;
  }

  public function updateMetPersons(): void {
    foreach ($this->participants as $participant) {
      foreach ($this->participants as $otherParticipant) {
        if ($participant->id !== $otherParticipant->id) {
          $participant->meetPerson($otherParticipant->id);
        }
      }
    }
  }

  public function countAlreadyMetEachOther(): int {
    $count = 0;
    foreach ($this->participants as $participant) {
      foreach ($this->participants as $otherParticipant) {
        if ($participant->alreadyMet($otherParticipant->id)) {
          $count++;
        }
      }
    }
    return $count;
  }

}

?>
