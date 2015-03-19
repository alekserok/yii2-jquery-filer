<?php

namespace mosedu\yii2-filer;

use yii\helpers\Html;
use yii\web\AssetBundle;
use yii\web\JsExpression; 
use yii\widgets\InputWidget;
use Yii;

/**
 * Yii2 widget for https://github.com/CreativeDream/jquery.filer
 *
 * @property string $settings
 * @property string $selector
 *
 * @author Victor Kozmin <promcalc@gmail.com>
 *
 * @link https://github.com/mosedu/yii2-filer
 * @link https://github.com/CreativeDream/jquery.filer
 * @license https://github.com/CreativeDream/jquery.filer/blob/master/LICENSE
 *
 *
 *        limit: null,
 *        maxSize: null,
 *        extensions: null,
 *        changeInput: true,
 *        showThumbs: true,
 *        appendTo: null,
 *        theme: "default",
 *        templates: {
 *            box: '<ul class="jFiler-item-list"></ul>',
 *            item: '<li class="jFiler-item">\
 *                        <div class="jFiler-item-container">\
 *                            <div class="jFiler-item-inner">\
 *                                <div class="jFiler-item-thumb">\
 *                                    <div class="jFiler-item-status"></div>\
 *                                    <div class="jFiler-item-info">\
 *                                        <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
 *                                    </div>\
 *                                    {{fi-image}}\
 *                                </div>\
 *                                <div class="jFiler-item-assets jFiler-row">\
 *                                    <ul class="list-inline pull-left">\
 *                                        <li>{{fi-progressBar}}</li>\
 *                                    </ul>\
 *                                    <ul class="list-inline pull-right">\
 *                                        <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
 *                                    </ul>\
 *                                </div>\
 *                            </div>\
 *                        </div>\
 *                    </li>',
 *            itemAppend: '<li class="jFiler-item">\
 *                        <div class="jFiler-item-container">\
 *                            <div class="jFiler-item-inner">\
 *                                <div class="jFiler-item-thumb">\
 *                                    <div class="jFiler-item-status"></div>\
 *                                    <div class="jFiler-item-info">\
 *                                        <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
 *                                    </div>\
 *                                    {{fi-image}}\
 *                                </div>\
 *                                <div class="jFiler-item-assets jFiler-row">\
 *                                    <ul class="list-inline pull-left">\
 *                                        <span class="jFiler-item-others">{{fi-icon}} {{fi-size2}}</span>\
 *                                    </ul>\
 *                                    <ul class="list-inline pull-right">\
 *                                        <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
 *                                    </ul>\
 *                                </div>\
 *                            </div>\
 *                        </div>\
 *                    </li>',
 *            progressBar: '<div class="bar"></div>',
 *            itemAppendToEnd: false,
 *            removeConfirmation: true,
 *            _selectors: {
 *                list: '.jFiler-item-list',
 *                item: '.jFiler-item',
 *                progressBar: '.bar',
 *                remove: '.jFiler-item-trash-action',
 *            }
 *        },
 *        uploadFile: {
 *            url: "upload.php",
 *            data: {},
 *            type: 'POST',
 *            enctype: 'multipart/form-data',
 *            beforeSend: function(){},
 *            success: function(data, el){
 *                var parent = el.find(".jFiler-jProgressBar").parent();
 *                el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
 *                    $("<div class=\"jFiler-item-others text-success\"><i class=\"icon-jfi-check-circle\"></i> Success</div>").hide().appendTo(parent).fadeIn("slow");    
 *                });
 *            },
 *            error: function(el){
 *                var parent = el.find(".jFiler-jProgressBar").parent();
 *                el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
 *                    $("<div class=\"jFiler-item-others text-error\"><i class=\"icon-jfi-minus-circle\"></i> Error</div>").hide().appendTo(parent).fadeIn("slow");    
 *                });
 *            },
 *            statusCode: {},
 *            onProgress: function(){},
 *            onComplete: function(){}
 *        },
 *        dragDrop: {
 *            dragEnter: null,
 *            dragLeave: null,
 *            drop: null,
 *        },
 *        addMore: true,
 *        clipBoardPaste: true,
 *        excludeName: null,
 *        beforeShow: function(){return true},
 *        onSelect: function(){},
 *        afterShow: function(){},
 *        onRemove: function(){},
 *        onEmpty: function(){},
 *        captions: {
 *            button: "Choose Files",
 *            feedback: "Choose files To Upload",
 *            feedback2: "files were chosen",
 *            drop: "Drop file here to Upload",
 *            removeConfirmation: "Are you sure you want to remove this file?",
 *            errors: {
 *                filesLimit: "Only {{fi-limit}} files are allowed to be uploaded.",
 *                filesType: "Only Images are allowed to be uploaded.",
 *                filesSize: "{{fi-name}} is too large! Please upload file up to {{fi-maxSize}} MB.",
 *                filesSizeAll: "Files you've choosed are too large! Please upload files up to {{fi-maxSize}} MB."
 *            }
 *        }
 *
 *
 *
 *
 *
 */
