<?php
/* @var $this DefaultController */
?>
<div class="modal" style="position: relative;">
    <div class="modal-header">
        <a href="/altadmin" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
        <h3>Восстановление доступа</h3>
    </div>
    <div class="modal-body">
        <?php
        if ($confirmation == 1) {
            echo '<p>Пароль успешно изменен.</p>
                <p>Теперь Вы можете вернуться <a href="/altadmin">на главную</a> для авторизации.</p>';
        } else {
            echo '<p>Ошибка! Проверте ссылку еще раз или вернитесь <a href="/altadmin">на главную</a>.</p>';
        }
        ?>
    </div>
    <div class="modal-footer">        
        <a href="/altadmin" class="btn">На главную</a>
    </div>
</div>
<br clear="all" />
