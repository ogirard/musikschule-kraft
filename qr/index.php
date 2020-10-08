<?php
require_once __DIR__ . '/../admin/angebot.inc.php';

$angebot = load_angebot();

// QR redirect
header("Location: $angebot->qr");