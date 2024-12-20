<?php 

namespace Geekbrains\Application1\Application;

use Exception;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Render {
    private string $viewFolder = "/src/Domain/Views";
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

    public static function renderExceptionPage(Exception $exception): string {
        $contentTemplateName = "exception.twig";
        $viewFolder = '/src/Domain/Views/';
        $loader = new FilesystemLoader($_SERVER['DOCUMENT_ROOT'] . $viewFolder);
        $environment = new Environment($loader, [
            'cache' => $_SERVER['DOCUMENT_ROOT'].'/cache/',
        ]);
        $template = $environment->load('layouts/main.twig');
        $templateVariables['content_template_name'] = $contentTemplateName;
        $templateVariables['exception_message'] = $exception->getMessage();
 
        return $template->render($templateVariables);
    }
}