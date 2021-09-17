<?php
abstract class Pages
{
    public function header()
    {
        echo '<!DOCTYPE html>';
        echo '<meta name="viewport" content="width=device-width">';

        echo '<link rel="stylesheet" type="text/css" href="Style/style.css">';

        echo '<link rel="stylesheet" href="Katex/katex.min.css">';
        echo '<script src="Katex/katex.min.js"></script>';

        echo '<link rel="stylesheet" href="Chem/easychem.css">';
        echo '<script src="Chem/easychem.js"></script>';

        echo '<link rel="stylesheet" href="Code/styles/color-brewer.min.css">';
        echo '<script src="Code/highlight.min.js"></script>';


    }
    public function name($name)
    {
        echo '<div class="head_name">'.$name.'</div>';
    }
    public function menu($id_arg)
    {
        echo '<div class="main_menu">';
        $id_massiv = Punkt::child($id_arg);
        foreach ($id_massiv as $id)
        {
            $punkt = new Punkt($id);
            echo '<div class ="punkt1">'.$punkt->name.'</div>';
            $id_punkt_massiv = Punkt::child($punkt->id);
            foreach ($id_punkt_massiv as $id_punkt)
            {
                $sub_punkt = new Punkt($id_punkt);
                echo '<div class ="punkt2"><a href="https://tiwy.ru/index.php?action=browse&parent='.$sub_punkt->id.'">'.$sub_punkt->name.'</a></div>';
            }
        }
        echo "</div>";
    }
}
?>