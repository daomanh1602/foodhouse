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
class Treetbl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_tree';
    }
    
    public function behaviors() {
        return [
                \yii\behaviors\TimestampBehavior::className(),
                'tree' => [
                        'class' => NestedSetsBehavior::className(),
                        'treeAttribute' => 'tree',
                        'leftAttribute' => 'lft',
                        'rightAttribute' => 'rgt',
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
        return new TreetblQuery(get_called_class());
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
                // [['name'], 'required'],
                [['position'],'default','value'=>0],
                [['tree', 'lft', 'rgt', 'depth', 'position'], 'integer'],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
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
    
    public static function getTree($node_id = 0 ,$tree, $meta){
        
        $children = [];
        if(!empty($node_id))
            $children= array_merge(
                self::findOne($node_id)->children()->column(),
                [$node_id]
            );
        
        $row = self::find()->select('id,depth')
                ->where(['NOT IN','id',$children])
                ->andWhere('depth > 0')
                ->andWhere(['tree' => $tree])
                ->with ( [
                    $meta,		
                ] )
                ->orderBy('tree,lft')
                ->all();
                
        $return = [];

        foreach ($row as $r)
            $return[$r->id]= str_repeat('--',$r->depth -1 ).' '.$r[$meta]['name'];
        return $return;			
    }
    //
    
    public function getTreecategory()
    {
        return $this->hasOne(Treecategory::className(), ['root_id' => 'id']);
    }

    public function getTreetag()
    {
        return $this->hasOne(Treetag::className(), ['root_id' => 'id']);
    }
    
    public function getUser_created()
    {
        return $this->hasOne(UserModel::className(), ['id' => 'created_by']);
    }
        
}
