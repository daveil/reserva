<?php
	define('DS', DIRECTORY_SEPARATOR);
	define('ROOT_PATH', dirname(dirname(__FILE__)));
	define('BASE_URL',DS.basename(dirname(dirname(__FILE__))));
	if(BASE_URL=='/public_html')
		define('WEB_URL','');
	else
		define('WEB_URL','http://localhost'.BASE_URL);
	class Assest{
		public static function css($path,$attrib=null){
			return self::createTag('css',$path,$attrib);
		}
		public static function js($path,$attrib=null){
			return self::createTag('js',$path,$attrib);
		}
		public static function img($path,$attrib=null){
			return self::createTag('img',$path,$attrib);
		}
		public static function createTag($type,$path,$attrib=null){
			$absolute_path =  str_replace(DS,'/',WEB_URL.'/'.$type.'/'.$path);
			if($type!='img')
				$absolute_path .='.'.$type;
			$absolute_path.='?'.rand();
			$attributes = '';
			if($attrib){
				foreach($attrib as $key=>$value)
					$attributes .= $key.'="'.$value.'"';
			}
			switch($type){
				case 'css':
					return '<link rel="stylesheet" href="'.$absolute_path.'" '.$attributes.' />';
				break;
				case 'js':
					return '<script type="text/javascript" src="'.$absolute_path.'" '.$attributes.'></script>';
				break;
				case 'img':
					return '<img src="'.$absolute_path.'" '.$attributes.' />';
				break;
			}
		}
		
	}
?>				