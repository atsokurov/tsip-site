<?php

$sep = DIRECTORY_SEPARATOR;

include_once(dirname(__FILE__) . $sep . "init.php");

$article = new CrTemplate("Site", "index-news-item");
$article->SetValue("==ITEM-HEADER==", "Приветствуем Вас на сайте платёжной системы 'ТохаБанк'.");
$article->SetValue("==ITEM-PARAGRAPH==", "'ТохаБанк' - это платёжная система, нацеленная на использование Ваших банковских карт(дебетовых или кредитных) от многих банков нашей страны.");
$page->Render($article);

$article = new CrTemplate("Site", "index-news-item");
$article->SetValue("==ITEM-HEADER==", "Почему мы?");
$article->SetValue("==ITEM-PARAGRAPH==", "Потому что мы используем самые передовые технологии передачи информации. Мы бережно относимся к нашим клиентам.");
$page->Render($article);

$article = new CrTemplate("Site", "index-news-item");
$article->SetValue("==ITEM-HEADER==", "Как пользоваться данным сервисом?");
$article->SetValue("==ITEM-PARAGRAPH==", "Чтобы использовать наш сервис, Вам достаточно зарегистрироваться, после чего Вы сможете в своём личном кабинете зарегистрировать банковскую карту во многих банках нашей страны.");
$page->Render($article);

/* Render whole page*/
$page->RenderPage();
?>
