<?php
require_once "Object/punkt.php";
require_once "pages.php";
require_once "Object/article.php";
class Browse extends Pages
{
    public function view($id)
    {


        $punkt = new Punkt($id);
        $this->header();

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
            $article = new Article($id);
            $this->team($article->text);
        }



    }
    public function team($text)
    {
        $text = str_replace("doubleslash","\\",$text);
        echo "<div class='article'>".$text."</div>";
        echo '<script src="browse.js"></script>';
    }


}
?>