<?php
class Html extends CHtml
{
    public static function fileimageUrl($url){
        return Yii::app()->baseUrl.'/main/images/'.$url;
    }
    public static function imageUrl($url){
        return Yii::app()->baseUrl.'/main/images/'.$url;
    }
    public static function cssUrl($url){
        return Yii::app()->baseUrl.'/main/css/'.$url;
    }
    
    public static function scriptUrl($url){
        return Yii::app()->baseUrl.'/main/js/'.$url;
    }

    public static function adminImageUrl($url){
        return Yii::app()->baseUrl.'/admin/images/'.$url;
    }

    public static function adminCssUrl($url){
        return Yii::app()->baseUrl.'/admin/css/'.$url;
    }

    public static function adminScriptUrl($url){
        return Yii::app()->baseUrl.'/admin/script/'.$url;
    }

    public static function extensionsUrl($url){
        return Yii::app()->baseUrl.'/extensions/'.$url;
    }
    
    /**
     *  cut string
     *
     */
    public static function cutStr($str, $length, $encode = true)
    {
        //$allowTag 不能使用，因為留下任何 tag ，截字串時就可能破壞 tag
        $str = strip_tags($str);
        $str = mb_substr($str, 0, $length, "UTF-8");
        
        $str = str_replace("\r\n", "", $str);
        $str = str_replace("\r", "", $str);
        $str = str_replace("\n", "", $str);
        $str = str_replace("'", "", $str);
        $str = str_replace("\"", "", $str);
        
        //return $str;
        if ($encode){
        	$str = htmlentities($str, ENT_QUOTES, "UTF-8");
        	$str = str_replace("&amp;nbsp;", "&nbsp;", "$str"); 
        }
        
        return $str;
    }
    

