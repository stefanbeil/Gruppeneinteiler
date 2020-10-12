<?php


include_once __Dir__ . "/FindBestMeeting.php";
include_once __Dir__ . "/../Round.php";

class FindBestRound
{

  public function __construct(int $roundsSearchDepth, int $meetingsSearchDepth, int $roundNumber, array $participants, array $meetingRooms)
  {
    $this->roundsSearchDepth = $roundsSearchDepth;
    $this->meetingsSearchDepth = $meetingsSearchDepth;

    $this->roundNumber = $roundNumber;
    $this->participants = $participants;
    $this->meetingRooms = $meetingRooms;
    $this->bestRoundCount = null;
    $this->meetings = array();
  }

  public function findBest()
  {
    $this->fillRound($this->roundsSearchDepth, $this->meetingsSearchDepth);
    $round = new Round($this->roundNumber, $this->participants, $this->meetingRooms);
    $round->bestRoundCount = $this->bestRoundCount;
    $round->meetings = $this->meetings;
    return $round;
  }

  public function fillRound(int $roundsSearchDepth, int $meetingsSearchDepth): void
  {
    $bestRoundCount = 1000000;
    $bestMeetings = array();
    for ($i = 1; $i <= $roundsSearchDepth; $i++) { //beste Runde aus $roundsSearchDepth Runden finden
      $leftPersons = $this->participants;  //noch nicht in dieser Runde zugeteilte Personen
      $meetingsBuffer = $this->searchMeetingsForRooms($this->meetingRooms, $leftPersons, $meetingsSearchDepth);
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
    $this->bestRoundCount = $bestRoundCount;
    $this->meetings = $bestMeetings;
  }


  private function searchMeetingsForRooms($meetingRooms, $leftPersons, $meetingsSearchDepth)
  {
    $meetingsBuffer = [];
    foreach ($this->meetingRooms as $meetingRoom) {  //für alle Räume ein gutes Meeting suchen

      $fbm = new FindBestMeeting($meetingRoom, $leftPersons, $meetingsSearchDepth, $this->roundNumber);
      list($bestMeeting, $countOfBestMeeting, $leftPersons) = $fbm->findBest();

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
