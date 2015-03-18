<?php

/**
 * This is the model class for table "slider".
 *
 * The followings are the available columns in table 'slider':
 * @property integer $id_slider
 * @property string $title_slider
 * @property string $desc_slider
 * @property string $img_slider
 * @property string $create_at
 */
class Slider extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'slider';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title_slider, img_slider', 'length', 'max'=>255),
			array('desc_slider, create_at', 'safe'),
			array('create_at','default', 'value'=>new CDbExpression('NOW()')),
			
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_slider, title_slider, desc_slider, img_slider, create_at', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_slider' => 'Id Slider',
			'title_slider' => 'Title Slider',
			'desc_slider' => 'Desc Slider',
			'img_slider' => 'Img Slider',
			'create_at' => 'Create At',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_slider',$this->id_slider);
		$criteria->compare('title_slider',$this->title_slider,true);
		$criteria->compare('desc_slider',$this->desc_slider,true);
		$criteria->compare('img_slider',$this->img_slider,true);
		$criteria->compare('create_at',$this->create_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function beforeSave() {
		if ( $this->scenario == 'update') {
			if (empty($this->img_slider)) {
				$this->img_slider = $this->findByPk($this->id_slider)->img_slider;
			}else{
				$this->img_slider = $this->img_slider;
			}
		}
        return parent::beforeSave();
	 }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Slider the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
