<?php

namespace app\controllers\admin;

use Yii;
use app\models\admin\Category;
use app\models\admin\CategoryForm;
use app\models\admin\CategorySearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;	

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends MyController {
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
     * Lists all Category models.
     * 
     * @return mixed
     */
    public function actionIndex() {
        $query = Category::find ()
                ->where (['status' => '1'])
                ->andWhere('depth > 0');

        
        $getName = Yii::$app->request->get ('g_name', '' );
        if($getName != ''){
            $query->innerJoinwith('category_detail')->andWhere('nobi_category_detail.name like :name',[':name'=> '%'.$getName.'%']);
        }
        
        $countQuery = clone $query;
        $pages = new Pagination ( [
                'totalCount' => $countQuery->count (),
                'pageSize' => 10
        ] );
        
        $the_category = $query
        ->orderBy ( 'nobi_category.lft' )
        ->offset ( $pages->offset )
        ->limit ( $pages->limit )
        ->with ( [
                    'category_detail' => function ($query) {
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
                'theCategory'=> $the_category,
                'pages' => $pages ,
        ] );
    }
    
    /**
     * Displays a single Category model.
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
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * 
     * @return mixed
     */
    public function actionC() {
        $model = new Category ();
        
        $theForm = new CategoryForm();
        $theForm->scenario = 'create';
        
        $query = Category::find ()
        ->select('id, depth')
        ->where (['status' => '1']);	
        
        $the_category = $query
            ->orderBy ( 'nobi_category.lft' )			
            ->with ( [
                'category_detail' => function ($query) {
                    $query->andWhere ( [
                            'lang_id' => '1'
                    ]);
                }
                
                ] )
            ->asArray()
            ->all (); 
                
        if ($theForm->load(Yii::$app->request->post()) && $theForm->validate() && !empty(Yii::$app->request->post('Category'))) {
            
            $post= Yii::$app->request->post('Category');
            
            $model->position = '0';
            $model->created_by = USER_ID;
            $model->updated_by = USER_ID;
            $model->created_at = NOW;
            $model->updated_at = NOW;
            $model->status = '1';
            $model->name = 'null';			
            $parent_id = $post ['parentId'];
            $model->parent_id = $parent_id;                   

            if (empty ( $parent_id )) {
                $model->makeRoot ();				
            } else {
                
                $parent = Category::findOne ( $parent_id );
                
                $a = $model->appendTo ($parent);

                $child_id = $model->id;
                
                if ($child_id != '') {
                    $r2 = Yii::$app->db->createCommand ()->insert ( 'nobi_category_detail', [
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
                        $action = 'Created category id :' . $child_id;
                        $result = '1';
                        MyController::actionSavelog ( $action, $result );
                    }else {
                        $action = 'Created category id :' . $child_id;
                        $result = '0';
                        MyController::actionSavelog ( $action, $result );
                    }
                }	
            }
        
            return $this->redirect ( '@web/admin/category' );
            // return $this->redirect ( [
            //     'view',
            //     'id' => $model->id 
            // ] );
        }
// 	return $this->render ( 'create', [
        return $this->render ( 'category_c', [ 
            'model' => $model ,
            'theForm' => $theForm,
            'theParent' => $the_category,
        ] );
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * 
     * @param integer $id        	
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel ( $id );
        
        $theForm = new CategoryForm();
        $theForm->scenario = 'create';
        
        if(!empty(Yii::$app->request->post('Category'))){        	
            $post= Yii::$app->request->post('Category');
            
            $model->name = $post['name'];
            $model->position = $post['position'];
            $parent_id = $post['parentId'];
            
            if($model->save()){				
                if(empty($parent_id)){					
                    $model->makeRoot();
                }else { //change root
                    $parent = Category::findOne($parent_id);
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
        $theCategory = Category::find()
                        ->where(['id' => $id])						
                        ->with ( [
                            'category_detail' => function ($query) {
                                $query->andWhere ( [
                                        'lang_id' => '1'
                                ] );
                            },				
                        ] )
                        ->limit(1)
                        ->one ();										
        if (! $theCategory || $theCategory['status'] === 0) {
            throw new HttpException ( 404, 'Category not found' );
        }
        
        $theForm = new CategoryForm();
        $theForm->scenario = 'create';
        $theForm->setAttributes ( $theCategory->getAttributes (), false );
        
        $theForm->name = $theCategory['category_detail']['name'];
        $theForm->description = $theCategory['category_detail']['description'];
        $theForm->content = $theCategory['category_detail']['content'];			
        $theForm->seo_title = $theCategory ['category_detail']['seo_title'];
        $theForm->seo_description = $theCategory ['category_detail']['seo_description'];

        if ($theForm->load( Yii::$app->request->post ()) && $theForm->validate () && !empty(Yii::$app->request->post('Category')) ) {
            
            $theCategory->updated_at = NOW;
            $theCategory->updated_by = USER_ID;
            $theCategory->status = 1;			
            
            $post= Yii::$app->request->post('Category');
            $parent_id = $post['parentId'];
            
            if($parent_id != $theCategory['parentId']){
                if($theCategory->save()){
                    if(empty($parent_id)){
                        $theCategory->makeRoot();
                    }else { //change root
                        $parent = Category::findOne($parent_id);
                        $theCategory->appendTo($parent);
                    }					
                }
            }
            $id = $theCategory->id;
            
            if ($id != '') {
                $r2 = Yii::$app->db->createCommand ()->update ( 'nobi_category_detail', [
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
                    $action = 'Update category id :' . $id;
                    $result = '1';
                    MyController::actionSavelog ( $action, $result );
                }
            }else {
                $action = 'Update category id :' . $id;
                $result = '0';
                MyController::actionSavelog ( $action, $result );
             }
            
             return $this->redirect(['index']);
        }
        
        return $this->render ( 'category_u', [
                'model' => $theCategory,
                'theForm' => $theForm,
// 				'theParent' => $the_category,
        ] );
    }
    
    /**
     * Deletes an existing Category model.
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
            $action = 'Delete category id :' . $id;
            $result = '1';
            MyController::actionSavelog ( $action, $result );
        } else {
            $action = 'Delete category :' . $id;
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
            $action = 'Delete category id :' . $id;
            $result = '1';
            MyController::actionSavelog ( $action, $result );
        } else {
            $action = 'Delete category :' . $id;
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
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * 
     * @param integer $id        	
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Category::findOne ( $id )) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException ( 'The requested page does not exist.' );
        }
    }
}
