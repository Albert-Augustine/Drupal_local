<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* modules/contrib/video_embed_field/templates/video-embed-iframe.html.twig */
class __TwigTemplate_84027e8dbae3fa55c8f0001d53036e5c77097a896ba59f421df34ee98086ec24 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 7];
        $filters = ["escape" => 7, "url_encode" => 7];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape', 'url_encode'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 7
        echo "<iframe";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["attributes"] ?? null)), "html", null, true);
        if ( !twig_test_empty(($context["url"] ?? null))) {
            echo " src=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["url"] ?? null)), "html", null, true);
            if ( !twig_test_empty(($context["query"] ?? null))) {
                echo "?";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, twig_urlencode_filter($this->sandbox->ensureToStringAllowed(($context["query"] ?? null))), "html", null, true);
            }
            if ( !twig_test_empty(($context["fragment"] ?? null))) {
                echo "#";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["fragment"] ?? null)), "html", null, true);
            }
            echo "\"";
        }
        echo "></iframe>
";
    }

    public function getTemplateName()
    {
        return "modules/contrib/video_embed_field/templates/video-embed-iframe.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  55 => 7,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{#
/**
 * @file
 * Display an iframe with alterable components.
 */
#}
<iframe{{ attributes }}{% if url is not empty %} src=\"{{ url }}{% if query is not empty %}?{{ query | url_encode }}{% endif %}{% if fragment is not empty %}#{{ fragment }}{% endif %}\"{% endif %}></iframe>
", "modules/contrib/video_embed_field/templates/video-embed-iframe.html.twig", "/home/powercms/public_project/drupal_project/web/modules/contrib/video_embed_field/templates/video-embed-iframe.html.twig");
    }
}
