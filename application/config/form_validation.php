<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
//Users
  'user' => array(
    array('field' => 'first_name','label' => 'lang:First Name','rules' => 'trim|required'),
	array('field' => 'last_name','label' => 'lang:Last Name','rules' => 'trim|required'),
	array('field' => 'password','label' => 'lang:Password','rules' => 'trim|required'),
	array('field' => 'group','label' => 'lang:Group','rules' => 'trim|required'),
	array('field' => 'status','label' => 'lang:Status','rules' => 'trim|required'),
  ),
  'user_not_required' => array(
	array('field' => 'email','label' => 'lang:E-mail','rules' => 'trim|valid_email|required'),			
  ),
  'user_required' => array(
	array('field' => 'email','label' => 'lang:E-mail','rules' => 'trim|required|valid_email|callback_check_email'),					
  ),

//Pages
  'pages' => array(
    array( 'field' => 'parent_id', 'label' => 'lang:Parent', 'rules' => 'trim|xss_clean' ),
    array( 'field' => 'managed_by', 'label' => 'lang:Managed By', 'rules' => 'trim|xss_clean' ),
    array( 'field' => 'meta_title', 'label' => 'lang:Meta Title', 'rules' => 'trim|required|xss_clean' ),
    array( 'field' => 'meta_keyword', 'label' => 'lang:Meta Keyword', 'rules' => 'trim|required|xss_clean' ),
    array( 'field' => 'meta_description', 'label' => 'lang:Meta Description', 'rules' => 'trim|required|xss_clean' ),
    array( 'field' => 'content', 'label' => 'lang:Content', 'rules' => 'trim|xss_clean' ),
    array( 'field' => 'status', 'label' => 'lang:Status', 'rules' => 'trim|required|xss_clean' ),
    array( 'field' => 'tags', 'label' => 'lang:tags', 'rules' => 'trim|xss_clean' ),
    array( 'field' => 'page_banner', 'label' => 'lang:page_banner', 'rules' => 'trim|xss_clean' ),
    
  ), 
  'pages_not_required' => array(
    array( 'field' => 'url', 'label' => 'lang:URL', 'rules' => 'trim|required|xss_clean' ),
    array( 'field' => 'page', 'label' => 'lang:Page', 'rules' => 'trim|required|xss_clean' ),			
  ),  
  'pages_required' => array(
    array( 'field' => 'url', 'label' => 'lang:URL', 'rules' => 'trim|required|xss_clean|callback_check_url' ),
    array( 'field' => 'page', 'label' => 'lang:Page', 'rules' => 'trim|required|xss_clean|callback_check_page' ),						
  ),
  
//Feedback Reply
  'feedback_reply' => array(
    array('field' => 'subject','label' => 'lang:Subject','rules' => 'trim|required'),
	array('field' => 'sender_email','label' => 'lang:Sender Email','rules' => 'trim|valid_email|required'),	
	array('field' => 'email','label' => 'lang:Email','rules' => 'trim|valid_email|required'),
	array('field' => 'cc','label' => 'lang:cc','rules' => 'trim|valid_email|xss_clean'),
	array('field' => 'bcc','label' => 'lang:bcc','rules' => 'trim|valid_email|xss_clean'),
	array('field' => 'message','label' => 'lang:message','rules' => 'trim|required')		
  ),

//Enquiry Reply
  'enquiry_reply' => array(
    array('field' => 'subject','label' => 'lang:Subject','rules' => 'trim|required|xss_clean'),
	array('field' => 'sender_email','label' => 'lang:Sender Email','rules' => 'trim|valid_email|required|xss_clean'),	
	array('field' => 'email','label' => 'lang:Email','rules' => 'trim|valid_email|required|xss_clean'),
	array('field' => 'cc','label' => 'lang:cc','rules' => 'trim|xss_clean'),
	array('field' => 'bcc','label' => 'lang:bcc','rules' => 'trim|xss_clean'),
	array('field' => 'comments','label' => 'lang:comments','rules' => 'trim|required|xss_clean')		
  ),
 
//Configaration
  'config' => array(
	array('field' => 'option','label' => 'lang:Option','rules' => 'trim||required|xss_clean|callback_check_option'),
    array('field' => 'group','label' => 'lang:Group','rules' => 'trim|required|xss_clean'),
	array('field' => 'value','label' => 'lang:Value','rules' => 'trim||required|xss_clean')
  ), 
