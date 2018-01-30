<?php

namespace app\controllers\admin;

use Yii;
use app\models\admin\TypeslideModel;
use yii\web\HttpException;
use yii\data\Pagination;
use yii\web\UploadedFile;

class TypeslideController extends MyController {
    public function actionIndex() {
        $query = TypeslideModel::find ();
        
        $getName = Yii::$app->request->get ('g_name', '' );
        
        if($getName != ''){
            $query->andWhere('name_1 like :name',[':name'=> '%'.$getName.'%']);
        }
        
        $countQuery = clone $query;
        $pages = new Pagination ( [ 
                'totalCount' => $countQuery->count (),
                'pageSize' => 10 
        ] );
        
        $the_post = $query
            ->orderBy ( 'id' )
            ->offset ( $pages->offset )
            ->limit ( $pages->limit )      
            ->with ( [                 
                'user_created' => function ($query) {
                    $query->select ( [ 
                            'id',
                            'username' 
                    ] );
                } 
            ] )     
            ->asArray()
            ->all ();

        return $this->render ( 'index', [ 
                'the_post' => $the_post,
                'pages' => $pages ,
                'name' => $getName
        ] );
    }
    public function actionC() {
        $thePost = new TypeslideModel ();
        
        if ($thePost->load ( Yii::$app->request->post () ) && $thePost->validate ()) {           
            $thePost->created_at = NOW;
            $thePost->created_by = USER_ID;
            $thePost->updated_at = NOW;
            $thePost->updated_by = USER_ID;
                        
            $result = $thePost->save ( false );
            
            if ($result) {
                $id = $thePost->id;                
                if ($id != '') {        
                    $action = 'Created type slide id :' . $id;
                    $result = '1';
                    MyController::actionSavelog ( $action, $result );                    
                }
            } else {
                $action = 'Created type slide id :' . $id;
                $result = '0';
                MyController::actionSavelog ( $action, $result );
            }
            
            return $this->redirect ( '@web/admin/typeslide' );
        }
        
        return $this->render ( 'type_c', [ 
                'thePost' => $thePost,
        ] );
    }
    
    public function actionU($id = '') {
        $thePost = TypeslideModel::find ()->where ( [ 
                'id' => $id 
        ] )->one ();
        
        if (! $thePost ) {
            throw new HttpException ( 404, 'Not found' );
        }
                
        if ($thePost->load ( Yii::$app->request->post () ) && $thePost->validate ()) {
            
            $thePost->updated_at = NOW;
            $thePost->updated_by = USER_ID;
                      
            $result = $thePost->save ( false );
            
            if ($result) {
                $id = $thePost->id;
                
                if ($id != '') {
                    $action = 'Update  type slide id :' . $id;
                    $result = '1';
                    MyController::actionSavelog ( $action, $result );                    
                }
            } else {
                $action = 'Update  type slide id :' . $id;
                $result = '0';
                MyController::actionSavelog ( $action, $result );
            }
            
            return $this->redirect ( '@web/admin/typeslide' );
        }
        
        return $this->render ( 'type_u', [ 
                'thePost' => $thePost,
        ] );
    }
    
    public function actionD($id = '') {
        $Post = TypeslideModel::find ()->where ( [ 
                'id' => $id 
        ] )->one ();
        
        if (!$Post ) {
            throw new HttpException ( 404, 'Not found' );
        }
        
        $result = Yii::$app->db->createCommand ()->update ( 'nobi_post', [ 
                'updated_at' => NOW,
                'updated_by' => USER_ID,
                'status' => '0' 
        ], [ 
                'id' => $id 
        ] )->execute ();
        
        if ($result) {
            $action = 'Delete post id :' . $id;
            $result = '1';
            MyController::actionSavelog ( $action, $result );
        } else {
            $action = 'Delete post id :' . $id;
            $result = '0';
            MyController::actionSavelog ( $action, $result );
        }
        return $this->redirect ( '@web/admin/post' );
    }
}