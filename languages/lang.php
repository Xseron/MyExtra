<?php
session_start();

if(empty($_SESSION['lang'])) { $_SESSION['lang'] = 'ru'; }

if(isset($_GET['lang']) && in_array($_GET['lang'], array('ru', 'en', 'kz')))	
{
  if(isset($_GET['lang'])) { $_SESSION['lang'] = $_GET['lang']; } 
  $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'ru';
} 
else 
{
  $lang = $_SESSION['lang'];
}

require_once($lang.'.php');
?>