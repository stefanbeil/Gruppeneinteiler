    <div class="row">
      <div class="col">
        <div class="jumbotron border" style="margin-bottom: 0px;">
          <h2>Rundeneinteilung</h2>
          <?php
          $i = 1;
          foreach ($bestRounds as $key => $round):
            echo "<div class=\"jumbotron roundsJumbo\">";
            echo "<h4>Runde: $round->roundNumber\n</h4>";
            foreach ($round->meetings as $meeting):
              echo "<h6>Meeting " . $i++ ."</h6>";
              echo "Teilnehmer:\n";
              foreach ($meeting->participants as $participant):
                echo "<div class=\"rounded personStyle\" >$participant->name</div>\n";
              endforeach;
              echo "\n<br><br>";
            endforeach;
            echo "</div>";
          endforeach;
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include_once __Dir__ . "/elements/footer.php";
?>
