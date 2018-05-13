<?php
namespace app\uploader\controller;
use think\Controller;
class Fill extends Controller{
    public function index($belong,$belongid){
        if(isset($_COOKIE['userid'])){
            
            $testpaper=new \app\api\controller\Testpaper();
            $data=$testpaper->getTitle($belong,$belongid);
            if($data){
                setcookie("belong",$belong);
                setcookie("belongid",$belongid);
                $this->assign('data',$data);
                return $this->fetch("fill");
            }
            return $this->error('未知大题');
        }
        return $this->error('请先登录');
    }
}