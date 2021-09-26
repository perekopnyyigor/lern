<?php
require_once "Object/punkt.php";
require_once "pages.php";
class MaimPage extends Pages
{
    public function view()
    {
        $this->header();
        $this->name("Технический справочник");
        $this->menu(0);
        $this->lis();
    }


}
?>