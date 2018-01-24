<?php

namespace common\models;

use Yii;
use creocoder\nestedsets\NestedSetsBehavior;
/**
 * This is the model class for table "test_tbl".
 *
 * @property integer $id
 * @property string $name
 * @property integer $tree
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 * @property integer $position
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */
class Testtbl extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'test_tbl';
	}
	
	public function behaviors() {
		return [
				\yii\behaviors\TimestampBehavior::className(),
				'tree' => [
						'class' => NestedSetsBehavior::className(),
						'treeAttribute' => 'tree',
						// 'leftAttribute' => 'lft',
						// 'rightAttribute' => 'rgt',
						// 'depthAttribute' => 'depth',
				],
		];
	}
	
	public function transactions()
	{
		return [
				self::SCENARIO_DEFAULT => self::OP_ALL,
		];
	}
	
	public static function find()
	{
		return new TesttblQuery(get_called_class());
	}
	
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
				[['name'], 'required'],
				[['position'],'default','value'=>0],
				[['tree', 'lft', 'rgt', 'depth', 'position'], 'integer'],
// 				[['created_at', 'updated_at'], 'safe'],
				[['name'], 'string', 'max' => 255],
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
				'id' => 'ID',
				'name' => 'Name',
				'tree' => 'Tree',
				'lft' => 'Lft',
				'rgt' => 'Rgt',
				'depth' => 'Depth',
				'position' => 'Position',
				'created_at' => 'Created At',
				'created_by' => 'Created By',
				'updated_at' => 'Updated At',
				'updated_by' => 'Updated By',
		];
	}
	
	public function getParentId(){
		$parentId = $this->parent;
    	return $parentId ? $parentId->id : null ;
	}
	
	public function getParent(){		
		return $this->parents(1)->one();
	}
	
	public static function getTree($node_id = 0){
		
		$children = [];
		if(!empty($node_id))
			$children= array_merge(
				self::findOne($node_id)->children()->column(),
				[$node_id]
			);
		
		$row = self::find()->select('id,name,depth')->where(['NOT IN','id',$children])->andWhere('depth > 1')->orderBy('tree,lft')->all();
		$return = [];
		foreach ($row as $r)
			$return[$r->id]= str_repeat('--',$r->depth).' '.$r->name;
		return $return;			
	}

	public function getEvent(){
		return $this->hasOne(Event::className(), ['id' => 'venue']);
	}
	
	
}
