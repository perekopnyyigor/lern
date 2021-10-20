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
            //$this->name($punkt->name);
            $this->breadcrumb($punkt);
            $this->menu($id);
            $this->list_anons($id);
        }
        else if ($punkt->generate==4)
        {
            $parent = new Punkt($punkt->parent);
            $grand_parent = new Punkt($parent->parent);
            $this->breadcrumb($grand_parent,$punkt->name);
            //$this->name($grand_parent->name);
            $this->menu($grand_parent->id);

            $this->team($article->text);
        }
        $this->seo($article->title,$article->description,$article->img);

        $this->social();

    }
    public function list_anons($id)
    {

        $database = new Database();
        $id3 = $database->select_rand("id","three"," WHERE parent = ".$id);

        for ($i=0;$i<count($id3);$i++)
        {

            $id4[$i] = $database->select_rand("id","three","WHERE parent = ".$id3[$i]);
            $this->anons($id4[$i]);
        }
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
    public function breadcrumb1($parent,$name="")
    {
        echo "
        <div class=\"breadcrumbs\">
        <a href=\"https://tiwy.ru\" title=\"\">Главная</a> →
  
        <a href=\"https://tiwy.ru/index.php?action=browse&parent=$parent->id\" title=\"\">$parent->name</a>";

        if($name!="")
            echo "→<a href=\"https://tiwy.ru/index.php?action=browse&parent=$parent->id\" title=\"\">$name</a>";

        echo "</div>";
    }
    public function breadcrumb($parent,$name="")
    {
        echo "
        <div class=\"breadcrumbs\" itemscope itemtype=\"https://schema.org/BreadcrumbList\">
        
        <span itemprop=\"itemListElement\" itemscope itemtype=\"https://schema.org/ListItem\">
            <a href=\"https://tiwy.ru\" title=\"\" itemprop=\"item\">
                <span itemprop=\"name\">Главная</span>
                <meta itemprop=\"position\" content=\"0\">
            </a> →
        </span>
        
        
        
        <span itemprop=\"itemListElement\" itemscope itemtype=\"https://schema.org/ListItem\">
            <a href=\"https://tiwy.ru/index.php?action=browse&parent=$parent->id\" title=\"\" itemprop=\"item\">
            <span itemprop=\"name\">$parent->name</span>
            <meta itemprop=\"position\" content=\"1\">
            </a>
        </span>
        ";

        if($name!="")
        {
            echo "
            <span itemprop=\"itemListElement\" itemscope itemtype=\"https://schema.org/ListItem\">
                →<a href=\"https://tiwy.ru/index.php?action=browse&parent=$parent->id\" title=\"\" itemprop=\"item\">
                <span itemprop=\"name\">$name</span>
                <meta itemprop=\"position\" content=\"2\">
                </a>
            </span>   
                
                ";
        }


        echo "</div>";
    }

}
?>