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

/* base.html.twig */
class __TwigTemplate_0914bcf2a16a6d39ea8b51662d4865a7 extends Template
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
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "base.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "base.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>";
        // line 6
        yield from $this->unwrap()->yieldBlock('title', $context, $blocks);
        yield "</title>
    <meta name=\"description\" content=\"Plateforme centralisée des appels d'offres publics au Burkina Faso\">

    <!-- Tailwind CSS -->
    <script src=\"https://cdn.tailwindcss.com\"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#529D58',
                        secondary: '#4382F0',
                        bfred: '#E63946',
                        bfgold: '#E9C46A',
                        bfcream: '#F8EDEB'
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- jQuery -->
    <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\" integrity=\"sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=\" crossorigin=\"anonymous\"></script>

    <!-- Alpine.js -->
    <script src=\"//unpkg.com/alpinejs\" defer></script>

    <!-- Google Fonts -->
    <link href=\"https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap\" rel=\"stylesheet\">
    <link rel=\"icon\" href=\"data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🇧🇫</text></svg>\">

    <!-- CSS custom -->
    <link type=\"text/css\" href=\"";
        // line 41
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("styles/app.css"), "html", null, true);
        yield "\">
</head>
<body class=\"bg-gray-50 font-sans antialiased\">
<!-- Navbar -->
<nav class=\"bg-primary text-white shadow-md\">
    <div class=\"container mx-auto px-4\">
        <div class=\"flex justify-between items-center h-16\">
            <!-- Logo -->
            <a href=\"";
        // line 49
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_home");
        yield "\" class=\"flex items-center space-x-2\">
                <img class=\"w-16 h-16\" src=\"";
        // line 50
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/logo.png"), "html", null, true);
        yield "\" alt=\"Logo\">
                <span class=\"font-bold text-lg\">AO Burkina</span>
            </a>

            <!-- Menu Desktop -->
            <div class=\"hidden md:flex items-center gap-4\">
                ";
        // line 56
        if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 56, $this->source); })()), "user", [], "any", false, false, false, 56)) {
            // line 57
            yield "                    <!-- Menu connecté -->
                    <div class=\" space-x-2 text-white\">
                        <a class=\"flex items-center\" href=\"";
            // line 59
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_user_account");
            yield "\">
                            <svg class=\"h-5 w-5\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z\"/>
                            </svg>
                            <span>";
            // line 63
            yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "user", [], "any", false, true, false, 63), "firstname", [], "any", true, true, false, 63) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 63, $this->source); })()), "user", [], "any", false, false, false, 63), "firstname", [], "any", false, false, false, 63)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 63, $this->source); })()), "user", [], "any", false, false, false, 63), "firstname", [], "any", false, false, false, 63), "html", null, true)) : ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 63, $this->source); })()), "user", [], "any", false, false, false, 63), "email", [], "any", false, false, false, 63), "html", null, true)));
            yield "</span>
                        </a>
                    </div>
                    ";
            // line 66
            if ($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN")) {
                // line 67
                yield "                        <!-- Menu Admin -->
                        <div x-data=\"{ adminOpen: false }\" class=\"relative\">
                            <button @click=\"adminOpen = !adminOpen\" class=\"flex items-center gap-1 px-3 py-2 rounded-md hover:bg-green-700 transition-colors\">
                                <svg class=\"h-5 w-5\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z\"/>
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M15 12a3 3 0 11-6 0 3 3 0 016 0z\"/>
                                </svg>
                                <span>Admin</span>
                                <svg class=\"h-4 w-4 transition-transform\" :class=\"{ 'transform rotate-180': adminOpen }\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M19 9l-7 7-7-7\"/>
                                </svg>
                            </button>

                            <div x-show=\"adminOpen\" @click.away=\"adminOpen = false\"
                                 x-transition:enter=\"transition ease-out duration-100\"
                                 x-transition:enter-start=\"transform opacity-0 scale-95\"
                                 x-transition:enter-end=\"transform opacity-100 scale-100\"
                                 x-transition:leave=\"transition ease-in duration-75\"
                                 x-transition:leave-start=\"transform opacity-100 scale-100\"
                                 x-transition:leave-end=\"transform opacity-0 scale-95\"
                                 class=\"absolute right-0 mt-2 w-56 bg-white rounded-md shadow-lg z-50 border border-gray-200\">
                                <div class=\"py-1\">
                                    <a href=\"";
                // line 89
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_ao_create");
                yield "\" class=\"block px-4 py-2 text-gray-800 hover:bg-green-50 transition-colors\">
                                        Créer un AO
                                    </a>
                                    <a href=\"";
                // line 92
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_ao_list");
                yield "\" class=\"block px-4 py-2 text-gray-800 hover:bg-green-50 transition-colors\">
                                        Liste des AO
                                    </a>
                                </div>
                            </div>
                        </div>
                    ";
            }
            // line 99
            yield "                    <a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
            yield "\"
                       class=\"relative inline-flex items-center px-4 py-2.5 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-green-600 to-green-500 shadow-sm hover:from-green-700 hover:to-green-600 transition-all duration-200 transform hover:-translate-y-0.5 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500\">
                        <svg class=\"-ml-1 mr-2 h-5 w-5\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                            <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1\"/>
                        </svg>
                        Déconnexion
                    </a>
                ";
        } else {
            // line 107
            yield "                    <!-- Menu déconnecté -->
                    <a href=\"";
            // line 108
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
            yield "\"
                       class=\"relative inline-flex items-center px-4 py-2.5 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-green-600 to-green-500 shadow-sm hover:from-green-700 hover:to-green-600 transition-all duration-200 transform hover:-translate-y-0.5 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500\">
                        <svg class=\"-ml-1 mr-2 h-5 w-5\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                            <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1\"/>
                        </svg>
                        Connexion
                    </a>

                    <a href=\"";
            // line 116
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register");
            yield "\"
                       class=\"relative inline-flex items-center px-4 py-2.5 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-bfred to-red-500 shadow-sm hover:from-bfredDark hover:to-red-600 transition-all duration-200 transform hover:-translate-y-0.5 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500\">
                        <svg class=\"-ml-1 mr-2 h-5 w-5\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                            <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z\"/>
                        </svg>
                        S'inscrire
                    </a>
                ";
        }
        // line 124
        yield "            </div>

            <!-- Menu Mobile avec Alpine.js -->
            <div class=\"md:hidden\" x-data=\"{ open: false }\">
                <button @click=\"open = !open\" class=\"p-2 rounded-md hover:bg-green-700 focus:outline-none transition-colors\">
                    <svg class=\"h-6 w-6\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                        <path x-show=\"!open\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M4 6h16M4 12h16M4 18h16\"/>
                        <path x-show=\"open\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M6 18L18 6M6 6l12 12\"/>
                    </svg>
                </button>

                <div x-show=\"open\" @click.away=\"open = false\"
                     x-transition:enter=\"transition ease-out duration-100\"
                     x-transition:enter-start=\"transform opacity-0 scale-95\"
                     x-transition:enter-end=\"transform opacity-100 scale-100\"
                     x-transition:leave=\"transition ease-in duration-75\"
                     x-transition:leave-start=\"transform opacity-100 scale-100\"
                     x-transition:leave-end=\"transform opacity-0 scale-95\"
                     class=\"absolute right-4 mt-2 w-56 bg-white rounded-lg shadow-xl py-1 z-50 border border-gray-200 divide-y divide-gray-100\">

                    <a href=\"";
        // line 144
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_home");
        yield "\" class=\"group flex items-center px-4 py-3 text-gray-800 hover:bg-green-50 transition-colors\">
                        <svg class=\"mr-3 h-5 w-5 text-gray-500 group-hover:text-green-600\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                            <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6\"/>
                        </svg>
                        Accueil
                    </a>

                    <div class=\"py-1\">
                        ";
        // line 152
        if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 152, $this->source); })()), "user", [], "any", false, false, false, 152)) {
            // line 153
            yield "                            ";
            if ($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN")) {
                // line 154
                yield "                                <a href=\"";
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_ao_create");
                yield "\" class=\"group flex items-center px-4 py-3 text-gray-800 hover:bg-green-50 transition-colors\">
                                    <svg class=\"mr-3 h-5 w-5 text-gray-500 group-hover:text-green-600\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                        <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M12 6v6m0 0v6m0-6h6m-6 0H6\"/>
                                    </svg>
                                    Créer un AO
                                </a>
                                <a href=\"";
                // line 160
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_ao_list");
                yield "\" class=\"group flex items-center px-4 py-3 text-gray-800 hover:bg-green-50 transition-colors\">
                                    <svg class=\"mr-3 h-5 w-5 text-gray-500 group-hover:text-green-600\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                        <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2\"/>
                                    </svg>
                                    Liste des AO
                                </a>
                            ";
            }
            // line 167
            yield "                            <a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_user_account");
            yield "\" class=\"group flex items-center px-4 py-3 text-gray-800 hover:bg-green-50 transition-colors\">
                                <svg class=\"mr-3 h-5 w-5 text-gray-500 group-hover:text-green-600\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z\"/>
                                </svg>
                                Mon compte
                            </a>
                            <a href=\"";
            // line 173
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
            yield "\" class=\"group flex items-center px-4 py-3 text-gray-800 hover:bg-green-50 transition-colors\">
                                <svg class=\"mr-3 h-5 w-5 text-gray-500 group-hover:text-green-600\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1\"/>
                                </svg>
                                Déconnexion
                            </a>
                        ";
        } else {
            // line 180
            yield "                            <a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
            yield "\" class=\"group flex items-center px-4 py-3 text-gray-800 hover:bg-green-50 transition-colors\">
                                <svg class=\"mr-3 h-5 w-5 text-gray-500 group-hover:text-green-600\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1\"/>
                                </svg>
                                Connexion
                            </a>
                            <a href=\"";
            // line 186
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register");
            yield "\" class=\"group flex items-center px-4 py-3 text-gray-800 hover:bg-green-50 transition-colors\">
                                <svg class=\"mr-3 h-5 w-5 text-gray-500 group-hover:text-green-600\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z\"/>
                                </svg>
                                Inscription
                            </a>
                        ";
        }
        // line 193
        yield "                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Contenu principal -->
