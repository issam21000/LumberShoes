<?php

/* users.twig */
class __TwigTemplate_9ba99b75cf63a2ea6fcfff65fafc8dac84e3e97c274273290c6dd76a2d4b6b7c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["data_issam"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
            // line 2
            echo "\t<li>";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["user"], "email", array()), "html", null, true);
            echo "</li>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['user'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "users.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  23 => 2,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% for user in data_issam %}
\t<li>{{user.email}}</li>
{% endfor %}", "users.twig", "/var/www/html/zhiephie/components/users.twig");
    }
}
