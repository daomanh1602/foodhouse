<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category_venus".
 *
 * @property integer $id
 * @property string $name
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 * @property integer $position
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 * @property integer $tree
 * @property integer $status
 * @property integer $parent_id
 */

use creocoder\nestedsets\NestedSetsBehavior;
class CategoryVenus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_venus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lft', 'rgt', 'depth', 'position', 'created_at', 'created_by', 'updated_at', 'updated_by', 'tree', 'status', 'parent_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'lft' => Yii::t('app', 'Lft'),
            'rgt' => Yii::t('app', 'Rgt'),
            'depth' => Yii::t('app', 'Depth'),
            'position' => Yii::t('app', 'Position'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'tree' => Yii::t('app', 'Tree'),
            'status' => Yii::t('app', 'Status'),
            'parent_id' => Yii::t('app', 'Parent ID'),
        ];
    }

    /**
     * @inheritdoc
     * @return CategoryVenusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CategoryVenusQuery(get_called_class());
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
		
		
		$row = self::find()->select('id,name,depth')->where(['NOT IN','id',$children])->orderBy('tree,lft')->all();
		$return = [];
		foreach ($row as $r)
			$return[$r->id]= str_repeat('- ',$r->depth).' '.$r->name;
		return $return;			
	}
    
    public function getUser_created()
    {
    	return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
}
