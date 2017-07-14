/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function(config) {
    config.language = 'zh-tw';
    config.uiColor = '#dcdcdc';
    config.width = '600';
    config.height = '400';
    config.contentsCss = ['../../css/service.css'];
    config.toolbarCanCollapse = true;
    config.allowedContent = true;
    config.fontSize_sizes = '12/12px;14/14px;16/16px;18/18px;20/20px;22/22px;24/24px;36/36px;48/48px;';

    config.toolbarGroups = [
        { name: 'document', groups: ['mode', 'document', 'doctools'] },
        { name: 'clipboard', groups: ['clipboard', 'undo'] },
        { name: 'editing', groups: ['find', 'selection', 'spellchecker', 'editing'] },
        { name: 'forms', groups: ['forms'] },
        { name: 'insert', groups: ['insert'] },
        { name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph'] },
        { name: 'basicstyles', groups: ['basicstyles', 'cleanup'] },
        { name: 'links', groups: ['links'] },
        { name: 'styles', groups: ['styles'] },
        { name: 'colors', groups: ['colors'] },
        { name: 'tools', groups: ['tools'] },
        { name: 'others', groups: ['others'] },
        { name: 'about', groups: ['about'] }
    ];

    config.removeButtons = 'ShowBlocks,About,Format,Styles,Iframe,Language,CreateDiv,Blockquote,Superscript,Subscript,HiddenField,ImageButton,Button,Select,Textarea,TextField,Radio,Checkbox,Scayt,Save,Preview,Print,Source,NewPage,Flash,Form';
    config.font_names = "新細明體/新細明體;微軟正黑體/微軟正黑體;標楷體/標楷體;" + config.font_names;

    config.font_defaultLabel = '新細明體';
    // 字型選單 (名稱/字體)
    //CKEDITOR.config.font_names = '新細明體/PMingLiU;細明體/MingLiU;標楷體/DFKai-SB;黑體/SimHei;宋體/SimSun;新宋體/NSimSun;仿宋/FangSong;楷體/KaiTi;仿宋_GB2312/FangSong_GB2312楷體_GB2312/KaiTi_GB2312;微軟正黑體/Microsoft JhengHei;微軟雅黑體/Microsoft YaHei;隸書/LiSu;幼圓/YouYuan;華文細黑/STXihei;華文楷體/STKaiti;華文宋體/STSong;華文中宋/STZhongsong;華文仿宋/STFangsong;方正舒體/FZShuTi;方正姚體/FZYaoti;華文彩雲/STCaiyun;華文琥珀/STHupo;華文隸書/STLiti;華文行楷/STXingkai;華文新魏/STXinwei;'+
    //'Arial/Arial, Helvetica, sans-serif;' +
    //'Comic Sans MS/Comic Sans MS, cursive;' +
    //'Courier New/Courier New, Courier, monospace;' +
    //'Georgia/Georgia, serif;' +
    //'Lucida Sans Unicode/Lucida Sans Unicode, Lucida Grande, sans-serif;' +
    //'Tahoma/Tahoma, Geneva, sans-serif;' +
    //'Times New Roman/Times New Roman, Times, serif;' +
    //'Trebuchet MS/Trebuchet MS, Helvetica, sans-serif;' +
    //'Verdana/Verdana, Geneva, sans-serif';
};
