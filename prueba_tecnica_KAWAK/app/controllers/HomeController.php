<?php
class HomeController extends Controller {

    public function index() {
        // si hay post, procesar aquí directamente
        $mensaje = '';
        $ok = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = $_POST['email'] ?? '';
            $clave   = $_POST['password'] ?? '';

            if ($usuario === 'admin' && $clave === '1234') {
                return $this->view('documentos/index');
               
            } else {
                $mensaje = 'Usuario o contraseña incorrectos.';
            }
        }

        // enviamos datos a la vista
        $this->view('home/index', [
            'mensaje' => $mensaje,
            'ok'  => $ok
        ]);
    }
}
