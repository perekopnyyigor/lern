<?php
require_once "Object/punkt.php";
require_once "Object/article.php";
require_once "Pages/pages.php";
class Redact extends Pages
{
    public function view($id)
    {
        $punkt = new Punkt($id);
        $article = new Article($id);
        $this->header();
        $this->menu_redact();
        $this->name($punkt->name);

       $this->form($article,$id);

        echo '<script src="redactor.js"></script>';
    }
    private function menu_redact()
    {
        echo '<div id="menu" class="main_menu">';

        echo '</div>';


    }
    private function form($article, $id)
    {
        $text = str_replace("doubleslash","\\\\",$article->text);
        echo '<form action="https://tiwy.ru/index.php?action=save" method="post">';
        echo "<p><textarea rows=\"50\" cols=\"150\" name=\"text\" id=\"text\">".$text."</textarea></p>";
        echo "<input type=\"hidden\" name=\"id\"  value=\"".$id."\" >";
        echo ' <input type="submit" /></form>';
    }
    public function add()
    {
        $text = str_replace("\\\\","doubleslash",$_POST["text"]);
        Article::add($_POST["id"],$text);
    }
}
?>