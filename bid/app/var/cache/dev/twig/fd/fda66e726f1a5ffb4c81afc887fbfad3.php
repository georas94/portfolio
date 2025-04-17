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

/* ao/component/_card.html.twig */
class __TwigTemplate_6bbec31a20b061faa729955f538e0efe extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "ao/component/_card.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "ao/component/_card.html.twig"));

        // line 1
        yield "<div class=\"h-full flex flex-col\">
    <!-- Header -->
    <div class=\"p-6 pb-0\">
        <span class=\"inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold\">
            ";
        // line 5
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["ao"]) || array_key_exists("ao", $context) ? $context["ao"] : (function () { throw new RuntimeError('Variable "ao" does not exist.', 5, $this->source); })()), "reference", [], "any", false, false, false, 5), "html", null, true);
        yield "
        </span>
        <h3 class=\"mt-2 text-xl font-bold text-gray-900\">";
        // line 7
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["ao"]) || array_key_exists("ao", $context) ? $context["ao"] : (function () { throw new RuntimeError('Variable "ao" does not exist.', 7, $this->source); })()), "titre", [], "any", false, false, false, 7), "html", null, true);
        yield "</h3>
        <p class=\"mt-1 text-gray-500 line-clamp-2\">";
        // line 8
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $this->extensions['Twig\Extra\String\StringExtension']->createUnicodeString(CoreExtension::getAttribute($this->env, $this->source, (isset($context["ao"]) || array_key_exists("ao", $context) ? $context["ao"] : (function () { throw new RuntimeError('Variable "ao" does not exist.', 8, $this->source); })()), "description", [], "any", false, false, false, 8)), "truncate", [100, "..."], "method", false, false, false, 8), "html", null, true);
        yield "</p>
    </div>

    <!-- Footer -->
    <div class=\"mt-auto p-6 pt-4 border-t border-gray-100\">
        <div class=\"flex justify-between items-center\">
            <div>
                <span class=\"text-sm font-medium text-gray-900\">";
        // line 15
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extra\Intl\IntlExtension']->formatCurrency(CoreExtension::getAttribute($this->env, $this->source, (isset($context["ao"]) || array_key_exists("ao", $context) ? $context["ao"] : (function () { throw new RuntimeError('Variable "ao" does not exist.', 15, $this->source); })()), "budget", [], "any", false, false, false, 15), "XOF"), "html", null, true);
        yield "</span>
                <span class=\"block text-xs text-gray-500\">Clôture le ";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["ao"]) || array_key_exists("ao", $context) ? $context["ao"] : (function () { throw new RuntimeError('Variable "ao" does not exist.', 16, $this->source); })()), "dateLimite", [], "any", false, false, false, 16), "d/m/Y"), "html", null, true);
        yield "</span>
            </div>
            <a href=\"";
        // line 18
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_ao_detail", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["ao"]) || array_key_exists("ao", $context) ? $context["ao"] : (function () { throw new RuntimeError('Variable "ao" does not exist.', 18, $this->source); })()), "id", [], "any", false, false, false, 18)]), "html", null, true);
        yield "\"
               class=\"px-4 py-2 bg-primary text-white rounded-lg hover:bg-secondary transition-colors text-sm font-medium\">
                Voir
            </a>
        </div>
    </div>
</div>";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "ao/component/_card.html.twig";
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
        return array (  82 => 18,  77 => 16,  73 => 15,  63 => 8,  59 => 7,  54 => 5,  48 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<div class=\"h-full flex flex-col\">
    <!-- Header -->
    <div class=\"p-6 pb-0\">
        <span class=\"inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold\">
            {{ ao.reference }}
        </span>
        <h3 class=\"mt-2 text-xl font-bold text-gray-900\">{{ ao.titre }}</h3>
        <p class=\"mt-1 text-gray-500 line-clamp-2\">{{ ao.description|u.truncate(100, '...') }}</p>
    </div>

    <!-- Footer -->
    <div class=\"mt-auto p-6 pt-4 border-t border-gray-100\">
        <div class=\"flex justify-between items-center\">
            <div>
                <span class=\"text-sm font-medium text-gray-900\">{{ ao.budget|format_currency('XOF') }}</span>
                <span class=\"block text-xs text-gray-500\">Clôture le {{ ao.dateLimite|date('d/m/Y') }}</span>
            </div>
            <a href=\"{{ path('app_ao_detail', {id: ao.id}) }}\"
               class=\"px-4 py-2 bg-primary text-white rounded-lg hover:bg-secondary transition-colors text-sm font-medium\">
                Voir
            </a>
        </div>
    </div>
</div>", "ao/component/_card.html.twig", "/app/templates/ao/component/_card.html.twig");
    }
}
