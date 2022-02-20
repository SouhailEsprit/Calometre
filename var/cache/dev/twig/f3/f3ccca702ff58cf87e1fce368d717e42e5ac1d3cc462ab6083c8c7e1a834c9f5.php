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

/* base-front-office.html.twig */
class __TwigTemplate_6028b5b60c5d27a6f7b97b358a5c9e1e381fd88c7753a3f859e22a424d630576 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'styles' => [$this, 'block_styles'],
            'header' => [$this, 'block_header'],
            'mainContent' => [$this, 'block_mainContent'],
            'footer' => [$this, 'block_footer'],
            'scripts' => [$this, 'block_scripts'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "base-front-office.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "base-front-office.html.twig"));

        // line 1
        echo "<!doctype html>
<html lang=\"en\">


<!-- Mirrored from pixner.net/bitbetio/main/blog-details.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 10 Feb 2022 21:37:05 GMT -->
<head>
    <meta charset=\"UTF-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"ie=edge\">
    <title>Bitbetio - HTML Template</title>

    <link rel=\"shortcut icon\" href=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("front-office/assets/images/fav.png"), "html", null, true);
        echo "\" type=\"image/x-icon\">
    <link rel=\"stylesheet\" href=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("front-office/assets/css/bootstrap.min.css"), "html", null, true);
        echo "\">
    <link rel=\"stylesheet\" href=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("front-office/assets/css/fontawesome.min.css"), "html", null, true);
        echo "\">
    <link rel=\"stylesheet\" href=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("front-office/assets/css/jquery-ui.css"), "html", null, true);
        echo "\">
    <link rel=\"stylesheet\" href=\"";
        // line 17
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("front-office/assets/css/plugin/nice-select.css"), "html", null, true);
        echo "\">
    <link rel=\"stylesheet\" href=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("front-office/assets/css/plugin/magnific-popup.css"), "html", null, true);
        echo "\">
    <link rel=\"stylesheet\" href=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("front-office/assets/css/plugin/slick.css"), "html", null, true);
        echo "\">
    <link rel=\"stylesheet\" href=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("front-office/assets/css/arafat-font.css"), "html", null, true);
        echo "\">
    <link rel=\"stylesheet\" href=\"";
        // line 21
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("front-office/assets/css/plugin/animate.css"), "html", null, true);
        echo "\">
    <link rel=\"stylesheet\" href=\"";
        // line 22
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("front-office/assets/css/style.css"), "html", null, true);
        echo "\">
    ";
        // line 23
        $this->displayBlock('styles', $context, $blocks);
        // line 25
        echo "</head>

<body>
<!-- start preloader -->
<div class=\"preloader\" id=\"preloader\"></div>
<!-- end preloader -->

<!-- Scroll To Top Start-->
<a href=\"javascript:void(0)\" class=\"scrollToTop\"><i class=\"fas fa-angle-double-up\"></i></a>
<!-- Scroll To Top End -->

<!-- header-section start -->
";
        // line 37
        $this->displayBlock('header', $context, $blocks);
        // line 137
        echo "<!-- Login Registration start -->
