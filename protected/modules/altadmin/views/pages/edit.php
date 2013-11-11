<script type="text/javascript" src="/library/altadmin/editor/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="/js/altadmin/includeEditor.js"></script>
<script type="text/javascript" src="/library/jquery-ui-1.10.0.custom/development-bundle/ui/i18n/jquery.ui.datepicker-ru.js"></script>
<link rel="stylesheet" href="/css/altadmin/color/colorpicker.css" type="text/css" />
<link rel="stylesheet" href="/css/altadmin/color/layout.css" type="text/css" />
<script type="text/javascript" src="/js/altadmin/color/colorpicker.js"></script>
<script type="text/javascript" src="/js/altadmin/color/eye.js"></script>
<script type="text/javascript" src="/js/altadmin/color/utils.js"></script>
<script type="text/javascript" src="/js/altadmin/color/layout.js?ver=1.0.2"></script>
<script>
    $(function() {
        $( "#datepicker" ).datepicker($.datepicker.regional[ "ru" ]);        
        $( "#datepicker2" ).datepicker($.datepicker.regional[ "ru" ]);
    });        
$('#colorpickerField1, #colorpickerField2, #colorpickerField3').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		$(el).val(hex);
		$(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		$(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	$(this).ColorPickerSetColor(this.value);
});
</script>

<?php
/* @var $this NewsController */

$this->breadcrumbs = array(
    'Дерево' => array('/altadmin/pages/'),
    'Редактирование',
);
?>
<?php
if (Yii::app()->user->hasFlash('success')):
    echo '<h4 class="alert_success">' . Yii::app()->user->getFlash('success') . '</h4>';
