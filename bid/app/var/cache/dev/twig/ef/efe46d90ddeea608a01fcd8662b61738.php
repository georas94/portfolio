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

/* registration/register.html.twig */
class __TwigTemplate_71f2045ca12ea1f39cdd00b5f1b5a156 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "registration/register.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "registration/register.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "registration/register.html.twig", 1);
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

        yield "Inscription - AO Burkina";
        
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
        yield "    <section class=\"py-16 bg-gray-50 transform transition-all duration-300\">
        <div class=\"container mx-auto px-4\">
            <!-- Flash messages -->
            ";
        // line 9
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 9, $this->source); })()), "flashes", ["error"], "method", false, false, false, 9));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 10
            yield "                <div class=\"max-w-md mx-auto mb-8\">
                    <div class=\"bg-red-100 border-l-4 border-red-500 text-red-700 p-4\" role=\"alert\">
                        <p>";
            // line 12
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
            yield "</p>
                    </div>
                </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 16
        yield "
            <div class=\"max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden p-8\">
                <h1 class=\"text-2xl font-bold text-center text-gray-800 mb-8\">Créer un compte</h1>

                ";
        // line 20
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 20, $this->source); })()), 'form_start', ["attr" => ["class" => "space-y-6"]]);
        yield "

                <!-- Prénom -->
                <div class=\"space-y-2 relative\">
                    ";
        // line 24
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 24, $this->source); })()), "firstname", [], "any", false, false, false, 24), 'label', ["label_attr" => ["class" => "block text-sm font-medium text-gray-700"]]);
        yield "
                    <div class=\"relative\">
                        <div class=\"absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none\">
                            <svg class=\"h-5 w-5 text-gray-400\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\"
                                      d=\"M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z\"/>
                            </svg>
                        </div>
                        ";
        // line 32
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 32, $this->source); })()), "firstname", [], "any", false, false, false, 32), 'widget', ["attr" => ["class" => "mt-1 block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500", "autocomplete" => "given-name"]]);
        // line 35
        yield "
                    </div>
                    ";
        // line 37
        if ( !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 37, $this->source); })()), "firstname", [], "any", false, false, false, 37), "vars", [], "any", false, false, false, 37), "errors", [], "any", false, false, false, 37))) {
            // line 38
            yield "                        <div class=\"text-red-600\">
                            ";
            // line 39
            yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 39, $this->source); })()), "firstname", [], "any", false, false, false, 39), 'errors');
            yield "
                        </div>
                    ";
        }
        // line 42
        yield "                </div>

                <!-- Nom -->
                <div class=\"space-y-2 relative\">
                    ";
        // line 46
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 46, $this->source); })()), "lastname", [], "any", false, false, false, 46), 'label', ["label_attr" => ["class" => "block text-sm font-medium text-gray-700"]]);
        yield "
                    <div class=\"relative\">
                        <div class=\"absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none\">
                            <svg class=\"h-5 w-5 text-gray-400\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\"
                                      d=\"M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z\"/>
                            </svg>
                        </div>
                        ";
        // line 54
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 54, $this->source); })()), "lastname", [], "any", false, false, false, 54), 'widget', ["attr" => ["class" => "mt-1 block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500", "autocomplete" => "family-name"]]);
        // line 57
        yield "
                    </div>
                    ";
        // line 59
        if ( !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 59, $this->source); })()), "lastname", [], "any", false, false, false, 59), "vars", [], "any", false, false, false, 59), "errors", [], "any", false, false, false, 59))) {
            // line 60
            yield "                        <div class=\"text-red-600\">
                            ";
            // line 61
            yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 61, $this->source); })()), "lastname", [], "any", false, false, false, 61), 'errors');
            yield "
                        </div>
                    ";
        }
        // line 64
        yield "                </div>

                <!-- Email -->
                <div class=\"space-y-2 relative\">
                    ";
        // line 68
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 68, $this->source); })()), "email", [], "any", false, false, false, 68), 'label', ["label_attr" => ["class" => "block text-sm font-medium text-gray-700"]]);
        yield "
                    <div class=\"relative\">
                        <div class=\"absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none\">
                            <svg class=\"h-5 w-5 text-gray-400\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\"
                                      d=\"M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z\"/>
                            </svg>
                        </div>
                        ";
        // line 76
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 76, $this->source); })()), "email", [], "any", false, false, false, 76), 'widget', ["attr" => ["class" => "mt-1 block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500", "autocomplete" => "email"]]);
        // line 79
        yield "
                    </div>
                    ";
        // line 81
        if ( !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 81, $this->source); })()), "email", [], "any", false, false, false, 81), "vars", [], "any", false, false, false, 81), "errors", [], "any", false, false, false, 81))) {
            // line 82
            yield "                        <div class=\"text-red-600\">
                            ";
            // line 83
            yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 83, $this->source); })()), "email", [], "any", false, false, false, 83), 'errors');
            yield "
                        </div>
                    ";
        }
        // line 86
        yield "                </div>

                <!-- Téléphone -->
                <div class=\"space-y-2 relative\">
                    ";
        // line 90
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 90, $this->source); })()), "phoneNumber", [], "any", false, false, false, 90), 'label', ["label_attr" => ["class" => "block text-sm font-medium text-gray-700"], "label" => "Téléphone (Burkinabè)"]);
        // line 92
        yield "
                    <div class=\"relative\">
                        <div class=\"absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none\">
                            <svg class=\"h-5 w-5 text-gray-400\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 20 20\" fill=\"currentColor\">
                                <path d=\"M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z\"/>
                            </svg>
                        </div>
                        ";
        // line 99
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 99, $this->source); })()), "phoneNumber", [], "any", false, false, false, 99), 'widget', ["attr" => ["class" => "mt-1 block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500", "placeholder" => "70 12 34 56", "inputmode" => "tel", "data-phone-format" => "bf"]]);
        // line 106
        yield "
                    </div>
                    <p class=\"mt-1 text-sm text-gray-500\">Format: 70 12 34 56 ou +22670 12 34 56</p>
                    ";
        // line 109
        if ( !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 109, $this->source); })()), "phoneNumber", [], "any", false, false, false, 109), "vars", [], "any", false, false, false, 109), "errors", [], "any", false, false, false, 109))) {
            // line 110
            yield "                        <div class=\"text-red-600\">
                            ";
            // line 111
            yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 111, $this->source); })()), "phoneNumber", [], "any", false, false, false, 111), 'errors');
            yield "
                        </div>
                    ";
        }
        // line 114
        yield "                </div>

                <!-- Mot de passe -->
                <div class=\"space-y-2 relative\">
                    ";
        // line 118
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 118, $this->source); })()), "plainPassword", [], "any", false, false, false, 118), 'label', ["label_attr" => ["class" => "block text-sm font-medium text-gray-700"]]);
        yield "
                    <div class=\"relative\">
                        <div class=\"absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none\">
                            <svg class=\"h-5 w-5 text-gray-400\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\"
                                      d=\"M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z\"/>
                            </svg>
                        </div>
                        ";
        // line 126
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 126, $this->source); })()), "plainPassword", [], "any", false, false, false, 126), 'widget', ["attr" => ["class" => "mt-1 block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500", "autocomplete" => "new-password"]]);
        // line 129
        yield "
                        <button type=\"button\" class=\"absolute inset-y-0 right-0 pr-3 flex items-center toggle-password\">
                            <svg class=\"h-5 w-5 text-gray-400\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\"
                                      d=\"M15 12a3 3 0 11-6 0 3 3 0 016 0z\"/>
                                <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\"
                                      d=\"M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z\"/>
                            </svg>
                        </button>
                    </div>
                    ";
        // line 139
        if ( !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 139, $this->source); })()), "plainPassword", [], "any", false, false, false, 139), "vars", [], "any", false, false, false, 139), "errors", [], "any", false, false, false, 139))) {
            // line 140
            yield "                        <div class=\"text-red-600\">
                            ";
            // line 141
            yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 141, $this->source); })()), "plainPassword", [], "any", false, false, false, 141), 'errors');
            yield "
                        </div>
                    ";
        }
        // line 144
        yield "                </div>

                <!-- Bouton de soumission -->
                <div class=\"pt-4\">
                    <button type=\"submit\"
                            class=\"w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200\">
                        S'inscrire
                    </button>
                </div>
                ";
        // line 153
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 153, $this->source); })()), 'form_end');
        yield "
            </div>
        </div>
    </section>
    <!-- Script pour basculer la visibilité du mot de passe -->
    <script>
        document.querySelector('.toggle-password').addEventListener('click', function () {
            const input = this.parentElement.querySelector('input');
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            this.querySelector('svg').classList.toggle('text-blue-500');
        });

        document.querySelector('input[name=\"registration_form[phoneNumber]\"]').addEventListener('input', function(e) {
            // Sauvegarde la position du curseur
            const cursorPosition = e.target.selectionStart;
            const originalLength = e.target.value.length;

            // Nettoyage
            let value = e.target.value.replace(/\\D/g, '');

            // Formatage automatique
            if (value.length > 0) {
                // Conversion +226/00226 en format local
                if (value.startsWith('226')) {
                    value = '0' + value.substring(3);
                }

                // Formatage avec espaces
                let formatted = '';
                for (let i = 0; i < value.length; i++) {
                    if (i === 2 || i === 4 || i === 6) {
                        formatted += ' ';
                    }
                    formatted += value[i];
                }

                e.target.value = formatted.substring(0, 11); // 0X XX XX XX
            }

            // Réajuste la position du curseur
            const diff = e.target.value.length - originalLength;
            e.target.setSelectionRange(cursorPosition + diff, cursorPosition + diff);
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
        return "registration/register.html.twig";
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
        return array (  320 => 153,  309 => 144,  303 => 141,  300 => 140,  298 => 139,  286 => 129,  284 => 126,  273 => 118,  267 => 114,  261 => 111,  258 => 110,  256 => 109,  251 => 106,  249 => 99,  240 => 92,  238 => 90,  232 => 86,  226 => 83,  223 => 82,  221 => 81,  217 => 79,  215 => 76,  204 => 68,  198 => 64,  192 => 61,  189 => 60,  187 => 59,  183 => 57,  181 => 54,  170 => 46,  164 => 42,  158 => 39,  155 => 38,  153 => 37,  149 => 35,  147 => 32,  136 => 24,  129 => 20,  123 => 16,  113 => 12,  109 => 10,  105 => 9,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Inscription - AO Burkina{% endblock %}

{% block body %}
    <section class=\"py-16 bg-gray-50 transform transition-all duration-300\">
        <div class=\"container mx-auto px-4\">
            <!-- Flash messages -->
            {% for message in app.flashes('error') %}
                <div class=\"max-w-md mx-auto mb-8\">
                    <div class=\"bg-red-100 border-l-4 border-red-500 text-red-700 p-4\" role=\"alert\">
                        <p>{{ message }}</p>
                    </div>
                </div>
            {% endfor %}

            <div class=\"max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden p-8\">
                <h1 class=\"text-2xl font-bold text-center text-gray-800 mb-8\">Créer un compte</h1>

                {{ form_start(registrationForm, {'attr': {'class': 'space-y-6'}}) }}

                <!-- Prénom -->
                <div class=\"space-y-2 relative\">
                    {{ form_label(registrationForm.firstname, null, {'label_attr': {'class': 'block text-sm font-medium text-gray-700'}}) }}
                    <div class=\"relative\">
                        <div class=\"absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none\">
                            <svg class=\"h-5 w-5 text-gray-400\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\"
                                      d=\"M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z\"/>
                            </svg>
                        </div>
                        {{ form_widget(registrationForm.firstname, {'attr': {
                            'class': 'mt-1 block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500',
                            'autocomplete': 'given-name'
                        }}) }}
                    </div>
                    {% if registrationForm.firstname.vars.errors is not empty %}
                        <div class=\"text-red-600\">
                            {{ form_errors(registrationForm.firstname) }}
                        </div>
                    {% endif %}
                </div>

                <!-- Nom -->
                <div class=\"space-y-2 relative\">
                    {{ form_label(registrationForm.lastname, null, {'label_attr': {'class': 'block text-sm font-medium text-gray-700'}}) }}
                    <div class=\"relative\">
                        <div class=\"absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none\">
                            <svg class=\"h-5 w-5 text-gray-400\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\"
                                      d=\"M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z\"/>
                            </svg>
                        </div>
                        {{ form_widget(registrationForm.lastname, {'attr': {
                            'class': 'mt-1 block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500',
                            'autocomplete': 'family-name'
                        }}) }}
                    </div>
                    {% if registrationForm.lastname.vars.errors is not empty %}
                        <div class=\"text-red-600\">
                            {{ form_errors(registrationForm.lastname) }}
                        </div>
                    {% endif %}
                </div>

                <!-- Email -->
                <div class=\"space-y-2 relative\">
                    {{ form_label(registrationForm.email, null, {'label_attr': {'class': 'block text-sm font-medium text-gray-700'}}) }}
                    <div class=\"relative\">
                        <div class=\"absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none\">
                            <svg class=\"h-5 w-5 text-gray-400\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\"
                                      d=\"M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z\"/>
                            </svg>
                        </div>
                        {{ form_widget(registrationForm.email, {'attr': {
                            'class': 'mt-1 block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500',
                            'autocomplete': 'email'
                        }}) }}
                    </div>
                    {% if registrationForm.email.vars.errors is not empty %}
                        <div class=\"text-red-600\">
                            {{ form_errors(registrationForm.email) }}
                        </div>
                    {% endif %}
                </div>

                <!-- Téléphone -->
                <div class=\"space-y-2 relative\">
                    {{ form_label(registrationForm.phoneNumber, 'Téléphone (Burkinabè)', {
                        'label_attr': {'class': 'block text-sm font-medium text-gray-700'}
                    }) }}
                    <div class=\"relative\">
                        <div class=\"absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none\">
                            <svg class=\"h-5 w-5 text-gray-400\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 20 20\" fill=\"currentColor\">
                                <path d=\"M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z\"/>
                            </svg>
                        </div>
                        {{ form_widget(registrationForm.phoneNumber, {
                            'attr': {
                                'class': 'mt-1 block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500',
                                'placeholder': '70 12 34 56',
                                'inputmode': 'tel',
                                'data-phone-format': 'bf'
                            }
                        }) }}
                    </div>
                    <p class=\"mt-1 text-sm text-gray-500\">Format: 70 12 34 56 ou +22670 12 34 56</p>
                    {% if registrationForm.phoneNumber.vars.errors is not empty %}
                        <div class=\"text-red-600\">
                            {{ form_errors(registrationForm.phoneNumber) }}
                        </div>
                    {% endif %}
                </div>

                <!-- Mot de passe -->
                <div class=\"space-y-2 relative\">
                    {{ form_label(registrationForm.plainPassword, null, {'label_attr': {'class': 'block text-sm font-medium text-gray-700'}}) }}
                    <div class=\"relative\">
                        <div class=\"absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none\">
                            <svg class=\"h-5 w-5 text-gray-400\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\"
                                      d=\"M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z\"/>
                            </svg>
                        </div>
                        {{ form_widget(registrationForm.plainPassword, {'attr': {
                            'class': 'mt-1 block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500',
                            'autocomplete': 'new-password'
                        }}) }}
                        <button type=\"button\" class=\"absolute inset-y-0 right-0 pr-3 flex items-center toggle-password\">
                            <svg class=\"h-5 w-5 text-gray-400\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\"
                                      d=\"M15 12a3 3 0 11-6 0 3 3 0 016 0z\"/>
                                <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\"
                                      d=\"M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z\"/>
                            </svg>
                        </button>
                    </div>
                    {% if registrationForm.plainPassword.vars.errors is not empty %}
                        <div class=\"text-red-600\">
                            {{ form_errors(registrationForm.plainPassword) }}
                        </div>
                    {% endif %}
                </div>

                <!-- Bouton de soumission -->
                <div class=\"pt-4\">
                    <button type=\"submit\"
                            class=\"w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200\">
                        S'inscrire
                    </button>
                </div>
                {{ form_end(registrationForm) }}
            </div>
        </div>
    </section>
    <!-- Script pour basculer la visibilité du mot de passe -->
    <script>
        document.querySelector('.toggle-password').addEventListener('click', function () {
            const input = this.parentElement.querySelector('input');
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            this.querySelector('svg').classList.toggle('text-blue-500');
        });

        document.querySelector('input[name=\"registration_form[phoneNumber]\"]').addEventListener('input', function(e) {
            // Sauvegarde la position du curseur
            const cursorPosition = e.target.selectionStart;
            const originalLength = e.target.value.length;

            // Nettoyage
            let value = e.target.value.replace(/\\D/g, '');

            // Formatage automatique
            if (value.length > 0) {
                // Conversion +226/00226 en format local
                if (value.startsWith('226')) {
                    value = '0' + value.substring(3);
                }

                // Formatage avec espaces
                let formatted = '';
                for (let i = 0; i < value.length; i++) {
                    if (i === 2 || i === 4 || i === 6) {
                        formatted += ' ';
                    }
                    formatted += value[i];
                }

                e.target.value = formatted.substring(0, 11); // 0X XX XX XX
            }

            // Réajuste la position du curseur
            const diff = e.target.value.length - originalLength;
            e.target.setSelectionRange(cursorPosition + diff, cursorPosition + diff);
        });
    </script>
{% endblock %}", "registration/register.html.twig", "/app/templates/registration/register.html.twig");
    }
}
