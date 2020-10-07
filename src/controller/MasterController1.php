<?php
include_once __Dir__ . "/../model/Person.php";
include_once __Dir__ . "/../model/MeetingRoom.php";
include_once __Dir__ . "/../model/Meeting.php";
include_once __Dir__ . "/../model/Round.php";
include_once __Dir__ . "/AbstractController.php";


class MasterController1 extends AbstractController
{
  public function __construct($searchTime = 1.5)
  {
    $this->searchTime = 1.5;
  }

  //findBestResult teilt alle Runden ein, versucht also das beste Gesamtergebnis zu finden
  public function findBestResult($countPeople, $sizeRooms, $countRooms, $countRounds)  //schnellere Eingabemaske
  {
    /* wenn beim Einteilen der Meetings nach gewissen Kriterien meherer Personen gleich gut in das Meeting passen,
    wird unter diesen Personen eine zufällige Person ausgewählt. Die Meetings werden auf diese Art mehrmals aufgefüllt.
    Das bisher beste Ergebnis wird sich dabei gemerkt. $meetingsSearchDepth gibt hierbei an, aus wie vielen Durchläufen
    sich das best Ergebnis gemerkt wird. $roundsSearchDepth macht das gleiche für die einzelnen Runden. */
    $roundsSearchDepth = 1;
    $meetingsSearchDepth = 1;
    $cycles = 0;
    /* in folgender do-while-Schleife wird das beste Gesamtergebnis von mehreren
    Durchläufen in $bestRounds und $bestPersons gespeichert. $roundCount und
    $bestTotalCount wird verwendet um die Güte der einzelnen Durchläufe miteinander
    zu vergleichen. */
    $bestTotalCount = 0;
    $bestRounds = array();
    $bestPersons = array();

    $meetingRooms = $this->createMeetingRooms($countRooms, $sizeRooms);
    $beginn = microtime(true);
    do {
      $persons = $this->createPersons($countPeople);
      //führt Runden auch aus. Name der Funktion noch ändern
      $rounds = $this->findGoodRounds($countRounds, $persons, $meetingRooms, $roundsSearchDepth, $meetingsSearchDepth);
      //statische Zählervariablen zurücksetzen (werden beim erstellen von Personen und Meetings hochgezählt)
      Person::$uniqueId = 1;
      Meeting::$meetingName = 1;
      /*$roundCount gibt an wie viele Personen alle Personen insgesamt getroffen haben.
      Falls der aktuelle $roundCount besser ist als der bisherige Bestwert($bestTotalCount)
      werden $bestRounds und $best Persons aktuallisiert */
      $roundCount = $this->totalCount($persons);
      if ($roundCount > $bestTotalCount) {
        $bestTotalCount = $roundCount;
        $bestRounds = $rounds;
        $bestPersons = $persons;
      }
      /* Die do-while Schleife wird solange solange durchlaufen, bis beim Überprüfen der Bedingung mindestens
      $this->searchTime Sekunden vergangen sind. In jedem Durchlauf wird $meetingsSearchDepth erhöht. $roundsSearchDepth
      in jedem 10ten. Je höher die Suchtiefe, desto bessere Ergebnisse werden erzielt. Gleichzeitig werden für große
      Eingabeparameter (viele Personen, große Gruppengröße) schnell Ergebnisse geliefert (dies aber natürlich bei
      geringerer Suchtiefe)*/
      $cycles++;
      $meetingsSearchDepth++;
      $roundsSearchDepth = floor($meetingsSearchDepth / 10) + 1;
      $totalDuration = microtime(true) - $beginn;
    } while ($totalDuration < $this->searchTime);

    $this->logInfoToConsole($totalDuration, $cycles);
    $newEncountersPerPersonPerRound = $this->newEncountersPerPersonPerRound($bestRounds);
    return array($bestRounds, $bestPersons, $newEncountersPerPersonPerRound);
  }

  private function createMeetingRooms($countRooms, $sizeRooms)
  {
    $meetingRooms = array();
    for ($i = 1; $i <= $countRooms; $i++) {
      $meetingRooms[] = new MeetingRoom($sizeRooms);
    }
    return $meetingRooms;
  }

  private function createPersons($countPeople)
  {
    $persons = array();
    for ($i = 1; $i <= $countPeople; $i++) {
      $person = new Person("Person" . strval($i));
      $persons[] = $person;
    }
    return $persons;
  }

}