class Widget extends InputWidget
{ 
    /**
     * @var array widget options
     * can be used in the mask and are predefined:
     *
     * - `a`: represents an alpha character (A-Z, a-z)
     * - `9`: represents a numeric character (0-9)
     * - `*`: represents an alphanumeric character (A-Z, a-z, 0-9)
     * - `[` and `]`: anything entered between the square brackets is considered optional user input. This is
     *   based on the `optionalmarker` setting in [[clientOptions]].
     *
     * Additional definitions can be set through the [[definitions]] property.
     */ 
    public $options = [];

    /**
     * @var array plugin options
     *
     */ 
    public $pluginOptions = [
        'limit' => null,
        'maxSize' => null,
        'extensions' => null,
        'changeInput' => true,
        'showThumbs' => true,
        'appendTo' => null,
        'theme' => "default",
        'templates' => [
            'box' => '<ul class="jFiler-item-list"></ul>',
            'item' => '<li class="jFiler-item">\
                        <div class="jFiler-item-container">\
                            <div class="jFiler-item-inner">\
                                <div class="jFiler-item-thumb">\
                                    <div class="jFiler-item-status"></div>\
                                    <div class="jFiler-item-info">\
                                        <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                    </div>\
                                    {{fi-image}}\
                                </div>\
                                <div class="jFiler-item-assets jFiler-row">\
                                    <ul class="list-inline pull-left">\
                                        <li>{{fi-progressBar}}</li>\
                                    </ul>\
                                    <ul class="list-inline pull-right">\
                                        <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                    </ul>\
                                </div>\
                            </div>\
                        </div>\
                    </li>',
            'itemAppend' => '<li class="jFiler-item">\
                        <div class="jFiler-item-container">\
                            <div class="jFiler-item-inner">\
                                <div class="jFiler-item-thumb">\
                                    <div class="jFiler-item-status"></div>\
                                    <div class="jFiler-item-info">\
                                        <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                    </div>\
                                    {{fi-image}}\
                                </div>\
                                <div class="jFiler-item-assets jFiler-row">\
                                    <ul class="list-inline pull-left">\
                                        <span class="jFiler-item-others">{{fi-icon}} {{fi-size2}}</span>\
                                    </ul>\
                                    <ul class="list-inline pull-right">\
                                        <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                    </ul>\
                                </div>\
                            </div>\
                        </div>\
                    </li>',
            'progressBar' => '<div class="bar"></div>',
            'itemAppendToEnd' => false,
            'removeConfirmation' => true,
            '_selectors' => [
                'list' => '.jFiler-item-list',
                'item' => '.jFiler-item',
                'progressBar' => '.bar',
                'remove' => '.jFiler-item-trash-action',
            ]
        ],
        'uploadFile' => null /*[
            'url' => "upload.php",
            'data' => [],
            'type' => 'POST',
            'enctype' => 'multipart/form-data',
            'beforeSend' => 'function(){}',
            'success' => 'function(data, el){
                var parent = el.find(".jFiler-jProgressBar").parent();
                el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
                    $("<div class=\"jFiler-item-others text-success\"><i class=\"icon-jfi-check-circle\"></i> Success</div>").hide().appendTo(parent).fadeIn("slow");    
                });
            }',
            'error' => 'function(el){
                var parent = el.find(".jFiler-jProgressBar").parent();
                el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
                    $("<div class=\"jFiler-item-others text-error\"><i class=\"icon-jfi-minus-circle\"></i> Error</div>").hide().appendTo(parent).fadeIn("slow");    
                });
            }',
            'statusCode' => [],
            'onProgress' => 'function(){}',
            'onComplete' => 'function(){}'
        ] */,
        'dragDrop' => [
            'dragEnter' => null,
            'dragLeave' => null,
            'drop' => null,
        ],
        'addMore' => true,
        'clipBoardPaste' => true,
        'excludeName' => null,
        'beforeShow' => 'function(){return true}',
        'onSelect' => 'function(){}',
        'afterShow' => 'function(){}',
        'onRemove' => 'function(){}',
        'onEmpty' => 'function(){}',
        'captions' => [
            'button' => "Choose Files",
            'feedback' => "Choose files To Upload",
            'feedback2' => "files were chosen",
            'drop' => "Drop file here to Upload",
            'removeConfirmation' => "Are you sure you want to remove this file?",
            'errors' => [
                'filesLimit' => "Only {{fi-limit}} files are allowed to be uploaded.",
                'filesType' => "Only Images are allowed to be uploaded.",
                'filesSize' => "{{fi-name}} is too large! Please upload file up to {{fi-maxSize}} MB.",
                'filesSizeAll' => "Files you've choosed are too large! Please upload files up to {{fi-maxSize}} MB."
            ]
        ]
    ];


