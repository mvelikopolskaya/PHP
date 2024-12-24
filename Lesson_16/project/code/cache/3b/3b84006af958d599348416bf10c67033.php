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

/* main.twig */
class __TwigTemplate_b79d835f6368dffc316c46b083677c52 extends Template
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
    <link href=\"/css/main.css\" rel=\"stylesheet\" />
    <body class=\"body\">
        <div id=\"header\">
            <div id=\"title\"><a name=\"title\">";
        // line 9
        yield from $this->loadTemplate("header.twig", "main.twig", 9)->unwrap()->yield($context);
        yield "</a></div>
            <div id=\"top_menu\">
              <div class=\"menu_item\">
                <a href=\"/\">Main</a>
              </div> 
              | <div class=\"menu_item\">
                <a href=\"/user\">Users</a>
              </div> 
              | <div class=\"menu_item\">
                <a href=\"/about\">About</a>
              </div> 
              | <div class=\"auth menu_item\">";
        // line 20
        yield from $this->loadTemplate("auth-template.twig", "main.twig", 20)->unwrap()->yield($context);
        // line 21
        yield "              </div>
            </div>
        </div>
        <div id=\"container\">
            <div id=\"sidebar\">
              
              <div class=\"sidebar_item\"><a href=\"/\" class=\"sidebar_item\">Main</a></div>
              <div class=\"sidebar_item\"><a href=\"/user\" class=\"sidebar_item\">Users</a></div>
              <div class=\"sidebar_item\"><a href=\"/about\" class=\"sidebar_item\">About</a></div>
            </div>
            <div id=\"content\"><p>";
        // line 31
        yield from $this->loadTemplate(($context["content_template_name"] ?? null), "main.twig", 31)->unwrap()->yield($context);
        yield "</p></div>
        </div>
        <div id=\"footer\"><div id=\"copyright\">";
        // line 33
        yield from $this->loadTemplate("footer.twig", "main.twig", 33)->unwrap()->yield($context);
        yield "</div>
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
        return "main.twig";
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
        return array (  88 => 33,  83 => 31,  71 => 21,  69 => 20,  55 => 9,  48 => 5,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "main.twig", "/data/mysite.local/src/Domain/Views/main.twig");
    }
}
