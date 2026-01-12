$(document).ready(function(){


    function changePassword(){
        $('body').append('\
            <div class="popUp">\
                <div class="whiteScreen"></div> \
                <div class="white-popUp"> \
                    <div class="container">\
                         <h3>修改登入密碼</h3> \
                        <form> \
	                         <input  type="password" placeholder="輸入舊密碼" class="form"/> \
	                         <input type="password" placeholder="輸入新密碼" class="form"/> \
	                         <input type="password" placeholder="再次輸入新密碼" class="form"/> \
	                         <div class="btn-green-border pull-left popUp-cancel"> \
	                            <h5>取消</h5> \
	                        </div> \
	                        <div class="btn-green pull-right"> \
	                            <h5> 確認</h5> \
	                        </div> \
                        </form> \
                    </div> \
                </div> \
            </div>')
    }


    function cancelRegister(){
        $('body').append('\
            <div class="popUp"> \
                <div class="whiteScreen"></div>\
                <div class="white-popUp"> \
                    <div class="container"> \
                        <h3>是否取消參與活動？</h3> \
                        <input type="text" placeholder="請輸入登入密碼" class="form"/> \
                        <div class="btn-green-border pull-left popUp-cancel">\
                             <h5>取消</h5> \
                        </div> \
                        <a href="cancelApply.html"><div class="btn-green pull-right"> \
                            <h5> 確認</h5>\
                        </div></a>\
                    </div> \
                </div> \
            </div>');
    }

    function deleteArticle(){
        $('body').append('\
            <div class="popUp"> \
                <div class="whiteScreen"></div> \
                <div class="white-popUp"> \
                    <div class="container"> \
                        <h3 style="margin-bottom:30px ;margin-top: 20px;">是否刪除XXX藝術家資料？</h3> \
                        <div class="btn-green-border pull-left popUp-cancel"> \
                        <h5>取消</h5> </div> <div class="btn-green pull-right"> \
                        <h5> 確認</h5> \
                        </div> \
                    </div> \
                </div> \
            </div>');
    }





    //變更密碼 彈跳視窗 
   $('.changePassword').click(function(){
        changePassword();
    });

    
   //取消報名 彈跳視窗 
   $('.cancleRegistret').click(function(){
        cancelRegister();
   });


   //刪除menu-list 5 的資料
$('.deleteArticle').click(function(e){
    e.preventDefault();
    deleteArticle();
  })
  
  
  //進入menu-list時更換鉛筆icon
$('#menu-apply li:not(.disEdited)').mouseenter(function() {
    if( !$(this).hasClass('active')){
      $(this).find('.fa-check').removeClass('fa-check').addClass('fa-pencil');  
   }
  });
  
  
  //離開menu-list時跟換回打勾icon
  $('#menu-apply li:not(.disEdited)').mouseleave(function() {
    if(!$(this).hasClass('active')){
      $(this).find('.fa-pencil').removeClass('fa-pencil').addClass('fa-check');
    }
  });
  
});