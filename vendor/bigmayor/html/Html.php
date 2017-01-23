<?php 
/*
* This file is part of the BigMayor package.
*
* @package		Amevon
* @author		Allan Amevor
* @copyright	Copyright Amevon Ltd.
* @license		http://amevon.com
* @link		    http://amevon.com
* @since		Version 1.0.0
*/
namespace BigMayor\Html;
use  BigMayor\Html\NavMaker;

class Html
{
	public $defaultClass = 'form-control';
	
	
	/*
	* 
	* Merge Array:
	* 
	* @param array $param
	* @param array $defaultParam
	* @param boolen $merge
	*
	* @return array
	*/ 
	public function mergeAttr($param, $defaultParam = array(), $merge = true)
	{
		
		if(!is_array($param) && !is_array($defaultParam)){
			return array();
		}
		if(!empty($param) && empty($defaultParam)){
			return $param;
		}
		if(empty($param) && !empty($defaultParam)){
			return $defaultParam;
		}
		if(is_array($param) && $merge == false){
			return $param;
		}
		else if(is_array($param) && $merge == true){
			if(!is_array($defaultParam)){
				return $param;
			}
			
			foreach($defaultParam as $key=>$value){
				if(!array_key_exists($key, $param)){
					$param[$key]=$value;
				}
		}
		return $param;
		}
		else{
			return false;
		}
	}
	
	/*
	* 
	* Generate Html Element Attributes
	* Output Example:  id="ys" class="className" style="padding:373;"
	*
	* @param array $param
	* @return array $defaultParam
	* @return boolen $merge
	*
	* @return string
	*/
	private  function makeAttr($param, $defaultParam = array(), $merge = true ){
		
		$attributes = $this->mergeAttr($param, $defaultParam, $merge);
		
		if(!is_array($attributes) || empty($attributes)){
			return '';
		}
		$s = "";
		foreach($attributes as $key => $value){
			$s .= " " . $key."=\"".$value."\""." ";
		}
		return $s;
	}
	
		
	/*
	* -
	* Generate Html Element: eg div, p,
	* Output Example:  <p id="ys" class="className" style="padding:373;">M y Value </p>
	* 
	* @param string $element
	* @param string $value
	* @param array  $attr
	*
	* @return string
	*
	*/
	public function createElement($element, $value = '',  $attr = array()){
		
		$a = $this->makeAttr($attr);
		
		$s = "";
		$s .= "<$element $a>"."\n";
		$s.= $value;
		$s.= "</$element>";
		
		return $s;
	}
	
	/*
	* -
	* Generate Html Element: is an alias of createElement,
	* -
	*/
	public  function element($element, $value, $attr = array()){
		return $this->createElement($element, $value, $attr);
	}
	
	
	/*
	* -
	* Generate Html Element open tag: eg div, p,
	* Output Example:  <p id="ys" class="className" style="padding:373;">
	* -
	* @param string $tag
	* @param string $attr
	*
	* @return string
	*/
	public  function begin($tag, $attr){
		
		$a = $this->makeAttr($attr);
		$s = "<$tag $a >";
		return $s;
		
	}
	
	public  function open($tag, $attr){
		return $this->beginTag($tag, $attr);
	}
	
	/*
	* -
	* Generate Html Element open tag: eg div, p,
	* Output Example:  </p>
	* 
	* @param string $tag
	*
	* @return string
	*/	 
	public function end($tag){
		return "</$tag>"."\n";
	}
	
   public function close($tag){
		return $this->end($tag);
	}
	
	/*
	* -
	* Empty tags eg: br, hr 
	* Output Example:  </p>
	*
	* @param string $tag
	* @param array $attr
	*
	* @return string
	*/
	public  function emptyTag($tag, $attr = array() ) {
		$a = $this->makeAttr($attr);
		return  "<$tag $a />";
	}
	
	
	public  function div($value, $attr=array()){
		return $this->element("div", $value, $attr);
	}
	
	public function h1($value, $attr = array()){
		return $this->element("h1", $value, $attr);
	}
	
	public function h2($value, $attr=array()){
		return $this->element("h2", $value, $attr);
	}
	
	public function h3($value, $attr = array()){
		return $this->element("h3", $value, $attr);
	}
	
	public function h4($value, $attr = array()){
		return $this->element("h4", $value, $attr);
	}
	
	public function h5($value, $attr=array()){
		return $this->element("h5", $value, $attr);
	}
	
	public function h6($value, $attr = array()){
		return $this->element("h6", $value, $attr);
	}
	
	public function p($value, $attr = array()){
		return $this->element("p", $value, $attr);
	}
	
	public function text($value, $attr = array()){
		return $this->element("p", $value, $attr);
	}
	
	public function aLink($value, $attr = array()){
		return $this->element("a", $value, $attr);
	}
	
	public function a($value, $attr = array()){
		return $this->element("a", $value, $attr);
	}
	
	public  function img($attr = array()){
		return $this->emptyTag('img', $attr);
	}
		