<div class=\"log-reg\">
    <div class=\"container\">
        <div class=\"row\">
            <div class=\"col-lg-6\">
                <div class=\"modal fade\" id=\"loginMod\">
                    <div class=\"modal-dialog modal-dialog-centered\">
                        <div class=\"modal-content\">
                            <div class=\"modal-header justify-content-center\">
                                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\"
                                        aria-label=\"Close\"></button>
                            </div>
                            <ul class=\"nav log-reg-btn justify-content-around\">
                                <li class=\"bottom-area\" role=\"presentation\">
                                    <button class=\"nav-link\" id=\"regArea-tab\" data-bs-toggle=\"tab\"
                                            data-bs-target=\"#regArea\" type=\"button\" role=\"tab\" aria-controls=\"regArea\"
                                            aria-selected=\"false\">
                                        SIGN UP
                                    </button>
                                </li>
                                <li class=\"bottom-area\" role=\"presentation\">
                                    <button class=\"nav-link active\" id=\"loginArea-tab\" data-bs-toggle=\"tab\"
                                            data-bs-target=\"#loginArea\" type=\"button\" role=\"tab\"
                                            aria-controls=\"loginArea\" aria-selected=\"true\">
                                        LOGIN
                                    </button>
                                </li>
                            </ul>
                            <div class=\"tab-content\">
                                <div class=\"tab-pane fade show active\" id=\"loginArea\" role=\"tabpanel\"
                                     aria-labelledby=\"loginArea-tab\">
                                    <div class=\"login-reg-content\">
                                        <div class=\"modal-body\">
                                            <div class=\"head-area\">
                                                <h6 class=\"title\">Login Direetly With</h6>
                                                <div class=\"social-link d-flex align-items-center\">
                                                    <a href=\"javascript:void(0)\" class=\"active\"><i
                                                                class=\"fab fa-facebook-f\"></i></a>
                                                    <a href=\"javascript:void(0)\"><i class=\"fab fa-twitter\"></i></a>
                                                    <a href=\"javascript:void(0)\"><i
                                                                class=\"fab fa-linkedin-in\"></i></a>
                                                    <a href=\"javascript:void(0)\"><i
                                                                class=\"fab fa-instagram\"></i></a>
                                                </div>
                                            </div>
                                            <div class=\"form-area\">
                                                <form action=\"#\">
                                                    <div class=\"row\">
                                                        <div class=\"col-12\">
                                                            <div class=\"single-input\">
                                                                <label for=\"logemail\">Email</label>
                                                                <input type=\"text\" id=\"logemail\"
                                                                       placeholder=\"Email Address\">
                                                            </div>
                                                            <div class=\"single-input\">
                                                                <label for=\"logpassword\">Password</label>
                                                                <input type=\"text\" id=\"logpassword\"
                                                                       placeholder=\"Email Password\">
                                                            </div>
                                                        </div>
                                                        <div class=\"col-12\">
                                                            <div class=\"remember-me\">
                                                                <label
                                                                        class=\"checkbox-single d-flex align-items-center\">
                                                                        <span class=\"left-area\">
                                                                            <span class=\"checkbox-area d-flex\">
                                                                                <input type=\"checkbox\"
                                                                                       checked=\"checked\">
                                                                                <span class=\"checkmark\"></span>
                                                                            </span>
                                                                            <span
                                                                                    class=\"item-title d-flex align-items-center\">
                                                                                <span>Remember Me</span>
                                                                            </span>
                                                                        </span>
                                                                </label>
                                                                <a href=\"javascript:void(0)\">Forgot Password</a>
                                                            </div>
                                                        </div>
                                                        <span class=\"btn-border w-100\">
                                                                <button class=\"cmn-btn w-100\">LOGIN</button>
                                                            </span>
                                                    </div>
                                                </form>
                                                <div class=\"bottom-area text-center\">
                                                    <p>Not a member ? <a href=\"javascript:void(0)\" class=\"reg-btn\">Register</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=\"tab-pane fade\" id=\"regArea\" role=\"tabpanel\"
                                     aria-labelledby=\"regArea-tab\">
                                    <div class=\"login-reg-content regMode\">
                                        <div class=\"modal-body\">
                                            <div class=\"head-area\">
                                                <h6 class=\"title\">Register On Bitbetio</h6>
                                                <div class=\"social-link d-flex align-items-center\">
                                                    <a href=\"javascript:void(0)\" class=\"active\"><i
                                                                class=\"fab fa-facebook-f\"></i></a>
                                                    <a href=\"javascript:void(0)\"><i class=\"fab fa-twitter\"></i></a>
                                                    <a href=\"javascript:void(0)\"><i
                                                                class=\"fab fa-linkedin-in\"></i></a>
                                                    <a href=\"javascript:void(0)\"><i
                                                                class=\"fab fa-instagram\"></i></a>
                                                </div>
                                            </div>
                                            <div class=\"form-area\">
                                                <form action=\"#\">
                                                    <div class=\"row\">
                                                        <div class=\"col-12\">
                                                            <div class=\"single-input\">
                                                                <label for=\"regemail\">Email</label>
                                                                <input type=\"text\" id=\"regemail\"
                                                                       placeholder=\"Email Address\">
                                                            </div>
                                                            <div class=\"single-input\">
                                                                <label for=\"regpassword\">Password</label>
                                                                <input type=\"text\" id=\"regpassword\"
                                                                       placeholder=\"Email Password\">
                                                            </div>
                                                            <div class=\"single-input\">
                                                                <label>Country</label>
                                                                <select>
                                                                    <option value=\"1\">United States</option>
                                                                    <option value=\"2\">United Kingdom</option>
                                                                    <option value=\"3\">Canada</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class=\"col-12\">
                                                            <div class=\"remember-me\">
                                                                <a href=\"javascript:void(0)\">Have a referral
                                                                    code?</a>
                                                            </div>
                                                        </div>
                                                        <span class=\"btn-border w-100\">
                                                                <button class=\"cmn-btn w-100\">SIGN UP</button>
                                                            </span>
                                                    </div>
                                                </form>
                                                <div class=\"bottom-area text-center\">
                                                    <p>Already have an member ? <a href=\"javascript:void(0)\"
                                                                                   class=\"log-btn\">Login</a></p>
                                                </div>
                                                <div class=\"counter-area\">
                                                    <div class=\"single\">
                                                        <div class=\"icon-area\">
                                                            <img src=\"";
        // line 285
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("front-office/assets/images/icon/signup-counter-icon-1.png"), "html", null, true);
        echo "\"
                                                                 alt=\"icon\">
                                                        </div>
                                                        <div class=\"text-area\">
                                                            <p>25,179k</p>
                                                            <p class=\"mdr\">Bets</p>
                                                        </div>
                                                    </div>
                                                    <div class=\"single\">
                                                        <div class=\"icon-area\">
                                                            <img src=\"";
        // line 295
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("front-office/assets/images/icon/signup-counter-icon-2.png"), "html", null, true);
        echo "\"
                                                                 alt=\"icon\">
                                                        </div>
                                                        <div class=\"text-area\">
                                                            <p>6.65 BTC</p>
                                                            <p class=\"mdr\">Total Won</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login Registration end -->


