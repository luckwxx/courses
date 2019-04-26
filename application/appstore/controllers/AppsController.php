<?php
 require_once 'fastphp/Controller.class.php';
 require_once 'static/Tools.php';

class AppsController extends Controller
{
    public function test()
    {
        //web文件上传
        $imgname = $_FILES['img']['name'];
        $tmp = $_FILES['img']['tmp_name'];

        $dotArray = explode('.', $imgname); // 以.分割字符串，得到数组
        $type = end($dotArray); // 得到最后一个元素：文件后缀
        $filepath = APP_PATH.'upload/img/'.Tools::uuid().'.'.$type;
        if(move_uploaded_file($tmp,$filepath)){
//            echo "上传成功";
            $this->sendResponse(200, '', "注册成功");
        }else
            {
            $this->sendResponse(400, '');
        }

//        $path = APP_PATH."upload/img/".Tools::uuid().".jpg";
//
//        $byte=$_POST['test'];
//        $byte = str_replace(' ','',$byte);   //处理数据
//        $byte = str_ireplace("<",'',$byte);
//        $byte = str_ireplace(">",'',$byte);
//        $byte=pack("H*",$byte);      //16进制转换成二进制
//        file_put_contents($path,$byte)//写入文件中！

        //

//        $img = $_POST["img"];
//        Tools::saveImage($path,$img);


//        $groupModel = new GroupModel;
//        $items = $groupModel->query("select max(id) AS id  from course_group;");
//
//        $this->sendResponse(200, $items, "注册成功");
    }

    /*
     * 创建app
     */
    public function create()
    {
        // Check for required parameters
        if (isset($_POST["name"]) &&
            isset($_POST["type"]) &&
            isset($_POST["token"]) &&
            isset($_POST["ver"])) {

            $de_json = json_decode(base64_decode($_POST["token"]),TRUE);
            $user_id = $de_json["user_id"];
            if(!$user_id){
                $this->sendResponse(10000,'',"参数错误");
                return;
            }


            $logo0 = '';
            $logo1 = '';
            $package = '';

            $app_id = 0;
            $appsModel = new AppsModel();
            //获取app_id
            $item = $appsModel->query("select max(id) AS id from apps;");//
            if (count($item) > 0) {
                $app_id = intval($item["id"])+1;
            }

            $fileDir = "upload/apps/".strval($app_id)."/".strval($_POST["ver"])."/";
            Tools::checkDir("./".$fileDir);

            //上传$logo0
            if ($_FILES['logo0']["error"] > 0) {
                $this->sendResponse(10004, '', $_FILES["logo0"]["error"]);
            } else {
                $imgname = $_FILES['logo0']['name'];
                $tmp = $_FILES['logo0']['tmp_name'];

                $dotArray = explode('.', $imgname); // 以.分割字符串，得到数组
                $type = end($dotArray); // 得到最后一个元素：文件后缀

                $logo0 = $fileDir.'logo57x57.'.$type;
                $filepath = APP_PATH.$logo0;
                $logo0 = "/".$logo0;

                if(move_uploaded_file($tmp,$filepath)){
                    //echo "上传成功";
                }else
                {
                    $logo0 = '';
                }
            }

            //上传$logo1
            if ($_FILES['logo1']["error"] > 0) {
                $this->sendResponse(10004, '', $_FILES['logo1']["error"]);
            } else {
                $imgname = $_FILES['logo1']['name'];
                $tmp = $_FILES['logo1']['tmp_name'];

                $dotArray = explode('.', $imgname); // 以.分割字符串，得到数组
                $type = end($dotArray); // 得到最后一个元素：文件后缀

                $logo1 = $fileDir.'logo.512x512.'.$type;
                $filepath = APP_PATH.$logo1;
                $logo1 = "/".$logo1;

                if(move_uploaded_file($tmp,$filepath)){
                    //echo "上传成功";
                }else
                {
                    $logo1 = '';
                }
            }

            //上传 $package
            if ($_FILES['package']["error"] > 0) {
                $this->sendResponse(10004, '', $_FILES['package']["error"]);
            } else {
                $imgname = $_FILES['package']['name'];
                $tmp = $_FILES['package']['tmp_name'];

                $dotArray = explode('.', $imgname); // 以.分割字符串，得到数组
                $type = end($dotArray); // 得到最后一个元素：文件后缀

                $package = "/".$fileDir.$imgname;

                $filepath = APP_PATH.$fileDir.$imgname;
                if(move_uploaded_file($tmp,$filepath)){
                    //echo "上传成功";
                }else
                {
                    $package = '';
                }
            }


            $appVersModel = new AppVersModel();
            $appVerID = 0;
            //获取app_id
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
 *  pos_id
 *  size
 */
    public function list()
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
            $this->sendResponse(200, $item);
        }
        else
            $this->sendResponse(10000,'',"参数错误");
    }
}