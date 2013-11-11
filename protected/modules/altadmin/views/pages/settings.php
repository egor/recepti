

             
<script type="text/javascript" src="/library/altadmin/editor/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="/js/altadmin/includeEditor.js"></script>



<script type="text/javascript" src="/library/jquery-ui-1.10.0.custom/development-bundle/ui/i18n/jquery.ui.datepicker-ru.js"></script>

<script>
    $(function() {

        $( "#datepicker" ).datepicker($.datepicker.regional[ "ru" ]);
        
    });
    
    

</script>
<?php
/* @var $this NewsController */

$this->breadcrumbs=array(
    'Страницы'=>array('/altadmin/pages/'),
    'Настройки',
);
?>
<?php if(Yii::app()->user->hasFlash('success')):
        echo '<h4 class="alert_success">'.Yii::app()->user->getFlash('success').'</h4>'; 
endif; ?>


    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'settings-form',
        'enableAjaxValidation' => false,
        'htmlOptions'=>array(
         'enctype'=>'multipart/form-data',
     ),
        //'enctype'=>'multipart/form-data'
            ));
    ?>
    <?php
    
    //echo $form->errorSummary($settings);
    
    ?>
<article class="module width_full">
		<header><h3 class="tabs_involved">Настройки</h3>
		<ul class="tabs">
   			<!--<li class="active"><a href="#tab1">Мета теги</a></li>-->
    		<li class="active"><a href="#tab2">Постраничный навигатор</a></li>
		</ul>
		</header>

		
			
			<div class="tab_content" id="tab2" style="display: none;">
			
<fieldset>    <label for="PSettings_value">Количество подстраниц на страницу</label>
                                        
                                        <?php echo $form->textField($paginator, 'value'); ?>
                                        <?php echo $form->error($paginator, 'value'); ?>
    	</fieldset>
			</div><!-- end of #tab2 -->
		<footer>
				<div class="submit_link">
        <?php echo CHtml::submitButton('Отменить'); ?>
        <?php echo CHtml::submitButton('Сохранить'); ?>
        <?php echo CHtml::submitButton('Сохранить и выйти', array('class'=>"alt_btn")); ?>
				</div>
			</footer>	
		</div><!-- end of .tab_container -->
		
		</article>                
               
    

    <?php $this->endWidget(); ?>