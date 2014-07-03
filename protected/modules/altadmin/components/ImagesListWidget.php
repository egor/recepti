<?php

/**
 * Description of UploadifyWidget
 *
 * @author egorik
 */
class ImagesListWidget extends CWidget {

    public $pid;
    public $folder;
    public $model;
    public $modelId;

    public function run() {
        $imgModel = new $this->model;
        $imgList = $imgModel->findAll(array('condition' => '`pid`="' . $this->pid . '"', 'order' => 'position DESC'));
        $this->render('imagesListWidget', array('imgList' => $imgList, 'folder' => $this->folder, 'model' => $this->model, 'modelId' => $this->modelId));
    }

}
