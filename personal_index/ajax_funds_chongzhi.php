<div class="chongzhi_container">
 <p class="buy_video_tittle">充值</p>
  <form id="cartoonConfirmForm" name=alipayment action="/zfb/alipayapi.php" method=post target="_blank">
    <fieldset>                        
      <div class="ui-fm-item">
        <label class="ui-fm-label ui-fm-label-reset"> 充值方式： </label>
        <img src="../image/zfb.jpg" width="120" height="53">
        <div id="J-limitTable" class="tb-inner tb-bank-intro " style="max-width:600px;margin-bottom:0px;zoom:0;height:auto;">
          <table>
            
            <p class="bank-tip">充值限额如下</p>
            
            <thead>
              <tr>
                <th style="background-color:#E9E9E9;">单笔限额(元)</th>
                <th style="background-color:#E9E9E9;">每日限额(元)</th>
                <th style="background-color:#E9E9E9;">每月限额(元)</th>
                <th style="background-color:#E9E9E9;">充值兑换比</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td> 5000 </td>
                <td> 5000 </td>
                <td> 无 </td>
                <td class="duihuanbi" rowspan="1"> 1学币/元  </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
     
      <div class="ui-fm-item ">
        <label class="ui-fm-label" for="J-depositAmount"> 充值金额： </label>
        <input size="30" id="J-depositAmount" name="WIDprice" class="ui-input ui-input-amount">
        元
        <div class="ui-fm-explain"> </div>
      </div>
      
      <!-- Powered by Alipay Security -->
      
      <div class="ui-fm-item ui-fm-action">
      <span class="ui-btn  ui-btn-ok">
      <input class="ui-btn-text" id="J_authSubmit" type="submit" value="确认充值">
    </fieldset>
  </form>
</div>
<!--end_chongzhi_container-->