<?php
namespace app\uploader\controller;
use think\Controller;
use think\Db;
use \app\api\model\User as UserModel;
use \app\api\model\Testpaper as PaperModel;
class Historypaper extends Controller{
    public function index(){
        $user=UserModel::get(["Cookie"=>$_COOKIE['userid']]);//从数据库调取此用户信息
        if($user){
            $this->assign("user",$user);
            $paper = Db::query("select * from testpaper where Uploader = $user->ID");
            if($paper)
            {
                $this->assign("paper",$paper);
            }
        }
        return $this->fetch("historypaper");
    }
}