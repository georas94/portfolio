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

/* legal/mentions.html.twig */
class __TwigTemplate_aed991210c3ad37eb55b80f005a9e70e extends Template
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
            'title' => [$this, 'block_title'],
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "legal/mentions.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "legal/mentions.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "legal/mentions.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "Mentions Légales - AO Burkina";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 5
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

        // line 6
        yield "    <section class=\"py-12 bg-white\">
        <div class=\"container mx-auto px-4 max-w-3xl\">
            <h1 class=\"text-3xl font-bold mb-8 text-center\">Mentions Légales</h1>

            <div class=\"bg-gray-50 p-6 rounded-lg shadow-sm\">
                <h2 class=\"text-xl font-semibold mb-4\">1. Éditeur</h2>
                <p class=\"mb-6\">
                    <strong>TLabs</strong> pour plateforme <strong>AO Burkina</strong><br>
                    Statut juridique : SA<br>
                    Siège social : a remplir plus tard<br>
                    Téléphone : +226 XX XX XX XX<br>
                    Email : contact@aoburkina.bf
                </p>

                <h2 class=\"text-xl font-semibold mb-4\">2. Hébergement</h2>
                <p class=\"mb-6\">
                    OVH<br>
                    Adresse : a remplir plus tard<br>
                    Téléphone : +226 XX XX XX XX
                </p>

                <h2 class=\"text-xl font-semibold mb-4\">3. Données personnelles</h2>
                <p class=\"mb-6\">
                    Conformément au RGPD, vous disposez d'un droit d'accès, de rectification et de suppression de vos données.
                    Pour toute demande, contactez notre DPO à : dpo@aoburkina.bf
                </p>

                <h2 class=\"text-xl font-semibold mb-4\">4. Propriété intellectuelle</h2>
                <p>
                    Le contenu de ce site est protégé par les droits d'auteur. Toute reproduction nécessite une autorisation écrite.
                </p>
            </div>
        </div>
    </section>
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
        return "legal/mentions.html.twig";
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
        return array (  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Mentions Légales - AO Burkina{% endblock %}

{% block body %}
    <section class=\"py-12 bg-white\">
        <div class=\"container mx-auto px-4 max-w-3xl\">
            <h1 class=\"text-3xl font-bold mb-8 text-center\">Mentions Légales</h1>

            <div class=\"bg-gray-50 p-6 rounded-lg shadow-sm\">
                <h2 class=\"text-xl font-semibold mb-4\">1. Éditeur</h2>
                <p class=\"mb-6\">
                    <strong>TLabs</strong> pour plateforme <strong>AO Burkina</strong><br>
                    Statut juridique : SA<br>
                    Siège social : a remplir plus tard<br>
                    Téléphone : +226 XX XX XX XX<br>
                    Email : contact@aoburkina.bf
                </p>

                <h2 class=\"text-xl font-semibold mb-4\">2. Hébergement</h2>
                <p class=\"mb-6\">
                    OVH<br>
                    Adresse : a remplir plus tard<br>
                    Téléphone : +226 XX XX XX XX
                </p>

                <h2 class=\"text-xl font-semibold mb-4\">3. Données personnelles</h2>
                <p class=\"mb-6\">
                    Conformément au RGPD, vous disposez d'un droit d'accès, de rectification et de suppression de vos données.
                    Pour toute demande, contactez notre DPO à : dpo@aoburkina.bf
                </p>

                <h2 class=\"text-xl font-semibold mb-4\">4. Propriété intellectuelle</h2>
                <p>
                    Le contenu de ce site est protégé par les droits d'auteur. Toute reproduction nécessite une autorisation écrite.
                </p>
            </div>
        </div>
    </section>
{% endblock %}", "legal/mentions.html.twig", "/app/templates/legal/mentions.html.twig");
    }
}
