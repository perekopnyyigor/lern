<?php
require_once "Object/punkt.php";
require_once "pages.php";
require_once "Object/article.php";
class Browse extends Pages
{
    public function view($id)
    {


        $punkt = new Punkt($id);
        $article = new Article($id);

        $this->header($article->title, $article->keyword, $article->description, $article->img);

        if($punkt->generate==2)
        {
            $this->name($punkt->name);
            $this->menu($id);
        }
        else if ($punkt->generate==4)
        {
            $parent = new Punkt($punkt->parent);
            $grand_parent = new Punkt($parent->parent);
            $this->name($grand_parent->name);
            $this->menu($grand_parent->id);

            $this->team($article->text);
        }
        $this->seo($article->title,$article->description,$article->img);
        $this->social();

    }
    private function social()
    {




    echo '<script src="https://yastatic.net/share2/share.js"></script>
<div class="ya-share2" data-curtain data-shape="round" data-limit="3" data-services="vkontakte,facebook,odnoklassniki,telegram"></div>';
    }
    private function seo($title, $description, $img)
    {

        echo '<div class="seo_browse" itemscope itemtype="http://schema.org/CreativeWork">';

       echo "<img itemprop=\"image\" alt=\"essay cover\" src=".$img." />";

       echo '<meta itemprop="learningResourceType" content="StudentEssay">';
       echo '<span itemprop="name">'.$title.'</span>';
       echo '<span itemprop="author">tiwy.ru</span>';
       echo '<span itemprop="description">'.$description.'</div>';
    }
    public function team($text)
    {
        $text = str_replace("doubleslash","\\",$text);
        echo "<div class='article'>".$text."</div>";
        echo '<script src="browse.js"></script>';
    }


}
?>