<!-- Main content start -->
<section class=\"blog-section ovf-unset\">
    <div class=\"overlay pt-120\">
        <div class=\"container\">
        ";
        // line 323
        $this->displayBlock('mainContent', $context, $blocks);
        // line 325
        echo "    </div>
    </div>
</section>
<!-- Main content end -->
";
        // line 329
        $this->displayBlock('footer', $context, $blocks);
        // line 369
        echo "<!--==================================================================-->
<script src=\"";
        // line 370
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("front-office/assets/js/jquery.min.js"), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 371
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("front-office/assets/js/jquery-ui.js"), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 372
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("front-office/assets/js/bootstrap.min.js"), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 373
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("front-office/assets/js/fontawesome.js"), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 374
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("front-office/assets/js/plugin/slick.js"), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 375
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("front-office/assets/js/plugin/jquery.nice-select.min.js"), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 376
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("front-office/assets/js/plugin/jquery.downCount.js"), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 377
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("front-office/assets/js/plugin/counter.js"), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 378
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("front-office/assets/js/plugin/waypoint.min.js"), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 379
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("front-office/assets/js/plugin/jquery.magnific-popup.min.js"), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 380
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("front-office/assets/js/plugin/wow.min.js"), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 381
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("front-office/assets/js/plugin/plugin.js"), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 382
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("front-office/assets/js/main.js"), "html", null, true);
        echo "\"></script>
";
        // line 383
        $this->displayBlock('scripts', $context, $blocks);
        // line 385
        echo "</body>


