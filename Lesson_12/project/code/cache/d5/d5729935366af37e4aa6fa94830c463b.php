<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* layouts/main.twig */
class __TwigTemplate_12bc3cbcd506de93fcc23db5cf202e7c extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<!DOCTYPE html>
  <head>
    <meta charset=\"UTF-8\" />
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />
    <title>";
        // line 5
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["title"] ?? null), "html", null, true);
        yield "</title>
    <link href=\"./css/main.css\" rel=\"stylesheet\" />
    <body class=\"body\">
        <div class=\"main\">
           <nav class=\"top_link\">
                <a class=\"link\" href=\"/\">Main</a>
                <a class=\"link\" href=\"/user\">Users</a>
                <a class=\"link\" href=\"/about\">About</a>
            </nav>
            <h1 class=\"header\">";
        // line 14
        yield from $this->loadTemplate("layouts/header.twig", "layouts/main.twig", 14)->unwrap()->yield($context);
        yield "</h1>
            <div class=\"content_main\">
                <div class=\"content\">
                    <span class=\"content_text\">
                        ";
        // line 18
        yield from $this->loadTemplate(($context["content_template_name"] ?? null), "layouts/main.twig", 18)->unwrap()->yield($context);
        // line 19
        yield "                    </span>
                </div>
                <div class=\"sidebar\">
                    <div class=\"sidebar_text\">
                        ";
        // line 23
        yield from $this->loadTemplate("layouts/sidebar.twig", "layouts/main.twig", 23)->unwrap()->yield($context);
        // line 24
        yield "                    </div>  
                </div>
            </div>
            <div class=\"footer\">
              <span class=\"footer_text\">
                ";
        // line 29
        yield from $this->loadTemplate("layouts/footer.twig", "layouts/main.twig", 29)->unwrap()->yield($context);
        // line 30
        yield "              </span>  
            </div>
        </div> 
    </body>
  </head>
</html>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "layouts/main.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  86 => 30,  84 => 29,  77 => 24,  75 => 23,  69 => 19,  67 => 18,  60 => 14,  48 => 5,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "layouts/main.twig", "/data/mysite.local/src/Domain/Views/layouts/main.twig");
    }
}
