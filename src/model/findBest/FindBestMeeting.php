<?php
declare(strict_types=1);
class FindBestMeeting
{
  public function __construct($meetingRoom, $leftPersons, $n, $roundNumber) {
    $this->meetingRoom = $meetingRoom;
    $this->leftPersons = $leftPersons;
    $this->n = $n;
    $this->roundNumber = $roundNumber;
  }

  public function findBest()
  {
    return $this->bestMeetingOutOfN($this->meetingRoom, $this->leftPersons, $this->n);
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