    /**
     * @var array plugin options which has to be js expression
     *
     */ 
    public $jsExpressionList = [
        'uploadFile.beforeSend',
        'uploadFile.success',
        'uploadFile.error',
        'uploadFile.onProgress',
        'uploadFile.onComplete',
        'beforeShow',
        'onSelect',
        'afterShow',
        'onRemove',
        'onEmpty',
    ];

    /**
     * Initializes the widget.
     *
     * @throws InvalidConfigException if the "mask" property is not set.
     */ 
    public function init() {
        //
        parent::init();
        foreach($this->jsExpressionList As $name) {
            $this->setJsExpression($name);
        }
    }

    /**
     * Run the widget.
     *
     */ 
    public function run() {
        Yii::info('this->pluginOptions = ' . print_r($this->pluginOptions, true));
        if ($this->hasModel()) {
            echo Html::activeTextInput($this->model, $this->attribute, $this->options);
        } else {
            echo Html::textInput($this->name, $this->value, $this->options);
        }
//        $this->registerClientScript(); 
    }

    /**
     * Convert parameter to JsExpression if exists
     *
     */ 
    public function setJsExpression($name) {
        $aKeys = explode('.', $name);
        $aTmp = &$this->pluginOptions;
        $bExists = true;
        list($k, $v) = each($aKeys);
        while ( $v !== false ) {
            if( !isset($aTmp[$v]) ) {
                $bExists = false;
                break;
            }
            else {
                $aTmp = &$aTmp[$v];
            }
            list($k, $v) = each($aKeys);
            Yii::info('k = ' . print_r($k, true));
            Yii::info('v = ' . print_r($v, true));
        }

        if( $bExists && !is_subclass_of($aTmp, JsExpression::className()) ) {
            $aTmp = new JsExpression($aTmp);
        }
    }

}
