<h1>Editar documento</h1>

<?php if (empty($doc)): ?>
  <p>No se encontró el documento.</p>
  <p><a href="<?= APP_URL ?>/public/documentos">← Volver</a></p>
<?php else: ?>
  <form method="post"
        action="<?= APP_URL ?>/public/documentos/actualizar/<?= (int)($doc['DOC_ID']) ?>"
        style="border:1px solid #e5e7eb; padding:16px; border-radius:10px; background:#fff; max-width:520px;">
    
    <label for="DOC_NOMBRE"><b>Nombre</b></label><br>
    <input type="text"
           id="DOC_NOMBRE"
           name="DOC_NOMBRE"
           value="<?= htmlspecialchars((string)($doc['DOC_NOMBRE'])) ?>"
           required
           style="width:100%; max-width:500px; padding:6px 10px;">

    <br><br>
    <button type="submit" style="padding:8px 14px; border:1px solid #ccc; border-radius:6px;">
      Guardar cambios
    </button>
    <a href="<?= APP_URL ?>/public/documentos" style="margin-left:10px;">Cancelar</a>
  </form>
<?php endif; ?>
