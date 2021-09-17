<?php
require_once "Pages/main_page.php";
require_once "Pages/admin.php";
require_once "Pages/redact.php";
require_once "Pages/browse.php";
$main_page=new MaimPage();
$admin = new Admin();
$redact = new Redact();
$browse = new Browse();
switch ($_GET["action"])
{
    case "":
        $main_page->view();
        break;
    case "admin":
        $admin->view();
        break;
    case "add_punkt":
        $admin->add_punkt();
        break;
    case  "open_menu":
        $admin->view($_GET["id"]);
        break;
    case  "open_redact":
        $redact->view($_GET["id"]);
        break;
    case "save":
        $redact->add();
        break;
    case "browse":
        $browse->view($_GET["parent"]);
        break;
}
?>