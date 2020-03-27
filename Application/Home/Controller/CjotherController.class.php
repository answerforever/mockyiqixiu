<?php
namespace Home\Controller;
use Think\Controller;
header("Content-Type: text/html;charset=utf-8");

class CjotherController extends Controller {
	
    public function index(){
        ini_set("max_execution_time", "60");
        $cs = trim($_GET['cs']);
        $user = M("scene");
        $where['eqcode'] = $cs;
        $code = $user->where($where)->select();

        $otherurl= trim($_GET['other_url']);
        if (!empty($code[0][scenecode_varchar])) {
            echo json_encode(array(
                "msg" => "已经存在",
                "url" => 'http://' . $_SERVER['HTTP_HOST'] . '/v/' . $code[0][scenecode_varchar]
            ));
            exit;
        }
        	
        $bgAudio_str='';
		
        $url = $otherurl.'/index.php?c=scene&a=view&id=' . $cs;
        $da = $this->GetCurl($url);

        $img = './Uploads/syspic/scene/';
        $img2 = './Uploads/';
        $mp3 = './Uploads/syspic/mp3/';
     
        $da=str_replace("src='http:\/\/ve13.com\/?c=liuyan&a=index'","",$da);
        $da=str_replace('\/','/',$da);
        $resp = json_decode(trim($da,chr(239).chr(187).chr(191)), true);
   

        if(C('ISLOG'))
            \Think\Log::write('other_GetCurl'.$url.var_export($resp,true)."\n\n -----------\n");


        if (empty($code) and $resp[obj][name] !== '该场景已关闭') {

          
            preg_match_all("/(((pic|syspic)\/\w+\/\w+(.*?)+.(gif|jpg|jpeg|png|bmp|svg|mp3)))/isu", $da, $array);



            $src2 = 'syspic/scene/';
            if(C('ISLOG'))			 \Think\Log::write('要下载的图片'.var_export($array,true)."\n\n -----------\n");
         
            $src3 =$da;

           
           
            $cover_other = $resp['obj']['cover'];
            $scenename = $resp['obj']['name'];
            $other_id = $resp['obj']['id'];
            $othercode = $cs;
            $movietype_other = $resp['obj']['pageMode'];
            $bgAudio = 2;
            $description = $resp['obj']['description'];
			
			
				//var_dump($bgAudio);die;
            if($cover_other){ // 封面图
                $this->save_pic($otherurl.'/Uploads/' . $cover_other, $img);

                $data['thumbnail_varchar']=$cover_other;
            }

            foreach ($array[0] as $key => $var) {
                $urls[$key] = pathinfo($array[0][$key]);
                $img='./Uploads/'.substr($var,0,strripos($var,'/')+1);
              $after_cjimg =   $this->save_pic($otherurl.'/Uploads/' . $var, $img);
                $replace_img =  strpos($after_cjimg , 'http://') !== false ?  $after_cjimg : $src2. $after_cjimg ;
                $da = str_replace($var, $replace_img , $da);
				//var_dump($da);die;
                
            }
			 $resp2 = json_decode(trim($da,chr(239).chr(187).chr(191)), true);
            $data['scenename_varchar'] = $scenename;
            $data['scenecode_varchar'] = 'S' . (date('y', time()) - 9) . date('m', time()) . randorderno(6, -1);
            $data['eqid_int'] = $other_id;
            $data['eqcode'] = $othercode;
            $data['createtime_time'] = date('Y-m-d H:i:s', time());
            $data['showstatus_int'] = 1;
            $data['movietype_int'] = 0;  
            $data['userid_int'] =0;


            $respbgAudio=json_decode($bgAudio,true);;
            if (!empty($respbgAudio['url'])) {
                $bgAudio_str= $bgAudio ; 

                if (preg_match('|^http://|', $respbgAudio['url'])) {
                    $mp = $respbgAudio['url'];


                } elseif (isset($respbgAudio['url'])) {
                    $mp =$otherurl.'/Uploads/' . $respbgAudio['url'];
                }
               
                if(C('ISLOG'))	\Think\Log::write('bgAudio $mp 地址：'.$mp."\n\n -----------\n");
               
                if(strpos($mp,'111ttt.com')===false){

                    $mp3='./Uploads'.substr( $respbgAudio['url'],0,strripos( $respbgAudio['url'],'/')+1);
                    $this->save_pic($mp, $mp3);
                }
                $data["musicurl_varchar"]= $bgAudio_str;

         
                $musicurl_varchar= $data["musicurl_varchar"];
            } else {
            }

         
            $data['scenetype_int'] = $resp['obj']['type'];
            $data['is_tpl'] = 1;
            $data['desc_varchar'] = $description;
            $data['biztype_int'] = $resp['obj']['biztype']? intval($resp['obj']['biztype']):0;
            $data['musictype_int'] = $respbgAudio['type'];
            $data['musictype_int'] = (empty($respbgAudio['type'])) ? 'null' : $data['musictype_int'];

            //2015-5-25
            $data['scenetype_int']= $_GET['scenetypeB'] ? intval($_GET['scenetypeB']) :'101';
            $data['tagid_int']= $_GET['scenetypeS'] ? intval($_GET['scenetypeS']) :'20';

           
            if(empty($resp2['list'])){
                print_r($resp2['list']);
                echo json_encode(array(
                    "msg" => "数据为空"
                ));
                exit;
            }

            if ($lastInsId = $user->add($data)) {
                if(C('ISLOG')) \Think\Log::write('scene 表'. D('')->getLastSql()."\n".var_export($data,true)."\n\n -----------\n");
               
                if($musicurl_varchar&& $_GET['isMusicToSys']){
                    $fileData=array(
                        'userid_int'=>0,
                        'filetype_int'=>2,
                        'filesrc_varchar'=>$musicurl_varchar,
                        'create_time'=>date('y-m-d H:i:s',time()),
                        'biztype_int'=>1,
                        'filename_varchar'=>'模板采集ID为'.$lastInsId.'的音乐',
                        'ext_varchar'=>'MP3'

                    );
					
                    M('upfilesys')->add($fileData);

                   

                }

                echo json_encode(array(
                    "msg" => "成功采集",
                    "url" => 'http://' . $_SERVER['HTTP_HOST'] . '/v-' . $data['scenecode_varchar']
                ));
            } else {
                die(var_dump("数据写入错误"));
                echo json_encode(array(
                    "msg" => "数据写入错误"
                ));
            }
            $dd = M("scenepage");
            $de['sceneid_bigint'] = $lastInsId;
            $de['scenecode_varchar'] =  $othercode; 
            $de['createtime_time'] = date('Y-m-d H:i:s', time());
            $de['content_text'] = '';
            $de['pagename_varchar'] = 'admin';
            $de['userid_int'] =0;

            foreach ($resp2['list'] as $k => $var) {
                $de['properties_text'] = $var["properties"] ? $var["properties"]: 'null';
                $de['content_text'] = json_encode($var['elements']);
                $de['pagecurrentnum_int'] = $k + 1;
                $dd->add($de);
                if($k==0)	\Think\Log::write('127 add page '.var_export($de,true));
            }
        } elseif (isset($_GET['cpic'])) {
            $dd = M("scenepage");
            $where['sceneid_bigint'] = $_GET['id'];
            $data = $dd->where($where)->field('content_text')->select();
        } else {

                echo json_encode(array(
                    "msg" => "参数不对"
                ));
            }

    }

