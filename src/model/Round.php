<?php
declare(strict_types=1);
class Round
{
  public function __construct(int $roundNumber, array $participants, array $meetingRooms)
  {
    $this->roundNumber = $roundNumber;
    $this->participants = $participants;
    $this->meetingRooms = $meetingRooms;
    $this->bestRoundCount = null;
    $meetings = array();
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
      list($bestMeeting, $countOfBestMeeting, $leftPersons) =
        $this->bestMeetingOutOfN($meetingRoom, $leftPersons, $meetingsSearchDepth);
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

  public function bestMeetingOutOfN($meetingRoom, $leftPersons, $n): array  //$n gibt die "Suchtiefe" an
  {
      $bestCount = 1000000;
      $bestMeeting;
      $leftPersonsAfterMeeting;
      for($i = 1; $i <= $n; $i++) {  //einzelen Meetings mehrmals befüllen und bestes Ergebnis weiterverwenden
        $availablePersons = $leftPersons;
        $meeting = new Meeting($meetingRoom, $this->roundNumber); //wird ein neus Meeitng erstellt
        shuffle($availablePersons);
        //fillMeeting evtl besser in Meeting.php und dann mit $meeting->fillMeeting($availablePersons) aufrufen
        list($meeting, $availablePersons) = $this->fillMeeting($meeting, $availablePersons);  //die leute, die in $meeting gesteckt werden, werden aus $leftPersonsCopy entfernt
        $meetingCount = $meeting->countAlreadyMetEachOther();
        if ($meetingCount < $bestCount) {
          $bestCount = $meetingCount;
          $bestMeeting = $meeting;
          $leftPersonsAfterMeeting = $availablePersons;
          if ($bestCount === 0) {  //besser kann es nicht werden.
            break;
          }
        }
      }
      return array($bestMeeting, $bestCount, $leftPersonsAfterMeeting);
  }

  public function counductRound() {
    foreach ($this->meetings as $meeting) {
      $meeting->updateMetPersons();
    }
  }

  public function fillMeeting(object $meeting, array $leftPersons): array   //evtl besser in class Meeting   //evtl besser mit Referenz(&)
  {
    while ($meeting->freeSpaces > 0) {
      if (count($leftPersons) === 0) {
        break;
      }
      $bestPerson = $meeting->getBestPersonToMeeting($leftPersons);
      $meeting->addParticipant($bestPerson);
      $leftPersons = $this->removePerson($leftPersons, $bestPerson);
    }
    return array($meeting, $leftPersons);  //überflüssig, da referezen als parameer übergeben werden
  }

  public function removePerson(array $group, object $person): array
  {
    $key = array_search($person, $group);
    if ($key !== false) {
      unset($group[$key]);
    } else {
      echo "$person->name konnte nicht entfernt werden \n\n";
    }
    return $group;
  }

}
 ?>