endif;
?>
<article class="module width_full">
    <header><h3>Редактирование страницы</h3></header>
    <div class="module_content">

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'news-data-_form-form',
            'enableAjaxValidation' => false,
            'htmlOptions' => array(
                'enctype' => 'multipart/form-data',
            ),
                //'enctype'=>'multipart/form-data'
                ));
        ?>
        <?php
        echo $form->errorSummary($pages);
        ?>
        <fieldset>
            <?php echo $form->labelEx($pages, 'visibility'); ?>
            <?php echo $form->checkBox($pages, 'visibility'); ?>
            <?php echo $form->error($pages, 'visibility'); ?>
        </fieldset>
        <fieldset>
            <?php echo $form->labelEx($pages, 'in_menu'); ?>
            <?php echo $form->checkBox($pages, 'in_menu'); ?>
            <?php echo $form->error($pages, 'in_menu'); ?>
        </fieldset>
        <fieldset>
            <?php echo $form->labelEx($pages, 'in_last'); ?>
            <?php echo $form->checkBox($pages, 'in_last'); ?>
            <?php echo $form->error($pages, 'in_last'); ?>
        </fieldset>  
        <fieldset>
            <?php echo $form->labelEx($pages, 'like'); ?>
            <?php echo $form->checkBox($pages, 'like'); ?>
            <?php echo $form->error($pages, 'like'); ?>
        </fieldset>
        <fieldset>
            <?php echo $form->labelEx($pages, 'url'); ?>
            <?php echo $form->textField($pages, 'url'); ?>
            <?php echo $form->error($pages, 'url'); ?>
        </fieldset>
        <fieldset>
            <?php echo $form->labelEx($pages, 'date'); ?>
            <?php echo $form->textField($pages, 'date', array('id' => 'datepicker')); ?>
            <?php echo $form->error($pages, 'date'); ?>
        </fieldset>
        <fieldset>
            <?php echo $form->labelEx($pages, 'print_date'); ?>
            <?php echo $form->checkBox($pages, 'print_date'); ?>
            <?php echo $form->error($pages, 'print_date'); ?>
        </fieldset>

        
        <fieldset>
            <?php echo $form->labelEx($pages, 'menu_name'); ?>
            <?php echo $form->textField($pages, 'menu_name'); ?>
            <?php echo $form->error($pages, 'menu_name'); ?>
            <div class="clear"></div>
        </fieldset>
        <fieldset>
            <?php echo $form->labelEx($pages, 'h1'); ?>
            <?php echo $form->textField($pages, 'h1'); ?>
            <?php echo $form->error($pages, 'h1'); ?>
        </fieldset>
        <fieldset>
            <?php echo $form->labelEx($pages, 'meta_keywords'); ?>
            <?php echo $form->textField($pages, 'meta_keywords'); ?>
            <?php echo $form->error($pages, 'meta_keywords'); ?>
        </fieldset>
        <fieldset>
            <?php echo $form->labelEx($pages, 'meta_title'); ?>
            <?php echo $form->textField($pages, 'meta_title'); ?>
            <?php echo $form->error($pages, 'meta_title'); ?>
        </fieldset>
        <fieldset>
            <?php echo $form->labelEx($pages, 'meta_description'); ?>
            <?php echo $form->textArea($pages, 'meta_description'); ?>
            <?php echo $form->error($pages, 'meta_description'); ?>
        </fieldset>
        <fieldset>
            <?php echo $form->labelEx($pages, 'short_text'); ?>
            <br /><br />
            <?php echo $form->textArea($pages, 'short_text', array('id' => 'editor-desc')); ?>
            <?php echo $form->error($pages, 'short_text'); ?>
        </fieldset>
        <fieldset>
            <?php echo $form->labelEx($pages, 'img'); ?><br/><br/>
            <p>&nbsp;&nbsp;&nbsp;<?php echo $form->fileField($pages, 'img'); ?></p>
            <?php
            echo $form->error($pages, 'img');
            if (!empty($pages->img)) {
                echo '<p>&nbsp;&nbsp;&nbsp;<img src="/images/pages/' . $pages->img . '" height="100px;"></p>';
            }
            echo $form->labelEx($pages, 'img_alt');
            ?>
            <?php echo $form->textField($pages, 'img_alt'); ?>
            <?php echo $form->error($pages, 'img_alt'); ?>
            <p><br/></p><p><br/></p>
            <?php echo $form->labelEx($pages, 'img_title'); ?>
            <?php echo $form->textField($pages, 'img_title'); ?>
            <?php echo $form->error($pages, 'img_title'); ?>
        </fieldset>
        <fieldset>
            <?php echo $form->labelEx($pages, 'text'); ?>
            <br /><br />
            <?php echo $form->textArea($pages, 'text', array('id' => 'editor-text')); ?>
            <br /><br />
            <?php echo $form->error($pages, 'text'); ?>
        </fieldset>
        <?php /*форма вверху страницы*/ ?>
        <fieldset>
            <?php echo $form->labelEx($pages, 'print_top_form'); ?>
            <?php echo $form->checkBox($pages, 'print_top_form'); ?>
            <?php echo $form->error($pages, 'print_top_form'); ?>
        </fieldset>
        <fieldset>
            <?php echo $form->labelEx($pages, 'footer_form_remark'); ?>
            <?php echo $form->textField($pages, 'footer_form_remark'); ?>
            <?php echo $form->error($pages, 'footer_form_remark'); ?>
        </fieldset>
        
        <fieldset>
            <?php echo $form->labelEx($pages, 'img_top_form'); ?><br/><br/>
            <p>&nbsp;&nbsp;&nbsp;<?php echo $form->fileField($pages, 'img_top_form'); ?></p>
            <?php
            echo $form->error($pages, 'img_top_form');
            if (!empty($pages->img_top_form)) {
                echo '<p>&nbsp;&nbsp;&nbsp;<img src="/images/pages/form/top/' . $pages->img_top_form . '" height="100px;"></p>';
            }
            ?>            
        </fieldset>
        <fieldset>
            <?php echo $form->labelEx($pages, 'end_date_top_form'); ?>
            <?php echo $form->textField($pages, 'end_date_top_form', array('id' => 'datepicker2')); ?>
            <?php echo $form->error($pages, 'end_date_top_form'); ?>
        </fieldset>
        <fieldset>
            <?php echo $form->labelEx($pages, 'end_time_top_form'); ?>
            <?php echo $form->textField($pages, 'end_time_top_form'); ?>
            <?php echo $form->error($pages, 'end_time_top_form'); ?>
        </fieldset>
        <?php /*форма внизу страницы*/ ?>
        <fieldset>
            <?php echo $form->labelEx($pages, 'print_footer_form'); ?>
            <?php echo $form->checkBox($pages, 'print_footer_form'); ?>
            <?php echo $form->error($pages, 'print_footer_form'); ?>
        </fieldset>
        <fieldset>
            <?php echo $form->labelEx($pages, 'top_form_remark'); ?>
            <?php echo $form->textField($pages, 'top_form_remark'); ?>
            <?php echo $form->error($pages, 'top_form_remark'); ?>
        </fieldset>
        
        <fieldset>
            <?php echo $form->labelEx($pages, 'text_footer_form'); ?>
            <br /><br />
            <?php echo $form->textArea($pages, 'text_footer_form', array('id' => 'editor2')); ?>
            <?php echo $form->error($pages, 'text_footer_form'); ?>
        </fieldset>
        <fieldset>
            <?php echo $form->labelEx($pages, 'color_footer_form'); ?>
            <?php echo $form->textField($pages, 'color_footer_form', array('id' => 'colorpickerField1')); ?>
            <?php echo $form->error($pages, 'color_footer_form'); ?>
        </fieldset>
        <fieldset>
            <?php echo $form->labelEx($pages, 'line_footer_form'); ?>
            <?php echo $form->textField($pages, 'line_footer_form'); ?>
            <?php echo $form->error($pages, 'line_footer_form'); ?>
        </fieldset>

    </div>
    <footer>
        <div class="submit_link">
            <?php echo CHtml::submitButton('Отменить'); ?>
<?php echo CHtml::submitButton('Сохранить'); ?>
<?php echo CHtml::submitButton('Сохранить и выйти', array('class' => "alt_btn")); ?>
        </div>
    </footer>
</article><!-- end of post new article -->
<?php $this->endWidget(); ?>