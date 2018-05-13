<?php
namespace app\uploader\controller;
use think\Controller;
class Newtestpaper extends Controller{
    public function index(){
        return $this->fetch('newtestpaper');
    }
    public function add($name,$class,$subject,$school,$uploader,$headquestion){
        $user=new \app\api\controller\User();
        $uploaderid=$user->checkuser($uploader);
        if($uploaderid){
            $testpaper=new \app\api\controller\Testpaper();
            $id=$testpaper->add($name,$class,$subject,$school,$uploaderid,$headquestion);
            return json(['status'=>1,'id'=>$id]);
        }
        return json(['status'=>0]);
    }
}