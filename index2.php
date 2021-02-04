
<?php //Seite mit "genauerer" Eingabemaske

require_once __DIR__ . "/src/controller/MasterController2.php";
require_once __DIR__ . "/src/model/findBest/FindBestAll2.php";

$MAX_COUNT_ROUNDS = 20;

//Personen und Räume werden aus den in $_GET übergebenen Parameter erstellt
$people = createPeopleByGET();
$rooms = createRoomsByGET();
$mastercontroller2 = new MasterController2();

if ((count($people) > 1) && (count($rooms) > 0) && isset($_GET['rounds'])) {
  $countRounds = min(intval(htmlspecialchars($_GET['rounds'])), $MAX_COUNT_ROUNDS);

  list($bestRounds, $bestPersons, $newEncountersPerPersonPerRound) =
    $mastercontroller2->getResults($people, $rooms, $countRounds);
    
  $mastercontroller2->renderResults($people, $rooms, $countRounds,
    $bestRounds, $bestPersons, $newEncountersPerPersonPerRound);
} else {
  $mastercontroller2->renderNoResults();
}



function createPeopleByGET() {
  $people = array();
  $counterPeople = 1;
  for ($i = 0; $i < 200; $i++) {   //ids ab 200 werden ignoriert
    if (isset($_GET["person" . strval($counterPeople)])) {
      $people[] = htmlspecialchars($_GET["person" . strval($counterPeople)]);
    }
    $counterPeople++;
  }
  return $people;
}

function createRoomsByGET() {
  $rooms = array();
  $counterRooms = 1;
  for ($i = 0; $i < 50; $i++) {   //ids ab 50 werden ignoriert
    if (isset($_GET["room" . strval($counterRooms)])) {
      $rooms[] = htmlspecialchars($_GET["room" . strval($counterRooms)]);
    }
    $counterRooms++;
  }
  return $rooms;
}
 ?>
