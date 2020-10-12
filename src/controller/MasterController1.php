<?php
include_once __Dir__ . "/../model/Person.php";
include_once __Dir__ . "/../model/MeetingRoom.php";
include_once __Dir__ . "/../model/Meeting.php";
include_once __Dir__ . "/../model/Round.php";
include_once __Dir__ . "/AbstractController.php";
include_once __Dir__ . "/../model/findBest/FindBestAll1.php";


class MasterController1 extends AbstractController
{
  public function __construct()
  {
  }

  function renderResults($quantityPersons, $groupSize, $quantityGroups, $countRounds)
  {
    $fba = new FindBestAll1();
    list($bestRounds, $bestPersons, $newEncountersPerPersonPerRound) =
      $fba->findBestResult($quantityPersons, $groupSize,
       $quantityGroups, $countRounds);

    $this->render("top.php", []);
    $this->render("parameters1.php", [
      "quantityPersons" => $quantityPersons,
      "groupSize" => $groupSize,
      "quantityGroups" => $quantityGroups,
      "rounds" => $countRounds
    ]);
    $this->render("statistics.php", [
      "bestRounds" => $bestRounds,
      "bestPersons" => $bestPersons,
      "rounds" => $countRounds,
      "newEncountersPerPersonPerRound" => $newEncountersPerPersonPerRound
     ]);
   $this->render("rounds.php", [
     "bestRounds" => $bestRounds,
     "bestPersons" => $bestPersons,
     "rounds" => $countRounds
    ]);
  }

  function renderNoResults()
  {
    $this->render("top.php", []);
    $this->render("parameters1.php", []);
    $this->render("noStatistics.php", []);
    $this->render("noRounds.php", []);
  }

}

?>
