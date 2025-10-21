<?php
class Controller {
    protected function view($view, $data = []) {
        extract($data);
        $file = __DIR__ . '/../views/' . $view . '.php';
        require __DIR__ . '/../views/layouts/header.php';
        if (file_exists($file)) { require $file; } else { echo "Vista no encontrada: $view"; }
        require __DIR__ . '/../views/layouts/footer.php';
    }
    protected function redirect($path) {
        header('Location: ' . APP_URL . '/public' . $path);
        exit;
    }
}
