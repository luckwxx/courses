<?php
 require_once 'fastphp/Controller.class.php';

class GroupController extends Controller
{
    public function test()
    {
        $groupModel = new GroupModel;
        $items = $groupModel->query("select max(id) AS id  from course_group;");

        $this->sendResponse(200, $items, "注册成功");
    }

    /*
     * 创建课程组
     */
    public function create()
    {
        // Check for required parameters
        if (isset($_POST["title"]) && isset($_POST["user_id"]) &&isset($_POST["type"]) && isset($_POST["content_type"])) {

            $groupModel = new GroupModel;

            $date = date('Y-m-d H:i:s');
            $data = array(
                "user_id"       => $_POST["user_id"],
                'title'         => $_POST["title"],
                'introduce'     => $_POST["introduce"],
//                'cover_image' => "".$_POST["type"],
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