</html>";
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 23
    public function block_styles($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "styles"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "styles"));

        // line 24
        echo "    ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 37
    public function block_header($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "header"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "header"));

        // line 38
        echo "<header class=\"header-section\">
    <div class=\"overlay\">
        <div class=\"container\">
            <div class=\"row d-flex header-area\">
                <nav class=\"navbar navbar-expand-lg navbar-light\">
                    <a class=\"navbar-brand\" href=\"index.html\">
                        <img src=\"";
        // line 44
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("front-office/assets/images/logo.png"), "html", null, true);
        echo "\" class=\"logo\" alt=\"logo\">
                    </a>
                    <button class=\"navbar-toggler collapsed\" type=\"button\" data-bs-toggle=\"collapse\"
                            data-bs-target=\"#navbar-content\">
                        <i class=\"fas fa-bars\"></i>
                    </button>
                    <div class=\"collapse navbar-collapse justify-content-end\" id=\"navbar-content\">
                        <ul class=\"navbar-nav mr-auto mb-2 mb-lg-0\">
                            <li class=\"nav-item\">
                                <a class=\"nav-link\" aria-current=\"page\" href=\"index.html\">Home</a>
                            </li>
                            <li class=\"nav-item dropdown main-navbar\">
                                <a class=\"nav-link dropdown-toggle\" href=\"javascript:void(0)\"
                                   data-bs-toggle=\"dropdown\" data-bs-auto-close=\"outside\">Dashboard</a>
                                <ul class=\"dropdown-menu main-menu shadow\">
                                    <li><a class=\"nav-link\" href=\"dashboard.html\">Dashboard</a></li>
                                    <li class=\"dropend sub-navbar\">
                                        <a href=\"javascript:void(0)\" class=\"dropdown-item dropdown-toggle\" data-bs-toggle=\"dropdown\"
                                           data-bs-auto-close=\"outside\">Setting</a>
                                        <ul class=\"dropdown-menu sub-menu shadow\">
                                            <li><a class=\"nav-link\" href=\"personal-details-setting.html\">Personal Details</a></li>
                                            <li><a class=\"nav-link\" href=\"modify-login-password.html\">Change Password</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class=\"nav-item dropdown main-navbar\">
                                <a class=\"nav-link dropdown-toggle\" href=\"javascript:void(0)\"
                                   data-bs-toggle=\"dropdown\" data-bs-auto-close=\"outside\">Sports</a>
                                <ul class=\"dropdown-menu main-menu shadow\">
                                    <li><a class=\"nav-link\" href=\"soccer-bets-2.html\">Tennis</a></li>
                                    <li><a class=\"nav-link\" href=\"soccer-bets-1.html\">Soccer</a></li>
                                    <li><a class=\"nav-link\" href=\"soccer-bets-2.html\">NBA</a></li>
                                </ul>
                            </li>
                            <li class=\"nav-item dropdown main-navbar\">
                                <a class=\"nav-link dropdown-toggle\" href=\"javascript:void(0)\"
                                   data-bs-toggle=\"dropdown\" data-bs-auto-close=\"outside\">Currency</a>
                                <ul class=\"dropdown-menu main-menu shadow\">
                                    <li><a class=\"nav-link\" href=\"escrow-bets-fee.html\">Escrow Bets Fee</a></li>
                                    <li><a class=\"nav-link\" href=\"currency-bet.html\">Currency Bet</a></li>
                                    <li><a class=\"nav-link\" href=\"betting-details.html\">Betting Details</a></li>
                                    <li><a class=\"nav-link\" href=\"create-new-currency.html\">Create Currency</a></li>
                                </ul>
                            </li>
                            <li class=\"nav-item dropdown main-navbar\">
                                <a class=\"nav-link dropdown-toggle active\" href=\"javascript:void(0)\"
                                   data-bs-toggle=\"dropdown\" data-bs-auto-close=\"outside\">Pages</a>
                                <ul class=\"dropdown-menu main-menu shadow\">
                                    <li class=\"dropend sub-navbar\">
                                        <a href=\"javascript:void(0)\" class=\"dropdown-item dropdown-toggle\" data-bs-toggle=\"dropdown\"
                                           data-bs-auto-close=\"outside\">Tournaments</a>
                                        <ul class=\"dropdown-menu sub-menu shadow\">
                                            <li><a class=\"nav-link\" href=\"tournaments.html\">Tournaments</a></li>
                                            <li><a class=\"nav-link\" href=\"tournaments-details.html\">Tournaments Details</a></li>
                                        </ul>
                                    </li>
                                    <li class=\"dropend sub-navbar\">
                                        <a href=\"javascript:void(0)\" class=\"dropdown-item dropdown-toggle\" data-bs-toggle=\"dropdown\"
                                           data-bs-auto-close=\"outside\">Blog</a>
                                        <ul class=\"dropdown-menu sub-menu shadow\">
                                            <li><a class=\"nav-link\" href=\"blog.html\">Blog</a></li>
                                            <li><a class=\"nav-link\" href=\"blog-details.html\">Blog Details</a></li>
                                        </ul>
                                    </li>
                                    <li><a class=\"nav-link\" href=\"affiliate.html\">Affiliate</a></li>
                                    <li><a class=\"nav-link\" href=\"faqs.html\">Faqs</a></li>
                                    <li><a class=\"nav-link\" href=\"privacy-policy.html\">Privacy Policy</a></li>
                                    <li><a class=\"nav-link\" href=\"terms-conditions.html\">Terms Conditions</a></li>
                                    <li><a class=\"nav-link\" href=\"error.html\">Error</a></li>
                                </ul>
                            </li>
                            <li class=\"nav-item\">
                                <a class=\"nav-link\" href=\"contact.html\">Contact</a>
                            </li>
                        </ul>
                        <div class=\"right-area header-action d-flex align-items-center max-un\">
                            <button type=\"button\" class=\"login\" data-bs-toggle=\"modal\" data-bs-target=\"#loginMod\">
                                Login
                            </button>
                            <button type=\"button\" class=\"cmn-btn reg\" data-bs-toggle=\"modal\"
                                    data-bs-target=\"#loginMod\">
                                Sign Up
                            </button>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- header-section end -->
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 323
    public function block_mainContent($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "mainContent"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "mainContent"));

        // line 324
        echo "        ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 329
    public function block_footer($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "footer"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "footer"));

        // line 330
        echo "<!-- Footer Area Start -->
<footer class=\"footer-section\">
    <div class=\"container pt-120\">

        <div class=\"footer-bottom-area pt-120\">
            <div class=\"row\">
                <div class=\"col-xl-12\">
                    <div class=\"menu-item\">
                        <a href=\"index.html\" class=\"logo\">
                            <img src=\"";
        // line 339
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("front-office/assets/images/logo.png"), "html", null, true);
        echo "\" alt=\"logo\">
                        </a>
                        <ul class=\"footer-link\">
                            <li><a href=\"contact.html\">Contact</a></li>
                            <li><a href=\"terms-conditions.html\">Terms of Services</a></li>
                            <li><a href=\"privacy-policy.html\">Privacy</a></li>
                        </ul>
                    </div>
                </div>
                <div class=\"col-12\">
                    <div class=\"copyright\">
                        <div class=\"copy-area\">
                            <p> Copyright © <a href=\"index.html\">Bitbetio</a> | Designed by
                                <a href=\"https://themeforest.net/user/pixelaxis\" class=\"auth\">Pixelaxis</a>
                            </p>
                        </div>
                        <div class=\"social-link d-flex align-items-center\">
                            <a href=\"javascript:void(0)\"><i class=\"fab fa-facebook-f\"></i></a>
                            <a href=\"javascript:void(0)\"><i class=\"fab fa-twitter\"></i></a>
                            <a href=\"javascript:void(0)\"><i class=\"fab fa-linkedin-in\"></i></a>
                            <a href=\"javascript:void(0)\"><i class=\"fab fa-instagram\"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Area End -->
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 383
    public function block_scripts($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "scripts"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "scripts"));

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "base-front-office.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  616 => 383,  576 => 339,  565 => 330,  555 => 329,  545 => 324,  535 => 323,  432 => 44,  424 => 38,  414 => 37,  404 => 24,  394 => 23,  381 => 385,  379 => 383,  375 => 382,  371 => 381,  367 => 380,  363 => 379,  359 => 378,  355 => 377,  351 => 376,  347 => 375,  343 => 374,  339 => 373,  335 => 372,  331 => 371,  327 => 370,  324 => 369,  322 => 329,  316 => 325,  314 => 323,  283 => 295,  270 => 285,  120 => 137,  118 => 37,  104 => 25,  102 => 23,  98 => 22,  94 => 21,  90 => 20,  86 => 19,  82 => 18,  78 => 17,  74 => 16,  70 => 15,  66 => 14,  62 => 13,  48 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!doctype html>
<html lang=\"en\">


