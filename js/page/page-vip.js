/**
* Author: [huyinghuan](xiacijian@163.com)
* Date: 2015.11.10
* Desc: VIP开通购买逻辑
*
{
  status: 1, 　//1:成功, ０:失败
  msg: "xxx"  //msg失败原因，成功时可以为空．　
}
**/
H.ready(['jquery'], function() {
	jQuery(function($) {
      var $nowCoins = $("div.vip-pc-buy #cal_nowCoins");
      var $needCoins = $("div.vip-pc-buy #cal_needCoins");
      var $buyDays = $("div.vip-pc-buy #cal_days");
      
      var buyVipFail = $("div.vip-pc-buy div#buyVipFail")
      var buyVipSuccess = $("div.vip-pc-buy div#buyVipSuccess")
      
      //判断米币
      var judgeCoinsEnough = function(){
        var nowCoin = parseInt($nowCoins.val()) || 0;
        var needCoins = parseInt($needCoins.val()) || 0;
        if(needCoins === 0){return;}
        //米币不足,提示
        if(nowCoin < needCoins){
          buyVipFail.slideDown();
          return false;
        }
        buyVipFail.hide();
        return true;
      }
      var $countDown = $("div.vip-pc-buy div#buyVipSuccess")
      
      var updateCountDown = function(cb){
        $countDown.slideDown();
        $p = $('#u-vip-msg-countdown')
        var n = 3;
        setInterval(function(){
          n = n - 1
          $p.html(n);
          if(n == 0){
            cb();
          }
        }, 1000)
      }
      
      $("div.vip-pc-buy .m-days").find('label').click(function(){
        
        //设置所需米币隐藏字段
        $needCoins.val($(this).data('need_coins'));
        
        //切换样式
        $(this).addClass('on')
          .siblings('label').removeClass('on')
          .find("input:radio[name=days]").attr('checked', false);
        
        //选中单选按钮
        $(this).find("input:radio[name=days]").attr('checked', true);
        $buyDays.val($(this).find("input:radio[name=days]").val())
        judgeCoinsEnough();
      });
      
      $submitForm = $("form#buygroupform")
      
      $('div.vip-pc-buy button#editsubmit_btn').click(function(){
        //判断米币不足
      　if(!judgeCoinsEnough()){return;}
        //提交表单
        var url = "home.php?mod=spacecp&ac=usergroup&do=buy&groupid=22&inajax=1";
        var data = {
          days: $buyDays.val()
        }
        
        $submitForm.find('input').each(function(){
          data[$(this).attr('name')] = $(this).val()
        })
        
        $.post(url, data, function(result){
          result = result ? JSON.parse(result) : {};
          if(result.code === 1){
            updateCountDown(function(){location.reload();});
          }else{
            buyVipFail.slideDown();
          }
        });
      });
      
	})
    
})