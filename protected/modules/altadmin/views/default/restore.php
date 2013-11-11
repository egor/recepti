<?php
/* @var $this DefaultController */
if (isset($mail)) {
    ?>    
    <div class="modal" style="position: relative;">
        <div class="modal-header">
            <a href="/altadmin" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
            <h3>Восстановление доступа</h3>
        </div>
        <div class="modal-body">    
            <p>На указанный email (<?php echo $mail; ?>) выслано письмо с подтверждением смены пароля и дальнейшими инструкциями.</p>
        </div>
        <div class="modal-footer">        
            <a href="/altadmin" class="btn">На главную</a>
        </div>
    </div>
    <br clear="all" />
    <?php
} else {
    ?>
    <div class="modal" style="position: relative;">
        <div class="modal-header">
            <a href="/" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
            <h3>Восстановление доступа</h3>
        </div>
        <div class="modal-body">
            <?php
            /** @var BootActiveForm $form */
            $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id' => 'verticalForm',
                'htmlOptions' => array('class' => ''),
                    ));
            ?>

    <?php echo $form->textFieldRow($model, 'email', array('class' => 'span12', 'label' => 'Login')); ?>
            <?php echo $form->passwordFieldRow($model, 'password', array('class' => 'span12')); ?>                
        </div>
        <div class="modal-footer">        
            <a href="/altadmin" class="btn">Назад</a>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'label' => 'Восстановить')); ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
    <br clear="all" />
    <?php
}