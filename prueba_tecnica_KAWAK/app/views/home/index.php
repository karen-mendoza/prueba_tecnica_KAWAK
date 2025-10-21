<h1>Ingreso</h1>

<?php if (!empty($mensaje)): ?>
  <p style="color: <?= $ok ? 'green' : 'red' ?>;">
    <?= htmlspecialchars($mensaje) ?>
  </p>
<?php endif; ?>

<form method="post" action="http://localhost/prueba_tecnica_KAWAK/public/">
  <label for="email">Correo o Usuario</label><br>
  <input type="text" id="email" name="email" required><br>

  <label for="password">Contraseña</label><br>
  <input type="password" id="password" name="password" required><br>

  <br>
  <button type="submit" style="padding:6px 12px;">Entrar</button>
</form>
