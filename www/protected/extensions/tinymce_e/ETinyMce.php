<?php
/**
 * ETinyMce is an input widget based on TinyMCE and the jQuery TinyMCE plugin.
 * 
 * @version TinyMCE 4.0.19
 *
 * http://www.tinymce.com
 * 
 * languages download http://www.tinymce.com/i18n/
 *
 *
 * Example:
 *
 *	
 *		$this->widget('application.extensions.tinymce_e.ETinyMce',
 *			array(
 *		    	'model' => $model,
 *		    	'attribute' => 'description',
 *		    	//'htmlOptions' => array('style'=>'margin-top:20px; margin-left:5px;'),
 *				//'name'=>'',
 *				'plugins' => array(
 *		        	"advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
 *               	"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
 *               	"table contextmenu directionality emoticons template textcolor paste fullpage textcolor jbimages custupload"
 *				),
 *				'options' => array(
 *					'toolbar1' => 'newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect',
 *					'toolbar2' => 'cut copy paste pastetext | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | inserttime preview | forecolor backcolor',
 *					'toolbar3' => 'table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft | jbimages | custupload',
 *					'width'=>'710px',
 *					'height'=>'500px',
 *					'menubar'=>false,
 *					'language'=>'zh_TW',
 *					//'toolbar_items_size'=>'small',
 *				),
 *			//'value' => $model->specification, 
 *			)
 *		);								
 *						
 * outsite insert to tinymce content
 * 		
 *		tinyMCE.execCommand("mceInsertContent", false, imgTag);
 *
 * 
 * 
 * 
 */
class ETinyMce extends CInputWidget
{
   /**
    * These are useful defaults in case you forget to set htmlOptions['cols']
    * and htmlOptions['rows']. However, since width and heigth are defined
    * below, the cols and rows don't actually matter (they're here just for
    * XHTML compliance)
    */
	const COLS = 40;
   	const ROWS = 10;


   //**************************************************************************
   // Widget properties
   //**************************************************************************


   /**
    * The width of the editor.
    * This will be overriden if you set htmlOptions['style'] = 'width:...';
    *
    * @var string
    */
   private $width = '100%';

   /**
    * The heigth of the editor.
    * This will be overriden if you set htmlOptions['style'] = 'heigth:...';
    *
    * @var integer
    */
   private $height = '400px';


   /**
    * The TinyMCE options. It is an associative array. Follow this example:
    *
    * $options['theme_advanced_toolbar_location'] = 'top';
    *
    * The keys and the corresponding values are the configuration options from
    * this page:
    *
    * @link http://wiki.moxiecode.com/index.php/TinyMCE:Configuration
   *
    * You can control the toolbars following these instructions:
    *
    * @link http://wiki.moxiecode.com/index.php/TinyMCE:Control_reference
    *
    * @var array
    */
   private $options = array();

   /**
    * Plugins to load. The more you load the slower is the first load.
    * You may want to extend the class and redefine this property to your needs.
    *
    * For an almost full editor:
    *
    * array('spellchecker','table','save','emotions','insertdatetime','preview','searchreplace','print','contextmenu','paste','fullscreen','noneditable','layer','visualchars');
    *
    * This variable is significative only if $this->options == array()
    *
    * @var array
    */
   private $plugins = array();




   //***************************************************************************
   // Constructor
   //***************************************************************************

   public function __construct($owner=null)
   {
      parent::__construct($owner);
      //$this->setLanguage(Yii::app()->language);
   }

   //***************************************************************************
   // Setters and getters
   //***************************************************************************

   /**
    * Setter
    *
    * @param array $value 
    */
   public function setOptions($value)
   {
      if (!is_array($value))
         throw new CException(Yii::t('ETinyMce', 'options must be an array'));
      $this->options = $value;
   }

   /**
    * Getter
    *
    * @return array
    */
   public function getOptions()
   {
      return $this->options;
   }

   /**
    * Setter
    *
    * @param string $value the heigth
    */
   public function setHeight($value)
   {
      if (!preg_match("/[\d]+[px|\%]/", $value))
         throw new CException(Yii::t('ETinyMce', 'height must be a string of digits terminated by "%" or "px"'));
      $this->height = $value;
   }

