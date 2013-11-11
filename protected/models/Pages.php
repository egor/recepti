<?php

/**
 * This is the model class for table "pages".
 *
 * The followings are the available columns in table 'pages':
 * @property integer $pages_id
 * @property integer $root
 * @property integer $lft
 * @property integer $rgt
 * @property integer $level
 * @property string $url
 * @property integer $visibility
 * @property integer $in_menu
 * @property string $menu_name
 * @property string $h1
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $short_text
 * @property string $text
 * @property string $img
 * @property string $img_alt
 * @property string $img_title
 * @property string $add_1
 * @property string $add_2
 */
class Pages extends CActiveRecord {

    const ADMIN_TREE_CONTAINER_ID = 'categorydemo_admin_tree';

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Pages the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'pages';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            //array('root, lft, rgt, level, url, visibility, in_menu, menu_name, h1, meta_title, meta_keywords, meta_description, short_text, text, img, img_alt, img_title, add_1, add_2', 'required'),
            array('root, lft, rgt, level, url, 
                visibility, in_menu, menu_name, h1, meta_title, 
                meta_keywords, meta_description, short_text, text, img, 
                img_alt, img_title, add_1, add_2, in_last, 
                date, print_top_form, img_top_form, end_date_top_form, end_time_top_form,
                print_footer_form, text_footer_form, color_footer_form, line_footer_form, print_date, like,
                footer_form_remark, top_form_remark', 'safe'),
            array('root, lft, rgt, level, visibility, in_menu, in_last, date, print_date, like', 'numerical', 'integerOnly' => true),
            array('url, menu_name, h1, img, img_alt, img_title, img_top_form, color_footer_form, line_footer_form, footer_form_remark, top_form_remark', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('pages_id, root, lft, rgt, level, 
                url, visibility, in_menu, menu_name, h1, 
                meta_title, meta_keywords, meta_description, short_text, text, 
                img, img_alt, img_title, add_1, add_2, 
                in_last, date, print_top_form, img_top_form, end_date_top_form, 
                end_time_top_form, print_footer_form, text_footer_form, color_footer_form, line_footer_form, print_date, like,
                footer_form_remark, top_form_remark', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'pages_id' => 'Pages',
            'root' => 'Root',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'level' => 'Level',
            'url' => 'Url',
            'visibility' => 'Выводить',
            'in_menu' => 'Отображать в меню',
            'menu_name' => 'Краткое название',
            'h1' => 'Заголовок (h1)',
            'meta_title' => 'Meta Title',
            'meta_keywords' => 'Meta Keywords',
            'meta_description' => 'Meta Description',
            'short_text' => 'Краткое описание',
            'text' => 'Текст',
            'img' => 'Картинка',
            'img_alt' => 'alt (альтернативный текст)',
            'img_title' => 'title (заголовок)',
            'add_1' => 'Add 1',
            'add_2' => 'Add 2',
            'in_last' => 'Выводить в последних статьях',
            'date' => 'Дата',
            'print_top_form'=>'Выводить форму вверху страницы',
            'img_top_form'=>'Картинка - фон формы',
            'end_date_top_form'=>'Дата окончания',
            'end_time_top_form'=>'Время окончания (00:00)',
            'print_footer_form'=>'Выводить форму внизу страницы',
            'text_footer_form'=>'Текст формы',
            'color_footer_form'=>'Цвет фона',
            'line_footer_form'=>'Текст под формой',
            'print_date'=>'Выводить дату',
            'like'=>'Выводить кнопки соц сетей',
            'footer_form_remark' => 'Пометка к форме (будет приходить на почту)',
            'top_form_remark' => 'Пометка к форме (будет приходить на почту)'            
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('pages_id', $this->pages_id);
        $criteria->compare('root', $this->root);
        $criteria->compare('lft', $this->lft);
        $criteria->compare('rgt', $this->rgt);
        $criteria->compare('level', $this->level);
        $criteria->compare('url', $this->url, true);
        $criteria->compare('visibility', $this->visibility);
        $criteria->compare('in_menu', $this->in_menu);
        $criteria->compare('menu_name', $this->menu_name, true);
        $criteria->compare('h1', $this->h1, true);
        $criteria->compare('meta_title', $this->meta_title, true);
        $criteria->compare('meta_keywords', $this->meta_keywords, true);
        $criteria->compare('meta_description', $this->meta_description, true);
        $criteria->compare('short_text', $this->short_text, true);
        $criteria->compare('text', $this->text, true);
        $criteria->compare('img', $this->img, true);
        $criteria->compare('img_alt', $this->img_alt, true);
        $criteria->compare('img_title', $this->img_title, true);
        $criteria->compare('add_1', $this->add_1, true);
        $criteria->compare('add_2', $this->add_2, true);
        $criteria->compare('in_last', $this->in_last, true);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('print_top_form', $this->print_top_form, true);
        $criteria->compare('img_top_form', $this->date, img_top_form);
        $criteria->compare('end_date_top_form', $this->end_date_top_form, true);
        $criteria->compare('end_time_top_form', $this->end_time_top_form, true);
        $criteria->compare('print_footer_form', $this->print_footer_form, true);
        $criteria->compare('text_footer_form', $this->text_footer_form, true);
        $criteria->compare('color_footer_form', $this->color_footer_form, true);
        $criteria->compare('line_footer_form', $this->line_footer_form, true);
        $criteria->compare('print_date', $this->print_date, true);
        $criteria->compare('like', $this->like, true);
        $criteria->compare('footer_form_remark',$this->footer_form_remark);
        $criteria->compare('top_form_remark',$this->top_form_remark);

 

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function behaviors() {
        return array(
            'NestedSetBehavior' => array(
                'class' => 'ext.nestedBehavior.NestedSetBehavior',
                'leftAttribute' => 'lft',
                'rightAttribute' => 'rgt',
                'levelAttribute' => 'level',
                'hasManyRoots' => true
            )
        );
    }

    public static function printULTree() {
        $categories = Pages::model()->findAll(array('order' => 'root,lft'));
        $level = 0;

        foreach ($categories as $n => $category) {

            if ($category->level == $level)
                echo CHtml::closeTag('li') . "\n";
            else if ($category->level > $level)
                echo CHtml::openTag('ul') . "\n";
            else {
                echo CHtml::closeTag('li') . "\n";

                for ($i = $level - $category->level; $i; $i--) {
                    echo CHtml::closeTag('ul') . "\n";
                    echo CHtml::closeTag('li') . "\n";
                }
            }

            echo CHtml::openTag('li', array('id' => 'node_' . $category->pages_id, 'rel' => $category->menu_name));
            $s=0;
            //foreach (Yii::app()->params['modules'] as $value) {
            //    if ($category->pages_id==$value) {
            //     $s=1;   
            
              //  echo CHtml::openTag('a', array('href' => '#', 'ondblclick'=>'window.location.href = "/altadmin/pages/edit/'.$category->pages_id.'"; return false;'));
            //}
            
            //}
            //if ($s==0) {
                echo CHtml::openTag('a', array('href' => '#', 'ondblclick'=>'window.location.href = "/altadmin/pages/edit/'.$category->pages_id.'"; return false;'));
            //}
            //// else {
            //echo CHtml::openTag('a', array('href' => '#', 'ondblclick'=>'window.location.href = "/altadmin/pages/edit/'.$category->pages_id.'"; return false;'));
            //}}
            echo CHtml::encode($category->menu_name);
            echo CHtml::closeTag('a');

            $level = $category->level;
        }

        for ($i = $level; $i; $i--) {
            echo CHtml::closeTag('li') . "\n";
            echo CHtml::closeTag('ul') . "\n";
        }
    }

    public static function printULTree_noAnchors() {
        $categories = Pages::model()->findAll(array('order' => 'lft'));
        $level = 0;

        foreach ($categories as $n => $category) {
            if ($category->level == $level)
                echo CHtml::closeTag('li') . "\n";
            else if ($category->level > $level)
                echo CHtml::openTag('ul') . "\n";
            else {         //if $category->level<$level
                echo CHtml::closeTag('li') . "\n";

                for ($i = $level - $category->level; $i; $i--) {
                    echo CHtml::closeTag('ul') . "\n";
                    echo CHtml::closeTag('li') . "\n";
                }
            }

            echo CHtml::openTag('li');
            echo CHtml::encode($category->menu_name);
            $level = $category->level;
        }

        for ($i = $level; $i; $i--) {
            echo CHtml::closeTag('li') . "\n";
            echo CHtml::closeTag('ul') . "\n";
        }
    }

}