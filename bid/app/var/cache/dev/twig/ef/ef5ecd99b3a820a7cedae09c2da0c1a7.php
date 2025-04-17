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

/* legal/conditions.html.twig */
class __TwigTemplate_99de3d0afe18b6b3d53065b3e4458b59 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "legal/conditions.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "legal/conditions.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "legal/conditions.html.twig", 1);
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

        yield "Conditions d'Utilisation - AO Burkina";
        
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
            <h1 class=\"text-3xl font-bold mb-8 text-center\">Conditions Générales d'Utilisation</h1>

            <div class=\"bg-gray-50 p-6 rounded-lg shadow-sm\">
                <h2 class=\"text-xl font-semibold mb-4\">1. Objet</h2>
                <p class=\"mb-6\">
                    Les présentes CGU régissent l'utilisation de la plateforme AO Burkina, service de publication et consultation d'appels d'offres publics.
                </p>

                <h2 class=\"text-xl font-semibold mb-4\">2. Accès au service</h2>
                <p class=\"mb-6\">
                    La plateforme est accessible gratuitement à tout utilisateur disposant d'un accès à internet. Les coûts d'accès sont à la charge de l'utilisateur.
                </p>

                <h2 class=\"text-xl font-semibold mb-4\">3. Responsabilités</h2>
                <p class=\"mb-6\">
                    Les informations publiées sont fournies à titre indicatif. AO Burkina ne garantit pas l'exhaustivité ou l'exactitude des appels d'offres publiés.
                </p>

                <h2 class=\"text-xl font-semibold mb-4\">4. Modification des CGU</h2>
                <p class=\"mb-6\">
                    AO Burkina se réserve le droit de modifier ces conditions à tout moment. Les utilisateurs seront informés par email ou via la plateforme.
                </p>

                <h2 class=\"text-xl font-semibold mb-4\">5. Loi applicable</h2>
                <p>
                    Les présentes conditions sont régies par la loi burkinabè et tout litige relèvera des tribunaux compétents de [Ville].
                </p>
            </div>

            <p class=\"text-center mt-8 text-gray-500\">
                Version en vigueur au ";
        // line 38
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate("now", "d/m/Y"), "html", null, true);
        yield "
            </p>
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
        return "legal/conditions.html.twig";
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
        return array (  134 => 38,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Conditions d'Utilisation - AO Burkina{% endblock %}

{% block body %}
    <section class=\"py-12 bg-white\">
        <div class=\"container mx-auto px-4 max-w-3xl\">
            <h1 class=\"text-3xl font-bold mb-8 text-center\">Conditions Générales d'Utilisation</h1>

            <div class=\"bg-gray-50 p-6 rounded-lg shadow-sm\">
                <h2 class=\"text-xl font-semibold mb-4\">1. Objet</h2>
                <p class=\"mb-6\">
                    Les présentes CGU régissent l'utilisation de la plateforme AO Burkina, service de publication et consultation d'appels d'offres publics.
                </p>

                <h2 class=\"text-xl font-semibold mb-4\">2. Accès au service</h2>
                <p class=\"mb-6\">
                    La plateforme est accessible gratuitement à tout utilisateur disposant d'un accès à internet. Les coûts d'accès sont à la charge de l'utilisateur.
                </p>

                <h2 class=\"text-xl font-semibold mb-4\">3. Responsabilités</h2>
                <p class=\"mb-6\">
                    Les informations publiées sont fournies à titre indicatif. AO Burkina ne garantit pas l'exhaustivité ou l'exactitude des appels d'offres publiés.
                </p>

                <h2 class=\"text-xl font-semibold mb-4\">4. Modification des CGU</h2>
                <p class=\"mb-6\">
                    AO Burkina se réserve le droit de modifier ces conditions à tout moment. Les utilisateurs seront informés par email ou via la plateforme.
                </p>

                <h2 class=\"text-xl font-semibold mb-4\">5. Loi applicable</h2>
                <p>
                    Les présentes conditions sont régies par la loi burkinabè et tout litige relèvera des tribunaux compétents de [Ville].
                </p>
            </div>

            <p class=\"text-center mt-8 text-gray-500\">
                Version en vigueur au {{ \"now\"|date(\"d/m/Y\") }}
            </p>
        </div>
    </section>
{% endblock %}", "legal/conditions.html.twig", "/app/templates/legal/conditions.html.twig");
    }
}
