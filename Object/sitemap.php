<?php
require_once "database.php";
require_once "Object/punkt.php";
class Sitemap
{
    public function main()
    {
        $cont = $this->content();
        echo $cont;
        $this->write($cont);
    }
    private function write($text)
    {
        $filename = 'sitemap.xml';
        // Открываем файл, флаг W означает - файл открыт на запись
        $f_hdl = fopen($filename, 'w');
        // Записываем в файл $text
        fwrite($f_hdl, $text);

        // Закрывает открытый файл
        fclose($f_hdl);
        echo "файл обновлен";

    }
    private function hrefs()
    {
        $text="";
        $database = new Database();
        $id_massiv = $database->select("id","three");
        foreach ($id_massiv as $id)
        {
            $punkt = new Punkt($id);
            if($punkt->generate==2 || $punkt->generate==4)
            {
                $text.= "<url>\n";
                $text.="<loc>https://tiwy.ru/index.php?action=browse&amp;parent=".$id."</loc>\n";
                $text.="<lastmod>2021-10-10</lastmod>\n";
                $text.= "</url>\n";
            }

        }
        return $text;
    }
    private function content()
    {
        $content="";
        $content.= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $content.= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
        $content.="<url>\n";
        $content.="<loc>https://tiwy.ru</loc>\n";
        $content.="<lastmod>2021-10-10</lastmod>\n";
        $content.="</url>\n";
        $content.=$this->hrefs();
        $content.= "</urlset>\n";

        return $content;
    }
}