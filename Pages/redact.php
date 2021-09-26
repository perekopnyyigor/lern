<?php
require_once "Object/punkt.php";
require_once "Object/article.php";
require_once "Pages/pages.php";


class Redact extends Pages
{
    private $url_img;
    public function view($id)
    {
        $punkt = new Punkt($id);
        $article = new Article($id);
        $this->header();
        $this->menu_redact();
        $this->name($punkt->name);

       $this->form($article,$id);
        $this->form_seo($id);
        echo '<script src="redactor.js"></script>';
    }
    private function menu_redact()
    {
        echo '<div id="menu" class="main_menu">';

        echo '</div>';


    }
    private function image_form()
    {
        echo '<form action="https://tiwy.ru/index.php?action=upload_image" method="post" enctype="multipart/form-data">';
        echo '<input type="file" name="file[]" />';

        echo '<br>';

        echo ' <p><input type="submit" value="Загрузить фото"/></p>
			</form>';
    }
    public function image_upload()
    {

        if(isset($_FILES["file"]))
        {


            foreach ($_FILES["file"]["error"] as $key => $error) {

                if ($error == UPLOAD_ERR_OK) {

                    $tmp_name = $_FILES["file"]["tmp_name"][$key];
                    //echo $tmp_name;
                    // basename() может спасти от атак на файловую систему;
                    // может понадобиться дополнительная проверка/очистка имени файла
                    $name = basename($_FILES["file"]["name"][$key]);
                    //$name =str_replace(" ","_",$name);
                    //$name =str_replace(".","_",$name);
                    //$name =str_replace("-","_",$name);
                    $this->url_img=$name;
                    $file=$_SERVER['DOCUMENT_ROOT']."/"."Img"."/".$name;
                    if(move_uploaded_file($tmp_name, $file))
                    {

                        echo $this->url_img;
                    }
                    else
                        echo "загрузка не удалась";

                }
                else
                    echo "err";

            }
        }


    }
    private function form($article, $id)
    {
        $text = str_replace("doubleslash","\\\\",$article->text);
        //echo "<div class='article'>";
        echo '<form action="https://tiwy.ru/index.php?action=save" method="post" enctype="multipart/form-data">';
        echo "<p><textarea class='article' rows=\"50\" cols=\"130\" name=\"text\" id=\"text\">".$text."</textarea></p>";
        echo "<input type=\"hidden\" name=\"id\"  value=\"".$id."\" >";
        echo "<input type=\"file\" name=\"file[]\" />";
        echo " <input type=\"submit\" /></form>";
        //echo "</div>";
    }
    private function form_seo($id)
    {
        $article = new Article($id);
        echo "<div class='seo'>";
        echo '<form action="https://tiwy.ru/index.php?action=save_seo" method="post" enctype="multipart/form-data">';
        echo "<br>title<br>";
        echo "<p><textarea rows=\"5\" cols=\"40\" name=\"title\" >".$article->title."</textarea></p>";
        echo "<br>Ключевые слова<br>";
        echo "<p><textarea rows=\"10\" cols=\"40\" name=\"key\" >".$article->keyword."</textarea></p>";
        echo "<br>Описание<br>";
        echo "<p><textarea rows=\"10\" cols=\"40\" name=\"desc\" >".$article->description."</textarea></p>";

        echo "<br>img<br>";
        echo "<p><textarea rows=\"5\" cols=\"40\" name=\"img\" >".$article->img."</textarea></p>";
        echo "<input type=\"hidden\" name=\"id\"  value=\"".$id."\" >";

        echo " <input type=\"submit\" /></form>";
        echo "</div>";
    }
    public function save_seo()
    {
        $id=$_POST["id"];
        $article = new Article($id);
        $article->seo($_POST["title"],$_POST["key"],$_POST["desc"],$_POST["img"]);
    }
    public function add()
    {
        $this->image_upload();
        $text = str_replace("\\\\","doubleslash",$_POST["text"]);


        if(isset($this->url_img))
            $text.='<img src="https://tiwy.ru/Img/'.$this->url_img.'">';

        echo $text;
        Article::add($_POST["id"],$text);
    }
}
?>