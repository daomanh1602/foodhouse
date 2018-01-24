<?php

namespace common\models;

class Grouptag extends MyActiveRecord
{
    public static function tableName()
    {
        return 'group_tag';
    }

    public function attributeLabels()
    {
        return [
            'name'=>'Name of group',        
        ];
    }

    public function rules()
    {
        return [
            [[
                'name'
                ], 'trim'],
            [[
                'name'
                ], 'required'],
        ];
    }

}
