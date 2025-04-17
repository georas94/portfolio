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

/* ao/list/list.html.twig */
class __TwigTemplate_758a941a592a0ae28b2030cf5e3b3f30 extends Template
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

        $this->blocks = [
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "ao/list/list.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "ao/list/list.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "ao/list/list.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 4
        yield "    <div x-data=\"{ searchTerm: '' }\" class=\"container mx-auto px-4 py-8\">
        <!-- Barre de recherche -->
        <div class=\"mb-8\">
            <input x-model=\"searchTerm\" type=\"text\" placeholder=\"Rechercher par référence, titre...\"
                   class=\"w-full p-3 border rounded-lg shadow-sm focus:ring-2 focus:ring-primary focus:border-transparent\">
        </div>

        <!-- Cartes responsive -->
        <div class=\"grid gap-6 md:grid-cols-2 lg:grid-cols-3\">
            ";
        // line 13
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["aos"]) || array_key_exists("aos", $context) ? $context["aos"] : (function () { throw new RuntimeError('Variable "aos" does not exist.', 13, $this->source); })()));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["ao"]) {
            // line 14
            yield "                <div x-show=\"searchTerm === '' ||
                    '";
            // line 15
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::lower($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["ao"], "reference", [], "any", false, false, false, 15)), "html", null, true);
            yield "'.includes(searchTerm.toLowerCase()) ||
                    '";
            // line 16
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::lower($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["ao"], "titre", [], "any", false, false, false, 16)), "html", null, true);
            yield "'.includes(searchTerm.toLowerCase())\"
                     class=\"bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 border border-gray-100\">
                    ";
            // line 18
            yield from $this->loadTemplate("ao/component/_card.html.twig", "ao/list/list.html.twig", 18)->unwrap()->yield(CoreExtension::merge($context, ["ao" => $context["ao"]]));
            // line 19
            yield "                </div>
            ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['ao'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 21
        yield "        </div>

        <!-- Empty state -->
        <template x-if=\"searchTerm !== '' && document.querySelectorAll('[x-show\\\\\$=\\\\'includes(searchTerm.toLowerCase())]').length === 0\">
            <div class=\"text-center py-12\">
                <svg class=\"mx-auto h-12 w-12 text-gray-400\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z\"/>
                </svg>
                <h3 class=\"mt-2 text-lg font-medium\">Aucun résultat</h3>
            </div>
        </template>
    </div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "ao/list/list.html.twig";
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
        return array (  133 => 21,  118 => 19,  116 => 18,  111 => 16,  107 => 15,  104 => 14,  87 => 13,  76 => 4,  63 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block body %}
    <div x-data=\"{ searchTerm: '' }\" class=\"container mx-auto px-4 py-8\">
        <!-- Barre de recherche -->
        <div class=\"mb-8\">
            <input x-model=\"searchTerm\" type=\"text\" placeholder=\"Rechercher par référence, titre...\"
                   class=\"w-full p-3 border rounded-lg shadow-sm focus:ring-2 focus:ring-primary focus:border-transparent\">
        </div>

        <!-- Cartes responsive -->
        <div class=\"grid gap-6 md:grid-cols-2 lg:grid-cols-3\">
            {% for ao in aos %}
                <div x-show=\"searchTerm === '' ||
                    '{{ ao.reference|lower }}'.includes(searchTerm.toLowerCase()) ||
                    '{{ ao.titre|lower }}'.includes(searchTerm.toLowerCase())\"
                     class=\"bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 border border-gray-100\">
                    {% include 'ao/component/_card.html.twig' with {'ao': ao} %}
                </div>
            {% endfor %}
        </div>

        <!-- Empty state -->
        <template x-if=\"searchTerm !== '' && document.querySelectorAll('[x-show\\\\\$=\\\\'includes(searchTerm.toLowerCase())]').length === 0\">
            <div class=\"text-center py-12\">
                <svg class=\"mx-auto h-12 w-12 text-gray-400\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z\"/>
                </svg>
                <h3 class=\"mt-2 text-lg font-medium\">Aucun résultat</h3>
            </div>
        </template>
    </div>
{% endblock %}", "ao/list/list.html.twig", "/app/templates/ao/list/list.html.twig");
    }
}
