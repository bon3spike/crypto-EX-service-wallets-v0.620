<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* @JMSSerializer/Collector/panel.html.twig */
class __TwigTemplate_70cdae8f39a279a9da2066c78ab26653 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'toolbar' => [$this, 'block_toolbar'],
            'head' => [$this, 'block_head'],
            'menu' => [$this, 'block_menu'],
            'panel' => [$this, 'block_panel'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "@WebProfiler/Profiler/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@JMSSerializer/Collector/panel.html.twig"));

        // line 2
        $macros["helper"] = $this->macros["helper"] = $this;
        // line 1
        $this->parent = $this->loadTemplate("@WebProfiler/Profiler/layout.html.twig", "@JMSSerializer/Collector/panel.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    public function block_toolbar($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "toolbar"));

        // line 5
        ob_start();
        // line 6
        echo twig_include($this->env, $context, "@JMSSerializer/icon.svg");
        echo "
        <span class=\"sf-toolbar-label\">S:</span>
        <span class=\"sf-toolbar-value\">";
        // line 8
        echo twig_escape_filter($this->env, twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 8, $this->source); })()), "runs", [0 => 1], "method", false, false, false, 8)), "html", null, true);
        echo "</span>
        <span class=\"sf-toolbar-label\">D:</span>
        <span class=\"sf-toolbar-value\">";
        // line 10
        echo twig_escape_filter($this->env, twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 10, $this->source); })()), "runs", [0 => 2], "method", false, false, false, 10)), "html", null, true);
        echo "</span>
        ";
        // line 11
        if ((twig_get_attribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 11, $this->source); })()), "instance", [], "any", false, false, false, 11) != "default")) {
            // line 12
            echo "            <span class=\"sf-toolbar-label\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 12, $this->source); })()), "instance", [], "any", false, false, false, 12), "html", null, true);
            echo "</span>
        ";
        }
        $context["icon"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 16
        ob_start();
        // line 17
        echo "<div class=\"sf-toolbar-info-piece\">
            <b>Serializations</b>
            <span class=\"sf-toolbar-status\">";
        // line 19
        echo twig_escape_filter($this->env, twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 19, $this->source); })()), "runs", [0 => 1], "method", false, false, false, 19)), "html", null, true);
        echo "</span>
        </div>
        <div class=\"sf-toolbar-info-piece\">
            <b>Deserializations</b>
            <span class=\"sf-toolbar-status\">";
        // line 23
        echo twig_escape_filter($this->env, twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 23, $this->source); })()), "runs", [0 => 2], "method", false, false, false, 23)), "html", null, true);
        echo "</span>
        </div>
        <div class=\"sf-toolbar-info-piece\">
            <b>Listeners</b>
            <span class=\"sf-toolbar-status\">";
        // line 27
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 27, $this->source); })()), "getNumListeners", [0 => "called"], "method", false, false, false, 27), "html", null, true);
        echo "</span>
        </div>
        <div class=\"sf-toolbar-info-piece\">
            <b>Handlers</b>
            <span class=\"sf-toolbar-status\">";
        // line 31
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 31, $this->source); })()), "getNumHandlers", [0 => "called"], "method", false, false, false, 31), "html", null, true);
        echo "</span>
        </div>
        <div class=\"sf-toolbar-info-piece\">
            <b>Metadata</b>
            <span class=\"sf-toolbar-status ";
        // line 35
        echo (((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 35, $this->source); })()), "loadedMetadata", [], "any", false, false, false, 35)) > 0)) ? ("sf-toolbar-status-none") : (""));
        echo "\">";
        echo twig_escape_filter($this->env, twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 35, $this->source); })()), "loadedMetadata", [], "any", false, false, false, 35)), "html", null, true);
        echo "</span>
        </div>";
        $context["text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 39
        $this->loadTemplate("@WebProfiler/Profiler/toolbar_item.html.twig", "@JMSSerializer/Collector/panel.html.twig", 39)->display(twig_array_merge($context, ["link" => (isset($context["profiler_url"]) || array_key_exists("profiler_url", $context) ? $context["profiler_url"] : (function () { throw new RuntimeError('Variable "profiler_url" does not exist.', 39, $this->source); })())]));
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 42
    public function block_head($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "head"));

        // line 43
        echo "<style>
        ";
        // line 44
        echo twig_include($this->env, $context, "@JMSSerializer/Collector/style/jms.css.twig");
        echo "
    </style>
    <style>
        .margin-left {
            margin-left: 10px;
        }

        .margin-top {
            margin-top: 10px;
        }

        .margin-bottom {
            margin-bottom: 10px;
        }
    </style>
    <script type=\"text/javascript\">
        ";
        // line 60
        echo twig_include($this->env, $context, "@JMSSerializer/Collector/script/jms.js.twig");
        echo "
    </script>
    ";
        // line 62
        $this->displayParentBlock("head", $context, $blocks);
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 65
    public function block_menu($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "menu"));

        // line 67
        echo "    ";
        $context["total"] = (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 67, $this->source); })()), "runs", [0 => 1], "method", false, false, false, 67)) + twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 67, $this->source); })()), "runs", [0 => 2], "method", false, false, false, 67)));
        // line 68
        echo "    <span class=\"label ";
        echo ((((isset($context["total"]) || array_key_exists("total", $context) ? $context["total"] : (function () { throw new RuntimeError('Variable "total" does not exist.', 68, $this->source); })()) == 0)) ? ("disabled") : (""));
        echo "\">
        <span class=\"icon\">
            ";
        // line 70
        echo twig_include($this->env, $context, "@JMSSerializer/icon.svg");
        echo "
        </span>
        <strong>
            JMS Serializer
            ";
        // line 74
        if ((twig_get_attribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 74, $this->source); })()), "instance", [], "any", false, false, false, 74) != "default")) {
            // line 75
            echo "                <small><br>(";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 75, $this->source); })()), "instance", [], "any", false, false, false, 75), "html", null, true);
            echo ")</small>
            ";
        }
        // line 77
        echo "        </strong>

        <span class=\"count\">
            <span>";
        // line 80
        echo twig_escape_filter($this->env, twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 80, $this->source); })()), "runs", [0 => 1], "method", false, false, false, 80)), "html", null, true);
        echo " + ";
        echo twig_escape_filter($this->env, twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 80, $this->source); })()), "runs", [0 => 2], "method", false, false, false, 80)), "html", null, true);
        echo "</span>
        </span>

    </span>";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 86
    public function block_panel($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "panel"));

        // line 87
        echo "<h2>
        JMS Serializer
        ";
        // line 89
        if ((twig_get_attribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 89, $this->source); })()), "instance", [], "any", false, false, false, 89) != "default")) {
            // line 90
            echo "            (";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 90, $this->source); })()), "instance", [], "any", false, false, false, 90), "html", null, true);
            echo ")
        ";
        }
        // line 92
        echo "    </h2>

    <div class=\"metrics\">
        <div class=\"metric\">
            <span class=\"value\">";
        // line 96
        echo twig_escape_filter($this->env, twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 96, $this->source); })()), "runs", [0 => 1], "method", false, false, false, 96)), "html", null, true);
        echo "</span>
            <span class=\"label\">Serializations</span>
        </div>
        <div class=\"metric\">
            <span class=\"value\">";
        // line 100
        echo twig_escape_filter($this->env, twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 100, $this->source); })()), "runs", [0 => 2], "method", false, false, false, 100)), "html", null, true);
        echo "</span>
            <span class=\"label\">Deserializations</span>
        </div>
        <div class=\"metric-divider\"></div>
        <div class=\"metric\">
            <span class=\"value\">";
        // line 105
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 105, $this->source); })()), "triggeredEvents", [], "any", false, false, false, 105), "count", [], "any", false, false, false, 105), "html", null, true);
        echo "</span>
            <span class=\"label\">Triggered event listeners</span>
        </div>
        <div class=\"metric\">
            <span class=\"value\">";
        // line 109
        echo twig_escape_filter($this->env, twig_round(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 109, $this->source); })()), "triggeredEvents", [], "any", false, false, false, 109), "duration", [], "any", false, false, false, 109), 2), "html", null, true);
        echo " <span class=\"unit\">ms</span></span>
            <span class=\"label\">Triggered event listeners (time)</span>
        </div>
    </div>

    ";
        // line 114
        echo twig_call_macro($macros["helper"], "macro_render_table_runs", [twig_get_attribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 114, $this->source); })()), "runs", [0 => 1], "method", false, false, false, 114), "Serializations"], 114, $context, $this->getSourceContext());
        echo "
    ";
        // line 115
        echo twig_call_macro($macros["helper"], "macro_render_table_runs", [twig_get_attribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 115, $this->source); })()), "runs", [0 => 2], "method", false, false, false, 115), "Deserializations"], 115, $context, $this->getSourceContext());
        echo "

    <div class=\"sf-tabs\">
        <div class=\"tab\">
            <h3 class=\"tab-title jms-toggle\" data-toggle=\"#jms-events\">
                Events
                <span class=\"badge\">
                    ";
        // line 122
        echo twig_escape_filter($this->env, twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 122, $this->source); })()), "triggeredListeners", [], "any", false, false, false, 122)), "html", null, true);
        echo "
                    (";
        // line 123
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 123, $this->source); })()), "getNumListeners", [0 => "called"], "method", false, false, false, 123), "html", null, true);
        echo " listeners)
                </span>


            </h3>

            <div class=\"tab-content\">
                <p class=\"help\">Triggered event listeners</p>

                <div id=\"jms-events\">";
        // line 133
        $this->loadTemplate("@JMSSerializer/Collector/events.html.twig", "@JMSSerializer/Collector/panel.html.twig", 133)->display($context);
        // line 134
        echo "</div>
            </div>
        </div>

        <div class=\"tab\">
            <h3 class=\"tab-title jms-toggle\" data-toggle=\"#jms-handlers\">
                Handlers
                <span class=\"badge\">
                    ";
        // line 142
        echo twig_escape_filter($this->env, twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 142, $this->source); })()), "triggeredHandlers", [], "any", false, false, false, 142)), "html", null, true);
        echo "
                    (";
        // line 143
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 143, $this->source); })()), "getNumHandlers", [0 => "called"], "method", false, false, false, 143), "html", null, true);
        echo " types)
                </span>
            </h3>

            <div class=\"tab-content\">
                <p class=\"help\">Triggered event handlers</p>

                <div id=\"jms-handlers\">";
        // line 151
        $this->loadTemplate("@JMSSerializer/Collector/handlers.html.twig", "@JMSSerializer/Collector/panel.html.twig", 151)->display($context);
        // line 152
        echo "</div>
            </div>
        </div>

        <div class=\"tab\">
            <h3 class=\"tab-title\">
                Metadata
                <span class=\"badge ";
        // line 159
        echo (((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 159, $this->source); })()), "loadedMetadata", [], "any", false, false, false, 159)) > 0)) ? ("status-info") : (""));
        echo "\">";
        // line 160
        echo twig_escape_filter($this->env, twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 160, $this->source); })()), "loadedMetadata", [], "any", false, false, false, 160)), "html", null, true);
        // line 161
        echo "</span>
            </h3>

            <div class=\"tab-content\">
                <p class=\"help\">Loaded metadata</p>

                <div id=\"jms-metadata\">";
        // line 168
        $this->loadTemplate("@JMSSerializer/Collector/metadata.html.twig", "@JMSSerializer/Collector/panel.html.twig", 168)->display($context);
        // line 169
        echo "</div>
            </div>
        </div>
    </div>";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 175
    public function macro_render_table_runs($__runs__ = null, $__mode__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "runs" => $__runs__,
            "mode" => $__mode__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start();
        try {
            $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
            $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "macro", "render_table_runs"));

            // line 177
            if ((twig_length_filter($this->env, (isset($context["runs"]) || array_key_exists("runs", $context) ? $context["runs"] : (function () { throw new RuntimeError('Variable "runs" does not exist.', 177, $this->source); })())) > 0)) {
                // line 178
                echo "<h3>";
                echo twig_escape_filter($this->env, (isset($context["mode"]) || array_key_exists("mode", $context) ? $context["mode"] : (function () { throw new RuntimeError('Variable "mode" does not exist.', 178, $this->source); })()), "html", null, true);
                echo "</h3>
        <table>
            <thead>
            <tr>
                <th>Type</th>
            </tr>
            </thead>";
                // line 185
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["runs"]) || array_key_exists("runs", $context) ? $context["runs"] : (function () { throw new RuntimeError('Variable "runs" does not exist.', 185, $this->source); })()));
                foreach ($context['_seq'] as $context["_key"] => $context["run"]) {
                    // line 186
                    echo "<tr>
                    <th class=\"colored font-normal\">";
                    // line 187
                    echo twig_var_dump($this->env, $context, ...[0 => twig_get_attribute($this->env, $this->source, $context["run"], "type", [], "any", false, false, false, 187)]);
                    echo "</th>
                </tr>";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['run'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 190
                echo "</table>";
            }
            
            $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);


            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    public function getTemplateName()
    {
        return "@JMSSerializer/Collector/panel.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  419 => 190,  411 => 187,  408 => 186,  404 => 185,  394 => 178,  392 => 177,  375 => 175,  365 => 169,  363 => 168,  355 => 161,  353 => 160,  350 => 159,  341 => 152,  339 => 151,  329 => 143,  325 => 142,  315 => 134,  313 => 133,  301 => 123,  297 => 122,  287 => 115,  283 => 114,  275 => 109,  268 => 105,  260 => 100,  253 => 96,  247 => 92,  241 => 90,  239 => 89,  235 => 87,  228 => 86,  215 => 80,  210 => 77,  204 => 75,  202 => 74,  195 => 70,  189 => 68,  186 => 67,  179 => 65,  172 => 62,  167 => 60,  148 => 44,  145 => 43,  138 => 42,  131 => 39,  124 => 35,  117 => 31,  110 => 27,  103 => 23,  96 => 19,  92 => 17,  90 => 16,  83 => 12,  81 => 11,  77 => 10,  72 => 8,  67 => 6,  65 => 5,  58 => 3,  50 => 1,  48 => 2,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{%- extends '@WebProfiler/Profiler/layout.html.twig' -%}
{%- import _self as helper -%}
{%- block toolbar -%}

    {%- set icon -%}
        {{- include('@JMSSerializer/icon.svg') }}
        <span class=\"sf-toolbar-label\">S:</span>
        <span class=\"sf-toolbar-value\">{{- collector.runs(1)|length }}</span>
        <span class=\"sf-toolbar-label\">D:</span>
        <span class=\"sf-toolbar-value\">{{- collector.runs(2)|length }}</span>
        {% if collector.instance != 'default' %}
            <span class=\"sf-toolbar-label\">{{- collector.instance -}}</span>
        {% endif %}
    {%- endset -%}

    {%- set text -%}
        <div class=\"sf-toolbar-info-piece\">
            <b>Serializations</b>
            <span class=\"sf-toolbar-status\">{{ collector.runs(1)|length }}</span>
        </div>
        <div class=\"sf-toolbar-info-piece\">
            <b>Deserializations</b>
            <span class=\"sf-toolbar-status\">{{ collector.runs(2)|length }}</span>
        </div>
        <div class=\"sf-toolbar-info-piece\">
            <b>Listeners</b>
            <span class=\"sf-toolbar-status\">{{ collector.getNumListeners('called') }}</span>
        </div>
        <div class=\"sf-toolbar-info-piece\">
            <b>Handlers</b>
            <span class=\"sf-toolbar-status\">{{ collector.getNumHandlers('called') }}</span>
        </div>
        <div class=\"sf-toolbar-info-piece\">
            <b>Metadata</b>
            <span class=\"sf-toolbar-status {{ collector.loadedMetadata|length > 0 ? 'sf-toolbar-status-none' : '' }}\">{{ collector.loadedMetadata|length }}</span>
        </div>
    {%- endset -%}

    {%- include '@WebProfiler/Profiler/toolbar_item.html.twig' with { 'link': profiler_url } -%}
{%- endblock -%}

{%- block head -%}
    <style>
        {{ include('@JMSSerializer/Collector/style/jms.css.twig') }}
    </style>
    <style>
        .margin-left {
            margin-left: 10px;
        }

        .margin-top {
            margin-top: 10px;
        }

        .margin-bottom {
            margin-bottom: 10px;
        }
    </style>
    <script type=\"text/javascript\">
        {{ include('@JMSSerializer/Collector/script/jms.js.twig') }}
    </script>
    {{ parent() }}
{%- endblock -%}

{%- block menu -%}
    {# This left-hand menu appears when using the full-screen profiler. #}
    {% set total = (collector.runs(1)|length) + (collector.runs(2)|length) %}
    <span class=\"label {{ total == 0 ? 'disabled' : '' }}\">
        <span class=\"icon\">
            {{ include('@JMSSerializer/icon.svg') }}
        </span>
        <strong>
            JMS Serializer
            {% if collector.instance != 'default' %}
                <small><br>({{- collector.instance -}})</small>
            {% endif %}
        </strong>

        <span class=\"count\">
            <span>{{ (collector.runs(1)|length) }} + {{ (collector.runs(2)|length) }}</span>
        </span>

    </span>
{%- endblock -%}

{%- block panel -%}
    <h2>
        JMS Serializer
        {% if collector.instance != 'default' %}
            ({{- collector.instance -}})
        {% endif %}
    </h2>

    <div class=\"metrics\">
        <div class=\"metric\">
            <span class=\"value\">{{- collector.runs(1)|length }}</span>
            <span class=\"label\">Serializations</span>
        </div>
        <div class=\"metric\">
            <span class=\"value\">{{- collector.runs(2)|length }}</span>
            <span class=\"label\">Deserializations</span>
        </div>
        <div class=\"metric-divider\"></div>
        <div class=\"metric\">
            <span class=\"value\">{{- collector.triggeredEvents.count }}</span>
            <span class=\"label\">Triggered event listeners</span>
        </div>
        <div class=\"metric\">
            <span class=\"value\">{{- collector.triggeredEvents.duration|round(2) }} <span class=\"unit\">ms</span></span>
            <span class=\"label\">Triggered event listeners (time)</span>
        </div>
    </div>

    {{ helper.render_table_runs(collector.runs(1), 'Serializations') }}
    {{ helper.render_table_runs(collector.runs(2), 'Deserializations') }}

    <div class=\"sf-tabs\">
        <div class=\"tab\">
            <h3 class=\"tab-title jms-toggle\" data-toggle=\"#jms-events\">
                Events
                <span class=\"badge\">
                    {{ collector.triggeredListeners|length }}
                    ({{ collector.getNumListeners('called') }} listeners)
                </span>


            </h3>

            <div class=\"tab-content\">
                <p class=\"help\">Triggered event listeners</p>

                <div id=\"jms-events\">
                    {%- include '@JMSSerializer/Collector/events.html.twig' -%}
                </div>
            </div>
        </div>

        <div class=\"tab\">
            <h3 class=\"tab-title jms-toggle\" data-toggle=\"#jms-handlers\">
                Handlers
                <span class=\"badge\">
                    {{ collector.triggeredHandlers|length }}
                    ({{ collector.getNumHandlers('called') }} types)
                </span>
            </h3>

            <div class=\"tab-content\">
                <p class=\"help\">Triggered event handlers</p>

                <div id=\"jms-handlers\">
                    {%- include '@JMSSerializer/Collector/handlers.html.twig' -%}
                </div>
            </div>
        </div>

        <div class=\"tab\">
            <h3 class=\"tab-title\">
                Metadata
                <span class=\"badge {{ collector.loadedMetadata|length > 0 ? 'status-info' : '' }}\">
                    {{- collector.loadedMetadata|length -}}
                </span>
            </h3>

            <div class=\"tab-content\">
                <p class=\"help\">Loaded metadata</p>

                <div id=\"jms-metadata\">
                    {%- include '@JMSSerializer/Collector/metadata.html.twig' -%}
                </div>
            </div>
        </div>
    </div>
{%- endblock -%}

{%- macro render_table_runs(runs, mode) -%}

    {%- if (runs|length)>0 -%}
        <h3>{{ mode }}</h3>
        <table>
            <thead>
            <tr>
                <th>Type</th>
            </tr>
            </thead>
            {%- for run in runs -%}
                <tr>
                    <th class=\"colored font-normal\">{{ dump(run.type) }}</th>
                </tr>
            {%- endfor -%}
        </table>
    {%- endif -%}
{%- endmacro -%}
", "@JMSSerializer/Collector/panel.html.twig", "/home/john/Desktop/testing_CQRS/vendor/jms/serializer-bundle/Resources/views/Collector/panel.html.twig");
    }
}
