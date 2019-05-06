<?php
 require_once 'fastphp/Controller.class.php';
 require_once 'static/Tools.php';

class AppsController extends Controller
{
    /*
     * 创建app
     */
    public function create()
    {
        // Check for required parameters
        if (isset($_POST["name"]) &&
            isset($_POST["type"]) &&
            isset($_POST["token"]) &&
            isset($_POST["bundle_id"]) &&
            isset($_POST["ver"])) {

            //验证token
            $de_json = json_decode(base64_decode($_POST["token"]),TRUE);
            $user_id = $de_json["user_id"];
            if(!$user_id){
                $this->sendResponse(10000,'',"token参数错误");
                return;
            }

            //获取要创建app_id
            $app_id = 0;
            $appsModel = new AppsModel();
            //获取app_id
            $item = $appsModel->query("select max(id) AS id from apps;");//
            if (count($item) > 0) {
                $app_id = intval($item["id"])+1;
            }


            $appDir = "upload/apps/".strval($app_id)."/";
            $packageDir = $appDir.strval($_POST["ver"])."/";
            //上传安装包
            $package = $this->saveUploadFile($packageDir,'package');
            if ( $package === '') {//没有安装包报错
                $this->sendResponse(10001,'',"上传安装包错误");
                return;
            }

            //上传图片
            $logo0   = $this->saveUploadFile($appDir,'logo0','logo57x57');
            $logo1   = $this->saveUploadFile($appDir,'logo1','logo512x512');

            //创建index.html href="itms-services:///?action=download-manifest&url=https://hanjx.tk/app/vhallyundemo/manifest.plist"
            $packageHost = 'https://hanjx.tk/';
            $plistUrl = $packageHost.$packageDir.'manifest.plist';
            $this->writeIndexFile($packageDir,$_POST["name"].'(v'.strval($_POST["ver"]).")",$_POST["describe"],$plistUrl);

            //创建manifest.plist
            $bundleid = $_POST["bundle_id"];
            $bundleversion = $_POST["ver"];
            $title = $_POST["name"];

            $this->writePlistFile($packageDir,$packageHost.$package,$packageHost.$logo0,$packageHost.$logo1, $bundleid,$bundleversion,$title);
            //入库
            $appVersModel = new AppVersModel();
            $appVerID = 0;
            //获取 appVerID
            $item = $appVersModel->query("select max(id) AS id from app_vers;");//
            if (count($item) > 0) {
                $appVerID = intval($item["id"])+1;
            }

            $date = date('Y-m-d H:i:s');
            $data = array(
                "ver"            => $_POST["ver"],
                'app_id'         => $app_id,
                'package'        => $package,
                'ver_build'      => $_POST["ver_build"],
                'create_time'   => $date,
                'update_time'   => $date);
            $appVersModel->add($data);

            $data1 = array(
                "name"        => $_POST["name"],
                'subname'     => $_POST["subname"],
                'describe'     => $_POST["describe"],
                'user_id'   => $user_id,
                'ver_id'   => $appVerID,
                'type'   => $_POST["type"],
                'bundle_id'=> $_POST["bundle_id"],
                'logo0'   => $logo0,
                'logo1'   => $logo1,

                'create_time' => $date,
                'update_time' => $date);
            $appsModel->add($data1);

            $this->sendResponse(200, $data1, "创建成功");
        }
        else
            $this->sendResponse(10000,'',"参数错误");
    }


    /*
 * 创建app ver
 */
    public function createver()
    {
        // Check for required parameters
        if (isset($_POST["token"]) &&
            isset($_POST["app_id"]) &&
            isset($_POST["ver"]) &&
            isset($_POST["ver_build"])) {

            //验证token
            $de_json = json_decode(base64_decode($_POST["token"]),TRUE);
            $user_id = $de_json["user_id"];
            if(!$user_id){
                $this->sendResponse(10000,'',"token参数错误");
                return;
            }

            //获取要创建app_id
            $app_id = $_POST["app_id"];


            $item = (new AppsModel)->select($app_id);

            if ( $item == null) {//没有安装包报错
                $this->sendResponse(10002,'',"app_id 不存在");
                return;
            }

            $appDir = "upload/apps/".strval($app_id)."/";
            $packageDir = $appDir.strval($_POST["ver"])."/";
            //上传安装包
            $package = $this->saveUploadFile($packageDir,'package');
            if ( $package === '') {//没有安装包报错
                $this->sendResponse(10001,'',"上传安装包错误");
                return;
            }

            //创建index.html href="itms-services:///?action=download-manifest&url=https://hanjx.tk/app/vhallyundemo/manifest.plist"
            $packageHost = 'https://hanjx.tk/';
            $plistUrl = $packageHost.$packageDir.'manifest.plist';
            $this->writeIndexFile($packageDir,$item["name"].'(v'.strval($_POST["ver"]).")",$item["describe"],$plistUrl);

            //创建manifest.plist
            $bundleid = $item["bundle_id"];
            $bundleversion = $_POST["ver"];
            $title = $item["name"];

            $logo0 = $item['logo0'];
            $logo1 = $item['logo1'];

            $this->writePlistFile($packageDir,$packageHost.$package,$packageHost.$logo0,$packageHost.$logo1, $bundleid,$bundleversion,$title);

            //入库
            $appVersModel = new AppVersModel();
            $appVerID = 0;
            //获取 appVerID
            $item = $appVersModel->query("select max(id) AS id from app_vers;");//
            if (count($item) > 0) {
                $appVerID = intval($item["id"])+1;
            }

            $date = date('Y-m-d H:i:s');
            $data = array(
                "ver"            => $_POST["ver"],
                'app_id'         => $app_id,
                'package'        => $package,
                'ver_build'      => $_POST["ver_build"],
                'create_time'   => $date,
                'update_time'   => $date);
            $appVersModel->add($data);

            $data1 = array(
                'ver_id'   => $appVerID,
                'update_time' => $date);
            (new AppsModel())->update($app_id,$data1);


            $this->sendResponse(200, $data, "创建成功");
        }
        else
            $this->sendResponse(10000,'',"参数错误");
    }


