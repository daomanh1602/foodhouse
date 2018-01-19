<?php

namespace app\controllers\admin;

use Yii;
use app\models\admin\Slide;
use app\models\admin\CategoryForm;
use app\models\admin\SlideSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;	
use yii\web\UploadedFile;
use yii\web\HttpException;

/**
 * SlideController implements the CRUD actions for Slide model.
 */
class SlideController extends MyController {
    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [ 
            'verbs' => [ 
                'class' => VerbFilter::className (),
                'actions' => [ 
                    'delete' => [ 
                        'POST' 
                    ] 
                ] 
            ] 
        ];
    }
    
    /**
     * Lists all Slide models.
     * 
     * @return mixed
     */
    public function actionIndex() {
        $query = Slide::find ()
                ->where (['status' => '1'])
                ->andWhere('depth > 0');

        
        $getName = Yii::$app->request->get ('g_name', '' );
        if($getName != ''){
            $query->innerJoinwith('slide_detail')->andWhere('nobi_slide_detail.name like :name',[':name'=> '%'.$getName.'%']);
        }
        
        $countQuery = clone $query;
        $pages = new Pagination ( [
                'totalCount' => $countQuery->count (),
                'pageSize' => 10
        ] );
        
        $the_Slide = $query
        ->orderBy ( 'nobi_slide.lft' )
        ->offset ( $pages->offset )
        ->limit ( $pages->limit )
        ->with ( [
                    'slide_detail' => function ($query) {
                        $query->andWhere ( [
                                'lang_id' => '1'
                        ]);			
                    },
                    
                    'user_created' => function ($query) {
                        $query->select ( [
                                'id',
                                'username'
                        ] );
                    }
                ] )
        ->asArray()
        ->all (); 		

        return $this->render ( 'index_2', [
                'name' => $getName,
                'theSlide'=> $the_Slide,
                'pages' => $pages ,
        ] );
    }
    
    /**
     * Displays a single Slide model.
     * 
     * @param integer $id        	
     * @return mixed
     */
    public function actionView($id) {
        return $this->render ( 'view', [ 
                'model' => $this->findModel ( $id ) 
        ] );
    }
    
    /**
     * Creates a new Slide model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * 
     * @return mixed
     */
    public function actionC() {
        $model = new Slide ();
        
        $theForm = new CategoryForm();
        $theForm->scenario = 'create_slide';
        
        $query = Slide::find ()
        ->select('id, depth')
        ->where (['status' => '1']);	
        
        $the_Slide = $query
        ->orderBy ( 'nobi_slide.lft' )			
        ->with ( [
            'slide_detail' => function ($query) {
                $query->andWhere ( [
                        'lang_id' => '1'
                ]);
            }    
        ])
        ->asArray()
        ->all (); 
 

        if ($theForm->load(Yii::$app->request->post()) && $theForm->validate() && Yii::$app->request->isPost) {
            
            $post= Yii::$app->request->post();
            
            $model->position = '0';
            $model->created_by = USER_ID;
            $model->updated_by = USER_ID;
            $model->created_at = NOW;
            $model->updated_at = NOW;
            $model->status = '1';
            $model->name = 'null';
            // var_dump($_POST);exit();

            $parent_id = '1';
            $model->parent_id = $parent_id;
            
            if (empty ( $parent_id )) {
                $model->makeRoot();				
            } else {
                
                $parent = Slide::findOne ( $parent_id );                
                $model->appendTo ($parent);
                $child_id = $model->id;
                
                if ($child_id != '') {
                    $r2 = Yii::$app->db->createCommand ()->insert ( 'nobi_slide_detail', [
                            'cate_id' => $child_id,
                            'name' => $theForm->name,
                            'lang_id' => '1',
                            'description' => $theForm->description,
                            'content' => $theForm->content,
                            'slug' => str_replace(' ','-',$theForm->name),
                            'seo_title' =>  $theForm->seo_title,
                            'seo_description' =>  $theForm->seo_description
                        ] )->execute ();
                        
                    if ($r2) {
                        $action = 'Created Slide id :' . $child_id;
                        $result = '1';
                        MyController::actionSavelog ( $action, $result );
                    }else {
                        $action = 'Created Slide id :' . $child_id;
                        $result = '0';
                        MyController::actionSavelog ( $action, $result );
                    }
                }	
            }
        
            return $this->redirect ( '@web/admin/slide' );

            // return $this->redirect ( [
            //     'view',
            //     'id' => $model->id 
            // ] );
        }
        
        return $this->render ( 'slide_c', [ 
            'model' => $model ,
            'theForm' => $theForm,
            'theParent' => $the_Slide,
        ] );
    }

    /**
     * Updates an existing Slide model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * 
     * @param integer $id        	
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel ( $id );
        
        $theForm = new CategoryForm();
        $theForm->scenario = 'create';
        
        if(!empty(Yii::$app->request->post('Slide'))){        	
            $post= Yii::$app->request->post('Slide');
            
            $model->name = $post['name'];
            $model->position = $post['position'];
            $parent_id = $post['parentId'];
            
            if($model->save()){				
                if(empty($parent_id)){					
                    $model->makeRoot();
                }else { //change root
                    $parent = Slide::findOne($parent_id);
                    $model->appendTo($parent);
                }
                return $this->redirect(['index']);
            }
            
        }			
        
        return $this->render ( 'update', [ 
                'model' => $model ,
                'theForm' => $theForm
        ] );
    }
    
    public function actionU($id = '') {
        $theSlide = Slide::find()
                        ->where(['id' => $id])						
                        ->with ( [
                            'slide_detail' => function ($query) {
                                $query->andWhere ( [
                                        'lang_id' => '1'
                                ] );
                            },				
                        ] )
                        ->limit(1)
                        ->one ();										
        if (! $theSlide || $theSlide['status'] === 0) {
            throw new HttpException ( 404, 'Slide not found' );
        }
        
        $theForm = new CategoryForm();
        $theForm->scenario = 'create';
        $theForm->setAttributes ( $theSlide->getAttributes (), false );
        
        $theForm->name = $theSlide['slide_detail']['name'];
        $theForm->description = $theSlide['slide_detail']['description'];
        $theForm->content = $theSlide['slide_detail']['content'];			
        $theForm->seo_title = $theSlide ['slide_detail']['seo_title'];
        $theForm->seo_description = $theSlide ['slide_detail']['seo_description'];

        if ($theForm->load( Yii::$app->request->post ()) && $theForm->validate () && !empty(Yii::$app->request->post('Slide')) ) {
            
            $theSlide->updated_at = NOW;
            $theSlide->updated_by = USER_ID;
            $theSlide->status = 1;			
            
            $post= Yii::$app->request->post('Slide');
            $parent_id = $post['parentId'];
            
            if($parent_id != $theSlide['parentId']){
                if($theSlide->save()){
                    if(empty($parent_id)){
                        $theSlide->makeRoot();
                    }else { //change root
                        $parent = Slide::findOne($parent_id);
                        $theSlide->appendTo($parent);
                    }					
                }
            }
            $id = $theSlide->id;
            
            if ($id != '') {
                $r2 = Yii::$app->db->createCommand ()->update ( 'nobi_slide_detail', [
                        'name' => $theForm->name,
                        'description' => $theForm->description,
                        'content' => $theForm->content,
                        'slug' => str_replace(' ','-',$theForm->name),
                        'seo_title' =>  $theForm->seo_title,
                        'seo_description' =>  $theForm->seo_description
                ], 'cate_id =:c_id', array (
                        ':c_id' => $id
                ) )->execute ();
                
                if ($r2) {
                    $action = 'Update Slide id :' . $id;
                    $result = '1';
                    MyController::actionSavelog ( $action, $result );
                }
            }else {
                $action = 'Update Slide id :' . $id;
                $result = '0';
                MyController::actionSavelog ( $action, $result );
             }
            
             return $this->redirect(['index']);
        }
        
        return $this->render ( 'Slide_u', [
                'model' => $theSlide,
                'theForm' => $theForm,
// 				'theParent' => $the_Slide,
        ] );
    }
    
    /**
     * Deletes an existing Slide model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * 
     * @param integer $id        	
     * @return mixed
     */
    public function actionDelete($id = '') {
        var_dump($_POST);exit();
        $model = $this->findModel($id);
        
        if (! $model|| $model['status'] === 0) {
            throw new HttpException ( 404, 'Post not found' );
        }
        
        if($model->isRoot()){
            $result = $model->deleteWithChildren();
        }else {
            $result = $model->delete();
        }
        if ($result) {
            $action = 'Delete Slide id :' . $id;
            $result = '1';
            MyController::actionSavelog ( $action, $result );
        } else {
            $action = 'Delete Slide :' . $id;
            $result = '0';
            MyController::actionSavelog ( $action, $result );
        }

        return $this->redirect ( [ 
                'index' 
        ] );
    }
    
    
    public function actionD($id = '') {
        $model = $this->findModel($id);
        
        if (! $model|| $model['status'] === 0) {
            throw new HttpException ( 404, 'Post not found' );
        }
        
        if($model->isRoot()){
            $result = $model->deleteWithChildren();
        }else {
            $result = $model->delete();
        }
        if ($result) {
            $action = 'Delete Slide id :' . $id;
            $result = '1';
            MyController::actionSavelog ( $action, $result );
        } else {
            $action = 'Delete Slide :' . $id;
            $result = '0';
            MyController::actionSavelog ( $action, $result );
        }
        
        return $this->redirect ( [
                'index'
        ] );
// 		var_dump($id);exit();
    }

    public function actionMoveup($id){
        
        $model = $this->findModel($id);
        $a = $model->prev()->one();
        if(isset($a)){
            $model->insertBefore($a);
        }        
        return $this->redirect(['index']);
        
    }

    public function actionMovedown($id){

        $model = $this->findModel($id);
        $a = $model->next()->one();
        if(isset($a)){
            $model->insertAfter($a);
        }        
        return $this->redirect(['index']);
        
    }


    /**
     * Finds the Slide model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * 
     * @param integer $id        	
     * @return Slide the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Slide::findOne ( $id )) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException ( 'The requested page does not exist.' );
        }
    }
}
