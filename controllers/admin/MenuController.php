<?php

namespace app\controllers\admin;

use Yii;
use app\models\admin\Menu;
use app\models\admin\MenuForm;
use app\models\admin\MenuSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;	

/**
 * MenuController implements the CRUD actions for Menu model.
 */
class MenuController extends MyController {
    /**
     * @inheritdoc
     */
    // public function behaviors() {
    //     return [ 
    //         'verbs' => [ 
    //             'class' => VerbFilter::className (),
    //             'actions' => [ 
    //                 'delete' => [ 
    //                     'POST' 
    //                 ] 
    //             ] 
    //         ] 
    //     ];
    // }
    
    /**
     * Lists all Menu models.
     * 
     * @return mixed
     */
    public function actionIndex() {
        $query = Menu::find ()
                ->where (['status' => '1'])
                ->andWhere('depth > 0');
        
        $getName = Yii::$app->request->get ('g_name', '' );
        if($getName != ''){
            $query->innerJoinwith('menu_detail')->andWhere('nobi_menu_detail.name like :name',[':name'=> '%'.$getName.'%']);
        }
        
        $countQuery = clone $query;
        $pages = new Pagination ( [
                'totalCount' => $countQuery->count (),
                'pageSize' => 10
        ] );
        
        $the_Menu = $query
        ->orderBy ( 'nobi_menu.lft' )
        ->offset ( $pages->offset )
        ->limit ( $pages->limit )
        ->with ( [
                    'menu_detail' => function ($query) {
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
                'theMenu'=> $the_Menu,
                'pages' => $pages ,
        ] );
    }
    
    /**
     * Displays a single Menu model.
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
     * Creates a new Menu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * 
     * @return mixed
     */
    public function actionC() {
       
        $model = new Menu ();
        
        $theForm = new MenuForm();
        $theForm->scenario = 'create';
        
        $query = Menu::find ()
        ->select('id, depth')
        ->where (['status' => '1']);	
        
        $the_Menu = $query
            ->orderBy ( 'nobi_menu.lft' )			
            ->with ( [
                'menu_detail' => function ($query) {
                    $query->andWhere ( [
                            'lang_id' => '1'
                    ]);
                }
                
            ] )
            ->asArray()
            ->all (); 
                
        if ($theForm->load(Yii::$app->request->post()) && $theForm->validate() && !empty(Yii::$app->request->post('Menu'))) {
            
            $post= Yii::$app->request->post('Menu');
            
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
                
                $parent = Menu::findOne ( $parent_id );
                
                $a = $model->appendTo ($parent);

                $child_id = $model->id;            
                
                if ($child_id != '') {
                    $r2 = Yii::$app->db->createCommand ()->insert ( 'nobi_menu_detail', [
                            'cate_id' => $child_id,
                            'name' => $theForm->name,
                            'lang_id' => '1',                           
                            'slug' => str_replace(' ','-',$theForm->name),
                            'url' => $theForm->url,
                        ] )->execute ();
                        
                    if ($r2) {
                        $action = 'Created Menu id :' . $child_id;
                        $result = '1';
                        MyController::actionSavelog ( $action, $result );
                    }else {
                        $action = 'Created Menu id :' . $child_id;
                        $result = '0';
                        MyController::actionSavelog ( $action, $result );
                    }
                }	
            }
        
            $this->genderfile();
            return $this->redirect(['index']);
        }

        return $this->render ( 'menu_c', [ 
            'model' => $model ,
            'theForm' => $theForm,
            'theParent' => $the_Menu,
        ] );
    }
    
    public function actionU($id = '') {
        $theMenu = Menu::find()
                        ->where(['id' => $id])						
                        ->with ( [
                            'menu_detail' => function ($query) {
                                $query->andWhere ( [
                                        'lang_id' => '1'
                                ] );
                            },				
                        ] )
                        ->limit(1)
                        ->one ();										
        if (! $theMenu || $theMenu['status'] === 0) {
            throw new HttpException ( 404, 'Menu not found' );
        }
        
        $theForm = new MenuForm();
        $theForm->scenario = 'create';
        $theForm->setAttributes ( $theMenu->getAttributes (), false );
        
        $theForm->name = $theMenu['menu_detail']['name'];
        $theForm->description = $theMenu['menu_detail']['description'];
        $theForm->content = $theMenu['menu_detail']['content'];			
        $theForm->seo_title = $theMenu ['menu_detail']['seo_title'];
        $theForm->seo_description = $theMenu ['menu_detail']['seo_description'];

        if ($theForm->load( Yii::$app->request->post ()) && $theForm->validate () && !empty(Yii::$app->request->post('Menu')) ) {
            
            $theMenu->updated_at = NOW;
            $theMenu->updated_by = USER_ID;
            $theMenu->status = 1;			
            
            $post= Yii::$app->request->post('Menu');
            $parent_id = $post['parentId'];
            
            if($parent_id != $theMenu['parentId']){
                if($theMenu->save()){
                    if(empty($parent_id)){
                        $theMenu->makeRoot();
                    }else { //change root
                        $parent = Menu::findOne($parent_id);
                        $theMenu->appendTo($parent);
                    }					
                }
            }
            $id = $theMenu->id;
            
            if ($id != '') {
                $r2 = Yii::$app->db->createCommand ()->update ( 'nobi_menu_detail', [
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
                    $action = 'Update Menu id :' . $id;
                    $result = '1';
                    MyController::actionSavelog ( $action, $result );
                }
            }else {
                $action = 'Update Menu id :' . $id;
                $result = '0';
                MyController::actionSavelog ( $action, $result );
             }
            $this->genderfile();
            return $this->redirect(['index']);
        }
        
        return $this->render ( 'Menu_u', [
                'model' => $theMenu,
                'theForm' => $theForm,
// 				'theParent' => $the_Menu,
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
            $action = 'Delete Menu id :' . $id;
            $result = '1';
            MyController::actionSavelog ( $action, $result );
        } else {
            $action = 'Delete Menu :' . $id;
            $result = '0';
            MyController::actionSavelog ( $action, $result );
        }
        $this->genderfile();
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
        $this->genderfile();
        return $this->redirect(['index']);
        
    }

    public function actionMovedown($id){

        $model = $this->findModel($id);
        $a = $model->next()->one();
        if(isset($a)){
            $model->insertAfter($a);
        }        
        $this->genderfile();
        return $this->redirect(['index']);
        
    }    

    /**
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * 
     * @param integer $id        	
     * @return Menu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Menu::findOne ( $id )) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException ( 'The requested page does not exist.' );
        }
    }

      private function Genderfile(){
        $query = Menu::find ()    
            ->select(['id'])            
            ->where (['status' => '1'])
            ->andWhere('depth > 0')               
            ->with ( [
                'menu_detail' => function ($query) {
                    $query->andWhere ( [
                        'lang_id' => '1'
                    ]);			
                }                    
            ] )	
            ->orderBy ( 'nobi_menu.lft' )
            ->asArray()            
            ->all (); 	

        $myfile = fopen("menu.php", "w") or die("Unable to open file!");
        $txt = "";
        
                                
                            
        foreach($query as $k => $v){
            $txt .= '<li class="active">';
            $txt .= '   <a href="'.$v['menu_detail']['url'].'">'.$v['menu_detail']['name'].'</a>';
            $txt .= '</li>';
        }

        fwrite($myfile, $txt);
        fclose($myfile);
    }

}
