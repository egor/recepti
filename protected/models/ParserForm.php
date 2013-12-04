<?php

class ParserForm extends CFormModel
{
    public $site;
    public $url;
    public $categoryId;
    public function rules()
    {
        return array(
            // username and password are required
            array('site, url, categoryId', 'required'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'site' => 'Адрес сайта',
            'url' => 'Страница списка',
            'categoryId' => 'Название категории',
        );
    }
}