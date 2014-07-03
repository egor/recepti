<?php

/**
 * Description of UploadifyWidget
 *
 * @author egorik
 */
class UploadifyWidget extends CWidget {

    public $model;
    public $pid;
    public $folder;
    public $modelId;

    public function run() {
        $this->render('uploadifyWidget', array('model' => $this->model, 'pid' => $this->pid, 'folder' => $this->folder, 'modelId' => $this->modelId));
    }

}
