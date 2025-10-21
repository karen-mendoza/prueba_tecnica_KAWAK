<?php
class Router {
    private $routes = ['GET'=>[], 'POST'=>[]];
    private $base;
    public function __construct($base = '') { $this->base = rtrim($base, '/'); }
    public function get($pattern, $handler)  { $this->add('GET',  $pattern, $handler); }
    public function post($pattern, $handler) { $this->add('POST', $pattern, $handler); }
    private function add($method, $pattern, $handler) {
        $regex = preg_replace('#\{([a-zA-Z_][a-zA-Z0-9_]*)\}#', '(?P<$1>[^/]+)', $pattern);
        $regex = '#^' . rtrim($regex, '/') . '/?$#';
        $this->routes[$method][] = ['regex'=>$regex, 'handler'=>$handler];
    }
    private function startsWith($haystack, $needle) {
        return $needle !== '' && strncmp($haystack, $needle, strlen($needle)) === 0;
    }
    public function dispatch($method, $path) {
        if ($this->base && $this->startsWith($path, $this->base)) {
            $path = substr($path, strlen($this->base));
        }
        foreach ($this->routes[$method] as $r) {
            if (preg_match($r['regex'], $path, $m)) {
                $params = array_filter($m, 'is_string', ARRAY_FILTER_USE_KEY);
                return call_user_func($r['handler'], $params);
            }
        }
        http_response_code(404); echo '404 Not Found';
    }
}
