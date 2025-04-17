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

/* registration/confirmation_email.html.twig */
class __TwigTemplate_168404ab01244f5130f9c4b535c7127f extends Template
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
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "registration/confirmation_email.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "registration/confirmation_email.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"utf-8\">
    <meta http-equiv=\"x-ua-compatible\" content=\"ie=edge\">
    <title>Email Confirmation</title>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <style type=\"text/css\">
        /**
         * Google webfonts. Recommended to include the .woff version for cross-client compatibility.
         */
        @media screen {
            @font-face {
                font-family: 'Source Sans Pro';
                font-style: normal;
                font-weight: 400;
                src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
            }
            @font-face {
                font-family: 'Source Sans Pro';
                font-style: normal;
                font-weight: 700;
                src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
            }
        }
        /**
         * Avoid browser level font resizing.
         * 1. Windows Mobile
         * 2. iOS / OSX
         */
        body,
        table,
        td,
        a {
            -ms-text-size-adjust: 100%; /* 1 */
            -webkit-text-size-adjust: 100%; /* 2 */
        }
        /**
         * Remove extra space added to tables and cells in Outlook.
         */
        table,
        td {
            mso-table-rspace: 0pt;
            mso-table-lspace: 0pt;
        }
        /**
         * Better fluid images in Internet Explorer.
         */
        img {
            -ms-interpolation-mode: bicubic;
        }
        /**
         * Remove blue links for iOS devices.
         */
        a[x-apple-data-detectors] {
            font-family: inherit !important;
            font-size: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
            color: inherit !important;
            text-decoration: none !important;
        }
        /**
         * Fix centering issues in Android 4.4.
         */
        div[style*=\"margin: 16px 0;\"] {
            margin: 0 !important;
        }
        body {
            width: 100% !important;
            height: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        /**
         * Collapse table borders to avoid space between cells.
         */
        table {
            border-collapse: collapse !important;
        }
        a {
            color: #1a82e2;
        }
        img {
            height: auto;
            line-height: 100%;
            text-decoration: none;
            border: 0;
            outline: none;
        }
    </style>

</head>
<body style=\"background-color: #e9ecef;\">

<!-- start preheader -->
<div class=\"preheader\" style=\"display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;\">
    A preheader is the short summary text that follows the subject line when an email is viewed in the inbox.
</div>
<!-- end preheader -->

<!-- start body -->
<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">

";
        // line 130
        yield "
    <!-- start hero -->
    <tr>
        <td align=\"center\" bgcolor=\"#e9ecef\">
            <!--[if (gte mso 9)|(IE)]>
            <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"600\">
                <tr>
                    <td align=\"center\" valign=\"top\" width=\"600\">
            <![endif]-->
            <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width: 600px;\">
                <tr>
                    <td align=\"left\" bgcolor=\"#ffffff\" style=\"padding: 36px 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf;\">
                        <h1 style=\"margin: 0; font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px;\">Hello ";
        // line 142
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["firstname"]) || array_key_exists("firstname", $context) ? $context["firstname"] : (function () { throw new RuntimeError('Variable "firstname" does not exist.', 142, $this->source); })()), "html", null, true);
        yield ", <br> Merci de confirmer votre email !</h1>
                    </td>
                </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
    <!-- end hero -->

    <!-- start copy block -->
    <tr>
        <td align=\"center\" bgcolor=\"#e9ecef\">
            <!--[if (gte mso 9)|(IE)]>
            <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"600\">
                <tr>
                    <td align=\"center\" valign=\"top\" width=\"600\">
            <![endif]-->
            <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width: 600px;\">

                <!-- start button -->
                <tr>
                    <td align=\"left\" bgcolor=\"#ffffff\">
                        <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
                            <tr>
                                <td align=\"center\" bgcolor=\"#ffffff\" style=\"padding: 12px;\">
                                    <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
                                        <tr>
                                            <td align=\"center\" bgcolor=\"#1a82e2\" style=\"border-radius: 6px;\">
                                                <a href=\"";
        // line 174
        yield (isset($context["signedUrl"]) || array_key_exists("signedUrl", $context) ? $context["signedUrl"] : (function () { throw new RuntimeError('Variable "signedUrl" does not exist.', 174, $this->source); })());
        yield "\" target=\"_blank\" style=\"display: inline-block; padding: 16px 36px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; color: #ffffff; text-decoration: none; border-radius: 6px;\">Je confirme mon email</a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- end button -->

                <!-- start copy -->
                <tr>
                    <td align=\"left\" bgcolor=\"#ffffff\" style=\"padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; border-bottom: 3px solid #d4dadf\">
                        <p style=\"margin: 0;\">À bientôt !</p>
                    </td>
                </tr>
                <!-- end copy -->

            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
    <!-- end copy block -->

    <!-- start footer -->
    <tr>
        <td align=\"center\" bgcolor=\"#e9ecef\" style=\"padding: 24px;\">
            <!--[if (gte mso 9)|(IE)]>
            <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"600\">
                <tr>
                    <td align=\"center\" valign=\"top\" width=\"600\">
            <![endif]-->
            <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width: 600px;\">

                <!-- start permission -->
                <tr>
                    <td align=\"center\" bgcolor=\"#e9ecef\" style=\"padding: 12px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;\">
                        <p style=\"margin: 0;\">Vous recevez cet email, car vous avez créé un compte sur AO Burkina.</p>
                    </td>
                </tr>
                <tr>
                    <td align=\"center\" bgcolor=\"#e9ecef\" style=\"padding: 12px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;\">
                        <p style=\"margin: 0;\">Ce lien expira le ";
        // line 221
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["expiresAtMessageKey"]) || array_key_exists("expiresAtMessageKey", $context) ? $context["expiresAtMessageKey"] : (function () { throw new RuntimeError('Variable "expiresAtMessageKey" does not exist.', 221, $this->source); })()), "html", null, true);
        yield "</p>
                    </td>
                </tr>
                <!-- end permission -->

            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
    <!-- end footer -->

