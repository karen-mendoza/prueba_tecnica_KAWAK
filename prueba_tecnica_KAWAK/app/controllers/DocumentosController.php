<?php
class DocumentosController extends Controller {
    public function index() {
        $this->leer();
    }
    public function subir() {
        $mensaje = '';
        $ok = false;

        if (empty($_FILES['archivo']) || $_FILES['archivo']['error'] !== UPLOAD_ERR_OK) {
            $mensaje = 'No se recibió archivo o hubo un error al subir.';
            return $this->leerConMensaje($mensaje, $ok);
        }

        $f      = $_FILES['archivo'];
        $nombre = $f['name'];
        $tmp    = $f['tmp_name'];

        $contenido_bin = file_get_contents($tmp);
        if ($contenido_bin === false) {
            $mensaje = 'No se pudo leer el archivo en el servidor.';
            return $this->leerConMensaje($mensaje, $ok);
        }

        $contenido_b64 = base64_encode($contenido_bin);
        $DOC_ID_TIPO    = 1;
        $DOC_ID_PROCESO = 1;
        $DOC_CODIGO = 'PEND-' . date('YmdHis') . '-' . substr(bin2hex(random_bytes(2)), 0, 4);
        $DOC_NOMBRE = $nombre;

        $k = new Kawak();
        
        // Escapar los valores antes de usarlos en el SQL
        $DOC_NOMBRE_ESC = $k->clearText($DOC_NOMBRE);
        $DOC_CODIGO_ESC = $k->clearText($DOC_CODIGO);
        $DOC_CONTENIDO_ESC = $k->clearText($contenido_b64);
        
        $sql = "
            INSERT INTO doc_documento
                (DOC_NOMBRE, DOC_CODIGO, DOC_CONTENIDO, DOC_ID_TIPO, DOC_ID_PROCESO)
            VALUES
                ('$DOC_NOMBRE_ESC', '$DOC_CODIGO_ESC', '$DOC_CONTENIDO_ESC', '$DOC_ID_TIPO', '$DOC_ID_PROCESO')
        ";

        if ($k->grabardatos($sql)) {
            $ok = true;
            $mensaje = 'Archivo subido correctamente.';
        } else {
            $mensaje = 'Error al guardar en BD: ' . $k->vererror();
        }

        return $this->leerConMensaje($mensaje, $ok);
    }
    public function leer() {
        $k = new Kawak();

        $sql = "SELECT DOC_ID, DOC_NOMBRE, DOC_CODIGO, DOC_ID_TIPO, DOC_ID_PROCESO, created_at
                FROM doc_documento
                ORDER BY DOC_ID DESC";
        $result = $k->leerdatosarray($sql);

        $documentos = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $documentos[] = $row;
            }
        }
        $mensaje = '';
        $ok = false;

        $this->view('documentos/index', compact('documentos','mensaje','ok'));
    }
    private function leerConMensaje($mensaje, $ok) {
        $k = new Kawak();

        $sql = "SELECT DOC_ID, DOC_NOMBRE, DOC_CODIGO, DOC_ID_TIPO, DOC_ID_PROCESO, created_at
                FROM doc_documento
                ORDER BY DOC_ID DESC";
        $result = $k->leerdatosarray($sql);

        $documentos = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $documentos[] = $row;
            }
        }

        $this->view('documentos/index', compact('documentos','mensaje','ok'));
    }

    public function editar(int $id) {
        $k = new Kawak();

        // Trae el documento por ID
        $id = (int)$id;
        $sql = "SELECT DOC_ID, DOC_NOMBRE, DOC_CODIGO, DOC_ID_TIPO, DOC_ID_PROCESO, created_at
                FROM doc_documento
                WHERE DOC_ID = $id
                LIMIT 1";
        $res = $k->leerdatosarray($sql);

        $doc = null;
        if ($res && $res->num_rows > 0) {
            $doc = $res->fetch_assoc();
        }

        if (!$doc) {
            $mensaje = 'Documento no encontrado.';
            $ok = false;
            return $this->leerConMensaje($mensaje, $ok);
        }

        $this->view('documentos/editar', ['doc' => $doc]);
    }

    public function actualizar(int $id) {
        $k = new Kawak();

        $id = (int)$id;
        $nombre = trim($_POST['DOC_NOMBRE'] ?? '');

        if ($nombre === '') {
            $mensaje = 'El nombre no puede estar vacío.';
            $ok = false;
            return $this->leerConMensaje($mensaje, $ok);
        }

        $nombre_esc = $k->clearText($nombre);

        $sql = "UPDATE doc_documento
                SET DOC_NOMBRE = '$nombre_esc', updated_at = NOW()
                WHERE DOC_ID = $id
                LIMIT 1";

        if ($k->grabardatos($sql)) {
            $mensaje = 'Documento actualizado correctamente.';
            $ok = true;
        } else {
            $mensaje = 'Error al actualizar: ' . $k->vererror();
            $ok = false;
        }

        // Vuelve al listado principal con mensaje
        return $this->leerConMensaje($mensaje, $ok);
    }

    public function eliminar(int $id) {
        $k = new Kawak();
        
        $id = (int)$id;
        
        // Verificar que el documento existe
        $sqlCheck = "SELECT DOC_ID FROM doc_documento WHERE DOC_ID = $id LIMIT 1";
        $res = $k->leerdatosarray($sqlCheck);
        
        if (!$res || $res->num_rows === 0) {
            $mensaje = 'Documento no encontrado.';
            $ok = false;
            return $this->leerConMensaje($mensaje, $ok);
        }
        
        // Eliminar el documento
        $sql = "DELETE FROM doc_documento WHERE DOC_ID = $id LIMIT 1";
        
        if ($k->grabardatos($sql)) {
            $mensaje = 'Documento eliminado correctamente.';
            $ok = true;
        } else {
            $mensaje = 'Error al eliminar: ' . $k->vererror();
            $ok = false;
        }
        
        // Vuelve al listado principal con mensaje
        return $this->leerConMensaje($mensaje, $ok);
    }

}