	public  function hr($attr=array()){
		return $this->emptyTag('hr', $attr);
	}
	
	public  function br($attr = array()){
		return $this->emptyTag('br', $attr);
	}
	
	public  function button($title, $attr = array()){
		return $this->element("button", $title, $attr);
	}
	
	public  function beginLi($attr = array()){
		return $this->open("li", $attr);
	}
	
	public  function endLi(){
		return "</li>"."\n";
	}
	
		
	/*
	* -
	* Generate Alerts
	* Output Example:  <div class="alert alert-success" role="alert">...</div>
	* 
	* @param string $value
	* @param string $class
	* @param array $attr
	*
	* @return string
	*/	
	public function alert($value, $class = "alert alert-success",  $attr = array()){
		
		$attr['class'] = (empty($attr['class']))? $class : $class. " ". $attr['class'];
		$attr['role'] = 'alert';
		
		return $this->element("div", $value,  $attr);
		
	}
		
	/*
	* -
	* Generate success alert
	* Output Example:  <div class="alert alert-success" role="alert">...</div>
	* 
	* @param string $value
	* @param array $attr
	*
	* @return string
	*/	
	public function success($value, $attr = array()){;
		return $this->alert($value, $class = "alert alert-success",  $attr);
	}
	
	
	/*
	* -
	* Generate info alert
	* Output Example:  <div class="alert alert-info" role="alert">...</div>
	* 
	* @param string $value
	* @param array $attr
	*
	* @return string
	*/	
	public function info($value, $attr = array()){;
		return $this->alert($value, $class = "alert alert-info",  $attr);
	}
	
	/*
	* -
	* Generate warning alert
	* Output Example:  <div class="alert alert-warning" role="alert">...</div>
	* 
	* @param string $value
	* @param array $attr
	*
	* @return string
	*/	
	public function warning($value, $attr = array()){;
		return $this->alert($value, $class = "alert alert-warning",  $attr);
	}
	
	
	/*
	* -
	* Generate danger alert
	* Output Example:  <div class="alert alert-warning" role="alert">...</div>
	* 
	* @param string $value
	* @param array $attr
	*
	* @return string
	*/	
	public function danger($value, $attr = array()){;
		return $this->alert($value, $class = "alert alert-danger",  $attr);
	}
	
	/*
	* -
	* Generate label
	* Output Example:  <div class="alert alert-success" role="alert">...</div>
	* 
	* @param string $text
	* @param string $type
	* @param array $attr
	*
	* @return string
	*/	
	public function label($text, $type = "default", $attr = array()){
		
		$options = [
			"default" => "label label-default", 
			"primary" => "label label-primary", 
			"success" => "label label-success",
			"info" => "label label-info",
			"warning" => "label label-warning",
			"danger" => "label label-danger",
		];
		
		$label_class = (isset($options[$type]))? $options[$type] :  "label label-default";
		$attr['class'] = (empty($attr['class']))? $label_class : $label_class. " ". $attr['class'];
		
		return $this->element("span", $text,  $attr);
		
	}
		
	/*
	* -
	* Generate label and wrap it with any element of your choice
	* Output Example:  <h3>Example heading <span class="label label-default">New</span></h3>
	* 
	* @param string $value
	* @param string $class
	* @param array $attr
	*
	* @return string
	*/	
	public function wrapLabel($text, $label_text, $element = 'h3', $label_type = "default", $position = 'right', $attr = array()){
		
		$label = $this->label($label_text, $label_type);
		$text = ($position == 'right')? $text." ". $label : $label." ".$text;
		
		return $this->element($element, $text,  $attr);
	}
	
	/*
	* -
	* Generate Danger or error title
	* Output Example:  <h3> <span class="label label-danger"><i class="fa fa-times" aria-hidden="true"></i></span> Example heading </h3>
	* 
	* @param string $value
	* @param string $class
	* @param array $attr
	*
	* @return string
	*/	
	public function dangerTitle($text, $attr = array()){
   		return  $this->wrapLabel($text, '<i class="fa fa-times" aria-hidden="true"></i>', $element = 'h3', $label_type = "danger", 
		$position = 'left', $attr);
	}
	
	/*
	* -
	* Generate warning or error title
	* Output Example:  <h3> <span class="label label-warning"><i class="fa fa-times" aria-hidden="true"></i></span> Example heading </h3>
	* 
	* @param string $value
	* @param string $class
	* @param array $attr
	*
	* @return string
	*/	
	public function warningTitle($text, $attr = array()){
   		return  $this->wrapLabel($text, '<i class="fa fa-times" aria-hidden="true"></i>', $element = 'h3', $label_type = "warning", 
		$position = 'left', $attr);
	}
	
