
var hash = "";

window.onhashchange = function(){
        // hash changed. Do something cool.
        if(location.hash){
             var hash = location.hash.substring(1);
			setTimeout(function() {
				window.scrollTo(0, 0);
				GetHash('#' + hash);
			}, 1);
			history.pushState("", document.title, window.location.href.replace(/\#(.+)/, '').replace(/http(s?)\:\/\/([^\/]+)/, '') );
        }
}

$(document).ready(function() {
});

/*
$(function() {
    window.onunload = function (){window.scrollTo(0, 0);}

    var hash = window.location.hash.substr(1);
    console.log(hash);
	if (hash != ''){
		//GetHash('#' + hash);
	}
});
*/
$(function(){
        if(location.hash){
             var hash = location.hash.substring(1);
			setTimeout(function() {
				window.scrollTo(0, 0);
				GetHash('#' + hash);
			}, 1);
			history.pushState("", document.title, window.location.href.replace(/\#(.+)/, '').replace(/http(s?)\:\/\/([^\/]+)/, '') );
        }
	/*
	if (hash != ''){
		console.log(hash)
		GetHash('#' + hash);
		hash = "";
	}
	*/
	/*
	if(location.hash){
		setTimeout(function(){
			window.scrollTo(0,0);
			var hash = window.location.hash.substr(1);
			if (hash != ''){
				GetHash('#' + hash);
			}
		}, 1)
	}
	*/
	$("input[type='file'].upload").change(function () {
	    var filePath=$(this).val().toLowerCase();
		var _parent = $(this).closest('.uploadbox');
	    if(filePath.indexOf("jpg")!=-1 || filePath.indexOf("jpeg")!=-1 || filePath.indexOf("df")!=-1 || filePath.indexOf("ai")!=-1 || filePath.indexOf("dxf")!=-1){
	        $(".fileerrorTip").html("").hide();
	        var arr=filePath.split('\\');
	        var fileName=arr[arr.length-1];
	        var _fileSize = Math.floor(this.files[0].size / 1024);
	        //alert($(this).closest('.uploadbox').html());

		        _parent.find('.uploadStat span').addClass('hidden');
		         
	        if (_fileSize <= 1024){
		        _parent.removeClass('unload').removeClass('uploadWrong').addClass('uploadOK');
		        _parent.find('.uploadfilename').removeClass('hidden').text(fileName + '	, ' + _fileSize + 'K');
	        }else{
		        _parent.removeClass('unload').removeClass('uploadOK').addClass('uploadWrong');
		        _parent.find('.uploadfilename').text('');
		        _parent.find('[type="file"]').val('');
		        
		        _parent.find('.uploadError').removeClass('hidden');
		        
	        }
	        
	    }else{
		        _parent.find('.uploadStat span').addClass('hidden');
		        _parent.removeClass('unload').removeClass('uploadOK').addClass('uploadWrong');
		        _parent.find('.uploadfilename').text('');
		        _parent.find('[type="file"]').val('');
		        
		        _parent.find('.uploadError').removeClass('hidden');
	     //   $(".showFileName").html("");
	    //    $(".fileerrorTip").html("您未上传文件，或者您上传文件类型有误！").show();
	     //   return false 
	    }
	})
	
	$('#contact_form').h5Validate({
		errorClass:'error'
	});

	$('.js-button-cf-submit').on('click',function(e){
		e.preventDefault();
		var cform = $('.contact_form');
		if(cform.h5Validate('allValid')) {
			cform.submit();
			//if (grecaptcha.getResponse() == ''){
			//	$('.cf_response').show();
			//	$('.cf_response .alert').hide();
			//	$('.cf_response .alert.alert-error').fadeIn('fast');
			//}else{
				//var formData = new FormData(cform[0]);
		/*
				$('[name="YII_CSRF_TOKEN"]').attr('id','YII_CSRF_TOKEN');
				$.ajax({
					url: cform.attr('action'),
					method: 'POST',
					cache: false,
					timeout: 30000,
					processData: false,
					contentType: false,
					data: new FormData(cform[0]),
					//data: cform.serialize(),
					//async: true,
					//data: {
					//	//attachment: $('', $('.contact_form')).val(),
					//	Contact: new FormData(cform[0]),
					//	csrfTokenName:$('[name="YII_CSRF_TOKEN"]').val()
					//}

				})
				.done(function(data){
					//if(data.match('success') != null) {
						cform.get(0).reset();
						//grecaptcha.getResponse() = '';
						$('.uploadbox').removeClass('uploadOK').removeClass('uploadWrong').addClass('unload');
						$('.uploadbox .uploadmsg').removeClass('hidden');
						$('.uploadbox .uploadfilename').text('');
						$('.uploadbox .uploadError').text('');
						$('.cf_response').show();
						$('.cf_response .alert').hide();
						$('.cf_response .alert.alert-success').fadeIn('fast');
					//}else{
					//	$('.cf_response .alert').hide();
					//	$('.cf_response .alert.alert-final-error').show();
					//}
					//console.log(data);
					//cform.get(0).reset();

					//cResponse.html(data).fadeIn('fast');
					//if(data.match('success') != null) {
					//	cform.get(0).reset();
					//}

				})
				.fail(function(data){
					$('.cf_response .alert').hide();
					$('.cf_response .alert.alert-final-error').show();
					//alert('請洽客服人員')
				});
			//}
		*/
		}
	});

})
function getHeader(BoxTop){
	if ($(".chaser").length > 0){
		return parseInt($(".chaser").height());
	}
	return 0;//parseInt(headerShowHeight);
}
function GetHash(str){
	var target = $(str);
	console.log(target.offset().top + getHeader(target.offset().top));
	$('html, body').stop().animate({
		scrollTop: (target.offset().top - getHeader(target.offset().top) - 70 + 'px')
	}, 500);	
}

function Validate(){
	
}