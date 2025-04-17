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

/* ao/create/create.html.twig */
class __TwigTemplate_404d0c90914a60afb233e9d0cdbe5325 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "ao/create/create.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "ao/create/create.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "ao/create/create.html.twig", 1);
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
        yield "    <div class=\"max-w-3xl mx-auto my-8\">
        <div class=\"bg-white rounded-xl shadow-md overflow-hidden p-6\">
            <h1 class=\"text-2xl font-bold mb-6\">Publier un nouvel AO</h1>

            ";
        // line 8
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 8, $this->source); })()), 'form_start');
        yield "
            <div class=\"space-y-6\">
                <!-- Champs de base -->
                <div class=\"grid md:grid-cols-2 gap-6\">
                    ";
        // line 12
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 12, $this->source); })()), "reference", [], "any", false, false, false, 12), 'row', ["attr" => ["class" => "input-field"]]);
        // line 14
        yield "
                    ";
        // line 15
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 15, $this->source); })()), "budget", [], "any", false, false, false, 15), 'row', ["attr" => ["class" => "input-field"]]);
        // line 17
        yield "
                </div>

                ";
        // line 20
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 20, $this->source); })()), "titre", [], "any", false, false, false, 20), 'row', ["attr" => ["class" => "input-field"]]);
        // line 22
        yield "

                ";
        // line 24
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 24, $this->source); })()), "entreprise", [], "any", false, false, false, 24), 'row', ["attr" => ["class" => "input-field"]]);
        // line 26
        yield "

                ";
        // line 28
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 28, $this->source); })()), "description", [], "any", false, false, false, 28), 'row', ["attr" => ["class" => "input-field min-h-[200px]", "data-controller" => "markdown-editor"]]);
        // line 33
        yield "

                <!-- Upload de fichiers -->
                <div x-data=\"{ files: [] }\">
                    <label class=\"block text-sm font-medium text-gray-700 mb-2\">Pièces jointes</label>
                    <div class=\"border-2 border-dashed border-gray-300 rounded-lg p-6 text-center\">
                        <input type=\"file\" multiple
                               @change=\"files = Array.from(\$event.target.files)\"
                               class=\"hidden\" id=\"file-upload\">
                        <label for=\"file-upload\" class=\"cursor-pointer\">
                            <svg class=\"mx-auto h-12 w-12 text-gray-400\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12\"/>
                            </svg>
                            <p class=\"mt-1 text-sm text-gray-600\">Glissez-déposez ou cliquez pour uploader</p>
                        </label>
                        <template x-if=\"files.length > 0\">
                            <div class=\"mt-4 space-y-2\">
                                <template x-for=\"file in files\" :key=\"file.name\">
                                    <div class=\"flex items-center text-sm text-gray-700\">
                                        <span x-text=\"file.name\" class=\"truncate\"></span>
                                        <span x-text=\"' (' + (file.size / 1024 / 1024).toFixed(2) + ' MB)'\" class=\"text-gray-500 ml-1\"></span>
                                    </div>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Submit -->
                <button type=\"submit\" class=\"btn-primary\">
                    Publier l'annonce
                </button>
            </div>
            ";
        // line 66
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 66, $this->source); })()), 'form_end');
        yield "
        </div>
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
        return "ao/create/create.html.twig";
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
        return array (  150 => 66,  115 => 33,  113 => 28,  109 => 26,  107 => 24,  103 => 22,  101 => 20,  96 => 17,  94 => 15,  91 => 14,  89 => 12,  82 => 8,  76 => 4,  63 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block body %}
    <div class=\"max-w-3xl mx-auto my-8\">
        <div class=\"bg-white rounded-xl shadow-md overflow-hidden p-6\">
            <h1 class=\"text-2xl font-bold mb-6\">Publier un nouvel AO</h1>

            {{ form_start(form) }}
            <div class=\"space-y-6\">
                <!-- Champs de base -->
                <div class=\"grid md:grid-cols-2 gap-6\">
                    {{ form_row(form.reference, {
                        attr: { class: 'input-field' }
                    }) }}
                    {{ form_row(form.budget, {
                        attr: { class: 'input-field' }
                    }) }}
                </div>

                {{ form_row(form.titre, {
                    attr: { class: 'input-field' }
                }) }}

                {{ form_row(form.entreprise, {
                    attr: { class: 'input-field' }
                }) }}

                {{ form_row(form.description, {
                    attr: {
                        class: 'input-field min-h-[200px]',
                        'data-controller': 'markdown-editor'
                    }
                }) }}

                <!-- Upload de fichiers -->
                <div x-data=\"{ files: [] }\">
                    <label class=\"block text-sm font-medium text-gray-700 mb-2\">Pièces jointes</label>
                    <div class=\"border-2 border-dashed border-gray-300 rounded-lg p-6 text-center\">
                        <input type=\"file\" multiple
                               @change=\"files = Array.from(\$event.target.files)\"
                               class=\"hidden\" id=\"file-upload\">
                        <label for=\"file-upload\" class=\"cursor-pointer\">
                            <svg class=\"mx-auto h-12 w-12 text-gray-400\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12\"/>
                            </svg>
                            <p class=\"mt-1 text-sm text-gray-600\">Glissez-déposez ou cliquez pour uploader</p>
                        </label>
                        <template x-if=\"files.length > 0\">
                            <div class=\"mt-4 space-y-2\">
                                <template x-for=\"file in files\" :key=\"file.name\">
                                    <div class=\"flex items-center text-sm text-gray-700\">
                                        <span x-text=\"file.name\" class=\"truncate\"></span>
                                        <span x-text=\"' (' + (file.size / 1024 / 1024).toFixed(2) + ' MB)'\" class=\"text-gray-500 ml-1\"></span>
                                    </div>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Submit -->
                <button type=\"submit\" class=\"btn-primary\">
                    Publier l'annonce
                </button>
            </div>
            {{ form_end(form) }}
        </div>
    </div>
{% endblock %}", "ao/create/create.html.twig", "/app/templates/ao/create/create.html.twig");
    }
}
