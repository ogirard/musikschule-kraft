<?php
require_once __DIR__ . '/util.inc.php';

define('NUMBER_OF_LESSIONS', 18);
define('ANGEBOT_JSON', "../data/content/angebot.json");

function load_angebot()
{
  return json_decode(file_get_contents(ANGEBOT_JSON));
}


function update_angebot($angebot)
{
  file_put_contents(ANGEBOT_JSON, json_encode($angebot, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

function handle_post_action(&$angebot)
{
  if (isset($_POST['preise_save_action'])) {
    try_set_int_input('mkeinzel30', $angebot->preise->einzel30);
    try_set_int_input('mkeinzel45', $angebot->preise->einzel45);
    try_set_int_input('mkzweier30', $angebot->preise->zweier30);
    return true;
  } else if (isset($_POST['gruppenkurse_save_action'])) {

    try_set_int_input('mkgroupjahr', $angebot->gruppenkurse->jahr);
    try_set_int_input('mkgrouppreis', $angebot->gruppenkurse->preis);
    try_set_int_input('mkgrouppreis_ab4', $angebot->gruppenkurse->preis_ab4);
    try_set_int_input('mkgroupmaterial', $angebot->gruppenkurse->material);
    try_set_text_input('mkgroupanmeldeschluss', $angebot->gruppenkurse->anmeldeschluss);

    for ($i = 0; $i < count($angebot->gruppenkurse->kurse); $i++) {
      $kurs = $angebot->gruppenkurse->kurse[$i];
      try_set_text_array_input('mkgroupcoursevon', $kurs->von, $i);
      try_set_text_array_input('mkgroupcoursebis', $kurs->bis, $i);
      try_set_text_array_input('mkgroupcoursewochentag', $kurs->wochentag, $i);
      try_set_text_array_input('mkgroupcoursezeit_von', $kurs->zeit_von, $i);
      try_set_text_array_input('mkgroupcoursezeit_bis', $kurs->zeit_bis, $i);
    }

    return true;
  } else if (isset($_POST['qr_save_action'])) {
    try_set_text_input('mkqr', $angebot->qr);
    return true;
  }

  return false;
}

