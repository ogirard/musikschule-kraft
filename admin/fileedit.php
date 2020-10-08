<?php
/**
 * JSON file edit page for www.musikschule-kraft.ch
 */
session_start();
require_once __DIR__ . '/auth.inc.php';
require_once __DIR__ . '/angebot.inc.php';

define('DATA_ROOT', realpath(__DIR__ . '/../data/content'));

$isLoggedIn = is_logged_in();
$loggedInUser = get_logged_in_user();

if (!$isLoggedIn || !isset($_GET['file'])) {
  header('Location: index.php');
  die();
}

$filename = $_GET['file'];
$absoluteFilename = DATA_ROOT . DIRECTORY_SEPARATOR . $filename;
if (!file_exists($absoluteFilename)) {
  header('Location: index.php');
  die();
}

$otherfilename = $filename == 'news.json' ? 'angebot.json' : 'news.json';
$filecontent = '';
$message = '';

if (isset($_POST['json_save_action'])) {
  $filecontent = $_POST['mkjson'];
  $validJson = json_decode($filecontent);
  if ($validJson !== null) {
    file_put_contents($absoluteFilename, json_encode($validJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    $message = '<br/><br/><div class="panel panel-success"><div class="panel-heading">Gespeichert</div></div>';
  } else {
    $message = '<br/><br/><div class="panel panel-danger"><div class="panel-heading">JSON nicht korrekt, nicht gespeichert!</div></div>';
  }
} else {
  $filecontent = file_get_contents($absoluteFilename);
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Musikschule Kraft - Administrator Bereich</title>

  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- styling relevant scripts / stylesheets -->
  <script src="../bower_components/modernizr/modernizr.js"></script>
  <link rel="stylesheet" type='text/css' href="../bower_components/normalize.css/normalize.min.css">
  <link rel="stylesheet" type='text/css' href="../vendor/h5bp-4.3.0/main.min.css">
  <link rel="stylesheet" type='text/css' href="../bower_components/fontawesome/css/font-awesome.min.css">
  <link rel="stylesheet" type='text/css' href="../css/mk-bootstrap.min.css">
  <link rel="stylesheet" type='text/css' href="../css/mk-admin.min.css">

  <!-- favicon -->
  <link rel="shortcut icon" href="../img/icon/favicon.ico" type="image/x-icon"/>
  <link rel="icon" href="../img/icon/favicon.ico" type="image/x-icon"/>
  <link rel="apple-touch-icon" href="../img/icon/apple-touch-icon-60.png">
  <link rel="apple-touch-icon" sizes="120x120" href="../img/icon/apple-touch-icon-120.png">
  <link rel="apple-touch-icon" sizes="76x76" href="../img/icon/apple-touch-icon-76.png">
  <link rel="apple-touch-icon" sizes="152x152" href="../img/icon/apple-touch-icon-152.png">
</head>
<body>
<div class="container mk-admin-page">
  <div class="row">
    <div class="col-xs-8">
      <h1>Daten Editor</h1>
    </div>
    <div class="col-xs-4 pull-right">
      <p>
        <a href="../"><img class="img-responsive" src="../img/logo_admin.png" alt="Musikschule Kraft"/></a>
      </p>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="pull-right">
        <form method="post" action="index.php" role="form">
          Angemeldet als <strong><?= $loggedInUser ?></strong>
          <button type="submit" name="logout_action" class="btn btn-link mk-btn-link" onfocus="blur()"
                  title="Abmelden">
            <i class="fa fa-power-off"></i>
          </button>
        </form>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <h3>Datenquellen editieren: <strong><?= $filename ?></strong></h3>

      <div class="pull-right">
        <a href="fileedit.php?file=<?= $otherfilename ?>"><i class="fa fa-file-text"></i> <?= $otherfilename ?></a> |
        <a href="index.php">Admin Bereich</a><br/>
      </div>
      <?= $message ?>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <form role="form" method="post" action="fileedit.php?file=<?= $filename ?>">
        <pre id="editor" class="mk-file-editor"><?= $filecontent ?></pre>
        <input type="hidden" id="mk-json" name="mkjson"/>
        <br/>

        <div class="pull-right">
          <button type="submit" class="btn btn-primary btn-sm" name="json_save_action"
                  onclick="MusikschuleKraft.CodeEditor.SynchronizeCode()">
            JSON Speichern
          </button>
        </div>
      </form>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <a href="../">Zurück zur Homepage</a>
    </div>
  </div>
  <br/>
</div>

<script src="../bower_components/jquery/dist/jquery.min.js" type="text/javascript"></script>
<script src="../bower_components/ace-builds/src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/mk-file-edit.js" type="text/javascript"></script>

</body>

</html>