<!-- Mirrored from pixner.net/bitbetio/main/blog-details.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 10 Feb 2022 21:37:05 GMT -->
<head>
    <meta charset=\"UTF-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"ie=edge\">
    <title>Bitbetio - HTML Template</title>

    <link rel=\"shortcut icon\" href=\"{{ asset('front-office/assets/images/fav.png') }}\" type=\"image/x-icon\">
    <link rel=\"stylesheet\" href=\"{{ asset('front-office/assets/css/bootstrap.min.css') }}\">
    <link rel=\"stylesheet\" href=\"{{ asset('front-office/assets/css/fontawesome.min.css') }}\">
    <link rel=\"stylesheet\" href=\"{{ asset('front-office/assets/css/jquery-ui.css') }}\">
    <link rel=\"stylesheet\" href=\"{{ asset('front-office/assets/css/plugin/nice-select.css') }}\">
    <link rel=\"stylesheet\" href=\"{{ asset('front-office/assets/css/plugin/magnific-popup.css') }}\">
    <link rel=\"stylesheet\" href=\"{{ asset('front-office/assets/css/plugin/slick.css') }}\">
    <link rel=\"stylesheet\" href=\"{{ asset('front-office/assets/css/arafat-font.css') }}\">
    <link rel=\"stylesheet\" href=\"{{ asset('front-office/assets/css/plugin/animate.css') }}\">
    <link rel=\"stylesheet\" href=\"{{ asset('front-office/assets/css/style.css') }}\">
    {% block styles %}
    {% endblock %}
</head>

<body>
<!-- start preloader -->
<div class=\"preloader\" id=\"preloader\"></div>
<!-- end preloader -->

<!-- Scroll To Top Start-->
<a href=\"javascript:void(0)\" class=\"scrollToTop\"><i class=\"fas fa-angle-double-up\"></i></a>
<!-- Scroll To Top End -->

