<?php

namespace common\models;

use Yii;
use creocoder\taggable\TaggableBehavior;

class Testperson extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'person_test';
	}
	
	public function behaviors() {
		 return [
            'taggable' => [
                'class' => TaggableBehavior::className(),
                // 'tagValuesAsArray' => false,
                // 'tagRelation' => 'tags',
                // 'tagValueAttribute' => 'name',
                // 'tagFrequencyAttribute' => 'frequency',
            ],
        ];
	}
	
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
				['tagValues', 'safe'],
		];
	}
	
	/**
	 * @inheritdoc
	 */

	public function transactions()
	{
		return [
			self::SCENARIO_DEFAULT => self::OP_ALL,
		];
	}
	
	public static function find()
    {
        return new TestpersonQuery(get_called_class());
    }
 
	public function attributeLabels()
	{
		return [

		];
	}

    public function getTags()
    {
        return $this->hasMany(Treetag::className(), ['root_id' => 'tag_id'])
            ->viaTable('person_tag_assn', ['person_id' => 'id']);
    }
	

}
