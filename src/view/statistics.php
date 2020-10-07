  <div class="col-md">
    <div class="jumbotron border">
      <h2>Statistik</h2>
      <?php
      $totalCount = 0.0;
      foreach ($bestPersons as $person) {
        $count = count($person->metPersonsIds);
        $totalCount += $count;
      }
      echo "<br>Anzahl durchschntittlicher neuer getroffener Personen pro Person pro Runde: " . round((($totalCount /count($bestPersons)) / $rounds), 2)  . "\n\n<br>";
      echo "<br>Anzahl durchschntittlicher neuer getroffener Personen pro Person insgesamt: " . round(($totalCount /count($bestPersons)), 2) . "\n\n <br><br>";

      ?>
      <div class="col imageWrapper" >
        <button class="btn btn-secondary" data-toggle="modal" data-target="#modal1">
          mehr Details
        </button>
        <div class="modal fade" id="modal1" tabindex="-1" role="dialog"aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Detailiertere Statistik
                </h5>
                <button type="button" class="close" data-dismiss="modal"
                aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <h3>Anzahl neuer getroffener Personen pro Person je Runde:</h3>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Runde</th>
                      <th scope="col">Anzahl</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  foreach ($newEncountersPerPersonPerRound as $key => $encounters)
                  echo "<tr><td>" . ($key + 1)  . "</td><td> " . round($encounters, 2) . "</td></tr>";
                  ?>
                  </tbody>
                </table>
                <br>
                <h3>Anzahl getroffener Personen je Person insgesamt: </h3>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Name</th>
                      <th scope="col">getroffene Personen</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($bestPersons as $person) {
                      $count = count($person->metPersonsIds);
                      echo "<tr><td>" . $person->name . "</td><td>". $count . "</td></tr>";
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> <!-- Schließendes Tag gehört zu der "row" in der sich statistics.php befindet -->
