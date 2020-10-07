
<?php //Seite mit "genauerer" Eingabemaske
require_once __DIR__ . "/src/controller/MasterController2.php";

$MAX_COUNT_ROUNDS = 20;

//Personen und Räume werden aus den in $_GET übergebenen Parameter erstellt
$people = createPeopleByGET();
$rooms = createRoomsByGET();

$meetEverybodyController = new MasterConroller2();

if ((count($people) > 1) && (count($rooms) > 0) && isset($_GET['rounds'])) {
  $countRounds = min(intval(htmlspecialchars($_GET['rounds'])), $MAX_COUNT_ROUNDS);
  list($bestRounds, $bestPersons, $newEncountersPerPersonPerRound) =
    $meetEverybodyController->findBestResult($people, $rooms, $countRounds);
  renderResults($meetEverybodyController, $bestRounds, $bestPersons, $people, $rooms, $newEncountersPerPersonPerRound, $countRounds);
} else {
  renderNoResults($meetEverybodyController);
}


function renderResults($meetEverybodyController, $bestRounds, $bestPersons, $people, $rooms, $newEncountersPerPersonPerRound, $countRounds)
{
  $meetEverybodyController->render("top.php", []);
  $meetEverybodyController->render("parameters2.php", [
      "bestRounds" => $bestRounds,
      "bestPersons" => $bestPersons,
      "people" => $people,
      "rooms" => $rooms,
      "rounds" => $countRounds
   ]);
   $meetEverybodyController->render("statistics.php", [
     "bestRounds" => $bestRounds,
     "bestPersons" => $bestPersons,
     "rounds" => $countRounds,   //zu countRounds umbenennen
     "newEncountersPerPersonPerRound" => $newEncountersPerPersonPerRound
    ]);
  $meetEverybodyController->render("rounds.php", [
    "bestRounds" => $bestRounds,
    "bestPersons" => $bestPersons,
    "rounds" => $countRounds   //zu countRounds umbenennen
   ]);
}

function renderNoResults($meetEverybodyController)
{
  $meetEverybodyController->render("top.php", []);
  $meetEverybodyController->render("parameters2.php", []);
  $meetEverybodyController->render("noStatistics.php", []);
  $meetEverybodyController->render("noRounds.php", []);
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
