<?php
namespace common\models;

use creocoder\nestedsets\NestedSetsQueryBehavior;
/**
 * This is the ActiveQuery class for [[Testtbl]].
 *
 * @see Testtbl
 */
class TesttblQuery extends \yii\db\ActiveQuery
{
	
	public function behaviors() {
		return [
				NestedSetsQueryBehavior::className(),
		];
	}
	/**
	 * @inheritdoc
	 * @return Testtbl[]|array
	 */
	public function all($db = null)
	{
		return parent::all($db);
	}
	
	/**
	 * @inheritdoc
	 * @return Testtbl|array|null
	 */
	public function one($db = null)
	{
		return parent::one($db);
	}
}
