<?php

namespace common\models;

use Yii;
use creocoder\taggable\TaggableQueryBehavior;

class TestpersonQuery extends \yii\db\ActiveQuery
{
    public function behaviors()
    {
        return [
            TaggableQueryBehavior::className(),
        ];
    }
}