</table>
<!-- end body -->

</body>
</html>
";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "registration/confirmation_email.html.twig";
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
        return array (  253 => 221,  203 => 174,  168 => 142,  154 => 130,  48 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"utf-8\">
    <meta http-equiv=\"x-ua-compatible\" content=\"ie=edge\">
    <title>Email Confirmation</title>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <style type=\"text/css\">
        /**
         * Google webfonts. Recommended to include the .woff version for cross-client compatibility.
         */
        @media screen {
            @font-face {
                font-family: 'Source Sans Pro';
                font-style: normal;
                font-weight: 400;
                src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
            }
            @font-face {
                font-family: 'Source Sans Pro';
                font-style: normal;
                font-weight: 700;
                src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
            }
        }
        /**
         * Avoid browser level font resizing.
         * 1. Windows Mobile
         * 2. iOS / OSX
         */
        body,
        table,
        td,
        a {
            -ms-text-size-adjust: 100%; /* 1 */
            -webkit-text-size-adjust: 100%; /* 2 */
        }
        /**
         * Remove extra space added to tables and cells in Outlook.
         */
        table,
        td {
            mso-table-rspace: 0pt;
            mso-table-lspace: 0pt;
        }
        /**
         * Better fluid images in Internet Explorer.
         */
        img {
            -ms-interpolation-mode: bicubic;
        }
        /**
         * Remove blue links for iOS devices.
         */
        a[x-apple-data-detectors] {
            font-family: inherit !important;
            font-size: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
            color: inherit !important;
            text-decoration: none !important;
        }
        /**
         * Fix centering issues in Android 4.4.
         */
        div[style*=\"margin: 16px 0;\"] {
            margin: 0 !important;
        }
        body {
            width: 100% !important;
            height: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        /**
         * Collapse table borders to avoid space between cells.
         */
        table {
            border-collapse: collapse !important;
        }
        a {
            color: #1a82e2;
        }
        img {
            height: auto;
            line-height: 100%;
            text-decoration: none;
            border: 0;
            outline: none;
        }
    </style>

</head>
<body style=\"background-color: #e9ecef;\">

<!-- start preheader -->
<div class=\"preheader\" style=\"display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;\">
    A preheader is the short summary text that follows the subject line when an email is viewed in the inbox.
</div>
<!-- end preheader -->

<!-- start body -->
<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">

{#    <!-- start logo -->#}
{#    <tr>#}
{#        <td align=\"center\" bgcolor=\"#e9ecef\">#}
{#            <!--[if (gte mso 9)|(IE)]>#}
{#            <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"600\">#}
{#                <tr>#}
{#                    <td align=\"center\" valign=\"top\" width=\"600\">#}
{#            <![endif]-->#}
{#            <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width: 600px;\">#}
{#                <tr>#}
{#                    <td align=\"center\" valign=\"top\" style=\"padding: 36px 24px;\">#}
{#                        <a href=\"https://www.blogdesire.com\" target=\"_blank\" style=\"display: inline-block;\">#}
{#                            <img src=\"https://www.blogdesire.com/wp-content/uploads/2019/07/blogdesire-1.png\" alt=\"Logo\" border=\"0\" width=\"48\" style=\"display: block; width: 48px; max-width: 48px; min-width: 48px;\">#}
{#                        </a>#}
{#                    </td>#}
{#                </tr>#}
{#            </table>#}
{#            <!--[if (gte mso 9)|(IE)]>#}
{#            </td>#}
{#            </tr>#}
{#            </table>#}
{#            <![endif]-->#}
{#        </td>#}
{#    </tr>#}
{#    <!-- end logo -->#}

    <!-- start hero -->
    <tr>
        <td align=\"center\" bgcolor=\"#e9ecef\">
            <!--[if (gte mso 9)|(IE)]>
            <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"600\">
                <tr>
                    <td align=\"center\" valign=\"top\" width=\"600\">
            <![endif]-->
            <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width: 600px;\">
                <tr>
                    <td align=\"left\" bgcolor=\"#ffffff\" style=\"padding: 36px 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf;\">
                        <h1 style=\"margin: 0; font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px;\">Hello {{ firstname }}, <br> Merci de confirmer votre email !</h1>
                    </td>
                </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
    <!-- end hero -->

    <!-- start copy block -->
    <tr>
        <td align=\"center\" bgcolor=\"#e9ecef\">
            <!--[if (gte mso 9)|(IE)]>
            <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"600\">
                <tr>
                    <td align=\"center\" valign=\"top\" width=\"600\">
            <![endif]-->
            <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width: 600px;\">

                <!-- start button -->
                <tr>
                    <td align=\"left\" bgcolor=\"#ffffff\">
                        <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
                            <tr>
                                <td align=\"center\" bgcolor=\"#ffffff\" style=\"padding: 12px;\">
                                    <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
                                        <tr>
                                            <td align=\"center\" bgcolor=\"#1a82e2\" style=\"border-radius: 6px;\">
                                                <a href=\"{{ signedUrl|raw }}\" target=\"_blank\" style=\"display: inline-block; padding: 16px 36px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; color: #ffffff; text-decoration: none; border-radius: 6px;\">Je confirme mon email</a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- end button -->

                <!-- start copy -->
                <tr>
                    <td align=\"left\" bgcolor=\"#ffffff\" style=\"padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; border-bottom: 3px solid #d4dadf\">
                        <p style=\"margin: 0;\">À bientôt !</p>
                    </td>
                </tr>
                <!-- end copy -->

            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
    <!-- end copy block -->

    <!-- start footer -->
    <tr>
        <td align=\"center\" bgcolor=\"#e9ecef\" style=\"padding: 24px;\">
            <!--[if (gte mso 9)|(IE)]>
            <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"600\">
                <tr>
                    <td align=\"center\" valign=\"top\" width=\"600\">
            <![endif]-->
            <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width: 600px;\">

                <!-- start permission -->
                <tr>
                    <td align=\"center\" bgcolor=\"#e9ecef\" style=\"padding: 12px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;\">
                        <p style=\"margin: 0;\">Vous recevez cet email, car vous avez créé un compte sur AO Burkina.</p>
                    </td>
                </tr>
                <tr>
                    <td align=\"center\" bgcolor=\"#e9ecef\" style=\"padding: 12px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;\">
                        <p style=\"margin: 0;\">Ce lien expira le {{ expiresAtMessageKey }}</p>
                    </td>
                </tr>
                <!-- end permission -->

            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
    <!-- end footer -->

</table>
<!-- end body -->

</body>
</html>
", "registration/confirmation_email.html.twig", "/app/templates/registration/confirmation_email.html.twig");
    }
}
