<?php 

namespace Geekbrains\Application1\Controllers;

use Geekbrains\Application1\Render;
use Geekbrains\Application1\Models\SiteInfo;

class InfoController {

    function actionIndex() {
        $siteInfo = new SiteInfo();
        $info = $siteInfo->getInfo();
        $render = new Render();
        return $render->renderPage('site-info.twig', [
            "server" => $info["server"],
            "phpversion" => $info["phpversion"],
            "userAgent" => $info["userAgent"]
        ]);
    }
}