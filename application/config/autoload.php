<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$autoload['packages'] = array('Packages','Libraries','Drivers','Helper files','Custom config files','Language files', 'Models');



$autoload['libraries'] = array('database', 'email', 'session','form_validation', 'cart','parser','pdf');


$autoload['drivers'] = array();


$autoload['helper'] = array('url','file','form','text', 'string');


$autoload['config'] = array();


$autoload['language'] = array();


$autoload['model'] = array('model_auth', 'model_groups', 'model_patient', 'model_users', 'model_department' , 'model_doctors', 'model_medicine' , 'model_disease' , 'model_advice' , 'model_complaint' , 'model_diagnosis' , 'model_examination' , 'model_investigation', 'model_chat', 'model_notices', 'model_slider', 'model_company');
