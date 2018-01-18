<?php

namespace app\controllers\admin;

use Yii;
use app\models\admin\PermissionModel;
use yii\web\HttpException;
use yii\data\Pagination;

class PermissionController extends MyController {
    public function actionIndex() {
        $query = PermissionModel::find ()->where ( [ 
                'status' => '1' 
        ] );
        
        $getName = Yii::$app->request->get ('g_name', '' );
        
        if($getName != ''){
            $query->andWhere('permission_name like :name',[':name'=> '%'.$getName.'%']);
        }
        
        $countQuery = clone $query;
        $pages = new Pagination ( [ 
                'totalCount' => $countQuery->count (),
                'pageSize' => 10 
        ] );
        
        $the_permission = $query
            ->orderBy ( 'id' )
            ->offset ( $pages->offset )
            ->limit ( $pages->limit )            
            ->asArray()
            ->all ();

        return $this->render ( 'index', [ 
                'the_permission' => $the_permission,
                'pages' => $pages ,
                'name' => $getName
        ] );
    }
    public function actionC() {
        $thePermission = new PermissionModel ();

        if ($thePermission->load ( Yii::$app->request->post () ) && $thePermission->validate ()) {
                       
            $thePost->status = 1;
            
            $result = $thePermission->save ( false );
           
            return $this->redirect ( '@web/admin/permission' );
        }
        
        return $this->render ( 'permission_c', [ 
            'thePermission' => $thePermission,
        ] );
    }
    
    public function actionU($id = '') {
        $thePermission = PermissionModel::find ()
            ->where (['id' => $id])            
            ->one ();
        
        if (! $thePermission || $thePermission ['status'] === 0) {
            throw new HttpException ( 404, 'Permission not found' );
        }
                               
        if ($thePermission->load ( Yii::$app->request->post () ) && $thePermission->validate ()) {
                                
            $result = $thePermission->save ( false );
            
            return $this->redirect ( '@web/admin/permission' );
        }
        
        return $this->render ( 'permission_u', [ 
            'thePermission' => $thePermission,
        ] );
    }
    
    public function actionD($id = '') {
        $thePermission = PermissionModel::find ()
            ->where (['id' => $id])
            ->one ();
        
        if (! $thePermission || $thePermission ['status'] === 0) {
            throw new HttpException ( 404, 'Permission not found' );
        }
        
        $result = Yii::$app->db->createCommand ()->update ( 'nobi_permission', [ 
                'status' => '0' 
        ], [ 
                'id' => $id 
        ] )->execute ();
        
        return $this->redirect ( '@web/admin/permission' );
    }
}