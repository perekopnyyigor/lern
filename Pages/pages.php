<?php
require_once "database.php";
require_once "Object/article.php";
abstract class Pages
{
    public function header($title="",$keyword="",$description="",$img="")
    {
        echo '<!DOCTYPE html>';
        echo '<html prefix="og: http://ogp.me/ns#">';
        echo '<head itemscope itemtype="http://schema.org/WPHeader">';

        echo '<title itemprop="headline">'.$title.'</title>';
        echo '<meta itemprop="description" name="description" content="'.$description.'">';
        echo '<meta itemprop="keywords" name="keywords" content="'.$keyword.'">';


        echo '<meta property="og:type"               content="article" />';
        echo '<meta property="og:title"              content="'.$title.'" />';
        echo '<meta property="og:description"        content="'.$description.'" />';
        echo '<meta property="og:image"              content="'.$img.'" />';

        echo '<meta property="og:url"              content="https://tiwy.ru'.$_SERVER['REQUEST_URI'].'" />';

        echo '<meta name="viewport" content="width=device-width">';
        echo '<link rel="stylesheet" type="text/css" href="Style/menu.css">';
        echo '<link rel="stylesheet" type="text/css" href="Style/style.css">';
        echo '<link rel="stylesheet" type="text/css" href="Style/mob_style.css">';
        echo '<link rel="stylesheet" type="text/css" href="Style/style_600_1000.css">';

        echo '<link rel="stylesheet" href="Katex/katex.min.css">';
        echo '<script src="Katex/katex.min.js"></script>';

        echo '<link rel="stylesheet" href="Chem/easychem.css">';
        echo '<script src="Chem/easychem.js"></script>';

        echo '<link rel="stylesheet" href="Code/styles/color-brewer.min.css">';
        echo '<script src="Code/highlight.min.js"></script>';
        echo '<script type="text/javascript" src="https://vk.com/js/api/share.js?95" charset="windows-1251"></script>';
        echo '</head>';

        echo "
        <!-- Yandex.Metrika counter -->
        <script type=\"text/javascript\" >
           (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
           m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
           (window, document, \"script\", \"https://mc.yandex.ru/metrika/tag.js\", \"ym\");
        
           ym(85830240, \"init\", {
                clickmap:true,
                trackLinks:true,
                accurateTrackBounce:true,
                webvisor:true
           });
        </script>
        <noscript><div><img src=\"https://mc.yandex.ru/watch/85830240\" style=\"position:absolute; left:-9999px;\" alt=\"\" /></div></noscript>
        <!-- /Yandex.Metrika counter -->
        ";


    }
    public function name($name)
    {
        echo '<div class="head_name">'.$name.'</div>';
    }
    public function menu($id_arg)
    {
        echo '
        <div class="hamburger-menu">
  <input id="menu__toggle" type="checkbox" />
  <label class="menu__btn" for="menu__toggle">
    <span></span>
  </label>
        ';
        echo '<ul class="main_menu">';

        $id_massiv = Punkt::child($id_arg);
        foreach ($id_massiv as $id)
        {
            $punkt = new Punkt($id);
            echo '<li class ="punkt1">'.$punkt->name.'</li>';
            $id_punkt_massiv = Punkt::child($punkt->id);
            foreach ($id_punkt_massiv as $id_punkt)
            {
                $sub_punkt = new Punkt($id_punkt);
                echo '<div class ="punkt2"><a href="https://tiwy.ru/index.php?action=browse&parent='.$sub_punkt->id.'">'.$sub_punkt->name.'</a></div>';
            }
        }
        echo "</ul>";
    }
    public function anons($teams)
    {
        foreach ($teams as $id)
        {
            $article =new Article($id);
            echo "<div class='punkt'>";
            echo '<a href="https://tiwy.ru/index.php?action=browse&parent='.$article->id.'">'.$article->title.'</a><br>';
            echo '<img  src="'.$article->img.'">';
            echo '<p>'.$article->description.'</p>';
            echo "</div>";
        }
    }

}
?>