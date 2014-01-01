<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "model" . DIRECTORY_SEPARATOR . "TimeValidator.php";

class HtmlHelper
{
    public function getHeader()
    {
        $html = "";
        $html .= "<!doctype html>" . "\n";
        $html .= "<html lang=\"en\">" . "\n";
        $html .= "\n";
        $html .= "<head>" . "\n";
        $html .= "  <meta charset=\"UTF-8\">" . "\n";
        $html .= "  <meta name=\"viewport\" content=\"width=device-width\">" . "\n";
        $html .= "\n";
        $html .= "  <link href=\"css/foundation.min.css\" rel=\"stylesheet\">" . "\n";
        $html .= "  <title>Rodyklės</title>" . "\n";
        $html .= "</head>" . "\n";
        $html .= "\n";
        $html .= "<body>" . "\n";

        return $html;
    }

    public function getMenu()
    {
        $html = "";
        $html .= "  <nav class=\"top-bar\" data-topbar>" . "\n";
        $html .= "    <ul class=\"title-area\">" . "\n";
        $html .= "      <li class=\"name\">" . "\n";
        $html .= "        <h1><a href=\"#\">Laikrodis</a></h1>" . "\n";
        $html .= "      </li>" . "\n";
        $html .= "      <li class=\"toggle-topbar menu-icon\"><a href=\"#\"><span>Menu</span></a></li>" . "\n";
        $html .= "    </ul>" . "\n";
        $html .= "\n";
        $html .= "  </nav>" . "\n";

        return $html;
    }

    public function getDescription()
    {
        $html = "";
        $html .= "  <div class=\"row\"><h1>Laikrodis</h1></div>" . "\n";

        return $html;
    }

    public function getTimeForm()
    {
        $time_validator = new TimeValidator();

        $html = "";
        $html .= "  <div class=\"row\">" . "\n";
        $html .= "    <div class=\"large-12 columns\">" . "\n";
        $html .= "      <p>Įveskite <span class=\"label\">laiką</span> ir nuspauskite mygtuką <span class=\"label success\">apskaičiuoti</span></p>" . "\n";
        $html .= "    </div>" . "\n";
        $html .= "  </div>" . "\n";
        $html .= "  <div class=\"row\">" . "\n";
        $html .= "    <div class=\"large-12 columns\">" . "\n";
        $html .= "      <form action=\"index.php\" method=\"POST\" data-abide>" . "\n";
        $html .= "        <div class=\"row collapse\">" . "\n";
        $html .= "          <div class=\"large-1 columns\">" . "\n";
        $html .= "            <span class=\"prefix\">Laikas</span>" . "\n";
        $html .= "          </div>" . "\n";
        $html .= "          <div class=\"large-1 columns\">" . "\n";
        $html .= "            <input type=\"text\" placeholder=\"00:00:00\" pattern=\"" . $time_validator->getRegex() . "\" id=\"time\" name=\"time\" required />" . "\n";
        $html .= "            <small class=\"error\">Nurodykite teisingą laiką (pvz.: 18:20:00)</small>" . "\n";
        $html .= "          </div>" . "\n";
        $html .= "          <div class=\"large-2 columns\">" . "\n";
        $html .= "            <input class=\"button success postfix\" type=\"submit\" name=\"calculate\" value=\"apskaičiuoti\" />" . "\n";
        $html .= "          </div>" . "\n";
        $html .= "          <div class=\"large-8 columns\"></div>" . "\n";
        $html .= "        </div>" . "\n";
        $html .= "      </form>" . "\n";
        $html .= "    </div>" . "\n";
        $html .= "  </div>" . "\n";

        return $html;
    }

    public function getResult($time, $min_angle, $max_angle)
    {
        $html = "";
        $html .= "  <div class=\"row\">" . "\n";
        $html .= "    <div class=\"large-12 columns\">" . "\n";
        $html .= "      <hr>" . "\n";
        $html .= "      <p>mažiausias kampas tarp analoginio laikrodžio valandos ir minučių rodyklių, kai laikas yra <span class=\"label\">" . $time . "</span>, lygus: <span class=\"label success\">" . $min_angle . "</span></p>" . "\n";
        $html .= "    </div>" . "\n";
        $html .= "  </div>" . "\n";
        $html .= "  <div class=\"row\">" . "\n";
        $html .= "    <div class=\"large-12 columns\">" . "\n";
        $html .= "      <p>didžiausias kampas tarp analoginio laikrodžio valandos ir minučių rodyklių, kai laikas yra <span class=\"label\">" . $time . "</span>, lygus: <span class=\"label alert\">" . $max_angle . "</span></p>" . "\n";
        $html .= "      <hr>" . "\n";
        $html .= "    </div>" . "\n";
        $html .= "  </div>" . "\n";

        return $html;
    }

    public function getSvgClock($svg_clock_html)
    {
        $html = "";
        $html .= "  <div class=\"row\">" . "\n";
        $html .= "    <div class=\"large-12 columns\">" . "\n";
        $html .= $svg_clock_html;
        $html .= "    </div>" . "\n";
        $html .= "  </div>" . "\n";

        return $html;
    }

    public function getFooter()
    {
        $html = "";

        $html .= "<script>" . "\n";
        $html .= "document.write('<script src=' +" . "\n";
        $html .= "('__proto__' in {} ? 'js/vendor/zepto' : 'js/vendor/jquery') +" . "\n";
        $html .= "'.js><\/script>')" . "\n";
        $html .= "</script>" . "\n";
        $html .= "<script src=\"js/foundation.min.js\"></script>" . "\n";

        $html .= "<script>" . "\n";
        $html .= "$(document).foundation();" . "\n";
        $html .= "</script>" . "\n";

        $html .= "</body>" . "\n";
        $html .= "\n";
        $html .= "</html>" . "\n";

        return $html;
    }
}