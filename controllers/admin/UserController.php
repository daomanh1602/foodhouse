<?php

namespace app\controllers\admin;

use Yii;
use app\models\admin\UserModel;
use app\models\admin\PermissionModel;
use yii\web\HttpException;
use yii\data\Pagination;

class UserController extends MyController {
    public function actionIndex() {
        $query = UserModel::find ()->where(['status_acc'=>'1']);
        
        $countQuery = clone $query;
        $pages = new Pagination ( [ 
                'totalCount' => $countQuery->count (),
                'pageSize' => 10 
        ] );
        
        
        $the_user = $query->orderBy ( 'id' )->offset ( $pages->offset )->limit ( $pages->limit )->all ();
        
        // var_dump($the_user);exit();
        return $this->render ( 'index', [ 
                'the_user' => $the_user,
                'pages' => $pages 
        ] );
    }
    
    public function actionC() {
        $theUser = new UserModel ();
        $theUser->scenario = 'create';

        $list_permission =  $query = PermissionModel::find ()
            ->select('id, permission_name')
            ->where ( [ 'status' => '1' ] )
            ->orderBy ( 'id' )           
            ->asArray()
            ->all ();
        
        if ($theUser->load ( Yii::$app->request->post () ) && $theUser->validate ()) {
            
            
            $theUser->created_at = NOW;
            $theUser->created_by = USER_ID;
            $theUser->updated_at = NOW;
            $theUser->updated_by = USER_ID;
            // $theUser->status_acc = 1;
            // $theUser->username = $theUser->username;
            // $theUser->f_name = $theUser->f_name;
            // $theUser->l_name = $theUser->l_name;
            // $theUser->emails = $theUser->emails;
            // $theUser->gender = $theUser->gender;
            $theUser->password = md5 ( $theUser->password ) . 'n0b1';
            
            $result = $theUser->save ( false );
            
            if($result){
                $id = $theUser->id;
                $action = 'Created user id :'.$id;
                $result = '1';
                MyController::actionSavelog($action , $result);	
            }else{
                $id = $theUser->id;
                $action = 'Created user id :'.$id;
                $result = '0';
                MyController::actionSavelog($action , $result);	
            }
            
            return $this->redirect('@web/admin/user');			
        }
        
        return $this->render ( 'users_c', [ 
                'theUser' => $theUser,
                'list_permission' => $list_permission
        ] );
    }
    
    public function actionU($id = ''){
        
        $theUser = UserModel::find()		
        ->where(['id'=>$id])
        ->one();
        
        if (!$theUser || $theUser['status_acc'] === 0) {
            throw new HttpException(404, 'User not found');
        }			
        
        $list_permission =  $query = PermissionModel::find ()
            ->select('id, permission_name')
            ->where ( [ 'status' => '1' ] )
            ->orderBy ( 'id' )           
            ->asArray()
            ->all ();

        $theUser->scenario = 'update';
        
        if ($theUser->load ( Yii::$app->request->post () ) && $theUser->validate ()) {
            
            $theUser->updated_at = NOW;
            $theUser->updated_by = 0;			
            $theUser->status_acc = 1;			
            $theUser->f_name = $theUser->f_name;
            $theUser->l_name = $theUser->l_name;
            $theUser->emails = $theUser->emails;
            $theUser->gender = $theUser->gender;
            $theUser->address = $theUser->address;
            //$theUser->password = md5 ( $theUser->password ) . 'n0b1';
            
            $result = $theUser->save ( false );
            
            if($result){
                $action = 'updated information user id :'.$id;
                $result = '1';
                MyController::actionSavelog($action , $result);	
            }else{
                $action = 'updated information user id :'.$id;
                $result = '0';
                MyController::actionSavelog($action , $result);				
            }
            
            return $this->redirect('@web/admin/user');
        }
        
        return $this->render ( 'users_u', [
                'theUser' => $theUser,
                'list_permission' => $list_permission
        ] );
        
    }
    
    public function actionD($id = ''){
        $theUser = UserModel::find()
        ->where(['id'=>$id])
        ->one();
        
        if (!$theUser || $theUser['status_acc'] === 0) {
            throw new HttpException(404, 'User not found');
        }
        
        $result = Yii::$app->db->createCommand()->update(
        'nobi_user', [
                'updated_at'=>NOW,
                'updated_by'=>USER_ID,
                'status_acc'=>'0',				
        ], ['id'=>$id])->execute();
        
        if($result){
            $action = 'Delete user id :'.$id;
            $result = '1';
            MyController::actionSavelog($action , $result);
        }else{
            $action = 'Delete user id :'.$id;
            $result = '0';
            MyController::actionSavelog($action , $result);
        }
        return $this->redirect('@web/admin/user');
    }
    
    
    
}
