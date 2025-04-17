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

/* dashboard/index.html.twig */
class __TwigTemplate_ff47e391e67c49e48c90e5ca85fa7089 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "dashboard/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "dashboard/index.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "dashboard/index.html.twig", 1);
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
        yield "    <div
            x-data=\"appelsOffresComponent()\"
            x-init=\"init()\"
            data-appels-offres='";
        // line 7
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(json_encode((isset($context["appels_offres"]) || array_key_exists("appels_offres", $context) ? $context["appels_offres"] : (function () { throw new RuntimeError('Variable "appels_offres" does not exist.', 7, $this->source); })())), "html_attr");
        yield "'
    >
        <div class=\"mb-4\">
            <input
                    type=\"text\"
                    x-model=\"search\"
                    placeholder=\"Rechercher un appel d'offre...\"
                    class=\"border px-4 py-2 w-full rounded\"
            />
        </div>

        <template x-for=\"appel in filteredAppels\" :key=\"appel.id\">
            <div class=\"border rounded p-4 mb-2\">
                <h2 class=\"text-xl font-bold\" x-text=\"appel.titre\"></h2>
                <p class=\"text-gray-600\" x-text=\"appel.description\"></p>
                <p class=\"text-sm text-gray-500\">
                    Organisation : <span x-text=\"appel.organisation\"></span>
                </p>
            </div>
        </template>

        <div x-show=\"filteredAppels.length === 0\" class=\"text-gray-500\">
            Aucun appel d'offre trouvé.
        </div>
    </div>

    <script>
        function appelsOffresComponent() {
            return {
                search: '',
                appelsOffres: [],
                init() {
                    const raw = this.\$el.dataset.appelsOffres;
                    try {
                        this.appelsOffres = JSON.parse(raw);
                        console.log(\"Appels d'offres chargés :\", this.appelsOffres);
                    } catch (e) {
                        console.error(\"Erreur de parsing JSON :\", e, raw);
                    }
                },
                get filteredAppels() {
                    if (!this.search) return this.appelsOffres;
                    const query = this.normalize(this.search);
                    return this.appelsOffres.filter(a =>
                        this.normalize(a.titre).includes(query)
                        || this.normalize(a.description).includes(query)
                        || this.normalize(a.organisation).includes(query)
                    );
                },
                normalize(str) {
                    return str
                        .toLowerCase()
                        .normalize(\"NFD\") // décompose les accents
                        .replace(/[\\u0300-\\u036f]/g, \"\"); // supprime les accents
                }
            };
        }
    </script>
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
        return "dashboard/index.html.twig";
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
        return array (  81 => 7,  76 => 4,  63 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block body %}
    <div
            x-data=\"appelsOffresComponent()\"
            x-init=\"init()\"
            data-appels-offres='{{ appels_offres|json_encode|e('html_attr') }}'
    >
        <div class=\"mb-4\">
            <input
                    type=\"text\"
                    x-model=\"search\"
                    placeholder=\"Rechercher un appel d'offre...\"
                    class=\"border px-4 py-2 w-full rounded\"
            />
        </div>

        <template x-for=\"appel in filteredAppels\" :key=\"appel.id\">
            <div class=\"border rounded p-4 mb-2\">
                <h2 class=\"text-xl font-bold\" x-text=\"appel.titre\"></h2>
                <p class=\"text-gray-600\" x-text=\"appel.description\"></p>
                <p class=\"text-sm text-gray-500\">
                    Organisation : <span x-text=\"appel.organisation\"></span>
                </p>
            </div>
        </template>

        <div x-show=\"filteredAppels.length === 0\" class=\"text-gray-500\">
            Aucun appel d'offre trouvé.
        </div>
    </div>

    <script>
        function appelsOffresComponent() {
            return {
                search: '',
                appelsOffres: [],
                init() {
                    const raw = this.\$el.dataset.appelsOffres;
                    try {
                        this.appelsOffres = JSON.parse(raw);
                        console.log(\"Appels d'offres chargés :\", this.appelsOffres);
                    } catch (e) {
                        console.error(\"Erreur de parsing JSON :\", e, raw);
                    }
                },
                get filteredAppels() {
                    if (!this.search) return this.appelsOffres;
                    const query = this.normalize(this.search);
                    return this.appelsOffres.filter(a =>
                        this.normalize(a.titre).includes(query)
                        || this.normalize(a.description).includes(query)
                        || this.normalize(a.organisation).includes(query)
                    );
                },
                normalize(str) {
                    return str
                        .toLowerCase()
                        .normalize(\"NFD\") // décompose les accents
                        .replace(/[\\u0300-\\u036f]/g, \"\"); // supprime les accents
                }
            };
        }
    </script>
{% endblock %}", "dashboard/index.html.twig", "/app/templates/dashboard/index.html.twig");
    }
}