    /*
     *  pos_id
     *  size
     */
    public function applist()
    {
        // Check for required parameters
        if (1) {
            $pos_id = $_POST["pos_id"];
            $size   = $_POST["size"];
            if(!isset($_POST["pos_id"])) $pos_id = 0;
            if(!isset($_POST["size"]))   $size = 20;

            $appsModel = new AppsModel;
            if($pos_id > 0)
                $appsModel->where(array("id<".$pos_id));
            $appsModel->order(array("update_time DESC LIMIT ".$size));
            $items = $appsModel->selectAll();
//            foreach($items as &$item){
//                $item["cover_image"] = Tools::imageHost().$item["cover_image"];
//            }
            unset($item); // 最后取消掉引用

            $this->sendResponse(200, $items);
        }
        else
            $this->sendResponse(10000,'',"参数错误");
    }

    /*
     *  app_id
     *
     */
    public function detail()
    {
        // Check for required parameters
        $app_id = $_POST["app_id"];
        if (isset($app_id) ) {
            $item = (new AppsModel)->select($app_id);
            $veritem = (new AppVersModel)->select($item['ver_id']);


            $this->sendResponse(200, array_merge($item, $veritem));
        }
        else
            $this->sendResponse(10000,'',"参数错误");
    }

    /*
     * 上传文件 目录，文件参数key，文件重命名
     */
    function saveUploadFile($dir,$filename,$rename = '')
    {
        if (!isset($_FILES[$filename])) return '';

        Tools::checkDir("./".$dir);//检查目录是否存在并创建

        //上传文件
        if ($_FILES[$filename]["error"] > 0) {

            echo 'error'.$_FILES[$filename]["error"];

            return '';
        } else {
            $imgname = $_FILES[$filename]['name'];
            $tmp = $_FILES[$filename]['tmp_name'];

            $filepath = '/'.$dir;
            if($rename == '') {
                $filepath = $filepath.$imgname;
            }
            else {
                $dotArray = explode('.', $imgname); // 以.分割字符串，得到数组
                $type = end($dotArray); // 得到最后一个元素：文件后缀

                $filepath = $filepath.$rename.'.'.$type;
            }

            if(move_uploaded_file($tmp,APP_PATH.$filepath)){
                //echo "上传成功";
                return $filepath;
            }else
            {
                return '';
            }
        }
    }

    /*
     * 创建并写入index文件
     */
    function writeIndexFile($packageDir,$title,$desc,$plisturl)
    {
        $myfile = fopen('./'.$packageDir."/index.html", "w") or die("Unable to open file!");

        $txt = '<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="x-dns-prefetch-control" content="on" />
    <meta name="renderer" content="webkit">
    <link rel="dns-prefetch" href="//cnstatic01.e.vhall.com/3rdlibs" />
    <link rel="dns-prefetch" href="//cnstatic01.e.vhall.com/static" />
    <title>App下载</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <link rel="stylesheet" href="//cnstatic01.e.vhall.com/static/css/project/app/app_mobile.css?v=20161221">
    <script>
    </script>
</head>

<body>
<div class="wrapper section-app">
    <h1 class="title">';
        $txt = $txt.$title;
        $txt = $txt.'</h1>
<p class="desc">';
        $txt = $txt.$title;
        $txt = $txt.'</p>
<section style="padding-top: 150px;" class="footer">
<a href="itms-services:///?action=download-manifest&url=';
        $txt = $txt.$plisturl;
        $txt = $txt.'" class="btn btn-download open-app" >APP下载</a>
    </section>
    <p style="font-size:10px" class="desc">未受信任的企业级开发者解决方法</p>
    <p style="font-size:10px" class="desc">设置 -> 通用 -> 描述文件 -> Beijing Vhall Technology co.,Ltd. 点击信任</p>
</div>
</body>
<script src="//cnstatic01.e.vhall.com/3rdlibs/jquery/1.11.2/jquery.min.js"></script>
</html>';
        fwrite($myfile, $txt);
        fclose($myfile);
    }

