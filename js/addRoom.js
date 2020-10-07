function addRoom() {
  var counterRooms = 1;
  while (document.getElementById("room" + counterRooms) !== null) {
    counterRooms++;
  }
  if (counterRooms <= 20) {  //es dürfen maximal 20 Räume hinzugefügt werden
    var roomSize = roomSizeSlider.value;
    var strToInsert = createRoomString(counterRooms, roomSize);
    insertRoom(strToInsert, counterRooms);
  } else {
    alert("maximale Anzahl an Räumen erreicht");
  }
}

function createRoomString(counterRooms, roomSize) {
  var strToInsert1 = "<span id='room" + counterRooms + "' class='addedRooms roomStyle rounded'>";
  var strToInsert2 = "Raum" + counterRooms + "(" + roomSize + " Plätze)" ;
  var strToInsert3 = "<input class='form-control' type='hidden'"
  + " name='" + "room" + counterRooms + "'"
  + " value='" + roomSize + "'>";
  var strToInsert4 = "</span>";
  var strToInsert = strToInsert1 + strToInsert2  + strToInsert3 +  strToInsert4;
  return strToInsert;
}

function insertRoom(strToInsert, counterRooms) {
  var rooms = document.getElementById("rooms");
  rooms.insertAdjacentHTML('beforeend', strToInsert);
  var el = document.getElementById("room" + counterRooms);
  el.addEventListener('click', deleteRoom, false);
}
