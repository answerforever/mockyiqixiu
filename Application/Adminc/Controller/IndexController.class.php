<?php
namespace Adminc\Controller;
use Adminc\Controller\BaseController;
class IndexController extends BaseController {
	public function get_server_ip() { 
		if (isset($_SERVER)) {
			if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$realip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
				if (isset($_SERVER['HTTP_CLIENT_IP'])) {
					$realip = $_SERVER['HTTP_CLIENT_IP'];
				} else {
					$realip = $_SERVER['REMOTE_ADDR'];
				}
			}
		} else {
			if (getenv('HTTP_X_FORWARDED_FOR')) {
				$realip = getenv('HTTP_X_FORWARDED_FOR');
			} else {
				if (getenv('HTTP_CLIENT_IP')) {
					$realip = getenv('HTTP_CLIENT_IP');
				} else {
					$realip = getenv('REMOTE_ADDR');
				}
			}
		}
		return $realip; 
	} 
    public function index(){
		$this->assign('Adminusername', session('adminUser')); 
		$this->assign('Adminuserid', session('adminUserid')); 
		$mysql= mysql_get_server_info();
    	$mysql=empty($mysql)?"未知":$mysql;
    	//服务器信息
    	$info = array(
    			'操作系统：' => PHP_OS,
			
				'服务器IP：' => $this->get_server_ip(),
    			'运行环境：' => $_SERVER["SERVER_SOFTWARE"],
    			'PHP运行方式：' => php_sapi_name(),
				'PHP版本：' => PHP_VERSION,
    			'MYSQL版本：' =>$mysql,
    			'程序系统版本' =>  "15.5 $ver $release &nbsp;&nbsp;&nbsp; [<a href='https://www.souho.net/' target='_blank'>访问论坛</a>]",
			 '官方最新版：' =>" 15.5 $lastver",
    			'上传附件限制：' => ini_get('upload_max_filesize'),
    			'执行时间限制：' => ini_get('max_execution_time') . "秒",
    			'剩余空间：' => round((@disk_free_space(".") / (1024 * 1024)), 2) . 'M',
				'SOCKET支持：'  => function_exists('fsockopen') ? '是' : '否',
				'ZLIB' => function_exists('gzclose') ? '是' : '否',
				'SAFE_MODE' => (boolean) ini_get('safe_mode') ?  '是' : '否',
				'safe_mode_gid' => (boolean) ini_get('safe_mode_gid') ? '是' : '否',
				'PHP上传附件限制' => get_cfg_var('post_max_size'),

		
    	);
    
     
		$ui['index'] = 'active';
        $this->assign('ui',$ui);
		$this->assign('server_info', $info);
		$this -> assign('updateinfo', $updateinfo);
        $this -> assign('chanageinfo', $chanageinfo);
		$this -> assign('domain_time', $domain_time);
        $this->assign('ver', $ver); 
        $this->assign('sys_info', $sys_info); 
		
		$this->display();
	}
}