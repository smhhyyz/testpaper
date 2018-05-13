<?php 
    namespace app\api\controller;
    use think\Controller;
    use \app\api\model\User as UserModel;
    /**
     * 选择题控制类
     * 
     */
    class Select extends Controller{
        public function getprogress($belong,$belongid){
            $list=\app\api\model\Select::all(['Belong'=>$belong,'BelongTitle'=>$belongid]);
            $testpaper=\app\api\model\Testpaper::get(['ID'=>$belong]);
            $list1=\json_decode($testpaper->HeadQuestion);
            $number=$list1[$belongid-1]->number;
            return ['progress'=>round(((count($list)+1)/$number)*100),'now'=>count($list)+1];
        }
        public function add($belong,$belongid,$name,$answerlist,$score){
            $select=new \app\api\model\Select();
            $answer=[];
            $option=[];
            foreach ($answerlist as $key=>$value) {
                array_push($option,$value['answer']);
                if($value['type']=="true"){
                    array_push($answer,$key);
                }  
            }
            $select->data([
                'Name'=>$name,
                'Answer'=>json_encode($answer),
                'Option'=>json_encode($option),
                'Belong'=>$belong,
                'BelongTitle'=>$belongid,
                'Score'=>(int)$score
            ]);
            $select->save();
        }
    }