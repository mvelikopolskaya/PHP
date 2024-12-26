<?php 

namespace Geekbrains\Application1\Domain\Controllers;
use Geekbrains\Application1\Application\Render;

class PageController {

    function actionIndex() {
        $render = new Render();
        return $render->renderPage('page-index.twig', 
        [
            'title' => "Main page",
            'time' => date("m:h:s")
        ]);
    }
}