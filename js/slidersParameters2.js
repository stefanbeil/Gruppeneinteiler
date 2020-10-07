var roomSizeSlider = document.getElementById("roomSizeSlider");
var roomSizeNumber = document.getElementById("groupSize");
roomSizeNumber.innerHTML = roomSizeSlider.value;
roomSizeSlider.oninput = function() {
  roomSizeNumber.innerHTML = this.value;
}

var roundsSlider = document.getElementById("roundsSlider");
var roundsNumber = document.getElementById("rounds");
roundsNumber.innerHTML = roundsSlider.value;
roundsSlider.oninput = function() {
  roundsNumber.innerHTML = this.value;
}
