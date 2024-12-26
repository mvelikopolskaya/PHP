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
        $this->loader = new FilesystemLoader($_SERVER['DOCUMENT_ROOT'] . "/../" . $this->viewFolder);
        $this->environment = new Environment($this->loader, [
            // 'cache' => $_SERVER['DOCUMENT_ROOT'] . "/../" . '/cache/'
        ]);
    }

    public function renderPage(
        string $contentTemplateName = 'page-index.twig', 
        array $templateVariables = []
        ): string {
        $template = $this->environment->load('main.twig');
        $templateVariables['content_template_name'] = $contentTemplateName;
        if(isset($_SESSION['user_name'])){
            $templateVariables['user_authorized'] = true;
            $templateVariables['user_name'] = $_SESSION['user_name'];
        }
 
        return $template->render($templateVariables);
    }


    public static function renderExceptionPage(Exception $exception): string {
        $contentTemplateName = "exception.twig";
        $viewFolder = '/src/Domain/Views/';
        $loader = new FilesystemLoader($_SERVER['DOCUMENT_ROOT'] . "/../" . $viewFolder);
        $environment = new Environment($loader, [
            'cache' => $_SERVER['DOCUMENT_ROOT']. "/../" . '/cache/',
        ]);
        $template = $environment->load('main.twig');
        $templateVariables['content_template_name'] = $contentTemplateName;
        $templateVariables['exception_message'] = $exception->getMessage();
 
        return $template->render($templateVariables);
    }

    public function renderPageWithForm(
        string $contentTemplateName = 'page-index.twig', 
        array $templateVariables = []
        ) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        $templateVariables['csrf_token'] = $_SESSION['csrf_token'];
        return $this->renderPage($contentTemplateName, $templateVariables);
    }
}