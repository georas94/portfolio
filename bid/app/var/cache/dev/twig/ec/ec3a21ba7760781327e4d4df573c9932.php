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

/* login/login.html.twig */
class __TwigTemplate_b9b89c8e960c890219f86d3f68b15b97 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "login/login.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "login/login.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "login/login.html.twig", 1);
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

        yield "Connexion - AO Burkina";
        
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
        yield "    <section class=\"py-16 bg-gray-50\">
        <div class=\"container mx-auto px-4\">
            <!-- Affichage des succès/erreurs -->
            ";
        // line 9
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 9, $this->source); })()), "flashes", ["registration_success"], "method", false, false, false, 9));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 10
            yield "                <div class=\"inset-0 flex items-center justify-center text-center\">
                    <div class=\"bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-5 w-1/2\">
                            ";
            // line 12
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
            yield "
                    </div>
                </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 16
        yield "            <!-- Affichage des erreurs -->
            ";
        // line 17
        if ((isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 17, $this->source); })())) {
            // line 18
            yield "                <div class=\"max-w-md mx-auto mb-8\">
                    <div class=\"bg-red-100 border-l-4 border-red-500 text-red-700 p-4\" role=\"alert\">
                        ";
            // line 20
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(CoreExtension::getAttribute($this->env, $this->source, (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 20, $this->source); })()), "messageKey", [], "any", false, false, false, 20), CoreExtension::getAttribute($this->env, $this->source, (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 20, $this->source); })()), "messageData", [], "any", false, false, false, 20), "security"), "html", null, true);
            yield "
                    </div>
                </div>
            ";
        }
        // line 24
        yield "
            <div class=\"max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden p-8\">
                <h1 class=\"text-2xl font-bold text-center text-gray-800 mb-8\">Connexion</h1>

                <form method=\"POST\" action=\"";
        // line 28
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
        yield "\" class=\"space-y-6\">
                    <input type=\"hidden\" name=\"_csrf_token\" value=\"";
        // line 29
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken("authenticate"), "html", null, true);
        yield "\">

                    <!-- Email -->
                    <div class=\"space-y-2 relative\">
                        <label for=\"inputEmail\" class=\"block text-sm font-medium text-gray-700\">Email</label>
                        <div class=\"relative\">
                            <div class=\"absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none\">
                                <svg class=\"h-5 w-5 text-gray-400\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z\"/>
                                </svg>
                            </div>
                            <input type=\"email\" class=\"mt-1 block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500\" name=\"_username\">
                        </div>
                    </div>

                    <!-- Mot de passe -->
                    <div class=\"space-y-2 relative\">
                        <label for=\"inputPassword\" class=\"block text-sm font-medium text-gray-700\">Mot de passe</label>
                        <div class=\"relative\">
                            <div class=\"absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none\">
                                <svg class=\"h-5 w-5 text-gray-400\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z\"/>
                                </svg>
                            </div>
                            <input type=\"password\" id=\"inputPassword\" name=\"_password\"
                                   class=\"mt-1 block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500\"
                                   autocomplete=\"new-password\">
                            <button type=\"button\" class=\"absolute inset-y-0 right-0 pr-3 flex items-center toggle-password\">
                                <svg class=\"h-5 w-5 text-gray-400\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M15 12a3 3 0 11-6 0 3 3 0 016 0z\"/>
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z\"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Remember me option -->
                    <div class=\"flex items-center justify-between\">
                        <div class=\"flex items-center\">
                            <input id=\"remember_me\" name=\"_remember_me\" type=\"checkbox\"
                                   class=\"h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded\">
                            <label for=\"remember_me\" class=\"ml-2 block text-sm text-gray-700\">
                                Se souvenir de moi
                            </label>
                        </div>
                        <div class=\"text-sm\">
                            <a href=\"#\" class=\"font-medium text-blue-600 hover:text-blue-500\">
                                Mot de passe oublié ?
                            </a>
                        </div>
                    </div>

                    <!-- Bouton de connexion -->
                    <div class=\"pt-4\">
                        <button type=\"submit\"
                                class=\"w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200\">
                            Se connecter
                        </button>
                    </div>

                    <div class=\"text-center text-sm text-gray-600 pt-4\">
                        <p>Pas encore de compte ? <a href=\"";
        // line 90
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register");
        yield "\" class=\"font-medium text-blue-600 hover:text-blue-500\">S'inscrire</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script>
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.parentElement.querySelector('input');
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                this.querySelector('svg').classList.toggle('text-blue-500');
            });
        });
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
        return "login/login.html.twig";
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
        return array (  213 => 90,  149 => 29,  145 => 28,  139 => 24,  132 => 20,  128 => 18,  126 => 17,  123 => 16,  113 => 12,  109 => 10,  105 => 9,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Connexion - AO Burkina{% endblock %}

{% block body %}
    <section class=\"py-16 bg-gray-50\">
        <div class=\"container mx-auto px-4\">
            <!-- Affichage des succès/erreurs -->
            {% for message in app.flashes('registration_success') %}
                <div class=\"inset-0 flex items-center justify-center text-center\">
                    <div class=\"bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-5 w-1/2\">
                            {{ message }}
                    </div>
                </div>
            {% endfor %}
            <!-- Affichage des erreurs -->
            {% if error %}
                <div class=\"max-w-md mx-auto mb-8\">
                    <div class=\"bg-red-100 border-l-4 border-red-500 text-red-700 p-4\" role=\"alert\">
                        {{ error.messageKey|trans(error.messageData, 'security') }}
                    </div>
                </div>
            {% endif %}

            <div class=\"max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden p-8\">
                <h1 class=\"text-2xl font-bold text-center text-gray-800 mb-8\">Connexion</h1>

                <form method=\"POST\" action=\"{{ path('app_login') }}\" class=\"space-y-6\">
                    <input type=\"hidden\" name=\"_csrf_token\" value=\"{{ csrf_token('authenticate') }}\">

                    <!-- Email -->
                    <div class=\"space-y-2 relative\">
                        <label for=\"inputEmail\" class=\"block text-sm font-medium text-gray-700\">Email</label>
                        <div class=\"relative\">
                            <div class=\"absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none\">
                                <svg class=\"h-5 w-5 text-gray-400\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z\"/>
                                </svg>
                            </div>
                            <input type=\"email\" class=\"mt-1 block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500\" name=\"_username\">
                        </div>
                    </div>

                    <!-- Mot de passe -->
                    <div class=\"space-y-2 relative\">
                        <label for=\"inputPassword\" class=\"block text-sm font-medium text-gray-700\">Mot de passe</label>
                        <div class=\"relative\">
                            <div class=\"absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none\">
                                <svg class=\"h-5 w-5 text-gray-400\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z\"/>
                                </svg>
                            </div>
                            <input type=\"password\" id=\"inputPassword\" name=\"_password\"
                                   class=\"mt-1 block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500\"
                                   autocomplete=\"new-password\">
                            <button type=\"button\" class=\"absolute inset-y-0 right-0 pr-3 flex items-center toggle-password\">
                                <svg class=\"h-5 w-5 text-gray-400\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M15 12a3 3 0 11-6 0 3 3 0 016 0z\"/>
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z\"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Remember me option -->
                    <div class=\"flex items-center justify-between\">
                        <div class=\"flex items-center\">
                            <input id=\"remember_me\" name=\"_remember_me\" type=\"checkbox\"
                                   class=\"h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded\">
                            <label for=\"remember_me\" class=\"ml-2 block text-sm text-gray-700\">
                                Se souvenir de moi
                            </label>
                        </div>
                        <div class=\"text-sm\">
                            <a href=\"#\" class=\"font-medium text-blue-600 hover:text-blue-500\">
                                Mot de passe oublié ?
                            </a>
                        </div>
                    </div>

                    <!-- Bouton de connexion -->
                    <div class=\"pt-4\">
                        <button type=\"submit\"
                                class=\"w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200\">
                            Se connecter
                        </button>
                    </div>

                    <div class=\"text-center text-sm text-gray-600 pt-4\">
                        <p>Pas encore de compte ? <a href=\"{{ path('app_register') }}\" class=\"font-medium text-blue-600 hover:text-blue-500\">S'inscrire</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script>
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.parentElement.querySelector('input');
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                this.querySelector('svg').classList.toggle('text-blue-500');
            });
        });
    </script>
{% endblock %}", "login/login.html.twig", "/app/templates/login/login.html.twig");
    }
}
