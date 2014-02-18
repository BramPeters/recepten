<?php

class TemplateManager {
//class voor template verwerking
//zeeeeeeer eenvoudig gehouden
  public function template($tplvars){
	  
	  $html  =	render('pres/head.tpl', $tplvars);
	  $html  .=	render('pres/bodie.tpl', $tplvars);
	  
	  return $html;
  }
		  	
}//einde Class

function render ($file, $vars){
    $_html = '';
    $_raw_file = addcslashes(file_get_contents($file), '"\\');
	//$_raw_file = file_get_contents($file);
    extract ($vars, EXTR_SKIP);
    eval('$_html = "'.$_raw_file.'";');
    return $_html;
}

?>