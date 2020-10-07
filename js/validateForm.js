function validateForm() {
  var enoughPeople = checkEnoughPeople();
  var enoughRooms = checkEnoughRooms();
  if (enoughPeople && enoughRooms) {
    return true;
  } else {
    alert("Es müssen mindestens zwei Personen und ein Raum hinzugefügt werden um Gruppen einzuteilen.");
    return false;
  }
}

function checkEnoughPeople() {
  var counterPeople = 0;
  var enoughPeople = false;
  for (var i = 1; i < 200; i++) {  //suche nach Personen mit id person1 bis person199
    if (null !== document.getElementById("person" + i)) {
      counterPeople++;
    }
    if (counterPeople >= 2) {
      enoughPeople = true;
      break;
    }
  }
  return enoughPeople
}

function checkEnoughRooms() {
  var counterRooms = 0;
  var enoughRooms = false;
  for (var i = 1; i < 100; i++) {  //suche nach Räumern mit id room1 bis room100
    if (null != document.getElementById("room" + i)) {
      counterRooms++;
    }
    if (counterRooms >= 1) {
      enoughRooms = true;
      break;
    }
  }
  return enoughRooms;
}
