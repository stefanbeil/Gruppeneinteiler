
<?php // Seite mit "schnellerer" Eingabemaske
require_once __DIR__ . "/src/controller/MasterController1.php";
require_once __DIR__ . "/src/model/findBest/FindBestAll1.php";


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

  $mastercontroller1->renderResults($quantityPersons, $groupSize, $quantityGroups, $countRounds);
} else {
  $mastercontroller1->renderNoResults();
}

 ?>
