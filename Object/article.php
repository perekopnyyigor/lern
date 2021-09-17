<?php
require_once "database.php";
class Article
{
    public $id;
    public $text;
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


    }

}
?>
