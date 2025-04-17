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

/* home/index.html.twig */
class __TwigTemplate_f62214962468d741277469169a032866 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "home/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "home/index.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "home/index.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 2
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

        yield "Plateforme des Marchés Publics - Burkina Faso";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 4
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

        // line 5
        yield "    <!-- Hero Section -->
    <section class=\"relative bg-gradient-to-r from-green-700 to-yellow-300 text-white pt-2 pb-2 md:pt-5 md:pb-2 overflow-hidden\">
        <!-- Effet gradiant -->
        <section class=\"bg-gradient-to-r from-green-700 to-yellow-300 text-white py-20 md:py-28\">
            <div class=\"container mx-auto px-4 text-center\">
                <h1 class=\"text-4xl md:text-5xl font-bold mb-6 leading-tight\">Opportunités d'Affaires Publiques</h1>
                <p class=\"text-xl md:text-2xl mb-8 max-w-3xl mx-auto\">Découvrez tous les appels d'offres gouvernementaux en un seul endroit</p>
                <a href=\"#appels-offres\" class=\"inline-block bg-red-600 text-white-700 font-semibold px-8 py-3 rounded-lg hover:bg-red-500 transition duration-300 shadow-lg transform hover:scale-105\"> Explorer les AO </a>
            </div>
        </section>
    </section>

    <section id=\"appels-offres\" class=\"py-16 bg-gray-50\">
        <div class=\"container mx-auto px-4\">
            <div class=\"text-center mb-12\">
                <h2 class=\"text-3xl font-bold text-gray-800 mb-3\">Appels d'offres disponibles</h2>
                <div class=\"w-20 h-1 bg-green-600 mx-auto\"></div>
            </div>

            <div x-data=\"{ searchTerm: '' }\" class=\"container mx-auto px-4 py-8\">
                <!-- Barre de recherche -->
                <div class=\"mb-8\">
                    <input x-model=\"searchTerm\" type=\"text\" placeholder=\"Rechercher par référence, titre...\"
                           class=\"w-full p-3 border rounded-lg shadow-sm focus:ring-2 focus:ring-primary focus:border-transparent\">
                </div>

                <!-- Cartes responsive -->
                <div class=\"grid gap-6 md:grid-cols-2 lg:grid-cols-3\">
                    ";
        // line 33
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["aos"]) || array_key_exists("aos", $context) ? $context["aos"] : (function () { throw new RuntimeError('Variable "aos" does not exist.', 33, $this->source); })()));
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
            // line 34
            yield "                        <div x-show=\"searchTerm === '' ||
                            '";
            // line 35
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::lower($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["ao"], "reference", [], "any", false, false, false, 35)), "html", null, true);
            yield "'.includes(searchTerm.toLowerCase()) ||
                            '";
            // line 36
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::lower($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["ao"], "titre", [], "any", false, false, false, 36)), "html", null, true);
            yield "'.includes(searchTerm.toLowerCase())\"
                             class=\"bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 border border-gray-100\">
                            ";
            // line 38
            yield from $this->loadTemplate("ao/component/_card.html.twig", "home/index.html.twig", 38)->unwrap()->yield(CoreExtension::merge($context, ["ao" => $context["ao"]]));
            // line 39
            yield "                        </div>
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
        // line 41
        yield "                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class=\"py-16 bg-white border-t border-gray-200\">
        <div class=\"container mx-auto px-4 text-center\">
            <h2 class=\"text-3xl font-bold mb-6\">Restez informé</h2>
            <p class=\"text-xl mb-8 max-w-2xl mx-auto\">Abonnez-vous à notre newsletter pour recevoir les nouveaux appels d'offres</p>
            <form class=\"max-w-md mx-auto flex\">
                <input type=\"email\" placeholder=\"Votre email\" class=\"border border-gray-300 p-3 rounded-l-lg flex-grow focus:outline-none focus:ring-2 focus:ring-green-500\" required>
                <button type=\"submit\" class=\"bg-green-600 text-white px-6 py-3 rounded-r-lg font-medium hover:bg-green-700 transition\"> S'abonner </button>
            </form>
        </div>
    </section>

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
                    return this.appelsOffres.filter(a => this.normalize(a.titre).includes(query) ||
                        this.normalize(a.description).includes(query) ||
                        this.normalize(a.organisation).includes(query));
                },
                normalize(str) {
                    return str
                        .toLowerCase()
                        .normalize(\"NFD\")
                        .replace(/[\\u0300-\\u036f]/g, \"\");
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
        return "home/index.html.twig";
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
        return array (  176 => 41,  161 => 39,  159 => 38,  154 => 36,  150 => 35,  147 => 34,  130 => 33,  100 => 5,  87 => 4,  64 => 2,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}
{% block title %}Plateforme des Marchés Publics - Burkina Faso{% endblock %}

{% block body %}
    <!-- Hero Section -->
    <section class=\"relative bg-gradient-to-r from-green-700 to-yellow-300 text-white pt-2 pb-2 md:pt-5 md:pb-2 overflow-hidden\">
        <!-- Effet gradiant -->
        <section class=\"bg-gradient-to-r from-green-700 to-yellow-300 text-white py-20 md:py-28\">
            <div class=\"container mx-auto px-4 text-center\">
                <h1 class=\"text-4xl md:text-5xl font-bold mb-6 leading-tight\">Opportunités d'Affaires Publiques</h1>
                <p class=\"text-xl md:text-2xl mb-8 max-w-3xl mx-auto\">Découvrez tous les appels d'offres gouvernementaux en un seul endroit</p>
                <a href=\"#appels-offres\" class=\"inline-block bg-red-600 text-white-700 font-semibold px-8 py-3 rounded-lg hover:bg-red-500 transition duration-300 shadow-lg transform hover:scale-105\"> Explorer les AO </a>
            </div>
        </section>
    </section>

    <section id=\"appels-offres\" class=\"py-16 bg-gray-50\">
        <div class=\"container mx-auto px-4\">
            <div class=\"text-center mb-12\">
                <h2 class=\"text-3xl font-bold text-gray-800 mb-3\">Appels d'offres disponibles</h2>
                <div class=\"w-20 h-1 bg-green-600 mx-auto\"></div>
            </div>

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
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class=\"py-16 bg-white border-t border-gray-200\">
        <div class=\"container mx-auto px-4 text-center\">
            <h2 class=\"text-3xl font-bold mb-6\">Restez informé</h2>
            <p class=\"text-xl mb-8 max-w-2xl mx-auto\">Abonnez-vous à notre newsletter pour recevoir les nouveaux appels d'offres</p>
            <form class=\"max-w-md mx-auto flex\">
                <input type=\"email\" placeholder=\"Votre email\" class=\"border border-gray-300 p-3 rounded-l-lg flex-grow focus:outline-none focus:ring-2 focus:ring-green-500\" required>
                <button type=\"submit\" class=\"bg-green-600 text-white px-6 py-3 rounded-r-lg font-medium hover:bg-green-700 transition\"> S'abonner </button>
            </form>
        </div>
    </section>

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
                    return this.appelsOffres.filter(a => this.normalize(a.titre).includes(query) ||
                        this.normalize(a.description).includes(query) ||
                        this.normalize(a.organisation).includes(query));
                },
                normalize(str) {
                    return str
                        .toLowerCase()
                        .normalize(\"NFD\")
                        .replace(/[\\u0300-\\u036f]/g, \"\");
                }
            };
        }
    </script>
{% endblock %}", "home/index.html.twig", "/app/templates/home/index.html.twig");
    }
}
