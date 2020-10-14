<?php


include_once __Dir__ . "/FindBestMeeting.php";
include_once __Dir__ . "/../Round.php";

class FindBestRound
{

  public function __construct(int $roundsSearchDepth, int $meetingsSearchDepth)
  {
    $this->roundsSearchDepth = $roundsSearchDepth;
    $this->meetingsSearchDepth = $meetingsSearchDepth;
  }

  public function findBest($roundNumber, $participants, $meetingRooms)
  {
    list($bestMeetings, $bestRoundCount) = $this->fillRound($participants, $meetingRooms, $roundNumber);
    $round = new Round($roundNumber, $participants, $meetingRooms);
    $round->meetings = $bestMeetings;
    $round->bestRoundCount = $bestRoundCount;
    return $round;
  }

  public function fillRound($participants, $meetingRooms, $roundNumber): array
  {
    $bestRoundCount = 1000000;
    $bestMeetings = array();
    for ($i = 1; $i <= $this->roundsSearchDepth; $i++) { //beste Runde aus $roundsSearchDepth Runden finden
      $leftPersons = $participants;  //noch nicht in dieser Runde zugeteilte Personen
      $meetingsBuffer = $this->searchMeetingsForRooms($meetingRooms, $leftPersons, $this->meetingsSearchDepth, $roundNumber);
      $totalCount = 0;  //$totalCount gibt an wie viele Leute sich mehrmals treffen
      foreach ($meetingsBuffer as $meetingBuffer) {
        $totalCount += $meetingBuffer[1];
      }
      if ($totalCount < $bestRoundCount) {
        $bestRoundCount = $totalCount;
        $bestMeetings = $this->updateBestMeetings($meetingsBuffer);
      }
      if ($totalCount === 0) {  //totalCount === 0, wenn keine Personen sich mehermals treffen. Besser als 0 kann es nicht werden
        break;
      }
    }
    return array($bestMeetings, $bestRoundCount);
  }


  private function searchMeetingsForRooms($meetingRooms, $leftPersons, $meetingsSearchDepth, $roundNumber)
  {
    $meetingsBuffer = [];
    foreach ($meetingRooms as $meetingRoom) {  //für alle Räume ein gutes Meeting suchen

      $fbm = new FindBestMeeting($meetingsSearchDepth);
      list($bestMeeting, $countOfBestMeeting, $leftPersons) = $fbm->findBest($meetingRoom, $leftPersons, $roundNumber);

      $meetingsBuffer[] = array($bestMeeting, $countOfBestMeeting);
    }
    return $meetingsBuffer;
  }

  private function updateBestMeetings($meetingsBuffer)
  {
    $bestMeetings = [];
    foreach ($meetingsBuffer as $meetingBuffer) {
      $bestMeetings[] = $meetingBuffer[0];
    }
    return $bestMeetings;
  }

}


 ?>