//Menu Builder
  'menu_builder' => array(
    array('field' => 'menuid','label' => 'lang:Menu ID','rules' => 'trim|required|xss_clean'),
	array('field' => 'status','label' => 'lang:Status','rules' => 'trim||required|xss_clean')
  ),
  'menu_builder_not_required' => array(
    array( 'field' => 'name', 'label' => 'lang:Menu', 'rules' => 'trim|required|xss_clean' )			
  ),  
  'menu_builder_required' => array(
    array( 'field' => 'name', 'label' => 'lang:Menu', 'rules' => 'trim|required|xss_clean|callback_check_menu' )						
  ),

//Blog
  'blogs' => array(
    array('field' => 'title', 'label' => 'Title', 'rules' => 'trim|required'),
    array('field' => 'tags', 'label' => 'Tags', 'rules' => 'trim|required'),
	array('field' => 'details','label' => 'Details','rules' => 'trim|required'),
	array('field' => 'date','label' => 'Date','rules' => 'trim|required'),
	array('field' => 'status','label' => 'Status','rules' => 'trim|required')
  ),
  'blogs_not_required' => array(
    array( 'field' => 'url', 'label' => 'lang:URL', 'rules' => 'trim|required|xss_clean' )			
  ),  
  'blogs_required' => array(
    array( 'field' => 'url', 'label' => 'lang:URL', 'rules' => 'trim|required|xss_clean|callback_check_url' )						
  ),

//Testimonials
  'testimonials' => array(
    array('field' => 'testimonial', 'label' => 'Testimonial', 'rules' => 'trim|required'),
	array('field' => 'name', 'label' => 'Name', 'rules' => 'trim|required'),
	array('field' => 'company_name', 'label' => 'company_name', 'rules' => 'trim|required'),
    array('field' => 'designation', 'label' => 'designation', 'rules' => 'trim|required|xss_clean'),
    array('field' => 'phone', 'label' => 'phone', 'rules' => 'trim|xss_clean'),
    array('field' => 'mobile', 'label' => 'mobile', 'rules' => 'trim|xss_clean'),
    array('field' => 'email', 'label' => 'email', 'rules' => 'trim|valid_email|xss_clean'),
    array('field' => 'web', 'label' => 'web', 'rules' => 'trim|xss_clean'),
    array('field' => 'publish_date', 'label' => 'publish_date', 'rules' => 'trim|xss_clean'),
    array('field' => 'status', 'label' => 'status', 'rules' => 'trim|required|xss_clean'),
  ), 

//  widgets
  'widgets' => array(
    array( 'field' => 'title', 'label' => 'lang:Title', 'rules' => 'trim|required|xss_clean' ),
    array( 'field' => 'description', 'label' => 'lang:Description', 'rules' => 'trim|xss_clean' ),
    array( 'field' => 'image', 'label' => 'lang:Image', 'rules' => 'trim|xss_clean' ),
    array('field' => 'status','label' => 'status','rules' => 'trim|required|xss_clean')
  ),
  'widgets_not_required' => array(
    array( 'field' => 'title', 'label' => 'lang:Title', 'rules' => 'trim|required|xss_clean' )			
  ),  
  'widgets_required' => array(
    array( 'field' => 'title', 'label' => 'lang:Title', 'rules' => 'trim|required|xss_clean|callback_check_title' )						
  ),
);

$config['pages'] = array_merge($config['pages'], $config['pages_required']);  
$config['pages_edit'] = array_merge($config['pages'], $config['pages_not_required']);

$config['user'] = array_merge($config['user'], $config['user_required']);  
$config['user_edit'] = array_merge($config['user'], $config['user_not_required']);

$config['menu_builder'] = array_merge($config['menu_builder'], $config['menu_builder_required']);  
$config['menu_builder_edit'] = array_merge($config['menu_builder'], $config['menu_builder_not_required']);

$config['blogs'] = array_merge($config['blogs'], $config['blogs_required']);  
$config['blogs_edit'] = array_merge($config['blogs'], $config['blogs_not_required']);

$config['widgets'] = array_merge($config['widgets'], $config['widgets_required']);  
$config['widgets_edit'] = array_merge($config['widgets'], $config['widgets_not_required']);