<div class="col-md">
  <div class="jumbotron border">
    <h2 id="parameter" style="float: left;">Parameter</h2>
    <a style="float: right;" href="index2.php#parameter">genauere Eingabemaske</a>
    <p>
      <?php
      if (!isset($quantityPersons)):
      ?>
      <form method="GET" action="index.php">
        <div class="slidecontainer">
          <input type="range" name="quantityPersons" min="4" max="100" value="32" class="slider" id="personsSlider" style="width: 100%;">
          <p>Anzahl Personen: <span id="quantityPersons"></span></p>
          <input type="range" name="groupSize" min="2" max="20" value="8" class="slider" id="groupSizeSlider" style="width: 100%;">
          <p>Gruppengröße: <span id="groupSize"></span></p>
          <input type="range" name="quantityGroups" min="2" max="20" value="4" class="slider" id="quantityGroupsSlider" style="width: 100%;">
          <p>Anzahl Gruppen: <span id="quantityGroups"></span></p>
          <input type="range" name="rounds" min="2" max="20" value="5" class="slider" id="roundsSlider" style="width: 100%;">
          <p>Anzahl Runden: <span id="rounds"></span></p>
          <input type="submit" class="btn btn-primary" value="Gruppen einteilen">
        </div>
      </form>
      <?php
      else:
      ?>
      <form method="GET" action="index.php">
        <div class="slidecontainer">
          <input type="range" name="quantityPersons" min="4" max="100" value="<?= $quantityPersons?>" class="slider" id="personsSlider" style="width: 100%;">
          <p>Anzahl Personen: <span id="quantityPersons"></span></p>
          <input type="range" name="groupSize" min="2" max="20" value="<?= $groupSize?>" class="slider" id="groupSizeSlider" style="width: 100%;">
          <p>Gruppengröße: <span id="groupSize"></span></p>
          <input type="range" name="quantityGroups" min="2" max="20" value="<?=  $quantityGroups?>" class="slider" id="quantityGroupsSlider" style="width: 100%;">
          <p>Anzahl Gruppen: <span id="quantityGroups"></span></p>
          <input type="range" name="rounds" min="2" max="20" value="<?= $rounds?>" class="slider" id="roundsSlider" style="width: 100%;">
          <p>Anzahl Runden: <span id="rounds"></span></p>
          <input type="submit" class="btn btn-primary" value="Gruppen einteilen">
        </div>
      </form>
      <?php
      endif;
      ?>
  </div>
  <script src="js/slidersParameters1.js"></script>
</div>
