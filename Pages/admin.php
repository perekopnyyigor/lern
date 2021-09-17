<?php
require_once "Object/punkt.php";
class Admin
{
    public function view($id=0)
    {

        $this->header();
        $this->menu(0);

        $id_massiv=[];
        $i=0;


        while ($id!=0)
        {

            $id_massiv[$i]=$id;
            echo $id;
            $punkt = new Punkt($id);
            $id = $punkt->parent;

            $i++;


        }

        print_r($id_massiv) ;
        for($i=count($id_massiv)-1;$i>=0;$i--)
            $this->menu($id_massiv[$i]);





    }
    private function header()
    {
        echo '<link rel="stylesheet" type="text/css" href="Style/style.css">';
    }
    private function form($id)
    {

        echo '<form action="https://tiwy.ru/index.php?action=add_punkt" method="post">';
        echo '<input name="name" placeholder="Дисциплина">';
        echo "<input type=\"hidden\" name=\"id\"  value=\"".$id."\" >";
        echo ' <input type="submit" /></form>';
    }
    private function menu($id)
    {
        echo "<div class='admin_menu'>";
        $main_punkt = new Punkt($id);
        echo $main_punkt->name."<br>";

        $punkt_id = Punkt::child($id);
        if(isset($punkt_id))
        {
            for($i=0;$i<count($punkt_id);$i++)
            {
                $punkt[$i] = new Punkt($punkt_id[$i]);
                if ($punkt[$i]->generate==4)
                {
                    echo '<a href="https://tiwy.ru/index.php?action=open_redact&id='.$punkt[$i]->id.'">'.$punkt[$i]->name.'</a><br>';
                }
                else
                    echo '<a href="https://tiwy.ru/index.php?action=open_menu&id='.$punkt[$i]->id.'">'.$punkt[$i]->name.'</a><br>';
            }
        }

        $this->form($id);
        echo "</div>";
    }
    public function add_punkt()
    {
        $name = $_POST["name"];
        $id = $_POST["id"];
        if($id ==0)
            Punkt::add($name, $id, 1);
         else
         {
             $punkt = new Punkt($id);


             $punkt->add_child($name);
         }

    }



}
?>
