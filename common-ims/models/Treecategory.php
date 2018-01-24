<?php
namespace common\models;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;

class Treecategory extends ActiveRecord
{
	public static function tableName()
	{
		return 'tbl_tree_category';
	}
	public function getTreemeta() {
		return $this->hasOne(Treetbl::className(), ['id' => 'root_id']);
	}
	
	
}