<?php
class

	 //阿里大鱼
        vendor("aliyun.apiSmsSend.SmsAlidayu");
        $dayuNew=new \SmsAlidayu();
        $result=$dayuNew::sendSms($mobile,"SMS_141920081",$safecode);
         if($result->Code !='OK'){
             throw new \Exception('短信发送失败，请重试',4222);
         }
	  /**
     * 生成验证码
     * @param int $length
     */
    function generate_code($length = 4) {
        return rand(pow(10,($length-1)), pow(10,$length)-1);
    }

}
