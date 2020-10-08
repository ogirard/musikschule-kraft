<?php

$year = 2013;
$height = 900;

if (isset($_GET['y'])) {
  $year = $_GET['y'];
}

if (isset($_GET['h'])) {
  $height = $_GET['h'];
}

?>

<div class="mk-page">
  <div class="row">
    <div class="col-xs-12">
      <h1>Schülerkonzert</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-10 col-xs-12">
      <iframe src="old/konzert_<?= $year ?>.html" class="mk-old-concert-frame" name="mk-old-concert-frame"
              style="min-height: <?= $height ?>px" scrolling="no"/>
      <br/>
      <a href="#/aktuell/konzert/archiv">Alle Konzerte ansehen</a><br/>
      <a href="#/aktuell">Zurück zu "Aktuell"</a><br/>
      <br/>
      <br/>
    </div>
    <div class="col-md-2 hidden-sm hidden-xs">
      <div class="mk-concert-title"><?= $year ?></div>
    </div>
  </div>
</div>
