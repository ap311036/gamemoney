/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function(config) {
    config.language = 'zh-tw';
    config.uiColor = '#dcdcdc';
    config.width = '600';
    config.height = '400';
    config.contentsCss = ['../css/service.css'];
    config.toolbarCanCollapse = true;
    config.allowedContent = true;
    config.fontSize_sizes = '12/12px;14/14px;16/16px;18/18px;20/20px;22/22px;24/24px;36/36px;48/48px;';

    config.toolbarGroups = [
        { name: 'document', groups: ['mode', 'document', 'doctools'] },
        { name: 'clipboard', groups: ['clipboard', 'undo'] },
        { name: 'editing', groups: ['find', 'selection', 'spellchecker', 'editing'] },
        { name: 'forms', groups: ['forms'] },
        { name: 'insert', groups: ['insert','Image'] },
        { name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph'] },
        { name: 'basicstyles', groups: ['basicstyles', 'cleanup'] },
        { name: 'links', groups: ['links'] },
        { name: 'styles', groups: ['styles'] },
        { name: 'colors', groups: ['colors'] },
        { name: 'tools', groups: ['tools'] },
        { name: 'others', groups: ['others'] },
        { name: 'about', groups: ['about'] }
    ];

    //config.removeButtons = 'Save,Source,NewPage,Print,Templates,Replace,Select,Button,Radio,Checkbox,Anchor,Flash,Iframe,PageBreak,CreateDiv,ShowBlocks';
    config.removeButtons = 'ShowBlocks,About,Format,Styles,Iframe,Language,CreateDiv,Blockquote,Superscript,Subscript,HiddenField,ImageButton,Button,Select,Textarea,TextField,Radio,Checkbox,Scayt,Save,Preview,Print,Source,NewPage,Flash,Form';
    config.font_names = "新細明體/新細明體;微軟正黑體/微軟正黑體;標楷體/標楷體;" + config.font_names;

    config.font_defaultLabel = '新細明體';
	config.filebrowserBrowseUrl = 'ckfinder/ckfinder.html';
	config.filebrowserImageBrowseUrl = 'ckfinder/ckfinder.html?Type=Images';
	config.filebrowserImageUploadUrl = 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';

};
