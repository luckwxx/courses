<?php
 require_once 'fastphp/Controller.class.php';

class UserController extends Controller
{
    public function test()
    {
        $userModel = new UserModel;
        $items = $userModel->query("select max(id) AS id  from users;");

        $this->sendResponse(200, $items, "注册成功");
    }

    //注册

    /**
     *
     */
    public function register()
    {
        // Check for required parameters
        if (isset($_POST["type"]) && isset($_POST["account"]) && isset($_POST["password"])) {

            // Put parameters into local variables
            $type = $_POST["type"];
            $account = $_POST["account"];
            $password = md5($_POST["password"]);

            $result = array(
                "identity_type=".$type,
                "identifier='".$account."'",
                "credential='".$password."'",
            );

            $userModel = new UserModel;
            $userAuthsModel = new UserAuthsModel;
            $userAuthsModel->where($result);
            $items = $userAuthsModel->selectAll();


            if (count($items)>0) {
                $this->sendResponse(10003,'',"此账号已被注册");
                return;
            }
            else {
                $date = date('Y-m-d H:i:s');
                $data['nickname']=$_POST['nickname'];
                $data['create_time']= $date;
                $userModel->add($data);

                $item = $userModel->query("select max(id) AS id  from users;");//
                if (count($item) > 0) {
                    $data1['user_id']=$item["id"];
                    $data1['identity_type']= $type;
                    $data1['identifier']=$account;
                    $data1['credential']=$password;
                    $data1['create_time']=$date;
                    $data1['login_time']=$date;
                    $userAuthsModel->add($data1);
                }
                
                $this->sendResponse(200, '', "注册成功");
            }
        }
        else
            $this->sendResponse(10000,'',"参数错误");
    }
    //登录
    public function login()
    {
        // Check for required parameters
        if (isset($_POST["type"]) && isset($_POST["account"]) && isset($_POST["password"])) {
     
            // Put parameters into local variables
            $type = $_POST["type"];
            $account = $_POST["account"];
            $password = md5($_POST["password"]);

            $result = array( 
                "identity_type=".$type,
                "identifier='".$account."'",
                "credential='".$password."'",
            );

            $userAuthsModel = new UserAuthsModel;
            $userAuthsModel->where($result);
            $items = $userAuthsModel->selectAll();

            if (count($items)==0) {
                $this->sendResponse(10001,'',"账号或密码错误");
                return;
            }


            $user_id = $items[0]["user_id"];
            $userModel = new UserModel;
            $item = $userModel->select($user_id);
            if (count($items)==0) {
                $this->sendResponse(10002,'',"用户不存在");
                return;
            }


            $data = array('id' => $items[0]['id'], 'login_time'=> date('Y-m-d H:i:s'));
            $count = $userAuthsModel->update($items[0]['id'], $data);


            $this->sendResponse(200,$item);
        }
        else
            $this->sendResponse(10000,'',"参数错误");
    }
}