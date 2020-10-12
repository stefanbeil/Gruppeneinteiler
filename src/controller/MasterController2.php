<?php
include_once __Dir__ . "/../model/Person.php";
include_once __Dir__ . "/../model/MeetingRoom.php";
include_once __Dir__ . "/../model/Meeting.php";
include_once __Dir__ . "/../model/Round.php";
include_once __Dir__ . "/AbstractController.php";
include_once __Dir__ . "/../model/findBest/FindBestAll2.php";

class MasterController2 extends AbstractController
{
  public function __construct()
  {
  }

  function renderResults($people, $rooms, $countRounds)
  {
    $fba = new FindBestAll2();
    list($bestRounds, $bestPersons, $newEncountersPerPersonPerRound) =
      $fba->findBestResult($people, $rooms, $countRounds);

    $this->render("top.php", []);
    $this->render("parameters2.php", [
        "bestRounds" => $bestRounds,
        "bestPersons" => $bestPersons,
        "people" => $people,
        "rooms" => $rooms,
        "rounds" => $countRounds
     ]);
     $this->render("statistics.php", [
       "bestRounds" => $bestRounds,
       "bestPersons" => $bestPersons,
       "rounds" => $countRounds,   //zu countRounds umbenennen
       "newEncountersPerPersonPerRound" => $newEncountersPerPersonPerRound
      ]);
    $this->render("rounds.php", [
      "bestRounds" => $bestRounds,
      "bestPersons" => $bestPersons,
      "rounds" => $countRounds   //zu countRounds umbenennen
     ]);
  }

  function renderNoResults()
  {
    $this->render("top.php", []);
    $this->render("parameters2.php", []);
    $this->render("noStatistics.php", []);
    $this->render("noRounds.php", []);
  }

}

 ?>