<!-- header-section start -->
{% block header %}
<header class=\"header-section\">
    <div class=\"overlay\">
        <div class=\"container\">
            <div class=\"row d-flex header-area\">
                <nav class=\"navbar navbar-expand-lg navbar-light\">
                    <a class=\"navbar-brand\" href=\"index.html\">
                        <img src=\"{{ asset('front-office/assets/images/logo.png') }}\" class=\"logo\" alt=\"logo\">
                    </a>
                    <button class=\"navbar-toggler collapsed\" type=\"button\" data-bs-toggle=\"collapse\"
                            data-bs-target=\"#navbar-content\">
                        <i class=\"fas fa-bars\"></i>
                    </button>
                    <div class=\"collapse navbar-collapse justify-content-end\" id=\"navbar-content\">
                        <ul class=\"navbar-nav mr-auto mb-2 mb-lg-0\">
                            <li class=\"nav-item\">
                                <a class=\"nav-link\" aria-current=\"page\" href=\"index.html\">Home</a>
                            </li>
                            <li class=\"nav-item dropdown main-navbar\">
                                <a class=\"nav-link dropdown-toggle\" href=\"javascript:void(0)\"
                                   data-bs-toggle=\"dropdown\" data-bs-auto-close=\"outside\">Dashboard</a>
                                <ul class=\"dropdown-menu main-menu shadow\">
                                    <li><a class=\"nav-link\" href=\"dashboard.html\">Dashboard</a></li>
                                    <li class=\"dropend sub-navbar\">
                                        <a href=\"javascript:void(0)\" class=\"dropdown-item dropdown-toggle\" data-bs-toggle=\"dropdown\"
                                           data-bs-auto-close=\"outside\">Setting</a>
                                        <ul class=\"dropdown-menu sub-menu shadow\">
                                            <li><a class=\"nav-link\" href=\"personal-details-setting.html\">Personal Details</a></li>
                                            <li><a class=\"nav-link\" href=\"modify-login-password.html\">Change Password</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class=\"nav-item dropdown main-navbar\">
                                <a class=\"nav-link dropdown-toggle\" href=\"javascript:void(0)\"
                                   data-bs-toggle=\"dropdown\" data-bs-auto-close=\"outside\">Sports</a>
                                <ul class=\"dropdown-menu main-menu shadow\">
                                    <li><a class=\"nav-link\" href=\"soccer-bets-2.html\">Tennis</a></li>
                                    <li><a class=\"nav-link\" href=\"soccer-bets-1.html\">Soccer</a></li>
                                    <li><a class=\"nav-link\" href=\"soccer-bets-2.html\">NBA</a></li>
                                </ul>
                            </li>
                            <li class=\"nav-item dropdown main-navbar\">
                                <a class=\"nav-link dropdown-toggle\" href=\"javascript:void(0)\"
                                   data-bs-toggle=\"dropdown\" data-bs-auto-close=\"outside\">Currency</a>
                                <ul class=\"dropdown-menu main-menu shadow\">
                                    <li><a class=\"nav-link\" href=\"escrow-bets-fee.html\">Escrow Bets Fee</a></li>
                                    <li><a class=\"nav-link\" href=\"currency-bet.html\">Currency Bet</a></li>
                                    <li><a class=\"nav-link\" href=\"betting-details.html\">Betting Details</a></li>
                                    <li><a class=\"nav-link\" href=\"create-new-currency.html\">Create Currency</a></li>
                                </ul>
                            </li>
                            <li class=\"nav-item dropdown main-navbar\">
                                <a class=\"nav-link dropdown-toggle active\" href=\"javascript:void(0)\"
                                   data-bs-toggle=\"dropdown\" data-bs-auto-close=\"outside\">Pages</a>
                                <ul class=\"dropdown-menu main-menu shadow\">
                                    <li class=\"dropend sub-navbar\">
                                        <a href=\"javascript:void(0)\" class=\"dropdown-item dropdown-toggle\" data-bs-toggle=\"dropdown\"
                                           data-bs-auto-close=\"outside\">Tournaments</a>
                                        <ul class=\"dropdown-menu sub-menu shadow\">
                                            <li><a class=\"nav-link\" href=\"tournaments.html\">Tournaments</a></li>
                                            <li><a class=\"nav-link\" href=\"tournaments-details.html\">Tournaments Details</a></li>
                                        </ul>
                                    </li>
                                    <li class=\"dropend sub-navbar\">
                                        <a href=\"javascript:void(0)\" class=\"dropdown-item dropdown-toggle\" data-bs-toggle=\"dropdown\"
                                           data-bs-auto-close=\"outside\">Blog</a>
                                        <ul class=\"dropdown-menu sub-menu shadow\">
                                            <li><a class=\"nav-link\" href=\"blog.html\">Blog</a></li>
                                            <li><a class=\"nav-link\" href=\"blog-details.html\">Blog Details</a></li>
                                        </ul>
                                    </li>
                                    <li><a class=\"nav-link\" href=\"affiliate.html\">Affiliate</a></li>
                                    <li><a class=\"nav-link\" href=\"faqs.html\">Faqs</a></li>
                                    <li><a class=\"nav-link\" href=\"privacy-policy.html\">Privacy Policy</a></li>
                                    <li><a class=\"nav-link\" href=\"terms-conditions.html\">Terms Conditions</a></li>
                                    <li><a class=\"nav-link\" href=\"error.html\">Error</a></li>
                                </ul>
                            </li>
                            <li class=\"nav-item\">
                                <a class=\"nav-link\" href=\"contact.html\">Contact</a>
                            </li>
                        </ul>
                        <div class=\"right-area header-action d-flex align-items-center max-un\">
                            <button type=\"button\" class=\"login\" data-bs-toggle=\"modal\" data-bs-target=\"#loginMod\">
                                Login
                            </button>
                            <button type=\"button\" class=\"cmn-btn reg\" data-bs-toggle=\"modal\"
                                    data-bs-target=\"#loginMod\">
                                Sign Up
                            </button>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- header-section end -->
{% endblock %}
<!-- Login Registration start -->
<div class=\"log-reg\">
    <div class=\"container\">
        <div class=\"row\">
            <div class=\"col-lg-6\">
                <div class=\"modal fade\" id=\"loginMod\">
                    <div class=\"modal-dialog modal-dialog-centered\">
                        <div class=\"modal-content\">
                            <div class=\"modal-header justify-content-center\">
                                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\"
                                        aria-label=\"Close\"></button>
                            </div>
                            <ul class=\"nav log-reg-btn justify-content-around\">
                                <li class=\"bottom-area\" role=\"presentation\">
                                    <button class=\"nav-link\" id=\"regArea-tab\" data-bs-toggle=\"tab\"
                                            data-bs-target=\"#regArea\" type=\"button\" role=\"tab\" aria-controls=\"regArea\"
                                            aria-selected=\"false\">
                                        SIGN UP
                                    </button>
                                </li>
                                <li class=\"bottom-area\" role=\"presentation\">
                                    <button class=\"nav-link active\" id=\"loginArea-tab\" data-bs-toggle=\"tab\"
                                            data-bs-target=\"#loginArea\" type=\"button\" role=\"tab\"
                                            aria-controls=\"loginArea\" aria-selected=\"true\">
                                        LOGIN
                                    </button>
                                </li>
                            </ul>
                            <div class=\"tab-content\">
                                <div class=\"tab-pane fade show active\" id=\"loginArea\" role=\"tabpanel\"
                                     aria-labelledby=\"loginArea-tab\">
                                    <div class=\"login-reg-content\">
                                        <div class=\"modal-body\">
                                            <div class=\"head-area\">
                                                <h6 class=\"title\">Login Direetly With</h6>
                                                <div class=\"social-link d-flex align-items-center\">
                                                    <a href=\"javascript:void(0)\" class=\"active\"><i
                                                                class=\"fab fa-facebook-f\"></i></a>
                                                    <a href=\"javascript:void(0)\"><i class=\"fab fa-twitter\"></i></a>
                                                    <a href=\"javascript:void(0)\"><i
                                                                class=\"fab fa-linkedin-in\"></i></a>
                                                    <a href=\"javascript:void(0)\"><i
                                                                class=\"fab fa-instagram\"></i></a>
                                                </div>
                                            </div>
                                            <div class=\"form-area\">
                                                <form action=\"#\">
                                                    <div class=\"row\">
                                                        <div class=\"col-12\">
                                                            <div class=\"single-input\">
                                                                <label for=\"logemail\">Email</label>
                                                                <input type=\"text\" id=\"logemail\"
                                                                       placeholder=\"Email Address\">
                                                            </div>
                                                            <div class=\"single-input\">
                                                                <label for=\"logpassword\">Password</label>
                                                                <input type=\"text\" id=\"logpassword\"
                                                                       placeholder=\"Email Password\">
                                                            </div>
                                                        </div>
                                                        <div class=\"col-12\">
                                                            <div class=\"remember-me\">
                                                                <label
                                                                        class=\"checkbox-single d-flex align-items-center\">
                                                                        <span class=\"left-area\">
                                                                            <span class=\"checkbox-area d-flex\">
                                                                                <input type=\"checkbox\"
                                                                                       checked=\"checked\">
                                                                                <span class=\"checkmark\"></span>
                                                                            </span>
                                                                            <span
                                                                                    class=\"item-title d-flex align-items-center\">
                                                                                <span>Remember Me</span>
                                                                            </span>
                                                                        </span>
                                                                </label>
                                                                <a href=\"javascript:void(0)\">Forgot Password</a>
                                                            </div>
                                                        </div>
                                                        <span class=\"btn-border w-100\">
                                                                <button class=\"cmn-btn w-100\">LOGIN</button>
                                                            </span>
                                                    </div>
                                                </form>
                                                <div class=\"bottom-area text-center\">
                                                    <p>Not a member ? <a href=\"javascript:void(0)\" class=\"reg-btn\">Register</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=\"tab-pane fade\" id=\"regArea\" role=\"tabpanel\"
                                     aria-labelledby=\"regArea-tab\">
                                    <div class=\"login-reg-content regMode\">
                                        <div class=\"modal-body\">
                                            <div class=\"head-area\">
                                                <h6 class=\"title\">Register On Bitbetio</h6>
                                                <div class=\"social-link d-flex align-items-center\">
                                                    <a href=\"javascript:void(0)\" class=\"active\"><i
                                                                class=\"fab fa-facebook-f\"></i></a>
                                                    <a href=\"javascript:void(0)\"><i class=\"fab fa-twitter\"></i></a>
                                                    <a href=\"javascript:void(0)\"><i
                                                                class=\"fab fa-linkedin-in\"></i></a>
                                                    <a href=\"javascript:void(0)\"><i
                                                                class=\"fab fa-instagram\"></i></a>
                                                </div>
                                            </div>
                                            <div class=\"form-area\">
                                                <form action=\"#\">
                                                    <div class=\"row\">
                                                        <div class=\"col-12\">
                                                            <div class=\"single-input\">
                                                                <label for=\"regemail\">Email</label>
                                                                <input type=\"text\" id=\"regemail\"
                                                                       placeholder=\"Email Address\">
                                                            </div>
                                                            <div class=\"single-input\">
                                                                <label for=\"regpassword\">Password</label>
                                                                <input type=\"text\" id=\"regpassword\"
                                                                       placeholder=\"Email Password\">
                                                            </div>
                                                            <div class=\"single-input\">
                                                                <label>Country</label>
                                                                <select>
                                                                    <option value=\"1\">United States</option>
                                                                    <option value=\"2\">United Kingdom</option>
                                                                    <option value=\"3\">Canada</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class=\"col-12\">
                                                            <div class=\"remember-me\">
                                                                <a href=\"javascript:void(0)\">Have a referral
                                                                    code?</a>
                                                            </div>
                                                        </div>
                                                        <span class=\"btn-border w-100\">
                                                                <button class=\"cmn-btn w-100\">SIGN UP</button>
                                                            </span>
                                                    </div>
                                                </form>
                                                <div class=\"bottom-area text-center\">
                                                    <p>Already have an member ? <a href=\"javascript:void(0)\"
                                                                                   class=\"log-btn\">Login</a></p>
                                                </div>
                                                <div class=\"counter-area\">
                                                    <div class=\"single\">
                                                        <div class=\"icon-area\">
                                                            <img src=\"{{ asset('front-office/assets/images/icon/signup-counter-icon-1.png') }}\"
                                                                 alt=\"icon\">
                                                        </div>
                                                        <div class=\"text-area\">
                                                            <p>25,179k</p>
                                                            <p class=\"mdr\">Bets</p>
                                                        </div>
                                                    </div>
                                                    <div class=\"single\">
                                                        <div class=\"icon-area\">
                                                            <img src=\"{{ asset('front-office/assets/images/icon/signup-counter-icon-2.png') }}\"
                                                                 alt=\"icon\">
                                                        </div>
                                                        <div class=\"text-area\">
                                                            <p>6.65 BTC</p>
                                                            <p class=\"mdr\">Total Won</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login Registration end -->


