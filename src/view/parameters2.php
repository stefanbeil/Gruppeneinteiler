<div class="col-lg">
  <div class="jumbotron border">
    <h2 id="parameter" style="float: left;">Parameter</h2>
    <a style="float: right;" href="index.php#parameter">schnellere Eingabemaske</a>
    <div>
      <div class="input-group mb-3">
        <input id="personName" type="text" class="form-control" placeholder="Name" onfocus="this.value=''" aria-label="Name der Person" aria-describedby="button-addon2">
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" type="button" id="button-addon1" onclick="addPerson();">Person hinzufügen</button>
        </div>
      </div>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Größe</span>
          <span class="input-group-text" id="groupSize"></span>
        </div>
        <input id="roomSizeSlider" type="range" class="form-control" name="groupSize" min="2" max="20" value="5" class="slider">
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="
          addRoom();">Raum hinzufügen</button>
        </div>
      </div>
      <form method="GET" action="index2.php" onsubmit="return validateForm()">
        <input type="range" name="rounds" min="2" max="20" value="5" class="slider" id="roundsSlider" style="width: 100%;">
        <p>Anzahl Runden: <span id="rounds"></span></p>
        <script> // muss vor "el.addEventListener('click', deletePerson, false);" stehen
        function deletePerson() {
          this.remove();
        }
        </script>
        <h2>Personen</h2>
        <p id="people">
        <?php
        if (isset($people)):
          foreach ($people as $key => $person):
        ?>
            <span id="person<?php echo ($key + 1);?>" class="addedPerson personStyle rounded">
              <?= $person; ?>
              <input class="form-control" type="hidden" name="person<?= ($key + 1)?>" value="<?= $person ?>">
            </span>
            <script>
            var el = document.getElementById("person<?= ($key + 1)?>");
            el.addEventListener('click', deletePerson, false);
            </script>
        <?php
          endforeach;
        endif;
        ?>
        </p>
        <script> //muss vor "el.addEventListener('click', deleteRoom, false);" stehen
        function deleteRoom() {
          this.remove();
        }
        </script>
        <h2>Räume</h2>
        <p id="rooms">
          <?php
          if (isset($rooms)):
            foreach ($rooms as $key => $room):
          ?>
              <span id="room<?php echo ($key + 1); ?>" class="addedRooms roomStyle rounded">
                <?php echo "Raum" .
                ($key + 1) .
                "(" . $room . " Plätze)"; ?>
                <input class="form-control" type="hidden" name="room<?php echo ($key + 1); ?>" value="<?php echo $room; ?>">
              </span>
              <script>
              var el = document.getElementById("room<?php echo ($key + 1);?>");
              el.addEventListener('click', deleteRoom, false);
              </script>
          <?php
            endforeach;
          endif;
          ?>
        </p>
        <input type="submit" class="btn btn-primary" value="Gruppen einteilen"></button>
      </form>
      <script src="js/slidersParameters2.js"></script>
      <script src="js/addRoom.js"></script>
      <script src="js/addPerson.js"></script>
      <script src="js/validateForm.js"></script>
    </div>
  </div>
</div>