<main class=\"container mx-auto px-4 py-6\">
    ";
        // line 202
        yield from $this->unwrap()->yieldBlock('body', $context, $blocks);
        // line 203
        yield "</main>

<!-- Footer -->
<footer class=\"bg-gray-800 text-white py-8 mt-12\">
    <div class=\"container mx-auto px-4\">
        <div class=\"grid md:grid-cols-3 gap-8 text-center md:text-left\">
            <div>
                <h3 class=\"font-bold text-lg mb-4\">AO Burkina</h3>
                <p class=\"text-gray-400\">Plateforme officielle des marchés publics pour le Burkina Faso</p>
            </div>
            <div>
                <h4 class=\"font-semibold mb-4\">Liens utiles</h4>
                <ul class=\"space-y-2\">
                    <li><a href=\"";
        // line 216
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_legal_mentions");
        yield "\" class=\"text-gray-400 hover:text-white\">Mentions légales</a></li>
                    <li><a href=\"";
        // line 217
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_legal_conditions");
        yield "\" class=\"text-gray-400 hover:text-white\">Conditions d'utilisation</a></li>
                </ul>
            </div>
            <div>
                <h4 class=\"font-semibold mb-4\">Contact</h4>
                <p class=\"text-gray-400\">contact@aoburkina.bf</p>
                <p class=\"text-gray-400\">+226 XX XX XX XX</p>
            </div>
        </div>
        <div class=\"border-t border-gray-700 mt-8 pt-6 text-center text-gray-400\">
            <p>&copy; ";
        // line 227
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate("now", "Y"), "html", null, true);
        yield " <strong>TLabs</strong> pour plateforme <strong> AO Burkina</strong>. Tous droits réservés.</p>
        </div>
    </div>