   /**
    * Getter
    *
    * @return string
    */
   public function getHeight()
   {
      return $this->height;
   }

   /**
    * Setter
    *
    * @param string $value the width
    */
   public function setWidth($value)
   {
      if (!preg_match("/[\d]+[px|\%]/", $value))
         throw new CException(Yii::t('ETinyMce', 'width must be a string of digits terminated by "%" or "px"'));
      $this->width = $value;
   }

   /**
    * Getter
    *
    * @return <type>
    */
   public function getWidth()
   {
      return $this->width;
   }




	/**
	 * The plugins which will be installed
	 *
	 * @param array $value
	 */
	public function setPlugins($value)
	{
	  	if (!is_array($value))
	     	throw new CException(Yii::t('ETinyMCE', 'plugins must be an array of strings'));
	  	$this->plugins = $value;
	}

   	/**
     * Returns the plugins
     *
     * @return array
     */
	public function getPlugins()
	{
	  	return $this->plugins;
	}
	



	/**
	 * Get the options for the TinyMCE editor. You may want to extend the class
	 * and to override this method to customize globally the options, so every
	 * editor will have the same l&f and the same behavior. Set 'options'=>array()
	 * in the view to get the defaults, otherwise you won't have editor :-)
	 *
	 * @param array $value
	 */
	protected function makeOptions($url='')
	{
      	list($name,$id) = $this->resolveNameID();


		$options['selector'] = "textarea#".$id;
		$options['theme'] = "modern";
     
     	//$options['language'] = 'zh_TW'
		//$options['width'] = $this->width;
		//$options['height'] = $this->height;
		//$options['content_css'] = "css/content.css";
		//$options['toolbar'] = "";
		//$options['toolbar1'] = "";
		//$options['toolbar2'] = "";
		//$options['toolbar3'] = "";
		//$options['menubar'] = false;
		
		//設true url=> ../../assets
		$options['relative_urls'] = false; 
      

		if (!empty($this->plugins) && is_array($this->plugins)) {      
		 	$options['plugins'] = implode(',', $this->plugins);
		}

      	// here any option is overriden by user's options
      	if (is_array($this->options)) {
         	$options = array_merge($options, $this->options);
      	}
      
      	return CJavaScript::encode($options);
   	}

   	//***************************************************************************
   	// Run Lola Run
   	//***************************************************************************

	/**
	 * Executes the widget.
	 * This method registers all needed client scripts and renders
	 * the text field.
	 */
	public function run()
	{
		list($name, $id) = $this->resolveNameID();

		$baseDir = dirname(__FILE__);
		$assets = Yii::app()->getAssetManager()->publish($baseDir.DIRECTORY_SEPARATOR.'assets');
		
		$tinyOptions = $this->makeOptions($baseDir);
				
		$cs = Yii::app()->getClientScript();
		$cs->registerCoreScript('jquery');
		
		
		$cs->registerScriptFile($assets.'/tinymce/tinymce.min.js');
		
		$this->htmlOptions['id'] = $id;
		//if (!array_key_exists('style', $this->htmlOptions)) {
		//	$this->htmlOptions['style'] = "width:{$this->width};height:{$this->height};";
		//}
		if (!$this->options['width']){
			$this->options['width'] = $this->width;
		}
		if (!$this->options['height']){
			$this->options['height'] = $this->height;
		}
		
		$this->htmlOptions['style'] = "width:{$this->options['width']};height:{$this->options['height']};";
		
		if (!array_key_exists('cols', $this->htmlOptions)) {
		 	$this->htmlOptions['cols'] = self::COLS;
		}
		if (!array_key_exists('rows', $this->htmlOptions)) {
		 	$this->htmlOptions['rows'] = self::ROWS;
		}			
    
      	$js =<<<EOP
tinymce.init({$tinyOptions});
EOP;
      	$cs->registerScript('Yii.'.get_class($this).'#'.$id, $js, CClientScript::POS_LOAD);

	  	if($this->hasModel()) {
			$textarea = CHtml::activeTextArea($this->model, $this->attribute, $this->htmlOptions);
      	} else {
			$textarea = CHtml::textArea($name, $this->value, $this->htmlOptions);
      	}
           
      	echo $textarea;
	}
}