    /**
     *  generate Flash embed tag
     *	$params['src'] is required
     */
    public static function embedFlash($params=array())
    {    	
    	if (!$params['src']){
    		return false;
    	}
    	
    	$defaultParams = array(
								'codebase' => 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0',
								'width' => '100%',
								'height' => '100%',
								'src' => '',
								'quality' => 'high',
								'pluginspage' => 'http://www.adobe.com/go/getflashplayer',
								'align' => 'middle',
								'play' => 'true',
								'loop' => 'true',
								'scale' => 'showall',
								'wmode' => 'transparent',
								'devicefont' => 'false',
								'id' => '',
								'bgcolor' => '#ffffff',
								'name' => '',
								'menu' => 'false',
								'allowFullScreen' => 'false',
								'allowScriptAccess' =>'sameDomain',
								'movie' => '',
								'salign' => '',
								'FlashVars' => ''
    							);
    	$newParams = array_merge($defaultParams, $params);

    	if (!$newParams['movie'])
    	{
    		$newParams['movie'] = $newParams['src'];
    	}
    	
    	$embed = "
					<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" codebase=\"{$newParams['codebase']}\" width=\"{$newParams['width']}\" height=\"{$newParams['height']}\" id=\"{$newParams['id']}\" align=\"{$newParams['align']}\">
					<param name=\"allowScriptAccess\" value=\"{$newParams['allowScriptAccess']}\" />
					<param name=\"allowFullScreen\" value=\"{$newParams['allowFullScreen']}\" />
					<param name=\"movie\" value=\"{$newParams['movie']}\" />
					<param name=\"menu\" value=\"{$newParams['menu']}\" />
					<param name=\"quality\" value=\"{$newParams['quality']}\" />
					<param name=\"bgcolor\" value=\"{$newParams['bgcolor']}\" />
					<param name=\"wmode\" value=\"{$newParams['wmode']}\" />
					<param name=\"FlashVars\" value=\"{$newParams['FlashVars']}\" />
					<embed src=\"{$newParams['src']}\" FlashVars=\"{$newParams['FlashVars']}\" menu=\"{$newParams['menu']}\" quality=\"{$newParams['quality']}\" bgcolor=\"{$newParams['bgcolor']}\" wmode=\"{$newParams['wmode']}\"  width=\"{$newParams['width']}\" height=\"{$newParams['height']}\" name=\"{$newParams['name']}\" align=\"{$newParams['align']}\" allowScriptAccess=\"{$newParams['allowScriptAccess']}\" allowFullScreen=\"{$newParams['allowFullScreen']}\" type=\"application/x-shockwave-flash\" pluginspage=\"{$newParams['pluginspage']}\" />
					</object>
    				";
    	
    	return $embed;
    }
   
    
    /**
     *  get article first Image For show
     *	
     */		      
    public static function getFirstImage($str, $alt = '', $htmlOption = array())
    {
        //$imgsrc_regex = '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i';
        $imgsrc_regex = '/<img[^>]+src=[\'"]([^>\'"]+)[\'"][^>]*>/i';
        preg_match($imgsrc_regex, $str, $matches);
        //沒有圖片的話, 使用預設的 image
        $image = ('' == $matches[1]) ? '' : $matches[1];
        return ('' !== $alt || 0 < count($htmlOption)) ? CHtml::image($image, $alt, $htmlOption) : $image;
    }

    
    /**
     *  resize Image For show
     *	
     */		  
    public static function resizeImg($imgUrl, $alt='', $htmlOption=array()) 
    {
    	$filepath = Yii::app()->params['docRoot'].$imgUrl;
    	
    	if(!is_file($filepath)){
    		return false;
    	}
    	
		list($width, $height) = getimagesize($filepath);
    	
    	$maxWidth = ($htmlOption['width'])? $htmlOption['width'] : $width;
    	$maxHeight = ($htmlOption['height'])? $htmlOption['height'] : $height;
    	    	
  		$percentW = round($maxWidth/$width, 4);
  		$percentH = round($maxHeight/$height, 4);
  		
  		if($percentW < 1 || $percentH < 1){
  			$percentage = ($percentW > $percentH)? $percentH : $percentW;  		
  		} else {
  			$percentage = 1;
  		}
  		$htmlOption['width'] = floor($width*$percentage);
  		$htmlOption['height'] = floor($height*$percentage);
  		
  		//判別 圖 or flash
  		$extend = strtolower(strrchr($imgUrl, "."));  		
  		if($extend == '.swf'){
  			$htmlOption['src'] = $imgUrl;
  			$media = self::embedFlash($htmlOption);  		
  		} else {  		
  			$media = CHtml::image($imgUrl, $alt, $htmlOption);
  		}
  		
  		return $media;
    }


    //
    public static function alertMsg($message, $url = '')
    {
        //set the header
        header("Content-Type: text/html; charset=utf-8");
        
        // wirte the html     
        echo '<html>';
        echo '<head>';
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
        echo '<title>' . CHtml::encode($message) . '</title>';
        echo '</head>';
        echo '<body>';
        
        echo '<script type="text/javascript">';
        echo '/*<![CDATA[*/';
        echo 'alert("' . CHtml::encode($message) . '");';
        echo ('' == trim($url)) ? 'history.go(-1);' : 'location.replace("'.$url.'");';
        echo '/*]]>*/';
        echo '</script>';
        
        echo '</body>';
        echo '</html>';
        
        //end the program
        Yii::app()->end();     
    }


    public static function moneyFormat($number) {
		setlocale(LC_MONETARY, 'en_US');
		$money = money_format('%!.0n', $number);
		return $money;
    }      


    /**
     *  Purifier for html editor
     *	
     */		  
    public static function editorPurifier($content) {
        $purifier = new CHtmlPurifier(); 
        $purifier->options = array(
        	'Attr.AllowedFrameTargets'=>array('_blank'),
        	'CSS.AllowTricky'=>true,	//Default false => not allow "display: "
        	'HTML.SafeIframe'=>true,
        	'URI.SafeIframeRegexp'=>'%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/)%',
        );
        $content = $purifier->purify($content);
        
        return $content; 
	}

}
?>