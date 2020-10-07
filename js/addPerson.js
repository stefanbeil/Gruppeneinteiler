function addPerson() {
  var counterPeople = 1;
  while (document.getElementById("person" + counterPeople) !== null) {
    counterPeople++;
  }
  var name = document.getElementById("personName");
  var personName = (name.value !== "") ? (personName = name.value) : ("Person" + counterPeople);
  if (window.innerWidth > 600) {
    name.focus();
  }
  var strToInsert = createPersonString(counterPeople, personName);
  insertPerson(strToInsert, counterPeople);
}

function createPersonString(counterPeople, personName) {
  var strToInsert1 = "<span id='person" + counterPeople + "' class='addedPerson rounded personStyle'>";
  var strToInsert2 = personName;
  var strToInsert3 = "<input class='form-control' type='hidden' name='"
    + "person"
    + counterPeople
    + "'  value='" + personName + "'>";
  var strToInsert4 = "</span>";
  var strToInsert = strToInsert1 + strToInsert2  + strToInsert3 +  strToInsert4;
  return strToInsert;
}

function insertPerson(strToInsert, counterPeople) {
  var people = document.getElementById("people");
  people.insertAdjacentHTML('beforeend', strToInsert);
  var el = document.getElementById("person" + counterPeople);
  el.addEventListener('click', deletePerson, false);
}
