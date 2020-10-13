Übersicht Gruppeneinteiler

Dieses Tool ist dafür gedacht Personen in mehreren Runden so in Gruppen einzuteilen, dass jede Person möglichst viele unterschiedliche Personen trifft.
Damit gute Ergebnisse erzielt werden, sollte die Anzahl der Personen gleich der Anzahl der Gruppen mal der Gruppengröße sein. Falls die Anzahl der Personen größer ist, müssen einzelne Personen in einigen Runden aussetzen. Falls die Anzahl der Personen kleiner ist, bleiben in einigen Gruppen Plätze leer.
Besonders gute Ergebnisse werden in der Regel erzielt, wenn die Gruppengröße ein Vielfaches der Anzahl der Gruppen ist.
Unter http://stefanbeil.bplaced.net/ ist das Tool auch online erreichbar.


Eingabemasken

Zur Übergabe der Parameter gibt es zwei unterschiedliche Eingabemasken. Bei der „schnelleren“ Eingabemaske, kann man die Personenanzahl, die Gruppengröße, die Anzahl der Gruppen und die Rundenanzahl übergeben. Bei der „genaueren“ Eingabemaske kann man Personen und Räume einzeln hinzufügen. Dadurch ist es auch möglich die Personen in unterschiedlich große Räume einzuteilen. Den Personen können hier auch Namen gegeben werden. Die Rundenanzahl kann man wie bei der anderen Eingabemaske einstellen. 


Ablauf des Algorithmus

In jeder Runde findet in jedem Raum ein Meeting statt. Die Meetings werden dabei nacheinander nach gewissen Kriterien mit Personen aufgefüllt. Wenn nach diesen Kriterien (wer kennt schon wen?) mehrere Personen gleich gut in das Meeting passen, wird eine zufällige Person ausgewählt. Das Auffüllen der Meetings mit Personen kann mehrmals mit einer gewissen Zufallskomponente ausgeführt werden. Hierbei wird sich immer das bisher beste Ergebnis gemerkt. 

Den einzelnen Runden können ebenfalls mehrfach Meetings zugewiesen werden, wobei sich auch hier das bisher beste Rundenergebnis gemerkt wird. 

Das Programm teilt mehrfach alle Runden ein, wobei bei jedem Durchlauf die Suchtiefe (wie oft werden die einzelnen Meetings und die einzelnen Runden eingeteilt) erhöht wird. Auch hier wird sich wieder das bisher beste Ergebnis gemerkt. 
Nach jedem Durchlauf wird überprüft, wie viel Zeit seit dem Start vergangen ist. Sobald die insgesamt verstrichene Zeit über einem festgelegten Wert liegt, wird kein erneuter Schleifendurchlauf mehr durchgeführt. Bei großen Eingabeparametern (viele Personen, große Gruppengröße) ist dadurch die Anzahl der Schleifendurchläufe und die Suchtiefe geringer als bei kleinen Eingabeparametern. Dafür wird das Ergebnis aber schnell geliefert.
