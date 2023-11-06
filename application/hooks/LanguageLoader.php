<?php
class LanguageLoader
{
   function initialize() {
       $ci =& get_instance();
       $ci->load->helper('language');
       $siteLang = $ci->session->userdata('site_lang');
       if ($siteLang) {
           $ci->lang->load('info',$siteLang);
       } else {
           $ci->lang->load('info','english');
       }
   }
}