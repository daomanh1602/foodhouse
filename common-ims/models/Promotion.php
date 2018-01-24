<?php
namespace common\models;

class Promotion extends MyActiveRecord
{
	public static function tableName()
	{
		return '{{%promotions}}';
	}

	public function attributeLabels()
	{
		return [
			'start_dt'=>'Start date',
			'end_dt'=>'End date',
			'info'=>'More information',
		];
	}

	public function rules()
	{
		return [
			[['name', 'code', 'start_dt', 'end_dt', 'info'], 'filter', 'filter'=>'trim'],
			[['name', 'code', 'start_dt', 'end_dt'], 'required'],
			[['name'], 'string', 'max'=>128],
			[['code'], 'string', 'max'=>64],
		];
	}

	public function getCreatedBy()
	{
		return $this->hasOne(User::className(), ['id'=>'created_by']);
	}

	public function getUpdatedBy()
	{
		return $this->hasOne(User::className(), ['id'=>'updated_by']);
	}

}
