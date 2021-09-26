<?php
require_once "database.php";
class Article
{
    public $id;
    public $text;

    public $title;
    public $description;
    public $keyword;
    public $img;

    public static function add($id,$text)
    {

        $datadase = new Database();

        $datadase->connect();

        $check = $datadase->select("id","article","WHERE id=".$id);

        if (isset($check[0]))
        {
            $sql ="UPDATE article SET text ='".$text."' WHERE id=".$id;
        }
        else
            $sql = "INSERT INTO article (id, text) VALUES ('".$id."', '".$text."')";

        $result = $datadase->conn->query($sql);
        // Check1
        if ($datadase->conn->error)
        {
            echo $datadase->conn->error;

        }
        else
            echo "Статья добавлена";

    }
    public function __construct($id)
    {
        $datadase = new Database();

        $datadase->connect();

        $this->id =$id;

        $text= $datadase->select("text","article","WHERE id=".$id);
        $this->text=$text[0];

        $title= $datadase->select("title","article","WHERE id=".$id);
        $this->title=$title[0];

        $description= $datadase->select("description","article","WHERE id=".$id);
        $this->description=$description[0];

        $keyword= $datadase->select("keyword","article","WHERE id=".$id);
        $this->keyword=$keyword[0];

        $img= $datadase->select("img","article","WHERE id=".$id);
        $this->img=$img[0];

    }
    public function seo($title,$keyword,$descripton,$img)
    {

        $datadase = new Database();

        $datadase->connect();

        $sql ="UPDATE article SET title ='".$title."',keyword ='".$keyword."',description='".$descripton."',img='".$img."' WHERE id=".$this->id;

        $result = $datadase->conn->query($sql);
        // Check1
        if ($datadase->conn->error)
        {
            echo $datadase->conn->error;

        }
        else
            echo "SEO добавлено";

    }

}
?>