<!-- Main content start -->
<section class=\"blog-section ovf-unset\">
    <div class=\"overlay pt-120\">
        <div class=\"container\">
        {% block mainContent %}
        {% endblock %}
    </div>
    </div>
</section>
<!-- Main content end -->
{% block footer %}
<!-- Footer Area Start -->
<footer class=\"footer-section\">
    <div class=\"container pt-120\">

        <div class=\"footer-bottom-area pt-120\">
            <div class=\"row\">
                <div class=\"col-xl-12\">
                    <div class=\"menu-item\">
                        <a href=\"index.html\" class=\"logo\">
                            <img src=\"{{ asset('front-office/assets/images/logo.png') }}\" alt=\"logo\">
                        </a>
                        <ul class=\"footer-link\">
                            <li><a href=\"contact.html\">Contact</a></li>
                            <li><a href=\"terms-conditions.html\">Terms of Services</a></li>
                            <li><a href=\"privacy-policy.html\">Privacy</a></li>
                        </ul>
                    </div>
                </div>
                <div class=\"col-12\">
                    <div class=\"copyright\">
                        <div class=\"copy-area\">
                            <p> Copyright © <a href=\"index.html\">Bitbetio</a> | Designed by
                                <a href=\"https://themeforest.net/user/pixelaxis\" class=\"auth\">Pixelaxis</a>
                            </p>
                        </div>
                        <div class=\"social-link d-flex align-items-center\">
                            <a href=\"javascript:void(0)\"><i class=\"fab fa-facebook-f\"></i></a>
                            <a href=\"javascript:void(0)\"><i class=\"fab fa-twitter\"></i></a>
                            <a href=\"javascript:void(0)\"><i class=\"fab fa-linkedin-in\"></i></a>
                            <a href=\"javascript:void(0)\"><i class=\"fab fa-instagram\"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Area End -->
{% endblock %}
<!--==================================================================-->
<script src=\"{{ asset('front-office/assets/js/jquery.min.js') }}\"></script>
<script src=\"{{ asset('front-office/assets/js/jquery-ui.js') }}\"></script>
<script src=\"{{ asset('front-office/assets/js/bootstrap.min.js') }}\"></script>
<script src=\"{{ asset('front-office/assets/js/fontawesome.js') }}\"></script>
<script src=\"{{ asset('front-office/assets/js/plugin/slick.js') }}\"></script>
<script src=\"{{ asset('front-office/assets/js/plugin/jquery.nice-select.min.js') }}\"></script>
<script src=\"{{ asset('front-office/assets/js/plugin/jquery.downCount.js') }}\"></script>
<script src=\"{{ asset('front-office/assets/js/plugin/counter.js') }}\"></script>
<script src=\"{{ asset('front-office/assets/js/plugin/waypoint.min.js') }}\"></script>
<script src=\"{{ asset('front-office/assets/js/plugin/jquery.magnific-popup.min.js') }}\"></script>
<script src=\"{{ asset('front-office/assets/js/plugin/wow.min.js') }}\"></script>
<script src=\"{{ asset('front-office/assets/js/plugin/plugin.js') }}\"></script>
<script src=\"{{ asset('front-office/assets/js/main.js') }}\"></script>
{% block scripts %}
{% endblock %}
</body>


</html>", "base-front-office.html.twig", "C:\\Users\\Ahmed Mahjoub\\Workspace\\Calometre\\templates\\base-front-office.html.twig");
    }
}
