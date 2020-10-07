<?php
include_once __Dir__ . "/../model/Person.php";
include_once __Dir__ . "/../model/MeetingRoom.php";
include_once __Dir__ . "/../model/Meeting.php";
include_once __Dir__ . "/../model/Round.php";
include_once __Dir__ . "/AbstractController.php";


class MasterConroller2 extends AbstractController
{
  public function __construct()
  {
  }
  /*siehe Kommentare bei findBestResult
  in MasterController1.php für mehr Details*/
  public function findBestResult(array $people, array $rooms, $countRounds)  //genauere Eingabemaske
  {
    $roundsSearchDepth = 1;
    $meetingsSearchDepth = 1;
    $cycles = 0;

    $bestTotalCount = 0;
    $bestRounds = array();
    $bestPersons = array();

    $meetingRooms = $this->createDifferentSizedMeetingRooms($rooms);//$rooms enthölt die Größe der einzelnen Räume

    $beginn = microtime(true);
    do {
      $persons = $this->createPersonsWithName($people);
      $rounds = $this->findGoodRounds($countRounds, $persons, $meetingRooms, $roundsSearchDepth, $meetingsSearchDepth);
      //statische Zählervariablen zurücksetzen
      Meeting::$meetingName = 1;
      $roundCount = $this->totalCount($persons);
      if ($roundCount > $bestTotalCount) {
        $bestTotalCount = $roundCount;
        $bestRounds = $rounds;
        $bestPersons = $persons;
      }
      $cycles++;
      $meetingsSearchDepth++;
      $roundsSearchDepth = floor($meetingsSearchDepth / 10) + 1;
      $totalDuration = microtime(true) - $beginn;
    } while($totalDuration < 1.5);

    $this->logInfoToConsole($totalDuration, $cycles);
    $newEncountersPerPersonPerRound = $this->newEncountersPerPersonPerRound($bestRounds);
    return array($bestRounds, $bestPersons, $newEncountersPerPersonPerRound);
  }

  private function createDifferentSizedMeetingRooms($rooms)
  {
    $meetingRooms = array();
    for ($i = 0; $i < count($rooms); $i++) {
      $meetingRooms[] = new MeetingRoom($rooms[$i]);
    }
    return $meetingRooms;
  }

  private function createPersonsWithName($people)
  {
    $persons = array();
    for ($i = 0; $i < count($people); $i++) {
      $person = new Person($people[$i]);
      $persons[] = $person;
    }
    return $persons;
  }

}
?>
