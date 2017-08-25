<?php
namespace app\core;
class View
{
    private static $instance = null;
    private $pathToViews;
    private $layout;

    public static function getInstance() {
        if(self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __clone() {}
    private function __construct()
    {
        $this->setLayout("main");
        $this->pathToViews = App::views_path();
    }

    public function setLayout($layout)
    {
        $this->layout = $this->pathToViews . "/layouts/$layout.html";
    }

    public function redirect($path) {
        header("Location: $path");
    }

    public function render($pathToView, $data = [])
    {
        $twig = App::getTwig();
        echo $twig->render($pathToView.".html",[
            'brand'=> Params::get('brand'),
            'isGuest' => App::isGuest(),
            'assets' => App::getPath(),
        ]+$data);
    }
}