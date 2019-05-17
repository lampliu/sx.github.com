<script>
	    //分享
    var config={$jscfg};//后台返回配置信息
    wx.config({
        debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
        appId: config.appId, // 必填，公众号的唯一标识
        timestamp: config.timestamp, // 必填，生成签名的时间戳
        nonceStr: config.nonceStr, // 必填，生成签名的随机串
        signature: config.signature,// 必填，签名
        jsApiList: config.jsApiList // 必填，需要使用的JS接口列表
    });


    wx.ready(function(){   //需在用户可能点击分享按钮前就先调用
        var imgurl=$("#imgurl").val();
        var title=$(".producttitle").text();
        wx.updateAppMessageShareData({//分享朋友
            title: "壹淘铺", // 分享标题
            desc: title, // 分享描述
            link:  window.location.href, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
            imgUrl: imgurl, // 分享图标
            success: function () {
                // 设置成功
            },
            cancel: function () {
            }
        });
        // wx.updateTimelineShareData({//分享朋友圈
        //     title: '', // 分享标题
        //     link: '', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
        //     imgUrl: '', // 分享图标
        //     success: function () {
        //         // 设置成功
        //     }
        // });
    });
</script>