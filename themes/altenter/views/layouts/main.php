<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="ru" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
        <link rel="stylesheet" type="text/css" href="/css/altadmin/style.css" />
        <title><?php echo CHtml::encode($this->pageTitle) . Yii::app()->params['extraTitle']; ?></title>

        <?php Yii::app()->bootstrap->register(); ?>
    </head>
    <body>
        

        <div class="container" id="page">

           

            <div class="row-fluid" style="height: 400px;">
        
                
<?php echo $content; ?>
                    <!--Body content-->
               
            </div>
            <div class="clear"></div>
            <div id="footer">
                Copyright &copy; 2010 - <?php echo date('Y'); ?> altadmin.<br/>
                Все права защищены.<br/>
            </div><!-- footer -->
        </div><!-- page -->
        
        
        <script>
            $("#restore").click(function() {
                return;
                 $.ajax({
        type: "POST",
        url: "/altadmin/restore",
        //data: "id=" + id,                
        success: function(data){
            //var obj = $.parseJSON(data);
            //if (obj.error == 0) {
                $("#content").html(data);
                //$("#tr-"+id).hide(3500);
            /*} else {
                if (obj.message != '') {
                    alert (obj.message);
                } else {
                    alert ('упс..... ошибочка');
                }
            }*/
        }
    });
                return false;
            });
        </script>        
       
   
    

    </body>
</html>