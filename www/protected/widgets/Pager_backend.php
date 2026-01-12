<?php
class Pager_backend extends CLinkPager
{
    private $_pagerView;
    private $_cssPageList;
    private $_noLabel;

    public function init()
    {
        parent::init();
        //重新覆寫名稱 (移除 &gt; &lt;)
        $this->nextPageLabel=Yii::t('yii','下一頁 <span class="fa fa-arrow-right"></span>');
        $this->prevPageLabel=Yii::t('yii','<span class="fa fa-arrow-left"></span> 上一頁');
        $this->firstPageLabel=Yii::t('yii','第一頁');
        $this->lastPageLabel=Yii::t('yii','最末頁');
        $this->header=Yii::t('yii','Go to page: ');
        $this->maxButtonCount=10; //每頁顯示幾個頁碼
            
        if (!isset($this->cssPageList)){
            $this->cssPageList = array(
                'first'=> 'previous',
                'previous'=>'previous',
                'next'=>'next',
                'last'=>'next',
                'internal'=>'page',
                'hidden'=> 'hidden',
                'selected'=> 'active',
            );
        }
        
        if (!isset($this->pagerView)){
        	$this->pagerView = "pager_backend";
        }
        
        if (!isset($this->noLabel)){
            $this->noLabel = array(
                'first', 'previous', 'next', 'last'
            );
        }
    }

    public function run()
    {
        $buttons=$this->createPageButtons();
        if(empty($buttons)){
            return;
        }
        
        //載入官方 pager css
        $this->registerClientScript();

        $this->render($this->pagerView, array(
            'buttons'=>$buttons,
            'pageCount'=>$this->getPageCount(),
        ));
    }

    /**
     * over write parent's function createPageButton
     *
     */
    protected function createPageButtons()
    {
        if(($pageCount=$this->getPageCount())<=1){
            return array();
        }

        list($beginPage,$endPage)=$this->getPageRange();
        $currentPage=$this->getCurrentPage(false); // currentPage is calculated in getPageRange()
        $buttons=array();

        // first page
		//$buttons[]=$this->createPageButton($this->firstPageLabel,0,'first',$currentPage<=0,false);

        // prev page
        if(($page=$currentPage-1)<0){
            $page=0;
        }
        $buttons[]=$this->createPageButton($this->prevPageLabel, $page, 'previous',$currentPage<=0,false);

        // internal pages
        for($i=$beginPage;$i<=$endPage;++$i){
            $buttons[]=$this->createPageButton($i+1, $i, 'internal',false,$i==$currentPage);
        }

        // next page
        if(($page=$currentPage+1)>=$pageCount-1){
            $page=$pageCount-1;
        }
        $buttons[]=$this->createPageButton($this->nextPageLabel, $page, 'next',$currentPage>=$pageCount-1,false);

        // last page
        //$buttons[]=$this->createPageButton($this->lastPageLabel, $pageCount-1, 'last', $currentPage>=$pageCount-1,false);

        return $buttons;

    }

    /**
     * over write parent's function createPageButton
     *
     */
    protected function createPageButton($label, $page, $pageType, $hidden, $selected)
    {
        $class = $this->cssPageList[$pageType];
        if ($hidden || $selected){
            //$class.=' '.($hidden ? self::CSS_HIDDEN_PAGE : self::CSS_SELECTED_PAGE);
            $class .= " ".($hidden ? $this->cssPageList['hidden'] : $this->cssPageList['selected']);
		}
        
        //check use label or not
        $liHtml  = CHtml::openTag('li', array('class'=>$class));
		
		if ($selected){
    	    $liHtml .= $label;
		}else{
			//$liHtml .= CHtml::link(CHtml::encode($label), $this->createPageUrl($page), array('title'=>('internal' == $pageType)? '第'.$label.'頁' : $label));
			$liHtml .= CHtml::link($label, $this->createPageUrl($page), array());
		}
        $liHtml .= Chtml::closeTag('li');
        
        return $liHtml;
    }

    public function setPagerView($pagerView)
    {
        $this->_pagerView = $pagerView;
    }
    
    public function getPagerView()
    {
        return $this->_pagerView;
    }
    
    public function setCssPageList($cssPageList)
    {
        $this->_cssPageList = $cssPageList;
    }
    
    public function getCssPageList()
    {
        return $this->_cssPageList;
    }
    
    public function setNoLabel($noLabel)
    {
        $this->_noLabel = $noLabel;
    }
    
    public function getNoLabel()
    {
        return $this->_noLabel;
    }
}
?>