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

/* account/account.html.twig */
class __TwigTemplate_6c0720d0e701d1009485c707b16b371f extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "account/account.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "account/account.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "account/account.html.twig", 1);
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

        yield "Mon compte - AO Burkina";
        
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
        yield "    <section class=\"py-12 bg-gray-50\">
        <div class=\"container mx-auto px-4\">
            <div class=\"max-w-4xl mx-auto\">
                <!-- En-tête -->
                <div class=\"pb-8 border-b border-gray-200\">
                    <h1 class=\"text-3xl font-bold text-gray-900\">Mon compte</h1>
                    <p class=\"mt-2 text-sm text-gray-600\">Gérez vos informations personnelles et vos préférences</p>
                </div>

                <!-- Section profil -->
                <div class=\"mt-8 bg-white shadow rounded-lg overflow-hidden\">
                    <div class=\"px-6 py-5 border-b border-gray-200 bg-gray-50\">
                        <h2 class=\"text-lg font-medium text-gray-900\">Informations personnelles</h2>
                    </div>
                    <div class=\"px-6 py-6\">
                        <div class=\"grid grid-cols-1 md:grid-cols-2 gap-6\">
                            <!-- Photo de profil (placeholder) -->
                            <div class=\"col-span-1 flex items-center\">
                                <div class=\"flex-shrink-0 h-24 w-24 rounded-full bg-blue-100 flex items-center justify-center\">
                                <span class=\"text-3xl text-blue-600 font-bold\">
                                    ";
        // line 26
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 26, $this->source); })()), "user", [], "any", false, false, false, 26), "firstname", [], "any", false, false, false, 26))), "html", null, true);
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 26, $this->source); })()), "user", [], "any", false, false, false, 26), "lastname", [], "any", false, false, false, 26))), "html", null, true);
        yield "
                                </span>
                                </div>
                                <div class=\"ml-4\">
                                    <p class=\"text-sm font-medium text-gray-700\">Photo de profil</p>
                                    <button type=\"button\" class=\"mt-2 text-sm text-blue-600 hover:text-blue-500\">
                                        Changer
                                    </button>
                                </div>
                            </div>

                            <!-- Statut de validation -->
                            <div class=\"col-span-1 flex justify-end\">
                            <span class=\"inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                ";
        // line 40
        if (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 40, $this->source); })()), "user", [], "any", false, false, false, 40), "isValid", [], "any", false, false, false, 40)) {
            // line 41
            yield "                                    bg-green-100 text-green-800
                                ";
        } else {
            // line 43
            yield "                                    bg-yellow-100 text-yellow-800
                                ";
        }
        // line 44
        yield "\">
                                ";
        // line 45
        if (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 45, $this->source); })()), "user", [], "any", false, false, false, 45), "isValid", [], "any", false, false, false, 45)) {
            // line 46
            yield "                                    Compte validé
                                ";
        } else {
            // line 48
            yield "                                    En attente de validation
                                ";
        }
        // line 50
        yield "                            </span>
                            </div>
                        </div>

                        <!-- Formulaire d'informations -->
                        <div class=\"mt-8 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6\">
                            <div class=\"sm:col-span-3\">
                                <label class=\"block text-sm font-medium text-gray-700\">Prénom</label>
                                <div class=\"mt-1 p-2 bg-gray-50 rounded-md border border-gray-200\">
                                    ";
        // line 59
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 59, $this->source); })()), "user", [], "any", false, false, false, 59), "firstname", [], "any", false, false, false, 59), "html", null, true);
        yield "
                                </div>
                            </div>

                            <div class=\"sm:col-span-3\">
                                <label class=\"block text-sm font-medium text-gray-700\">Nom</label>
                                <div class=\"mt-1 p-2 bg-gray-50 rounded-md border border-gray-200\">
                                    ";
        // line 66
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 66, $this->source); })()), "user", [], "any", false, false, false, 66), "lastname", [], "any", false, false, false, 66), "html", null, true);
        yield "
                                </div>
                            </div>

                            <div class=\"sm:col-span-4\">
                                <label class=\"block text-sm font-medium text-gray-700\">Email</label>
                                <div class=\"mt-1 p-2 bg-gray-50 rounded-md border border-gray-200\">
                                    ";
        // line 73
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 73, $this->source); })()), "user", [], "any", false, false, false, 73), "email", [], "any", false, false, false, 73), "html", null, true);
        yield "
                                </div>
                            </div>

                            <div class=\"sm:col-span-4\">
                                <label class=\"block text-sm font-medium text-gray-700\">Téléphone</label>
                                <div class=\"mt-1 p-2 bg-gray-50 rounded-md border border-gray-200\">
                                    ";
        // line 80
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 80, $this->source); })()), "user", [], "any", false, false, false, 80), "phoneNumber", [], "any", false, false, false, 80), "html", null, true);
        yield "
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section sécurité -->
                <div class=\"mt-8 bg-white shadow rounded-lg overflow-hidden\">
                    <div class=\"px-6 py-5 border-b border-gray-200 bg-gray-50\">
                        <h2 class=\"text-lg font-medium text-gray-900\">Sécurité</h2>
                    </div>
                    <div class=\"px-6 py-6\">
                        <div class=\"space-y-6\">
                            <div>
                                <label class=\"block text-sm font-medium text-gray-700\">Mot de passe</label>
                                <div class=\"mt-1\">
                                    <a href=\"";
        // line 97
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_change_password");
        yield "\" class=\"text-sm text-blue-600 hover:text-blue-500\">
                                        Changer mon mot de passe
                                    </a>
                                </div>
                            </div>

                            <div>
                                <label class=\"block text-sm font-medium text-gray-700\">Rôles</label>
                                <div class=\"mt-1\">
                                    ";
        // line 106
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 106, $this->source); })()), "user", [], "any", false, false, false, 106), "roles", [], "any", false, false, false, 106));
        foreach ($context['_seq'] as $context["_key"] => $context["role"]) {
            // line 107
            yield "                                        <span class=\"inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mr-2\">
                                        ";
            // line 108
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["role"], "html", null, true);
            yield "
                                    </span>
                                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['role'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 111
        yield "                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class=\"mt-8 flex flex-col sm:flex-row justify-end space-y-4 sm:space-y-0 sm:space-x-4\">
                    <a href=\"";
        // line 119
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_account_edit");
        yield "\"
                       class=\"inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500\">
                        <svg class=\"-ml-1 mr-2 h-5 w-5\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                            <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z\"/>
                        </svg>
                        Modifier mon profil
                    </a>

                    <a href=\"";
        // line 127
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
        yield "\"
                       class=\"inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500\">
                        <svg class=\"-ml-1 mr-2 h-5 w-5\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                            <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1\"/>
                        </svg>
                        Déconnexion
                    </a>
                </div>
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
        return "account/account.html.twig";
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
        return array (  273 => 127,  262 => 119,  252 => 111,  243 => 108,  240 => 107,  236 => 106,  224 => 97,  204 => 80,  194 => 73,  184 => 66,  174 => 59,  163 => 50,  159 => 48,  155 => 46,  153 => 45,  150 => 44,  146 => 43,  142 => 41,  140 => 40,  122 => 26,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Mon compte - AO Burkina{% endblock %}

{% block body %}
    <section class=\"py-12 bg-gray-50\">
        <div class=\"container mx-auto px-4\">
            <div class=\"max-w-4xl mx-auto\">
                <!-- En-tête -->
                <div class=\"pb-8 border-b border-gray-200\">
                    <h1 class=\"text-3xl font-bold text-gray-900\">Mon compte</h1>
                    <p class=\"mt-2 text-sm text-gray-600\">Gérez vos informations personnelles et vos préférences</p>
                </div>

                <!-- Section profil -->
                <div class=\"mt-8 bg-white shadow rounded-lg overflow-hidden\">
                    <div class=\"px-6 py-5 border-b border-gray-200 bg-gray-50\">
                        <h2 class=\"text-lg font-medium text-gray-900\">Informations personnelles</h2>
                    </div>
                    <div class=\"px-6 py-6\">
                        <div class=\"grid grid-cols-1 md:grid-cols-2 gap-6\">
                            <!-- Photo de profil (placeholder) -->
                            <div class=\"col-span-1 flex items-center\">
                                <div class=\"flex-shrink-0 h-24 w-24 rounded-full bg-blue-100 flex items-center justify-center\">
                                <span class=\"text-3xl text-blue-600 font-bold\">
                                    {{ app.user.firstname|first|upper }}{{ app.user.lastname|first|upper }}
                                </span>
                                </div>
                                <div class=\"ml-4\">
                                    <p class=\"text-sm font-medium text-gray-700\">Photo de profil</p>
                                    <button type=\"button\" class=\"mt-2 text-sm text-blue-600 hover:text-blue-500\">
                                        Changer
                                    </button>
                                </div>
                            </div>

                            <!-- Statut de validation -->
                            <div class=\"col-span-1 flex justify-end\">
                            <span class=\"inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                {% if app.user.isValid %}
                                    bg-green-100 text-green-800
                                {% else %}
                                    bg-yellow-100 text-yellow-800
                                {% endif %}\">
                                {% if app.user.isValid %}
                                    Compte validé
                                {% else %}
                                    En attente de validation
                                {% endif %}
                            </span>
                            </div>
                        </div>

                        <!-- Formulaire d'informations -->
                        <div class=\"mt-8 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6\">
                            <div class=\"sm:col-span-3\">
                                <label class=\"block text-sm font-medium text-gray-700\">Prénom</label>
                                <div class=\"mt-1 p-2 bg-gray-50 rounded-md border border-gray-200\">
                                    {{ app.user.firstname }}
                                </div>
                            </div>

                            <div class=\"sm:col-span-3\">
                                <label class=\"block text-sm font-medium text-gray-700\">Nom</label>
                                <div class=\"mt-1 p-2 bg-gray-50 rounded-md border border-gray-200\">
                                    {{ app.user.lastname }}
                                </div>
                            </div>

                            <div class=\"sm:col-span-4\">
                                <label class=\"block text-sm font-medium text-gray-700\">Email</label>
                                <div class=\"mt-1 p-2 bg-gray-50 rounded-md border border-gray-200\">
                                    {{ app.user.email }}
                                </div>
                            </div>

                            <div class=\"sm:col-span-4\">
                                <label class=\"block text-sm font-medium text-gray-700\">Téléphone</label>
                                <div class=\"mt-1 p-2 bg-gray-50 rounded-md border border-gray-200\">
                                    {{ app.user.phoneNumber }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section sécurité -->
                <div class=\"mt-8 bg-white shadow rounded-lg overflow-hidden\">
                    <div class=\"px-6 py-5 border-b border-gray-200 bg-gray-50\">
                        <h2 class=\"text-lg font-medium text-gray-900\">Sécurité</h2>
                    </div>
                    <div class=\"px-6 py-6\">
                        <div class=\"space-y-6\">
                            <div>
                                <label class=\"block text-sm font-medium text-gray-700\">Mot de passe</label>
                                <div class=\"mt-1\">
                                    <a href=\"{{ path('app_change_password') }}\" class=\"text-sm text-blue-600 hover:text-blue-500\">
                                        Changer mon mot de passe
                                    </a>
                                </div>
                            </div>

                            <div>
                                <label class=\"block text-sm font-medium text-gray-700\">Rôles</label>
                                <div class=\"mt-1\">
                                    {% for role in app.user.roles %}
                                        <span class=\"inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mr-2\">
                                        {{ role }}
                                    </span>
                                    {% endfor %}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class=\"mt-8 flex flex-col sm:flex-row justify-end space-y-4 sm:space-y-0 sm:space-x-4\">
                    <a href=\"{{ path('app_account_edit') }}\"
                       class=\"inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500\">
                        <svg class=\"-ml-1 mr-2 h-5 w-5\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                            <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z\"/>
                        </svg>
                        Modifier mon profil
                    </a>

                    <a href=\"{{ path('app_logout') }}\"
                       class=\"inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500\">
                        <svg class=\"-ml-1 mr-2 h-5 w-5\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                            <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1\"/>
                        </svg>
                        Déconnexion
                    </a>
                </div>
            </div>
        </div>
    </section>
{% endblock %}", "account/account.html.twig", "/app/templates/account/account.html.twig");
    }
}
