<?php
declare(strict_types=1);
include_once __Dir__ . "/findBest/FindBestMeeting.php";

class Round
{
  public function __construct(int $roundNumber, array $participants, array $meetingRooms)
  {
    $this->roundNumber = $roundNumber;
    $this->participants = $participants;
    $this->meetingRooms = $meetingRooms;
    $this->bestRoundCount = null;  
    $this->meetings = array();
  }

  public function counductRound() {
    foreach ($this->meetings as $meeting) {
      $meeting->updateMetPersons();
    }
  }


}
 ?>
