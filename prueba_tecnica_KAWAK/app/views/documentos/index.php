<h1>Subir documento</h1>
<p style="color:#555; margin-top:-6px;">
  Formato permitido: PDF, DOCX, XLSX, JPG, PNG (máx. 10 MB).
</p>

<form method="post"
      action="<?= APP_URL ?>/public/documentos/subir"
      enctype="multipart/form-data"
      style="border:1px solid #e5e7eb; padding:16px; border-radius:10px; background:#fff; margin-bottom: 20px;">

  <label for="archivo"><b>Selecciona un archivo</b></label><br>
  <input type="file"
         id="archivo"
         name="archivo"
         accept=".pdf,.docx,.xlsx,.jpg,.jpeg,.png"
         required>

  <br><br>

  <button type="submit"
          style="padding:8px 14px; border:1px solid #ccc; border-radius:6px;">
    Subir
  </button>
</form>

<h2>Documentos registrados</h2>

<table cellpadding="6" cellspacing="0" style="border-collapse: collapse; width:100%; border:1px solid #ddd;">
  <thead style="background:#f0f0f0;">
    <tr>
      <th style="border:1px solid #ddd;">ID</th>
        <th style="border:1px solid #ddd;">Nombre</th>
        <th style="border:1px solid #ddd;">Código</th>
        <th style="border:1px solid #ddd;">ID Tipo</th>
        <th style="border:1px solid #ddd;">ID Proceso</th>
        <th style="border:1px solid #ddd;">Fecha</th>
        <th style="border:1px solid #ddd;">Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php if (!empty($documentos)): ?>
      <?php foreach ($documentos as $d): ?>
        <tr>
            <td style="border:1px solid #ddd;"><?= htmlspecialchars((string)($d['DOC_ID'])) ?></td>
            <td style="border:1px solid #ddd;"><?= htmlspecialchars((string)($d['DOC_NOMBRE'] )) ?></td>
            <td style="border:1px solid #ddd;"><?= htmlspecialchars((string)($d['DOC_CODIGO'] )) ?></td>
            <td style="border:1px solid #ddd;"><?= htmlspecialchars((string)($d['DOC_ID_TIPO'] )) ?></td>
            <td style="border:1px solid #ddd;"><?= htmlspecialchars((string)($d['DOC_ID_PROCESO'] )) ?></td>
            <td style="border:1px solid #ddd;"><?= htmlspecialchars((string)($d['created_at'] )) ?></td>
            <td style="border:1px solid #ddd;">
            <a href="<?= APP_URL ?>/public/documentos/editar/<?= (int)($d['DOC_ID']) ?>">Editar</a>
            <a href="<?= APP_URL ?>/public/documentos/eliminar/<?= (int)($d['DOC_ID']) ?>" 
                   onclick="return confirm('¿Estás seguro de que deseas eliminar este documento?');"
                   style="color: #dc2626;">
                   Eliminar
                </a>
        </td>
        </tr>
      <?php endforeach; ?>
    <?php else: ?>
      <tr>
        <td colspan="6" style="text-align:center; border:1px solid #ddd;">
          No hay documentos registrados.
        </td>
      </tr>
    <?php endif; ?>
  </tbody>
</table>