    function writePlistFile($packageDir,$packageUrl,$logo0Url,$logo1Url,$bundleid,$bundleversion,$title)
    {
        $myfile = fopen('./'.$packageDir."/manifest.plist", "w") or die("Unable to open file!");

        $txt = '<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
<plist version="1.0">
<dict>
	<key>items</key>
	<array>
		<dict>
			<key>assets</key>
			<array>
				<dict>
					<key>kind</key>
					<string>software-package</string>
					<key>url</key>
					<string>';
        $txt = $txt.$packageUrl;
        $txt = $txt.'</string>
				</dict>
				<dict>
					<key>kind</key>
					<string>display-image</string>
					<key>url</key>
					<string>';
        $txt = $txt.$logo0Url;
        $txt = $txt.'</string>
				</dict>
				<dict>
					<key>kind</key>
					<string>full-size-image</string>
					<key>url</key>
					<string>';
        $txt = $txt.$logo1Url;
        $txt = $txt.'</string>
				</dict>
			</array>
			<key>metadata</key>
			<dict>
				<key>bundle-identifier</key>
				<string>';
        $txt = $txt.$bundleid;
        $txt = $txt.'</string>
				<key>bundle-version</key>
				<string>';
        $txt = $txt.$bundleversion;
        $txt = $txt.'</string>
				<key>kind</key>
				<string>software</string>
				<key>title</key>
				<string>';
        $txt = $txt.$title;
        $txt = $txt.'</string>
			</dict>
		</dict>
	</array>
</dict>
</plist>
';
        fwrite($myfile, $txt);
        fclose($myfile);
    }

//上传多个文件到upload/baby/  https://blog.csdn.net/wry_developer/article/details/75566305
    public function test()
    {
        $babyDir = "upload/baby/";
        $this->uploadfile($babyDir);
        $this->sendResponse(200, '', "创建成功");
    }


    function buildInfo(){
     $info = $_FILES;
        $i = 0;
        foreach ($_FILES as $v){//三维数组转换成2维数组
            if(is_string($v['name'])){ //单文件上传
                $info[$i] = $v;
                $i++;
            }else{ // 多文件上传
                foreach ($v['name'] as $key=>$val){//2维数组转换成1维数组
                    //取出一维数组的值，然后形成另一个数组
                    //新的数组的结构为：info=>i=>('name','size'.....)
                    $info[$i]['name'] = $v['name'][$key];
                    $info[$i]['size'] = $v['size'][$key];
                    $info[$i]['type'] = $v['type'][$key];
                    $info[$i]['tmp_name'] = $v['tmp_name'][$key];
                    $info[$i]['error'] = $v['error'][$key];
                    $i++;
                }
            }
        }
        return $info;
    }

    function uploadfile($path="uploads",
                        $allowExt = array('png','jpg','jpeg','gif','mmp','qnmlgb'),
                        $maxSize=10485760,$imgFlag=true){

        Tools::checkDir("./".$path);//检查目录是否存在并创建

        $uploadedFiles = array();
        $i = 0;
        $infoArr = $this->buildInfo();
        foreach ($infoArr as $val) {
            if ($val['error'] === UPLOAD_ERR_OK) {

                if($val['size']>$maxSize){
                    $mes = "文件太大了";
                    exit;
                }

                if(!is_uploaded_file($val['tmp_name'])){
                    $mes = "不是通过httppost传输的";
                    exit;
                }

                $realName = $val['name'];
                $destination = $path."/".$realName;
                if(move_uploaded_file($val['tmp_name'], APP_PATH.$destination)){
                    $val['name'] = $realName;
                    unset($val['error'],$val['tmp_name'],$val['size'],$val['type']);

                    $uploadedFiles[$i]=$val;//?????????
                    $i++;
                }
            }else {
                switch ($val['error']) {
                    case 1: // UPLOAD_ERR_INI_SIZE
                        $mes = "超过配置文件中上传文件的大小";
                        break;
                    case 2: // UPLOAD_ERR_FORM_SIZE
                        $mes = "超过表单中配置文件的大小";
                        break;
                    case 3: // UPLOAD_ERR_PARTIAL
                        $mes = "文件被部分上传";
                        break;
                    case 4: // UPLOAD_ERR_NO_FILE
                        $mes = "没有文件被上传";
                        break;
                    case 6: // UPLOAD_ERR_NO_TMP_DIR
                        $mes = "没有找到临事文件目录";
                        break;
                    case 7: // UPLOAD_ERR_CANT_WRITE
                        $mes = "文件不可写";
                        break;
                    case 8: // UPLOAD_ERR_EXTENSION
                        $mes = "php扩展程序中断了上传程序";
                        break;
                }
                echo $mes;
            }
        }

        return $uploadedFiles;
    }
}