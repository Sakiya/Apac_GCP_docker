/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.uiColor = '#AADC6E';
    config.language = 'zh';
    //config.skin = 'kama';
    config.height = 500;

    config.toolbar = 'MyBasic';

    config.toolbar_MyFull =[
    { name: 'document', items : ['Source','-','Preview','Print','-','Templates'] },
    { name: 'clipboard', items : ['Paste','PasteText','PasteFromWord'] },
    { name: 'editing', items : ['Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt'] },
    //{ name: 'forms', items : ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'] },
    { name: 'links', items : ['Link','Unlink','Anchor'] },
    { name: 'insert', items : ['Image','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe'] },
    { name: 'paragraph', items : ['NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl'] },
    '/',
    { name: 'basicstyles', items : ['Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat'] },
    { name: 'colors', items : ['TextColor','BGColor'] },
    { name: 'styles', items : ['Styles','Format','Font','FontSize'] },
    ];
    /*
    */

	config.toolbar_MyBasic=[
     { name: 'paragraph', items : ['NumberedList','BulletedList'] },
     { name: 'links', items : ['Link','Unlink'] },
    { name: 'styles', items : ['Format','FontSize'] },
     ];

	 //config.filebrowserBrowseUrl = '/niceclinic/admin/script/ckfinder/ckfinder.html';
	 //config.filebrowserUploadUrl = '/niceclinic/admin/script/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
};