    public function searchMultiArray(array $array, $search, $mode = 'key') {
        $res = array();
        foreach (new RecursiveIteratorIterator(new RecursiveArrayIterator($array)) as $key => $value) {
            if ($search === $ {
                $ {
                    "mode"
                }
            }) {
                if ($mode == 'key') {
                    $res[] = $value;
                } else {
                    $res[] = $key;
                }
            }
        }
        return $res;
    }
    public function my_file_exists($file) {
        if (preg_match('/^http:\/\//', $file)) {
            if (ini_get('allow_url_fopen')) {
                if (@fopen($file, 'r')) return true;
            } else {
                $parseurl = parse_url($file);
                $host = $parseurl['host'];
                $path = $parseurl['path'];
                $fp = fsockopen($host, 80, $errno, $errstr, 10);
                if (!$fp) return false;
                fputs($fp, "GET {$path} HTTP/1.1 \r\nhost:{$host}\r\n\r\n");
                if (preg_match('/HTTP\/1.1 200/', fgets($fp, 1024))) return true;
            }
            return false;
        }
        return file_exists($file);
    }

   public function save_pic($url, $savepath = '') {
        $filename = $this->get_filename($url);
        if(file_exists($savepath.$filename)){
            return $filename;
        }
        $url = trim($url);
        $url = str_replace(" ", "%20", $url);
        $string = $this->read_filetext($url);
        if (empty($string)) {
            \Think\Log::write("-------------------------------\n".'读取不了文件,地址：'.$url."\n");
            return $filename;
        }
        $this->make_dir($savepath);
        $filepath = $savepath . $filename;
        $this->write_filetext($filepath, $string);
        if( C('after_cj_deal') > 1){
            $configApp52 = array(
                'driver' => 'qiniu'
            );
            $upload = new \Think\UploadQQ($configApp52);
            $filedata['ext'] = end(explode('.', $filename)); ;
            $filedata['tmp_name'] =$filepath ;
            $result =  $upload->qiniuSave($filedata) ;
            return $result['downloadUrl'] ;
        }else{
            return $filename;

        }
    }

    function get_filename($filepath) {
        $fr = explode("/", $filepath);
        $count = count($fr) - 1;
        return $fr[$count];
    }
    function read_filetext($filepath) {
        $filepath = trim($filepath);
        $htmlfp = @fopen($filepath, "r");
        if (strstr($filepath, "://")) {
            while ($data = @fread($htmlfp, 500000)) {
                $string.= $data;
            }
        } else {
            $string = @fread($htmlfp, @filesize($filepath));
        }
        @fclose($htmlfp);
        return $string;
    }
    function write_filetext($filepath, $string) {
        $fp = @fopen($filepath, "w");
        @fputs($fp, $string);
        @fclose($fp);
    }
    function make_dir($path) {
        if (!file_exists($path)) {
            $mk = @mkdir($path, 0777, true);
            @chmod($path, 0777);
        }
        return true;
    }
    function GetCurl($url) {
        $curl =curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_USERAGENT,"Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322; .NET CLR 2.0.50727)");
        curl_setopt($curl, CURLOPT_REFERER, 'http://baidu.com/');
        $resp =curl_exec($curl);
        curl_close($curl);
        return $resp;
    }


} ?>