	/*
	* -
	* Generate Success title
	* Output Example:  <h3> <span class="label label-danger"><i class="fa fa-times" aria-hidden="true"></i></span> Example heading </h3>
	* 
	* @param string $value
	* @param string $class
	* @param array $attr
	*
	* @return string
	*/	
	public function successTitle($text, $attr = array()){
   		return  $this->wrapLabel($text, '<i class="fa fa-check" aria-hidden="true"></i>', $element = 'h3', $label_type = "success", 
		$position = 'left', $attr);
	}
	
	
	/*
	* -
	* Generate Html Panel
	* Output Example: <div class="panel panel-default">
	* 						<div class="panel-heading">
	* 							<h3 class="panel-title">Panel title</h3>
	* 						</div>
	* 						<div class="panel-body">
	* 							Panel content
	*						 </div>
	* 						<div class="panel-footer">Panel footer</div>
	* 				</div>
	* 
	* @param string $title
	* @param string  $body
	* @param string  $footer
	* @param string  $type
	* @param array  $attr
	*
	* @return string
	*/	
	public function panel($title, $body, $footer = '',  $type = "default", $attr = array()){
		
		$options = [
				"primary" => "panel panel-primary", 
				"success" => "panel panel-success", 
				"info" => "panel panel-info",
				"warning" => "panel panel-warning",
				"danger" => "panel panel-danger",
				"default" => "panel panel-default",
			];
		
		$class = (isset($options[$type]))? $options[$type] :  "panel panel-default";
		$attr['class'] = (empty($attr['class']))? $class : $class . " ". $attr['class'];
		
		$panel = $this->open('div', $attr);
		
		if(!empty($title)){
			$panel .= "<div class=\"panel-heading\">
							<h3 class=\"panel-title\">$title</h3>
					  </div>";
		}
		
		if(!empty($body)){
			$panel .=  "<div class=\"panel-body\"> $body </div>";
		}
		if(!empty($footer)){
			$panel .=  "<div class=\"panel-footer\"> $footer </div>";
		}
		
		$panel .= $this->end('div');
		return $panel;
	}
	

	public function primaryPanel($title, $body, $footer = '', $attr = array()){
		return $this->panel($title, $body, $footer,  $type = "primary", $attr);
	}
	
	public function successPanel($title, $body, $footer = '', $attr = array()){
		return $this->panel($title, $body, $footer,  $type = "success", $attr);
	}
	
	public function infoPanel($title, $body, $footer = '', $attr = array()){
		return $this->panel($title, $body, $footer,  $type = "info", $attr);
	}
	
	public function warningPanel($title, $body, $footer = '', $attr = array()){
		return $this->panel($title, $body, $footer,  $type = "warning", $attr);
	}
	
	public function dangerPanel($title, $body, $footer = '', $attr = array()){
		return $this->panel($title, $body, $footer,  $type = "danger", $attr);
	}
	
	public function defaultPanel($title, $body, $footer = '', $attr = array()){
		return $this->panel($title, $body, $footer,  $type = "default", $attr);
	}
	

	/*
	* -
	* Generate Html Panel Body
	* Output Example: <div class="panel panel-default">
	* 						<div class="panel-body">
	* 							Panel content
	*						 </div>
	* 				</div>
	* 
	* @param string $title
	* @param string  $body
	* @param string  $footer
	* @param string  $type
	* @param array  $attr
	*
	* @return string
	*/	
	public function panelBody($body,  $attr = array()){
		return $this->panel('', $body, $footer = '',  $type = "default", $attr);
	}
	
	
	/* 
	* Make Flat Menu: That is menu without dropdown
	*  
	* @param array $data
	* @param array $attr
	*
	* @return string
	*/ 
	public function nav($data, $attr = array())
	{
		$obj = new NavMaker();
		return $obj->makeNav($data, $attr);
	}
	
	/* 
	* Make  Dropdown Menu:
	* Example:.....................................................................
	* $param["before"] = 	"<div class=\"navbar yamm navbar-default navbar-fixed-top\">
						<div class=\"container\">
						<ul class=\"nav navbar-nav\">";
	* $param["after"] =     "</ul> </div> </div>";
	* $param["dropdownLi"] = ["class"=>"dropdown"];
	* $param["dropdownLink"] = ["class"=>"dropdown-toggle", "data-toggle"=>"dropdown"];
	* $param["dropdownU"] =   ["class"=>"dropdown-menu"];
	* 
	* @param array $data
	* @param array $attr
	*
	* @return string
	*/
	public function dropdownNav($data, $attr = array())
	{
		$obj = new NavMaker();
		return $obj->makeDropdownNav($data, $attr);
	}
	
	
	/* 
	* Make Mega Nav
	*
	* @param array
	* @param array $param = ["before"=>"", "after"=>"", "col_class"=>"", "col_no"=>3"]
	*
	* return : string
	* 
	*/
	public function megaNav($data, $attr = []){
		
		$obj = new NavMaker();
		return $obj->makeMegaNav($data, $attr);
	}
	
		
	/*
	* Generate Html stucture for breadcrum
	*
	* @param array $data
	* @param string $arrow
	*
	* return string
	*/	
	public function breadcrumb($data, $arrow = '&rarr;'){
		$obj = new NavMaker();
		return $obj->breadcrumb($data, $arrow);
	}
	

 }