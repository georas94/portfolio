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

/* ao/edit/edit.html.twig */
class __TwigTemplate_0ae3d49a93ec0735bb6ab81cffdf9641 extends Template
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
            'javascripts' => [$this, 'block_javascripts'],
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "ao/edit/edit.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "ao/edit/edit.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "ao/edit/edit.html.twig", 1);
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

        yield "Modifier AO ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["ao"]) || array_key_exists("ao", $context) ? $context["ao"] : (function () { throw new RuntimeError('Variable "ao" does not exist.', 3, $this->source); })()), "reference", [], "any", false, false, false, 3), "html", null, true);
        
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
        yield "    <div class=\"container mx-auto px-4 py-8\">
    <div class=\"max-w-3xl mx-auto\">
        <div class=\"flex justify-between items-center mb-8\">
            <h1 class=\"text-2xl font-bold text-gray-800\">Modification AO <span class=\"text-blue-600\">";
        // line 9
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["ao"]) || array_key_exists("ao", $context) ? $context["ao"] : (function () { throw new RuntimeError('Variable "ao" does not exist.', 9, $this->source); })()), "reference", [], "any", false, false, false, 9), "html", null, true);
        yield "</span></h1>
            <a href=\"";
        // line 10
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_ao_detail", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["ao"]) || array_key_exists("ao", $context) ? $context["ao"] : (function () { throw new RuntimeError('Variable "ao" does not exist.', 10, $this->source); })()), "id", [], "any", false, false, false, 10)]), "html", null, true);
        yield "\" class=\"text-sm text-blue-600 hover:text-blue-800 flex items-center\">
                <svg class=\"w-4 h-4 mr-1\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M10 19l-7-7m0 0l7-7m-7 7h18\"/>
                </svg>
                Retour à l'AO
            </a>
        </div>

        <div class=\"bg-white rounded-xl shadow-md overflow-hidden\">
            <div class=\"p-8\">
                ";
        // line 20
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 20, $this->source); })()), 'form_start');
        yield "
                <div class=\"space-y-6\">
                    <!-- Référence -->
                    <div class=\"space-y-2\">
                        ";
        // line 24
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 24, $this->source); })()), "reference", [], "any", false, false, false, 24), 'label', ["label_attr" => ["class" => "block text-sm font-medium text-gray-700"]]);
        yield "
                        <div class=\"relative rounded-md shadow-sm\">
                            <div class=\"absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none\">
                                <svg class=\"h-5 w-5 text-gray-400\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2\"/>
                                </svg>
                            </div>
                            ";
        // line 31
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 31, $this->source); })()), "reference", [], "any", false, false, false, 31), 'widget', ["attr" => ["class" => "h-8 focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md", "placeholder" => "REF-2023-001"]]);
        // line 34
        yield "
                        </div>
                        ";
        // line 36
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 36, $this->source); })()), "reference", [], "any", false, false, false, 36), 'errors');
        yield "
                    </div>

                    <!-- Titre -->
                    <div class=\"space-y-2\">
                        ";
        // line 41
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 41, $this->source); })()), "titre", [], "any", false, false, false, 41), 'label', ["label_attr" => ["class" => "block text-sm font-medium text-gray-700"]]);
        yield "
                        ";
        // line 42
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 42, $this->source); })()), "titre", [], "any", false, false, false, 42), 'widget', ["attr" => ["class" => "h-8 focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md", "placeholder" => "Titre descriptif de l'AO"]]);
        // line 45
        yield "
                        ";
        // line 46
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 46, $this->source); })()), "titre", [], "any", false, false, false, 46), 'errors');
        yield "
                    </div>

                    <!-- Description -->
                    <div class=\"space-y-2\">
                        ";
        // line 51
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 51, $this->source); })()), "description", [], "any", false, false, false, 51), 'label', ["label_attr" => ["class" => "block text-sm font-medium text-gray-700"]]);
        yield "
                        ";
        // line 52
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 52, $this->source); })()), "description", [], "any", false, false, false, 52), 'widget', ["attr" => ["class" => "focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md h-32", "placeholder" => "Détails complets de l'appel d'offres..."]]);
        // line 55
        yield "
                        ";
        // line 56
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 56, $this->source); })()), "description", [], "any", false, false, false, 56), 'errors');
        yield "
                    </div>

                    <!-- Entreprise -->
                    <div class=\"space-y-2\">
                        ";
        // line 61
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 61, $this->source); })()), "entreprise", [], "any", false, false, false, 61), 'label', ["label_attr" => ["class" => "block text-sm font-medium text-gray-700"]]);
        yield "
                        <div class=\"relative rounded-md shadow-sm\">
                            <div class=\"absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none\">
                                <svg class=\"h-5 w-5 text-gray-400\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4\"/>
                                </svg>
                            </div>
                            ";
        // line 68
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 68, $this->source); })()), "entreprise", [], "any", false, false, false, 68), 'widget', ["attr" => ["class" => "h-8 focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md", "placeholder" => "Nom de l'entreprise"]]);
        // line 71
        yield "
                        </div>
                        ";
        // line 73
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 73, $this->source); })()), "entreprise", [], "any", false, false, false, 73), 'errors');
        yield "
                    </div>

                    <!-- Date Limite -->
                    <div class=\"space-y-2\">
                        ";
        // line 78
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 78, $this->source); })()), "dateLimite", [], "any", false, false, false, 78), 'label', ["label_attr" => ["class" => "block text-sm font-medium text-gray-700"]]);
        yield "
                        <div class=\"relative rounded-md shadow-sm\">
                            <div class=\"absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none\">
                                <svg class=\"h-5 w-5 text-gray-400\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z\"/>
                                </svg>
                            </div>
                            ";
        // line 85
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 85, $this->source); })()), "dateLimite", [], "any", false, false, false, 85), 'widget', ["attr" => ["class" => "h-8 focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md"]]);
        // line 87
        yield "
                        </div>
                        ";
        // line 89
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 89, $this->source); })()), "dateLimite", [], "any", false, false, false, 89), 'errors');
        yield "
                    </div>

                    <!-- Budget -->
                    <div class=\"space-y-2\">
                        ";
        // line 94
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 94, $this->source); })()), "budget", [], "any", false, false, false, 94), 'label', ["label_attr" => ["class" => "block text-sm font-medium text-gray-700"]]);
        yield "
                        <div class=\"relative rounded-md shadow-sm\">
                            <div class=\"absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none\">
                                <svg class=\"h-5 w-5 text-gray-400\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z\"/>
                                </svg>
                            </div>
                            ";
        // line 101
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 101, $this->source); })()), "budget", [], "any", false, false, false, 101), 'widget', ["attr" => ["class" => "h-8 focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md", "placeholder" => "Montant en XOF"]]);
        // line 104
        yield "
                        </div>
                        ";
        // line 106
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 106, $this->source); })()), "budget", [], "any", false, false, false, 106), 'errors');
        yield "
                    </div>

                    <!-- Statut -->
                    <div class=\"space-y-2\">
                        ";
        // line 111
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 111, $this->source); })()), "statut", [], "any", false, false, false, 111), 'label', ["label_attr" => ["class" => "block text-sm font-medium text-gray-700"]]);
        // line 113
        yield "
                        <div class=\"relative rounded-md shadow-sm\">
                            <div class=\"absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none\">
                                <svg class=\"h-5 w-5 text-gray-400\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M8 9l4-4 4 4m0 6l-4 4-4-4\"/>
                                </svg>
                            </div>
                            ";
        // line 120
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 120, $this->source); })()), "statut", [], "any", false, false, false, 120), 'widget', ["attr" => ["class" => "mt-1 block w-full pl-3 pr-10 py-3 text-base border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md appearance-none bg-white"]]);
        // line 124
        yield "
                        </div>
                        ";
        // line 126
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 126, $this->source); })()), "statut", [], "any", false, false, false, 126), 'errors');
        yield "
                    </div>
                    <!-- Regénérer PDF -->
                    <div class=\"flex items-center\">
                        ";
        // line 130
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 130, $this->source); })()), "regenerate_pdf", [], "any", false, false, false, 130), 'widget', ["attr" => ["class" => "h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"]]);
        // line 132
        yield "
                        ";
        // line 133
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 133, $this->source); })()), "regenerate_pdf", [], "any", false, false, false, 133), 'label', ["label_attr" => ["class" => "ml-2 block text-sm text-gray-700"]]);
        // line 135
        yield "
                    </div>
                </div>

                <div class=\"mt-8 pt-5 border-t border-gray-200 flex justify-end space-x-3\">
                    <a href=\"";
        // line 140
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_ao_detail", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["ao"]) || array_key_exists("ao", $context) ? $context["ao"] : (function () { throw new RuntimeError('Variable "ao" does not exist.', 140, $this->source); })()), "id", [], "any", false, false, false, 140)]), "html", null, true);
        yield "\" class=\"bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500\">
                        Annuler
                    </a>
                    <button type=\"submit\" class=\"inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500\">
                        <svg class=\"-ml-1 mr-2 h-5 w-5\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                            <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4\"/>
                        </svg>
                        Enregistrer les modifications
                    </button>
                </div>
                ";
        // line 150
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 150, $this->source); })()), 'form_end');
        yield "
            </div>
        </div>
    </div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 155
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        // line 156
        yield "    <script>
        alert('yes')
        // Si vous voulez un select encore plus stylé
        import TomSelect from 'tom-select';

        new TomSelect('#ao_form_statut', {
            create: false,
            sortField: {
                field: \"text\",
                direction: \"asc\"
            }
        });
        // Petite animation quand un champ est invalid
        document.querySelectorAll('[name]').forEach(input => {
            input.addEventListener('invalid', () => {
                input.classList.add('animate-pulse', 'border-red-500');
                setTimeout(() => {
                    input.classList.remove('animate-pulse');
                }, 1000);
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
        return "ao/edit/edit.html.twig";
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
        return array (  341 => 156,  328 => 155,  312 => 150,  299 => 140,  292 => 135,  290 => 133,  287 => 132,  285 => 130,  278 => 126,  274 => 124,  272 => 120,  263 => 113,  261 => 111,  253 => 106,  249 => 104,  247 => 101,  237 => 94,  229 => 89,  225 => 87,  223 => 85,  213 => 78,  205 => 73,  201 => 71,  199 => 68,  189 => 61,  181 => 56,  178 => 55,  176 => 52,  172 => 51,  164 => 46,  161 => 45,  159 => 42,  155 => 41,  147 => 36,  143 => 34,  141 => 31,  131 => 24,  124 => 20,  111 => 10,  107 => 9,  102 => 6,  89 => 5,  65 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Modifier AO {{ ao.reference }}{% endblock %}

{% block body %}
    <div class=\"container mx-auto px-4 py-8\">
    <div class=\"max-w-3xl mx-auto\">
        <div class=\"flex justify-between items-center mb-8\">
            <h1 class=\"text-2xl font-bold text-gray-800\">Modification AO <span class=\"text-blue-600\">{{ ao.reference }}</span></h1>
            <a href=\"{{ path('app_ao_detail', {id: ao.id}) }}\" class=\"text-sm text-blue-600 hover:text-blue-800 flex items-center\">
                <svg class=\"w-4 h-4 mr-1\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M10 19l-7-7m0 0l7-7m-7 7h18\"/>
                </svg>
                Retour à l'AO
            </a>
        </div>

        <div class=\"bg-white rounded-xl shadow-md overflow-hidden\">
            <div class=\"p-8\">
                {{ form_start(form) }}
                <div class=\"space-y-6\">
                    <!-- Référence -->
                    <div class=\"space-y-2\">
                        {{ form_label(form.reference, null, {'label_attr': {'class': 'block text-sm font-medium text-gray-700'}}) }}
                        <div class=\"relative rounded-md shadow-sm\">
                            <div class=\"absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none\">
                                <svg class=\"h-5 w-5 text-gray-400\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2\"/>
                                </svg>
                            </div>
                            {{ form_widget(form.reference, {'attr': {
                                'class': 'h-8 focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md',
                                'placeholder': 'REF-2023-001'
                            }}) }}
                        </div>
                        {{ form_errors(form.reference) }}
                    </div>

                    <!-- Titre -->
                    <div class=\"space-y-2\">
                        {{ form_label(form.titre, null, {'label_attr': {'class': 'block text-sm font-medium text-gray-700'}}) }}
                        {{ form_widget(form.titre, {'attr': {
                            'class': 'h-8 focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md',
                            'placeholder': 'Titre descriptif de l\\'AO'
                        }}) }}
                        {{ form_errors(form.titre) }}
                    </div>

                    <!-- Description -->
                    <div class=\"space-y-2\">
                        {{ form_label(form.description, null, {'label_attr': {'class': 'block text-sm font-medium text-gray-700'}}) }}
                        {{ form_widget(form.description, {'attr': {
                            'class': 'focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md h-32',
                            'placeholder': 'Détails complets de l\\'appel d\\'offres...'
                        }}) }}
                        {{ form_errors(form.description) }}
                    </div>

                    <!-- Entreprise -->
                    <div class=\"space-y-2\">
                        {{ form_label(form.entreprise, null, {'label_attr': {'class': 'block text-sm font-medium text-gray-700'}}) }}
                        <div class=\"relative rounded-md shadow-sm\">
                            <div class=\"absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none\">
                                <svg class=\"h-5 w-5 text-gray-400\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4\"/>
                                </svg>
                            </div>
                            {{ form_widget(form.entreprise, {'attr': {
                                'class': 'h-8 focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md',
                                'placeholder': 'Nom de l\\'entreprise'
                            }}) }}
                        </div>
                        {{ form_errors(form.entreprise) }}
                    </div>

                    <!-- Date Limite -->
                    <div class=\"space-y-2\">
                        {{ form_label(form.dateLimite, null, {'label_attr': {'class': 'block text-sm font-medium text-gray-700'}}) }}
                        <div class=\"relative rounded-md shadow-sm\">
                            <div class=\"absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none\">
                                <svg class=\"h-5 w-5 text-gray-400\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z\"/>
                                </svg>
                            </div>
                            {{ form_widget(form.dateLimite, {'attr': {
                                'class': 'h-8 focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md',
                            }}) }}
                        </div>
                        {{ form_errors(form.dateLimite) }}
                    </div>

                    <!-- Budget -->
                    <div class=\"space-y-2\">
                        {{ form_label(form.budget, null, {'label_attr': {'class': 'block text-sm font-medium text-gray-700'}}) }}
                        <div class=\"relative rounded-md shadow-sm\">
                            <div class=\"absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none\">
                                <svg class=\"h-5 w-5 text-gray-400\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z\"/>
                                </svg>
                            </div>
                            {{ form_widget(form.budget, {'attr': {
                                'class': 'h-8 focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md',
                                'placeholder': 'Montant en XOF'
                            }}) }}
                        </div>
                        {{ form_errors(form.budget) }}
                    </div>

                    <!-- Statut -->
                    <div class=\"space-y-2\">
                        {{ form_label(form.statut, null, {
                            'label_attr': {'class': 'block text-sm font-medium text-gray-700'}
                        }) }}
                        <div class=\"relative rounded-md shadow-sm\">
                            <div class=\"absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none\">
                                <svg class=\"h-5 w-5 text-gray-400\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M8 9l4-4 4 4m0 6l-4 4-4-4\"/>
                                </svg>
                            </div>
                            {{ form_widget(form.statut, {
                                'attr': {
                                    'class': 'mt-1 block w-full pl-3 pr-10 py-3 text-base border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md appearance-none bg-white'
                                }
                            }) }}
                        </div>
                        {{ form_errors(form.statut) }}
                    </div>
                    <!-- Regénérer PDF -->
                    <div class=\"flex items-center\">
                        {{ form_widget(form.regenerate_pdf, {'attr': {
                            'class': 'h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded'
                        }}) }}
                        {{ form_label(form.regenerate_pdf, null, {'label_attr': {
                            'class': 'ml-2 block text-sm text-gray-700'
                        }}) }}
                    </div>
                </div>

                <div class=\"mt-8 pt-5 border-t border-gray-200 flex justify-end space-x-3\">
                    <a href=\"{{ path('app_ao_detail', {id: ao.id}) }}\" class=\"bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500\">
                        Annuler
                    </a>
                    <button type=\"submit\" class=\"inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500\">
                        <svg class=\"-ml-1 mr-2 h-5 w-5\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                            <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4\"/>
                        </svg>
                        Enregistrer les modifications
                    </button>
                </div>
                {{ form_end(form) }}
            </div>
        </div>
    </div>
{% endblock %}
{% block javascripts %}
    <script>
        alert('yes')
        // Si vous voulez un select encore plus stylé
        import TomSelect from 'tom-select';

        new TomSelect('#ao_form_statut', {
            create: false,
            sortField: {
                field: \"text\",
                direction: \"asc\"
            }
        });
        // Petite animation quand un champ est invalid
        document.querySelectorAll('[name]').forEach(input => {
            input.addEventListener('invalid', () => {
                input.classList.add('animate-pulse', 'border-red-500');
                setTimeout(() => {
                    input.classList.remove('animate-pulse');
                }, 1000);
            });
        });
    </script>
{% endblock %}", "ao/edit/edit.html.twig", "/app/templates/ao/edit/edit.html.twig");
    }
}
