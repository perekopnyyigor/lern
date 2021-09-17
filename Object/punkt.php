<?php
require_once "database.php";
class Punkt
{
    public $id;
    public $name;
    public $generate;
    public $parent;
    public static function child($id)
    {
        $datadase = new Database();

        $datadase->connect();

        return $datadase->select("id","three","WHERE parent=".$id);
    }
    public static function add($name, $parent, $generate)
    {

        $datadase = new Database();

        $datadase->connect();


        $sql = "INSERT INTO three (name, parent, generate) 
				VALUES ('".$name."', '".$parent."', '".$generate."')";

        $result = $datadase->conn->query($sql);
        // Check1
        if ($datadase->conn->error)
        {
            echo $datadase->conn->error;

        }
        else
            echo "Пункт добавлен";

    }
    public function __construct($id)
    {
        $datadase = new Database();

        $datadase->connect();

        $this->id =$id;

        $name = $datadase->select("name","three","WHERE id=".$id);
        $this->name=$name[0];

        $generate = $datadase->select("generate","three","WHERE id=".$id);
        $this->generate=$generate[0];

        $parent = $datadase->select("parent","three","WHERE id=".$id);
        $this->parent=$parent[0];
    }
    public function add_child($name)
    {

        $datadase = new Database();

        $datadase->connect();
        $generate = $this->generate + 1;

        $sql = "INSERT INTO three (name, parent, generate)
				VALUES ('".$name."', '".$this->id."', '".$generate."')";

        $result = $datadase->conn->query($sql);
        // Check1
        if ($datadase->conn->error)
        {
            echo $datadase->conn->error;

        }
        else
            echo "Пункт добавлен";

    }

}
?>