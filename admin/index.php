<?php
/**
 * Administrator Page for www.musikschule-kraft.ch
 */
session_start();
require_once __DIR__ . '/auth.inc.php';
require_once __DIR__ . '/angebot.inc.php';


$username = '';
$password = '';

if (isset($_POST['login_action'])) {
  if (isset($_POST['username'])) {
    $username = $_POST['username'];
  }

  if (isset($_POST['password'])) {
    $password = $_POST['password'];
  }

  if (login($username, $password)) {
    header('Location: index.php');
  }
} else if (isset($_POST['logout_action'])) {
  logout();
}


$isLoggedIn = is_logged_in();
$loggedInUser = get_logged_in_user();

if ($isLoggedIn) {
  $angebot = load_angebot();
  if (handle_post_action($angebot) !== false) {
    update_angebot($angebot);
    // reload page (avoid double postings on refresh)
    header('Location: index.php');
    die();
  }
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
    <h1>Administrator Bereich</h1>
  </div>
  <div class="col-xs-4 pull-right">
    <p>
      <a href="../"><img class="img-responsive" src="../img/logo_admin.png" alt="Musikschule Kraft"/></a>
    </p>
  </div>
</div>
<?php if (!$isLoggedIn) { ?>
  <div class="row">
    <div class="col-xs-6">
      <h3>Bitte melden Sie sich an</h3>

      <form method="post" action="" role="form">
        <div class="form-group">
          <label for="username">Benutzer</label>
          <input type="text" id="username" name="username" value="<?= $username ?>" class="form-control"/>
        </div>
        <div class="form-group">
          <label for="password">Passwort</label>
          <input type="password" id="password" name="password" value="" class="form-control"/>
        </div>
        <br/>

        <div class="pull-right">
          <button type="submit" name="login_action" class="btn btn-primary">Einloggen</button>
        </div>
      </form>
      <br/>
      <br/>
      <br/>
    </div>
  </div>
<?php } else { ?>
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
    <div class="col-xs-8">
      <h3>Logins</h3>
      <table role="table" class="table">
        <tr>
          <th width="250px">Service</th>
          <th width="350px">Benutzername</th>
          <th>Passwort</th>
        </tr>
        <tr>
          <td><a href="https://plus.google.com" target="_blank">Google+ <i
                class="fa fa-google-plus-square"></i></a></td>
          <td>google@musikschule-kraft.ch</td>
          <td>ip2562ck</td>
        </tr>
        <tr>
          <td><a href="https://www.youtube.com" target="_blank">YouTube <i
                class="fa fa-youtube-square"></i></a></td>
          <td>google@musikschule-kraft.ch</td>
          <td>ip2562ck</td>
        </tr>
        <tr>
          <td><a href="https://sysconf.webland.ch/Kunden.aspx" target="_blank">Webland.ch (Hosting)</a></td>
          <td>26730</td>
          <td>730170</td>
        </tr>
        <tr>
          <td><a href="http://www.onlineftp.ch/index.php" target="_blank">FTP</a></td>
          <td>Server: www.musikschule-kraft.ch<br/>Benutzer: www827</td>
          <td>ip2562</td>
        </tr>
      </table>
    </div>
    <div class="col-xs-4">
      <h3>Datenquellen</h3>
      <i class="fa fa-file-text"></i> <a href="fileedit.php?file=angebot.json">angebot.json</a><br/>
      <i class="fa fa-file-text"></i> <a href="fileedit.php?file=news.json">news.json</a>
      <br/>
      <br/>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-8">
      <h3>QR URL</h3>

      <form role="form" method="post" action="index.php">
        <div class="form-group">
          <label for="mk-qr">QR URL</label>
          <input type="url" class="form-control input-sm" value="<?= $angebot->qr ?>"
                 id="mk-qr" name="mkqr"/>
        </div>
        <br/>

        <div class="pull-right">
          <button type="submit" class="btn btn-primary btn-sm" name="qr_save_action">QR URL Speichern</button>
        </div>
      </form>
      <br/>
      <br/>

      <h3>Einzelunterricht</h3>
      <h4>Preis pro Lektion (18 Lektionen / Semester)</h4>

      <form role="form" method="post" action="index.php">
        <div class="form-group">
          <label for="mk-einzel-30">Einzelunterricht 30min</label>

          <div class="input-group input-group-sm">
            <span class="input-group-addon">CHF</span>
            <input type="text" class="form-control input-sm" value="<?= $angebot->preise->einzel30 ?>"
                   id="mk-einzel-30"
                   name="mkeinzel30"/>
          </div>
        </div>
        <div class="form-group">
          <label for="mk-einzel-45">Einzelunterricht 45min</label>

          <div class="input-group input-group-sm">
            <span class="input-group-addon">CHF</span>
            <input type="text" class="form-control input-sm" value="<?= $angebot->preise->einzel45 ?>"
                   id="mk-einzel-45"
                   name="mkeinzel45"/>
          </div>
        </div>
        <div class="form-group">
          <label for="mk-zweier-30">Zweierunterricht 30min</label>

          <div class="input-group input-group-sm">
            <span class="input-group-addon">CHF</span>
            <input type="text" class="form-control input-sm" value="<?= $angebot->preise->zweier30 ?>"
                   id="mk-zweier-30"
                   name="mkzweier30"/>
          </div>
        </div>
        <br/>

        <div class="pull-right">
          <button type="submit" class="btn btn-primary btn-sm" name="preise_save_action">Einzelunterricht Speichern
          </button>
        </div>
      </form>
      <br/>
      <br/>

      <h3>Gruppenkurse</h3>

      <form role="form" method="post" action="index.php">
        <div class="form-group">
          <label for="mk-group-jahr">Jahr</label>

          <input type="text" class="form-control input-sm" value="<?= $angebot->gruppenkurse->jahr ?>"
                 id="mk-group-jahr"
                 name="mkgroupjahr"/>
        </div>

        <div class="form-group">
          <label for="mk-group-preis">Preis</label>

          <div class="input-group input-group-sm">
            <span class="input-group-addon">CHF</span>
            <input type="text" class="form-control input-sm" value="<?= $angebot->gruppenkurse->preis ?>"
                   id="mk-group-preis"
                   name="mkgrouppreis"/>
          </div>
        </div>

        <div class="form-group">
          <label for="mk-group-preis_ab4">Preis ab 4 Personen</label>

          <div class="input-group input-group-sm">
            <span class="input-group-addon">CHF</span>
            <input type="text" class="form-control input-sm" value="<?= $angebot->gruppenkurse->preis_ab4 ?>"
                   id="mk-group-preis_ab4"
                   name="mkgrouppreis_ab4"/>
          </div>
        </div>

        <div class="form-group">
          <label for="mk-group-material">Materialkosten</label>

          <div class="input-group input-group-sm">
            <span class="input-group-addon">CHF</span>
            <input type="text" class="form-control input-sm" value="<?= $angebot->gruppenkurse->material ?>"
                   id="mk-group-material"
                   name="mkgroupmaterial"/>
          </div>
        </div>

        <div class="form-group">
          <label for="mk-group-anmeldeschluss">Anmeldeschluss</label>

          <input type="text" class="form-control input-sm" value="<?= $angebot->gruppenkurse->anmeldeschluss ?>"
                 id="mk-group-anmeldeschluss"
                 name="mkgroupanmeldeschluss"/>
        </div>

        <?php foreach ($angebot->gruppenkurse->kurse as $kurs) { ?>
          <h4><?= $kurs->name ?></h4>
          <div class="row">
            <div class="col-xs-1"></div>
            <div class="col-xs-11">
              <div class="form-group">
                <label for="mk-group-course-von">Von</label>

                <input type="text" class="form-control input-sm" value="<?= $kurs->von ?>"
                       id="mk-group-course-von"
                       name="mkgroupcoursevon[]"/>
              </div>
              <div class="form-group">
                <label for="mk-group-course-bis">Bis</label>

                <input type="text" class="form-control input-sm" value="<?= $kurs->bis ?>"
                       id="mk-group-course-bis"
                       name="mkgroupcoursebis[]"/>
              </div>
              <div class="form-group">
                <label for="mk-group-course-wochentag">Wochentag</label>

                <input type="text" class="form-control input-sm" value="<?= $kurs->wochentag ?>"
                       id="mk-group-course-wochentag"
                       name="mkgroupcoursewochentag[]"/>
              </div>
              <div class="form-group">
                <label for="mk-group-course-zeit_von">Zeit von</label>

                <input type="text" class="form-control input-sm" value="<?= $kurs->zeit_von ?>"
                       id="mk-group-course-zeit_von"
                       name="mkgroupcoursezeit_von[]"/>
              </div>
              <div class="form-group">
                <label for="mk-group-course-zeit_bis">Zeit bis</label>

                <input type="text" class="form-control input-sm" value="<?= $kurs->zeit_bis ?>"
                       id="mk-group-course-zeit_bis"
                       name="mkgroupcoursezeit_bis[]"/>
              </div>
            </div>
          </div>
        <?php } ?>
        <br/>

        <div class="pull-right">
          <button type="submit" class="btn btn-primary btn-sm" name="gruppenkurse_save_action">Gruppenkurse Speichern
          </button>
        </div>
      </form>
      <br/>
      <br/>
    </div>
  </div>

<?php } ?>
<div class="row">
  <div class="col-xs-12">
    <a href="../">Zurück zur Homepage</a>
  </div>
</div>
<br/>
</div>
</body>

</html>