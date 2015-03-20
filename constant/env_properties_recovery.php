<?php 
//环境配置文件备份。
define("MODE_DEVELOP", '0');		//开发模式
define("MODE_TEST", '1');			//测试模式
define("MODE_SEC", '2');			//安全模式，公开前测试
define("MODE_PUB", '3');			//公开模式

$CODE_MODE = MODE_DEVELOP;
switch ($CODE_MODE) {
	case MODE_DEVELOP:
		require_once("env_case_d.php");
		break;
	
	case MODE_TEST:
		require_once("env_case_t.php");
		break;
	
	case MODE_SEC:
		require_once("env_case_s.php");
		break;
	
	case MODE_PUB:
		require_once("env_case_p.php");
		break;
	
	default:
		# code...
		break;
}


ini_set('date.timezone','Asia/Tokyo');




 ?>