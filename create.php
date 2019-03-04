<?php
         $config = config("easywechat");//配置文件
         $money_sum = 100;//以分为单位
         $sender = "壹淘铺";
         $mch_id = $config['payment']['merchant_id'];//商户id
         $wxappid =$config['app_id'];//appid

         //设置调接口的参数
         $pay_params = array();
         $pay_params['wxappid'] = $wxappid; //appid
         $pay_params['mch_id'] = $mch_id;//商户id
         $pay_params['mch_billno'] = $pay_params['mch_id'] . date('YmdHis') . rand(1000, 9999);//组合成28位，根据官方开发文档，可以自行设置
         $pay_params['client_ip'] = $_SERVER['REMOTE_ADDR'];
         $pay_params['re_openid'] = $openid;//接收红包openid
         $pay_params['total_amount'] = $money_sum;
         $pay_params['min_value'] = $money_sum;
         $pay_params['max_value'] = $money_sum;
         $pay_params['total_num'] = 1;//发放给的人数
         $pay_params['nick_name'] = $sender;
         $pay_params['send_name'] = $sender;
         $pay_params['wishing'] = "恭喜发财";
         $pay_params['act_name'] = $sender . "推荐";
         $pay_params['remark'] = $sender . "红包";


         $url = "https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack";
         $wxpay = new RedWxPay();
         $pay_result = $wxpay->pay($url, $pay_params);

         $responseObj = simplexml_load_string($pay_result, 'SimpleXMLElement', LIBXML_NOCDATA);
         if ($pay_result && $responseObj->return_code == 'SUCCESS' && $responseObj->result_code == 'SUCCESS') {
             return true;
         }
         return false;
