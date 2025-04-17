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

/* ao/detail/detail.html.twig */
class __TwigTemplate_d08f2ed4fd43a433285ceaab91726bac extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "ao/detail/detail.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "ao/detail/detail.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "ao/detail/detail.html.twig", 1);
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
        yield "    ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 4, $this->source); })()), "flashes", ["create_ao_success"], "method", false, false, false, 4));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 5
            yield "        <div class=\"inset-0 flex items-center justify-center text-center\">
            <div class=\"bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-5 w-1/2\">
                ";
            // line 7
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
            yield "
            </div>
        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 11
        yield "    ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 11, $this->source); })()), "flashes", ["edit_ao_success"], "method", false, false, false, 11));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 12
            yield "        <div class=\"inset-0 flex items-center justify-center text-center\">
            <div class=\"bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-5 w-1/2\">
                ";
            // line 14
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
            yield "
            </div>
        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 18
        yield "    <div class=\"max-w-4xl mx-auto bg-white rounded-xl shadow-md overflow-hidden my-8\">
        <!-- Header -->
        <div class=\"bg-primary p-6 text-white\">
            <div class=\"flex justify-between items-start\">
                <div>
                    <span class=\"inline-block px-3 py-1 bg-white/20 rounded-full text-sm\">";
        // line 23
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["ao"]) || array_key_exists("ao", $context) ? $context["ao"] : (function () { throw new RuntimeError('Variable "ao" does not exist.', 23, $this->source); })()), "reference", [], "any", false, false, false, 23), "html", null, true);
        yield "</span>
                    <span class=\"px-2 py-1 text-xs font-semibold rounded-full
                        ";
        // line 25
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["ao"]) || array_key_exists("ao", $context) ? $context["ao"] : (function () { throw new RuntimeError('Variable "ao" does not exist.', 25, $this->source); })()), "statut", [], "any", false, false, false, 25) == "BROUILLON")) {
            yield "bg-yellow-100 text-yellow-800
                        ";
        } elseif ((CoreExtension::getAttribute($this->env, $this->source,         // line 26
(isset($context["ao"]) || array_key_exists("ao", $context) ? $context["ao"] : (function () { throw new RuntimeError('Variable "ao" does not exist.', 26, $this->source); })()), "statut", [], "any", false, false, false, 26) == "PUBLIE")) {
            yield "bg-blue-100 text-blue-800
                        ";
        } elseif ((CoreExtension::getAttribute($this->env, $this->source,         // line 27
(isset($context["ao"]) || array_key_exists("ao", $context) ? $context["ao"] : (function () { throw new RuntimeError('Variable "ao" does not exist.', 27, $this->source); })()), "statut", [], "any", false, false, false, 27) == "CLOTURE")) {
            yield "bg-gray-100 text-gray-800
                        ";
        } elseif ((CoreExtension::getAttribute($this->env, $this->source,         // line 28
(isset($context["ao"]) || array_key_exists("ao", $context) ? $context["ao"] : (function () { throw new RuntimeError('Variable "ao" does not exist.', 28, $this->source); })()), "statut", [], "any", false, false, false, 28) == "ATTRIBUE")) {
            yield "bg-green-100 text-green-800";
        }
        yield "\">
                        ";
        // line 29
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["ao"]) || array_key_exists("ao", $context) ? $context["ao"] : (function () { throw new RuntimeError('Variable "ao" does not exist.', 29, $this->source); })()), "statut", [], "any", false, false, false, 29), "html", null, true);
        yield "
                    </span>
                    <h1 class=\"mt-2 text-2xl font-bold\">";
        // line 31
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["ao"]) || array_key_exists("ao", $context) ? $context["ao"] : (function () { throw new RuntimeError('Variable "ao" does not exist.', 31, $this->source); })()), "titre", [], "any", false, false, false, 31), "html", null, true);
        yield "</h1>
                </div>
                ";
        // line 33
        if ($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN")) {
            // line 34
            yield "                    <form action=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_ao_close", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["ao"]) || array_key_exists("ao", $context) ? $context["ao"] : (function () { throw new RuntimeError('Variable "ao" does not exist.', 34, $this->source); })()), "id", [], "any", false, false, false, 34)]), "html", null, true);
            yield "\" method=\"POST\">
                        <button type=\"submit\"
                                class=\"px-4 py-2 bg-red-500 hover:bg-red-600 rounded-lg text-white text-sm font-medium transition-colors\">
                            Clôturer
                        </button>
                    </form>
                ";
        }
        // line 41
        yield "            </div>
        </div>

        <!-- Content -->
        <div class=\"p-6 grid md:grid-cols-3 gap-8\">
            <!-- Main -->
            <div class=\"md:col-span-2\">
                <div class=\"prose max-w-none\">
                    ";
        // line 49
        yield $this->env->getRuntime('Twig\Extra\Markdown\MarkdownRuntime')->convert(CoreExtension::getAttribute($this->env, $this->source, (isset($context["ao"]) || array_key_exists("ao", $context) ? $context["ao"] : (function () { throw new RuntimeError('Variable "ao" does not exist.', 49, $this->source); })()), "description", [], "any", false, false, false, 49));
        yield "
                </div>

                <!-- Fichiers -->
                <div class=\"mt-8\">
                    <h3 class=\"text-lg font-medium mb-4\">Documents joints</h3>
                    <div class=\"space-y-2\">
                        ";
        // line 56
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["ao"]) || array_key_exists("ao", $context) ? $context["ao"] : (function () { throw new RuntimeError('Variable "ao" does not exist.', 56, $this->source); })()), "files", [], "any", false, false, false, 56));
        foreach ($context['_seq'] as $context["_key"] => $context["file"]) {
            // line 57
            yield "                            <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/ao/" . CoreExtension::getAttribute($this->env, $this->source, $context["file"], "filename", [], "any", false, false, false, 57))), "html", null, true);
            yield "\"
                               class=\"flex items-center p-3 border rounded-lg hover:bg-gray-50 transition-colors\">
                                <svg class=\"h-5 w-5 text-gray-400 mr-3\" fill=\"none\" stroke=\"currentColor\"
                                     viewBox=\"0 0 24 24\">
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\"
                                          d=\"M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z\"/>
                                </svg>
                                <span>";
            // line 64
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["file"], "originalFilename", [], "any", false, false, false, 64), "html", null, true);
            yield "</span>
                            </a>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['file'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 67
        yield "                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class=\"space-y-6\">
                <!-- Stats -->
                <div class=\"bg-gray-50 p-4 rounded-lg\">
                    <div class=\"grid grid-cols-2 gap-4 text-center\">
                        <div>
                            <p class=\"text-sm text-gray-500\">Budget</p>
                            <p class=\"font-bold\">";
        // line 78
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extra\Intl\IntlExtension']->formatCurrency(CoreExtension::getAttribute($this->env, $this->source, (isset($context["ao"]) || array_key_exists("ao", $context) ? $context["ao"] : (function () { throw new RuntimeError('Variable "ao" does not exist.', 78, $this->source); })()), "budget", [], "any", false, false, false, 78), "XOF"), "html", null, true);
        yield "</p>
                        </div>
                        <div>
                            <p class=\"text-sm text-gray-500\">Clôture</p>
                            <p class=\"font-bold\">";
        // line 82
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["ao"]) || array_key_exists("ao", $context) ? $context["ao"] : (function () { throw new RuntimeError('Variable "ao" does not exist.', 82, $this->source); })()), "dateLimite", [], "any", false, false, false, 82), "d/m/Y"), "html", null, true);
        yield "</p>
                        </div>
                    </div>
                </div>
                <!-- Boutons CTA -->
                <div class=\"space-y-4\">
                    ";
        // line 88
        if ($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN")) {
            // line 89
            yield "                        <div class=\"mt-4 text-center\">
                            <a href=\"";
            // line 90
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_ao_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["ao"]) || array_key_exists("ao", $context) ? $context["ao"] : (function () { throw new RuntimeError('Variable "ao" does not exist.', 90, $this->source); })()), "id", [], "any", false, false, false, 90)]), "html", null, true);
            yield "\"
                               class=\"bg-yellow-400 text-white px-4 py-2 rounded hover:bg-yellow-500\">
                                Modifier cet AO
                            </a>
                        </div>
                    ";
        }
        // line 96
        yield "                    ";
        if ((isset($context["canSubmit"]) || array_key_exists("canSubmit", $context) ? $context["canSubmit"] : (function () { throw new RuntimeError('Variable "canSubmit" does not exist.', 96, $this->source); })())) {
            // line 97
            yield "                        <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_ao_submit", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["ao"]) || array_key_exists("ao", $context) ? $context["ao"] : (function () { throw new RuntimeError('Variable "ao" does not exist.', 97, $this->source); })()), "id", [], "any", false, false, false, 97)]), "html", null, true);
            yield "\"
                           class=\"block w-full text-center px-4 py-3 bg-gradient-to-r from-primary to-secondary text-white rounded-lg font-medium hover:shadow-md transition-all\">
                            Soumettre une offre
                        </a>
                    ";
        }
        // line 102
        yield "                    ";
        if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["ao"]) || array_key_exists("ao", $context) ? $context["ao"] : (function () { throw new RuntimeError('Variable "ao" does not exist.', 102, $this->source); })()), "getFiles", [], "method", false, false, false, 102)) {
            // line 103
            yield "                        <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_ao_download_pdf", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["ao"]) || array_key_exists("ao", $context) ? $context["ao"] : (function () { throw new RuntimeError('Variable "ao" does not exist.', 103, $this->source); })()), "id", [], "any", false, false, false, 103)]), "html", null, true);
            yield "\"
                           class=\"block w-full text-center px-4 py-3 rounded-lg font-medium transition-colors flex items-center justify-center\">
                            <svg class=\"w-5 h-5 mr-2\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\"
                                      d=\"M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4\"/>
                            </svg>
                            Télécharger le dossier complet
                        </a>
                    ";
        }
        // line 112
        yield "                </div>
            </div>
        </div>
    </div>
    ";
        // line 116
        if (($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN") && (Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["ao"]) || array_key_exists("ao", $context) ? $context["ao"] : (function () { throw new RuntimeError('Variable "ao" does not exist.', 116, $this->source); })()), "logs", [], "any", false, false, false, 116)) > 0))) {
            // line 117
            yield "        <div class=\"mt-8 overflow-x-auto\">
            <h3 class=\"text-lg font-medium mb-4\">Historique des modifications</h3>

            <div class=\"shadow rounded-lg overflow-hidden\">
                <!-- Version desktop (lg+) -->
                <table class=\"hidden lg:table min-w-full divide-y divide-gray-200\">
                    <thead class=\"bg-gray-50\">
                    <tr>
                        <th class=\"px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase\">Date</th>
                        <th class=\"px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase\">Utilisateur</th>
                        <th class=\"px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase\">Action</th>
                        <th class=\"px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase\">Changements</th>
                    </tr>
                    </thead>
                    <tbody class=\"bg-white divide-y divide-gray-200\">
                    ";
            // line 132
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(Twig\Extension\CoreExtension::sort($this->env, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ao"]) || array_key_exists("ao", $context) ? $context["ao"] : (function () { throw new RuntimeError('Variable "ao" does not exist.', 132, $this->source); })()), "logs", [], "any", false, false, false, 132), function ($__a__, $__b__) use ($context, $macros) { $context["a"] = $__a__; $context["b"] = $__b__; return (CoreExtension::getAttribute($this->env, $this->source, (isset($context["b"]) || array_key_exists("b", $context) ? $context["b"] : (function () { throw new RuntimeError('Variable "b" does not exist.', 132, $this->source); })()), "changedAt", [], "any", false, false, false, 132) <=> CoreExtension::getAttribute($this->env, $this->source, (isset($context["a"]) || array_key_exists("a", $context) ? $context["a"] : (function () { throw new RuntimeError('Variable "a" does not exist.', 132, $this->source); })()), "changedAt", [], "any", false, false, false, 132)); }));
            foreach ($context['_seq'] as $context["_key"] => $context["log"]) {
                // line 133
                yield "                        <tr>
                            <td class=\"px-6 py-4 whitespace-nowrap text-sm text-gray-500\">
                                ";
                // line 135
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["log"], "changedAt", [], "any", false, false, false, 135), "d/m/Y H:i"), "html", null, true);
                yield "
                            </td>
                            <td class=\"px-6 py-4 whitespace-nowrap text-sm text-gray-500\">
                                ";
                // line 138
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["log"], "user", [], "any", false, false, false, 138), "email", [], "any", false, false, false, 138), "html", null, true);
                yield "
                            </td>
                            <td class=\"px-6 py-4 whitespace-nowrap text-sm text-gray-500\">
                                ";
                // line 141
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["log"], "action", [], "any", false, false, false, 141), "html", null, true);
                yield "
                            </td>
                            <td class=\"px-6 py-4 text-sm text-gray-500\">
                                ";
                // line 144
                if (CoreExtension::getAttribute($this->env, $this->source, $context["log"], "changes", [], "any", false, false, false, 144)) {
                    // line 145
                    yield "                                    <ul class=\"list-disc pl-5\">
                                        ";
                    // line 146
                    $context['_parent'] = $context;
                    $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["log"], "changes", [], "any", false, false, false, 146));
                    foreach ($context['_seq'] as $context["field"] => $context["change"]) {
                        // line 147
                        yield "                                            <li class=\"break-words\">
                                                <strong>";
                        // line 148
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["field"], "html", null, true);
                        yield ":</strong>
                                                De \"";
                        // line 149
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, $context["change"], "old", [], "any", true, true, false, 149)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["change"], "old", [], "any", false, false, false, 149), "vide")) : ("vide")), "html", null, true);
                        yield "\"
                                                à \"";
                        // line 150
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, $context["change"], "new", [], "any", true, true, false, 150)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["change"], "new", [], "any", false, false, false, 150), "vide")) : ("vide")), "html", null, true);
                        yield "\"
                                            </li>
                                        ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['field'], $context['change'], $context['_parent']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 153
                    yield "                                    </ul>
                                ";
                } else {
                    // line 155
                    yield "                                    -
                                ";
                }
                // line 157
                yield "                            </td>
                        </tr>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['log'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 160
            yield "                    </tbody>
                </table>

                <!-- Version mobile (lg-) -->
                <div class=\"lg:hidden space-y-3\">
                    ";
            // line 165
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["ao"]) || array_key_exists("ao", $context) ? $context["ao"] : (function () { throw new RuntimeError('Variable "ao" does not exist.', 165, $this->source); })()), "logs", [], "any", false, false, false, 165));
            foreach ($context['_seq'] as $context["_key"] => $context["log"]) {
                // line 166
                yield "                        <details class=\"bg-white p-3 rounded-lg shadow\">
                            <summary class=\"font-medium text-gray-700\">
                                ";
                // line 168
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["log"], "changedAt", [], "any", false, false, false, 168), "d/m/Y"), "html", null, true);
                yield " - ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["log"], "action", [], "any", false, false, false, 168), "html", null, true);
                yield "
                            </summary>
                            <div class=\"mt-2 text-sm text-gray-600\">
                                <div>Par: ";
                // line 171
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["log"], "user", [], "any", false, false, false, 171), "email", [], "any", false, false, false, 171), "html", null, true);
                yield "</div>
                                ";
                // line 172
                if (CoreExtension::getAttribute($this->env, $this->source, $context["log"], "changes", [], "any", false, false, false, 172)) {
                    // line 173
                    yield "                                    <div class=\"mt-2\">
                                        <div class=\"font-medium\">Modifications:</div>
                                        <ul class=\"list-disc pl-5 mt-1 space-y-1\">
                                            ";
                    // line 176
                    $context['_parent'] = $context;
                    $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["log"], "changes", [], "any", false, false, false, 176));
                    foreach ($context['_seq'] as $context["field"] => $context["change"]) {
                        // line 177
                        yield "                                                <li>
                                                    ";
                        // line 178
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["field"], "html", null, true);
                        yield ":
                                                    ";
                        // line 179
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, $context["change"], "old", [], "any", true, true, false, 179)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["change"], "old", [], "any", false, false, false, 179), "vide")) : ("vide")), "html", null, true);
                        yield " → ";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, $context["change"], "new", [], "any", true, true, false, 179)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["change"], "new", [], "any", false, false, false, 179), "vide")) : ("vide")), "html", null, true);
                        yield "
                                                </li>
                                            ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['field'], $context['change'], $context['_parent']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 182
                    yield "                                        </ul>
                                    </div>
                                ";
                }
                // line 185
                yield "                            </div>
                        </details>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['log'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 188
            yield "                </div>
            </div>
        </div>
    ";
        }
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "ao/detail/detail.html.twig";
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
        return array (  447 => 188,  439 => 185,  434 => 182,  423 => 179,  419 => 178,  416 => 177,  412 => 176,  407 => 173,  405 => 172,  401 => 171,  393 => 168,  389 => 166,  385 => 165,  378 => 160,  370 => 157,  366 => 155,  362 => 153,  353 => 150,  349 => 149,  345 => 148,  342 => 147,  338 => 146,  335 => 145,  333 => 144,  327 => 141,  321 => 138,  315 => 135,  311 => 133,  307 => 132,  290 => 117,  288 => 116,  282 => 112,  269 => 103,  266 => 102,  257 => 97,  254 => 96,  245 => 90,  242 => 89,  240 => 88,  231 => 82,  224 => 78,  211 => 67,  202 => 64,  191 => 57,  187 => 56,  177 => 49,  167 => 41,  156 => 34,  154 => 33,  149 => 31,  144 => 29,  138 => 28,  134 => 27,  130 => 26,  126 => 25,  121 => 23,  114 => 18,  104 => 14,  100 => 12,  95 => 11,  85 => 7,  81 => 5,  76 => 4,  63 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block body %}
    {% for message in app.flashes('create_ao_success') %}
        <div class=\"inset-0 flex items-center justify-center text-center\">
            <div class=\"bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-5 w-1/2\">
                {{ message }}
            </div>
        </div>
    {% endfor %}
    {% for message in app.flashes('edit_ao_success') %}
        <div class=\"inset-0 flex items-center justify-center text-center\">
            <div class=\"bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-5 w-1/2\">
                {{ message }}
            </div>
        </div>
    {% endfor %}
    <div class=\"max-w-4xl mx-auto bg-white rounded-xl shadow-md overflow-hidden my-8\">
        <!-- Header -->
        <div class=\"bg-primary p-6 text-white\">
            <div class=\"flex justify-between items-start\">
                <div>
                    <span class=\"inline-block px-3 py-1 bg-white/20 rounded-full text-sm\">{{ ao.reference }}</span>
                    <span class=\"px-2 py-1 text-xs font-semibold rounded-full
                        {% if ao.statut == 'BROUILLON' %}bg-yellow-100 text-yellow-800
                        {% elseif ao.statut == 'PUBLIE' %}bg-blue-100 text-blue-800
                        {% elseif ao.statut == 'CLOTURE' %}bg-gray-100 text-gray-800
                        {% elseif ao.statut == 'ATTRIBUE' %}bg-green-100 text-green-800{% endif %}\">
                        {{ ao.statut }}
                    </span>
                    <h1 class=\"mt-2 text-2xl font-bold\">{{ ao.titre }}</h1>
                </div>
                {% if is_granted('ROLE_ADMIN') %}
                    <form action=\"{{ path('app_ao_close', {id: ao.id}) }}\" method=\"POST\">
                        <button type=\"submit\"
                                class=\"px-4 py-2 bg-red-500 hover:bg-red-600 rounded-lg text-white text-sm font-medium transition-colors\">
                            Clôturer
                        </button>
                    </form>
                {% endif %}
            </div>
        </div>

        <!-- Content -->
        <div class=\"p-6 grid md:grid-cols-3 gap-8\">
            <!-- Main -->
            <div class=\"md:col-span-2\">
                <div class=\"prose max-w-none\">
                    {{ ao.description|markdown_to_html }}
                </div>

                <!-- Fichiers -->
                <div class=\"mt-8\">
                    <h3 class=\"text-lg font-medium mb-4\">Documents joints</h3>
                    <div class=\"space-y-2\">
                        {% for file in ao.files %}
                            <a href=\"{{ asset('uploads/ao/' ~ file.filename) }}\"
                               class=\"flex items-center p-3 border rounded-lg hover:bg-gray-50 transition-colors\">
                                <svg class=\"h-5 w-5 text-gray-400 mr-3\" fill=\"none\" stroke=\"currentColor\"
                                     viewBox=\"0 0 24 24\">
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\"
                                          d=\"M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z\"/>
                                </svg>
                                <span>{{ file.originalFilename }}</span>
                            </a>
                        {% endfor %}
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class=\"space-y-6\">
                <!-- Stats -->
                <div class=\"bg-gray-50 p-4 rounded-lg\">
                    <div class=\"grid grid-cols-2 gap-4 text-center\">
                        <div>
                            <p class=\"text-sm text-gray-500\">Budget</p>
                            <p class=\"font-bold\">{{ ao.budget|format_currency('XOF') }}</p>
                        </div>
                        <div>
                            <p class=\"text-sm text-gray-500\">Clôture</p>
                            <p class=\"font-bold\">{{ ao.dateLimite|date('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>
                <!-- Boutons CTA -->
                <div class=\"space-y-4\">
                    {% if is_granted('ROLE_ADMIN') %}
                        <div class=\"mt-4 text-center\">
                            <a href=\"{{ path('app_ao_edit', {id: ao.id}) }}\"
                               class=\"bg-yellow-400 text-white px-4 py-2 rounded hover:bg-yellow-500\">
                                Modifier cet AO
                            </a>
                        </div>
                    {% endif %}
                    {% if canSubmit %}
                        <a href=\"{{ path('app_ao_submit', {id: ao.id}) }}\"
                           class=\"block w-full text-center px-4 py-3 bg-gradient-to-r from-primary to-secondary text-white rounded-lg font-medium hover:shadow-md transition-all\">
                            Soumettre une offre
                        </a>
                    {% endif %}
                    {% if ao.getFiles() %}
                        <a href=\"{{ path('app_ao_download_pdf', {id: ao.id}) }}\"
                           class=\"block w-full text-center px-4 py-3 rounded-lg font-medium transition-colors flex items-center justify-center\">
                            <svg class=\"w-5 h-5 mr-2\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\"
                                      d=\"M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4\"/>
                            </svg>
                            Télécharger le dossier complet
                        </a>
                    {% endif %}
                </div>
            </div>
        </div>
    </div>
    {% if is_granted('ROLE_ADMIN') and ao.logs|length > 0 %}
        <div class=\"mt-8 overflow-x-auto\">
            <h3 class=\"text-lg font-medium mb-4\">Historique des modifications</h3>

            <div class=\"shadow rounded-lg overflow-hidden\">
                <!-- Version desktop (lg+) -->
                <table class=\"hidden lg:table min-w-full divide-y divide-gray-200\">
                    <thead class=\"bg-gray-50\">
                    <tr>
                        <th class=\"px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase\">Date</th>
                        <th class=\"px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase\">Utilisateur</th>
                        <th class=\"px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase\">Action</th>
                        <th class=\"px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase\">Changements</th>
                    </tr>
                    </thead>
                    <tbody class=\"bg-white divide-y divide-gray-200\">
                    {% for log in ao.logs|sort((a, b) => b.changedAt <=> a.changedAt) %}
                        <tr>
                            <td class=\"px-6 py-4 whitespace-nowrap text-sm text-gray-500\">
                                {{ log.changedAt|date('d/m/Y H:i') }}
                            </td>
                            <td class=\"px-6 py-4 whitespace-nowrap text-sm text-gray-500\">
                                {{ log.user.email }}
                            </td>
                            <td class=\"px-6 py-4 whitespace-nowrap text-sm text-gray-500\">
                                {{ log.action }}
                            </td>
                            <td class=\"px-6 py-4 text-sm text-gray-500\">
                                {% if log.changes %}
                                    <ul class=\"list-disc pl-5\">
                                        {% for field, change in log.changes %}
                                            <li class=\"break-words\">
                                                <strong>{{ field }}:</strong>
                                                De \"{{ change.old|default('vide') }}\"
                                                à \"{{ change.new|default('vide') }}\"
                                            </li>
                                        {% endfor %}
                                    </ul>
                                {% else %}
                                    -
                                {% endif %}
                            </td>
                        </tr>
                    {% endfor %}
                    </tbody>
                </table>

                <!-- Version mobile (lg-) -->
                <div class=\"lg:hidden space-y-3\">
                    {% for log in ao.logs %}
                        <details class=\"bg-white p-3 rounded-lg shadow\">
                            <summary class=\"font-medium text-gray-700\">
                                {{ log.changedAt|date('d/m/Y') }} - {{ log.action }}
                            </summary>
                            <div class=\"mt-2 text-sm text-gray-600\">
                                <div>Par: {{ log.user.email }}</div>
                                {% if log.changes %}
                                    <div class=\"mt-2\">
                                        <div class=\"font-medium\">Modifications:</div>
                                        <ul class=\"list-disc pl-5 mt-1 space-y-1\">
                                            {% for field, change in log.changes %}
                                                <li>
                                                    {{ field }}:
                                                    {{ change.old|default('vide') }} → {{ change.new|default('vide') }}
                                                </li>
                                            {% endfor %}
                                        </ul>
                                    </div>
                                {% endif %}
                            </div>
                        </details>
                    {% endfor %}
                </div>
            </div>
        </div>
    {% endif %}
{% endblock %}", "ao/detail/detail.html.twig", "/app/templates/ao/detail/detail.html.twig");
    }
}
