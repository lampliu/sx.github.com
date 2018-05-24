<?php
/**
 * Created by PhpStorm.
 * User: shuangxi
 * Date: 2018/5/14
 * Time: 11:48
 */

namespace api\home\controller;

use think\Db;

class AddressController extends BaseController
{

    /**
     * 生成树型结构所需要的2维数组
     * @var array
     */
    public $arr = [];
    /**
     * 构造函数，初始化类
     * @param array 2维数组，例如：
     */

    public function __construct()
    {
        parent::__construct();
        $this->arr =  Db::name('region')->select()->toArray();
        $this->ret = '';
    }



    /**
     * 得到子级数组
     * @param int
     * @return array
     */
    public function getChild($myId)
    {
        $newArr = [];
        if (is_array($this->arr)) {
            foreach ($this->arr as $id => $a) {

                if ($a['parent_id'] == $myId) {
                    $newArr[$id] = $a;
                }
            }
        }

        return $newArr ? $newArr : false;
    }


    /**
     * 生成树型结构数组
     * @param int myID，表示获得这个ID下的所有子级
     * @param int $maxLevel 最大获取层级,默认不限制
     * @param int $level 当前层级,只在递归调用时使用,真实使用时不传入此参数
     * @return array
     */
    public function getTreeArray($myId, $maxLevel = 0, $level = 1)
    {
        $returnArray = [];

        //一级数组
        $children = $this->getChild($myId);

        if (is_array($children)) {
            foreach ($children as $child) {
                $child['name']           = $child['region_name'];
                $returnArray[$child['region_id']] = $child;
                if ($maxLevel === 0 || ($maxLevel !== 0 && $maxLevel > $level)) {
                    $mLevel                                = $level + 1;
                    $returnArray[$child['region_id']]["sub"] = $this->getTreeArray($child['region_id'], $maxLevel, $mLevel);
                }
            }
        }

        return $returnArray;
    }

	   /**
      * 重置多维数组
      */
     public function addressTree(){
         $a=$this->getTreeArray(1,4);
         $this->success('请求成功',$a);
     }


}