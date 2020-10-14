<?php
abstract class FindBestAllBoth
{
  public function totalCount($persons)
  {
    $count = 0;;
    foreach ($persons as $person) {
      $count += count($person->metPersonsIds);
    }
    return $count;
  }

  public function newEncountersPerPersonPerRound($bestRounds)
  {
    $encountersArray= array();
    foreach ($bestRounds as $round) {
      $possibleEncoutersInRound = 0;
      foreach ($round->meetings as $meeting) {
        $possibleEncoutersInRound += count($meeting->participants) * (count($meeting->participants) - 1);
      }
      $actualEncountersInRound = $possibleEncoutersInRound - $round->bestRoundCount;
      $actualEncountersInRoundPerPerson = $actualEncountersInRound / count($round->participants);
      $encountersArray[] = $actualEncountersInRoundPerPerson;
    }
    return($encountersArray);
  }

  public function findGoodRounds($countRounds, $persons, $meetingRooms, $roundsSearchDepth, $meetingsSearchDepth)
  {
    $rounds = array();
    for($j = 1; $j <= $countRounds; $j++) {
      $fbr = new FindBestRound($roundsSearchDepth, $meetingsSearchDepth);
      $rounds[$j - 1] = $fbr->findBest($j, $persons, $meetingRooms);  //$j für Rundennummer
      $rounds[$j - 1]->counductRound();
    }
    return $rounds;
  }

  public function logInfoToConsole($totalDuration, $cycles)
  {
    echo "<script>console.log('Dauer: " . $totalDuration . "' );</script>";
    echo "<script>console.log('cycles/meetingsSearchDepth: " . $cycles . "' );</script>";
  }

}

 ?>
