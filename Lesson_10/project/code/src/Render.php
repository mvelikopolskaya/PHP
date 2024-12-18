<?php 

namespace Geekbrains\Application1;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Render {
    private string $viewFolder = "/src/Views";
    private FilesystemLoader $loader;
    private Environment $environment;

    function __construct() {
        $this->loader = new FilesystemLoader($_SERVER['DOCUMENT_ROOT'] . $this->viewFolder);
        $this->environment = new Environment($this->loader, [
            // 'cache' => $_SERVER['DOCUMENT_ROOT'] . '/cache/'
        ]);
    }

    function renderPage(
        string $contentTemplateName = 'page-index.twig', 
        array $templateVariables = []
    ) {
        $template = $this->environment->load('layouts/main.twig');
        $templateVariables['content_template_name'] = $contentTemplateName;
        $templateVariables['title'] = "page name";
        return $template->render($templateVariables);
    }
}
