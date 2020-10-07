var personsSlider = document.getElementById("personsSlider");
var quantityPersons = document.getElementById("quantityPersons");
quantityPersons.innerHTML = personsSlider.value;
personsSlider.oninput = function() {
quantityPersons.innerHTML = this.value;
}

var groupSizeSlider = document.getElementById("groupSizeSlider");
var groupSize = document.getElementById("groupSize");
groupSize.innerHTML = groupSizeSlider.value;
groupSizeSlider.oninput = function() {
groupSize.innerHTML = this.value;
}

var quantityGroupsSlider = document.getElementById("quantityGroupsSlider");
var quantityGroups = document.getElementById("quantityGroups");
quantityGroups.innerHTML = quantityGroupsSlider.value;
quantityGroupsSlider.oninput = function() {
quantityGroups.innerHTML = this.value;
}

var roundsSlider = document.getElementById("roundsSlider");
var rounds = document.getElementById("rounds");
rounds.innerHTML = roundsSlider.value;
roundsSlider.oninput = function() {
rounds.innerHTML = this.value;
}
