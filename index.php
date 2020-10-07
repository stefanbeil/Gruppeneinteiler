
<?php // Seite mit "schnellerer" Eingabemaske
require_once __DIR__ . "/src/controller/MasterController1.php";

$MAX_QUANTITY_PERSONS = 100;
$MAX_GROUP_SIZE = 20;
$MAX_QUANTITY_GROUPS = 20;
$MAX_COUNT_ROUNDS = 20;

$mastercontroller1 = new MasterController1();

if (isset($_GET['quantityPersons']) && isset($_GET['groupSize'])
  && isset($_GET['quantityGroups']) && isset($_GET['rounds'])) {

  $quantityPersons = min(intval(htmlspecialchars($_GET['quantityPersons'])), $MAX_QUANTITY_PERSONS); //XSS-Schutz, hier wahrscheinlich nicht nötig, aber sicher ist sicher
  $groupSize = min(intval(htmlspecialchars($_GET['groupSize'])), $MAX_GROUP_SIZE);
  $quantityGroups = min(intval(htmlspecialchars($_GET['quantityGroups'])), $MAX_QUANTITY_GROUPS);
  $countRounds = min(intval(htmlspecialchars($_GET['rounds'])), $MAX_COUNT_ROUNDS);

  list($bestRounds, $bestPersons, $newEncountersPerPersonPerRound) =
    $mastercontroller1->findBestResult($quantityPersons, $groupSize,
     $quantityGroups, $countRounds);

  renderResults($mastercontroller1, $bestRounds, $bestPersons, $newEncountersPerPersonPerRound,
    $quantityPersons, $groupSize, $quantityGroups, $countRounds);
} else {
  renderNoResults($mastercontroller1);
}


function renderResults($mastercontroller1, $bestRounds, $bestPersons, $newEncountersPerPersonPerRound,
  $quantityPersons, $groupSize, $quantityGroups, $countRounds)
{
  $mastercontroller1->render("top.php", []);
  $mastercontroller1->render("parameters1.php", [
    "quantityPersons" => $quantityPersons,
    "groupSize" => $groupSize,
    "quantityGroups" => $quantityGroups,
    "rounds" => $countRounds
  ]);
  $mastercontroller1->render("statistics.php", [
    "bestRounds" => $bestRounds,
    "bestPersons" => $bestPersons,
    "rounds" => $countRounds,
    "newEncountersPerPersonPerRound" => $newEncountersPerPersonPerRound
   ]);
 $mastercontroller1->render("rounds.php", [
   "bestRounds" => $bestRounds,
   "bestPersons" => $bestPersons,
   "rounds" => $countRounds
  ]);
}

function renderNoResults($mastercontroller1)
{
  $mastercontroller1->render("top.php", []);
  $mastercontroller1->render("parameters1.php", []);
  $mastercontroller1->render("noStatistics.php", []);
  $mastercontroller1->render("noRounds.php", []);
}

 ?>