</footer>
</body>
</html>";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 6
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

        yield "AO Burkina - Plateforme des marchés publics";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 202
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

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "base.html.twig";
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
        return array (  400 => 202,  377 => 6,  360 => 227,  347 => 217,  343 => 216,  328 => 203,  326 => 202,  315 => 193,  305 => 186,  295 => 180,  285 => 173,  275 => 167,  265 => 160,  255 => 154,  252 => 153,  250 => 152,  239 => 144,  217 => 124,  206 => 116,  195 => 108,  192 => 107,  180 => 99,  170 => 92,  164 => 89,  140 => 67,  138 => 66,  132 => 63,  125 => 59,  121 => 57,  119 => 56,  110 => 50,  106 => 49,  95 => 41,  57 => 6,  50 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>{% block title %}AO Burkina - Plateforme des marchés publics{% endblock %}</title>
    <meta name=\"description\" content=\"Plateforme centralisée des appels d'offres publics au Burkina Faso\">

    <!-- Tailwind CSS -->
    <script src=\"https://cdn.tailwindcss.com\"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#529D58',
                        secondary: '#4382F0',
                        bfred: '#E63946',
                        bfgold: '#E9C46A',
                        bfcream: '#F8EDEB'
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- jQuery -->
    <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\" integrity=\"sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=\" crossorigin=\"anonymous\"></script>

    <!-- Alpine.js -->
    <script src=\"//unpkg.com/alpinejs\" defer></script>

    <!-- Google Fonts -->
    <link href=\"https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap\" rel=\"stylesheet\">
    <link rel=\"icon\" href=\"data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🇧🇫</text></svg>\">

    <!-- CSS custom -->
    <link type=\"text/css\" href=\"{{ asset('styles/app.css') }}\">
</head>
<body class=\"bg-gray-50 font-sans antialiased\">
<!-- Navbar -->
<nav class=\"bg-primary text-white shadow-md\">
    <div class=\"container mx-auto px-4\">
        <div class=\"flex justify-between items-center h-16\">
            <!-- Logo -->
            <a href=\"{{ path('app_home') }}\" class=\"flex items-center space-x-2\">
                <img class=\"w-16 h-16\" src=\"{{ asset('assets/logo.png') }}\" alt=\"Logo\">
                <span class=\"font-bold text-lg\">AO Burkina</span>
            </a>

            <!-- Menu Desktop -->
            <div class=\"hidden md:flex items-center gap-4\">
                {% if app.user %}
                    <!-- Menu connecté -->
                    <div class=\" space-x-2 text-white\">
                        <a class=\"flex items-center\" href=\"{{ path('app_user_account') }}\">
                            <svg class=\"h-5 w-5\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z\"/>
                            </svg>
                            <span>{{ app.user.firstname ?? app.user.email }}</span>
                        </a>
                    </div>
                    {% if is_granted('ROLE_ADMIN') %}
                        <!-- Menu Admin -->
                        <div x-data=\"{ adminOpen: false }\" class=\"relative\">
                            <button @click=\"adminOpen = !adminOpen\" class=\"flex items-center gap-1 px-3 py-2 rounded-md hover:bg-green-700 transition-colors\">
                                <svg class=\"h-5 w-5\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z\"/>
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M15 12a3 3 0 11-6 0 3 3 0 016 0z\"/>
                                </svg>
                                <span>Admin</span>
                                <svg class=\"h-4 w-4 transition-transform\" :class=\"{ 'transform rotate-180': adminOpen }\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M19 9l-7 7-7-7\"/>
                                </svg>
                            </button>

                            <div x-show=\"adminOpen\" @click.away=\"adminOpen = false\"
                                 x-transition:enter=\"transition ease-out duration-100\"
                                 x-transition:enter-start=\"transform opacity-0 scale-95\"
                                 x-transition:enter-end=\"transform opacity-100 scale-100\"
                                 x-transition:leave=\"transition ease-in duration-75\"
                                 x-transition:leave-start=\"transform opacity-100 scale-100\"
                                 x-transition:leave-end=\"transform opacity-0 scale-95\"
                                 class=\"absolute right-0 mt-2 w-56 bg-white rounded-md shadow-lg z-50 border border-gray-200\">
                                <div class=\"py-1\">
                                    <a href=\"{{ path('app_ao_create') }}\" class=\"block px-4 py-2 text-gray-800 hover:bg-green-50 transition-colors\">
                                        Créer un AO
                                    </a>
                                    <a href=\"{{ path('app_ao_list') }}\" class=\"block px-4 py-2 text-gray-800 hover:bg-green-50 transition-colors\">
                                        Liste des AO
                                    </a>
                                </div>
                            </div>
                        </div>
                    {% endif %}
                    <a href=\"{{ path('app_logout') }}\"
                       class=\"relative inline-flex items-center px-4 py-2.5 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-green-600 to-green-500 shadow-sm hover:from-green-700 hover:to-green-600 transition-all duration-200 transform hover:-translate-y-0.5 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500\">
                        <svg class=\"-ml-1 mr-2 h-5 w-5\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                            <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1\"/>
                        </svg>
                        Déconnexion
                    </a>
                {% else %}
                    <!-- Menu déconnecté -->
                    <a href=\"{{ path('app_login') }}\"
                       class=\"relative inline-flex items-center px-4 py-2.5 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-green-600 to-green-500 shadow-sm hover:from-green-700 hover:to-green-600 transition-all duration-200 transform hover:-translate-y-0.5 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500\">
                        <svg class=\"-ml-1 mr-2 h-5 w-5\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                            <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1\"/>
                        </svg>
                        Connexion
                    </a>

                    <a href=\"{{ path('app_register') }}\"
                       class=\"relative inline-flex items-center px-4 py-2.5 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-bfred to-red-500 shadow-sm hover:from-bfredDark hover:to-red-600 transition-all duration-200 transform hover:-translate-y-0.5 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500\">
                        <svg class=\"-ml-1 mr-2 h-5 w-5\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                            <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z\"/>
                        </svg>
                        S'inscrire
                    </a>
                {% endif %}
            </div>

            <!-- Menu Mobile avec Alpine.js -->
            <div class=\"md:hidden\" x-data=\"{ open: false }\">
                <button @click=\"open = !open\" class=\"p-2 rounded-md hover:bg-green-700 focus:outline-none transition-colors\">
                    <svg class=\"h-6 w-6\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                        <path x-show=\"!open\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M4 6h16M4 12h16M4 18h16\"/>
                        <path x-show=\"open\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M6 18L18 6M6 6l12 12\"/>
                    </svg>
                </button>

                <div x-show=\"open\" @click.away=\"open = false\"
                     x-transition:enter=\"transition ease-out duration-100\"
                     x-transition:enter-start=\"transform opacity-0 scale-95\"
                     x-transition:enter-end=\"transform opacity-100 scale-100\"
                     x-transition:leave=\"transition ease-in duration-75\"
                     x-transition:leave-start=\"transform opacity-100 scale-100\"
                     x-transition:leave-end=\"transform opacity-0 scale-95\"
                     class=\"absolute right-4 mt-2 w-56 bg-white rounded-lg shadow-xl py-1 z-50 border border-gray-200 divide-y divide-gray-100\">

                    <a href=\"{{ path('app_home') }}\" class=\"group flex items-center px-4 py-3 text-gray-800 hover:bg-green-50 transition-colors\">
                        <svg class=\"mr-3 h-5 w-5 text-gray-500 group-hover:text-green-600\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                            <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6\"/>
                        </svg>
                        Accueil
                    </a>

                    <div class=\"py-1\">
                        {% if app.user %}
                            {% if is_granted('ROLE_ADMIN') %}
                                <a href=\"{{ path('app_ao_create') }}\" class=\"group flex items-center px-4 py-3 text-gray-800 hover:bg-green-50 transition-colors\">
                                    <svg class=\"mr-3 h-5 w-5 text-gray-500 group-hover:text-green-600\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                        <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M12 6v6m0 0v6m0-6h6m-6 0H6\"/>
                                    </svg>
                                    Créer un AO
                                </a>
                                <a href=\"{{ path('app_ao_list') }}\" class=\"group flex items-center px-4 py-3 text-gray-800 hover:bg-green-50 transition-colors\">
                                    <svg class=\"mr-3 h-5 w-5 text-gray-500 group-hover:text-green-600\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                        <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2\"/>
                                    </svg>
                                    Liste des AO
                                </a>
                            {% endif %}
                            <a href=\"{{ path('app_user_account') }}\" class=\"group flex items-center px-4 py-3 text-gray-800 hover:bg-green-50 transition-colors\">
                                <svg class=\"mr-3 h-5 w-5 text-gray-500 group-hover:text-green-600\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z\"/>
                                </svg>
                                Mon compte
                            </a>
                            <a href=\"{{ path('app_logout') }}\" class=\"group flex items-center px-4 py-3 text-gray-800 hover:bg-green-50 transition-colors\">
                                <svg class=\"mr-3 h-5 w-5 text-gray-500 group-hover:text-green-600\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1\"/>
                                </svg>
                                Déconnexion
                            </a>
                        {% else %}
                            <a href=\"{{ path('app_login') }}\" class=\"group flex items-center px-4 py-3 text-gray-800 hover:bg-green-50 transition-colors\">
                                <svg class=\"mr-3 h-5 w-5 text-gray-500 group-hover:text-green-600\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1\"/>
                                </svg>
                                Connexion
                            </a>
                            <a href=\"{{ path('app_register') }}\" class=\"group flex items-center px-4 py-3 text-gray-800 hover:bg-green-50 transition-colors\">
                                <svg class=\"mr-3 h-5 w-5 text-gray-500 group-hover:text-green-600\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z\"/>
                                </svg>
                                Inscription
                            </a>
                        {% endif %}
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Contenu principal -->
<main class=\"container mx-auto px-4 py-6\">
    {% block body %}{% endblock %}
</main>

<!-- Footer -->
<footer class=\"bg-gray-800 text-white py-8 mt-12\">
    <div class=\"container mx-auto px-4\">
        <div class=\"grid md:grid-cols-3 gap-8 text-center md:text-left\">
            <div>
                <h3 class=\"font-bold text-lg mb-4\">AO Burkina</h3>
                <p class=\"text-gray-400\">Plateforme officielle des marchés publics pour le Burkina Faso</p>
            </div>
            <div>
                <h4 class=\"font-semibold mb-4\">Liens utiles</h4>
                <ul class=\"space-y-2\">
                    <li><a href=\"{{ path('app_legal_mentions') }}\" class=\"text-gray-400 hover:text-white\">Mentions légales</a></li>
                    <li><a href=\"{{ path('app_legal_conditions') }}\" class=\"text-gray-400 hover:text-white\">Conditions d'utilisation</a></li>
                </ul>
            </div>
            <div>
                <h4 class=\"font-semibold mb-4\">Contact</h4>
                <p class=\"text-gray-400\">contact@aoburkina.bf</p>
                <p class=\"text-gray-400\">+226 XX XX XX XX</p>
            </div>
        </div>
        <div class=\"border-t border-gray-700 mt-8 pt-6 text-center text-gray-400\">
            <p>&copy; {{ \"now\"|date(\"Y\") }} <strong>TLabs</strong> pour plateforme <strong> AO Burkina</strong>. Tous droits réservés.</p>
        </div>
    </div>
</footer>
</body>
</html>", "base.html.twig", "/app/templates/base.html.twig");
    }
}
