<?php require_once __DIR__ . '/../../../config/config.php'; ?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars(APP_NAME) ?></title>
  <style>
    body{font-family:system-ui,Arial;margin:0;background:#f6f7fb}
    header,footer{background:#111;color:#fff;padding:12px 16px}
    header a{color:#9ad; margin-right:8px; text-decoration:none}
    main{max-width:960px;margin:24px auto;background:#fff;padding:20px;border-radius:12px;border:1px solid #e5e7eb}
  </style>
</head>
<body>
<header>
  <strong><?= htmlspecialchars(APP_NAME) ?></strong>
  · <a href="<?= APP_URL ?>/public/">Inicio</a>
</header>
<main>
