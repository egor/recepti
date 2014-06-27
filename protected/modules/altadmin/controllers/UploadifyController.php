<?php

class UploadifyController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionUploadImg() {
        
        $arrSizeImg['small']['width'] = 100;
        $arrSizeImg['small']['height'] = 75;
        $arrSizeImg['big']['width'] = 400;
        $arrSizeImg['big']['height'] = 300;
        $modelImg = new $_POST['model'];
        $modelImg->pid = $_POST['pid'];
        $modelImg->name = 'tmp';
        $modelImg->position = 0;
        //$banners->module = $_POST['module'];
        $modelImg->visibility = 0;
        //$banners->link = '#';
        //$banners->new_window = 1;
        //$banners->language = $_POST['language'];
        $modelImg->save();
        $verifyToken = md5('unique_salt' . $_POST['timestamp']);
        if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
            $folder = '/images/' . $_POST['folder'];
            Yii::import('application.extensions.upload.Upload');
            Yii::app()->setComponents(array('imagemod' => array('class' => 'application.extensions.imagemodifier.CImageModifier')));
            Yii::app()->imagemod->setLanguage('ru_RU');
            $handle = Yii::app()->imagemod->load($_FILES['Filedata']);
            if ($handle->uploaded) {
                $handle->image_watermark = Yii::getPathOfAlias('webroot').'/images/watermark/watermark.png';
                $handle->image_watermark_position = 'BR';
                //не заменять - на _
                $handle->file_safe_name = false;
                //не переименовывать
                $handle->file_auto_rename = false;
                $handle->jpeg_quality = 100;
                //$handle->file_name_body = $id;
                //$handle->file_new_name_body = $modelImg->dishes_gallery_id;
                $handle->file_name_body_pre = $modelImg->dishes_gallery_id . '-';
                $handle->process(Yii::getPathOfAlias('webroot') . $folder . '/real/');
                if ($handle->processed) {
                    $img = $handle->file_dst_name;
                    //$handle->clean();
                } else {                
                    Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> ' . $handle->error);
                }
                $handle->image_watermark = Yii::getPathOfAlias('webroot').'/images/watermark/watermark.png';
                $handle->image_watermark_position = 'BR';

                $handle->file_safe_name = false;
                $handle->file_auto_rename = false;
                $handle->jpeg_quality = 100;
                $handle->image_resize = true;
                $handle->image_ratio = true;
                $handle->image_ratio_crop = true;
                //$handle->file_new_name_body = $modelImg->dishes_gallery_id;
                $handle->file_name_body_pre = $modelImg->dishes_gallery_id . '-';
                $handle->image_x = $arrSizeImg['big']['width'];
                $handle->image_y = $arrSizeImg['big']['height'];
                $handle->process(Yii::getPathOfAlias('webroot') . $folder . '/big/');
                if ($handle->processed) {
                    $img = $handle->file_dst_name;
                    //$handle->clean();
                } else {
                    Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> ' . $handle->error);
                }
                $handle->image_watermark = Yii::getPathOfAlias('webroot').'/images/watermark/watermark.png';
                $handle->image_watermark_position = 'BR';

                $handle->file_safe_name = false;
                $handle->file_auto_rename = false;
                $handle->jpeg_quality = 100;
                $handle->image_resize = true;
                $handle->image_ratio = false;
                $handle->image_ratio_crop = true;
                //$handle->file_new_name_body = $modelImg->dishes_gallery_id;
                $handle->file_name_body_pre = $modelImg->dishes_gallery_id . '-';
                $handle->image_x = $arrSizeImg['small']['width'];
                $handle->image_y = $arrSizeImg['small']['height'];
                $handle->process(Yii::getPathOfAlias('webroot') . $folder . '/small/');
                if ($handle->processed) {
                    $img = $handle->file_dst_name;
                    //$handle->clean();
                } else {
                    Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> ' . $handle->error);
                }
            }
            $modelImg->name = $img;//$modelImg->dishes_gallery_id . '.' . $handle->file_src_name_ext;
            $modelImg->visibility = 1;
            $modelImg->save();
        }
        $this->renderPartial('upload');
    }


    public function actionShowImagesList() 
    {
        return $this->widget('ImagesListWidget', array('pid' => $_POST['pid'], 'folder' => $_POST['folder'], 'model'=>$_POST['model'], 'modelId'=>$_POST['modelId']));
    }


    // Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
}