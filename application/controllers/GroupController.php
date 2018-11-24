<?php
 require_once 'fastphp/Controller.class.php';
 require_once 'static/Tools.php';

class GroupController extends Controller
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
     * 创建课程组
     */
    public function create()
    {
        // Check for required parameters
        if (isset($_POST["title"]) && isset($_POST["user_id"]) ) {

            $cover_image = '';
            if (($_FILES["cover_image"]["type"] == "image/gif") ||
                ($_FILES["cover_image"]["type"] == "image/jpeg") ||
                ($_FILES["cover_image"]["type"] == "image/png") ||
                ($_FILES["cover_image"]["type"] == "image/pjpeg"))
            {
                if ($_FILES["cover_image"]["error"] > 0) {
                    $this->sendResponse(10004, '', $_FILES["cover_image"]["error"]);
                } else {
                    $fillname = $_FILES['cover_image']['name']; // 得到文件全名
                    $dotArray = explode('.', $fillname);  // 以.分割字符串，得到数组
                    $type = end($dotArray); // 得到最后一个元素：文件后缀
                    $cover_image = "/upload/img/".md5(uniqid(rand())).'.'.$type; // 产生随机唯一的名字
                    move_uploaded_file( $_FILES["cover_image"]["tmp_name"], APP_PATH.$cover_image);
                }
            }

            $groupModel = new GroupModel;

            $date = date('Y-m-d H:i:s');
            $data = array(
                "user_id"       => $_POST["user_id"],
                'title'         => $_POST["title"],
                'introduce'     => $_POST["introduce"],
                'cover_image'   => $cover_image,
                'type'          => $_POST["type"],
                'content_type'  => $_POST["content_type"],
                'label'         => $_POST["label"],
                'color'         => $_POST["color"],
                'enroll'        => $_POST["enroll"],
                'create_time'   => $date,
                'update_time'   => $date);

            $groupModel->add($data);

            $this->sendResponse(200, '', "创建成功");
        }
        else
            $this->sendResponse(10000,'',"参数错误");
    }

    /*
     *  id
     *  size
     */
    public function list()
    {
        // Check for required parameters
        if (1) {

            $pos_id = $_POST["pos_id"];
            $size   = $_POST["size"];

            if(!isset($_POST["pos_id"]))
                $pos_id = 0;
            if(!isset($_POST["size"]))
                $size = 20;

                $groupModel = new GroupModel;

            if($pos_id > 0)
            {
                $where = array(
                    "id<".$pos_id
                );
                $groupModel->where($where);
            }

            $order = array(
                "id DESC LIMIT ".$size
            );
            $groupModel->order($order);
            $items = $groupModel->selectAll();

            foreach($items as &$item){
                $item["cover_image"] = Tools::imageHost().$item["cover_image"];
            }
            unset($item); // 最后取消掉引用

            $this->sendResponse(200, $items);
        }
        else
            $this->sendResponse(10000,'',"参数错误");
    }

    /*主页推荐
     *  id
     *  size
     */
    public function focus()
    {
        $items = (new ItemModel)->selectAll();
    }
}