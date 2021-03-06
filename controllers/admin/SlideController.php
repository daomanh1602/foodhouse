<?php

namespace app\controllers\admin;

use Yii;
use app\models\admin\Slide;
use app\models\admin\TypeslideModel;
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
     * Lists all Slide models.
     * 
     * @return mixed
     */
    public function actionIndex($action = '' ) {
        $query = Slide::find ()
                ->where (['status' => '1'])
                ->andWhere('depth > 0');

        
        $getName = Yii::$app->request->get('g_name', '' );
        if($getName != ''){
            $query->innerJoinwith('slide_detail')->andWhere('nobi_slide_detail.name like :name',[':name'=> '%'.$getName.'%']);
        }
        
        $getType = Yii::$app->request->get('type_s', '' );
        if($getType != ''){
            $query->innerJoinwith('slide_type')->andWhere('nobi_type_slide.id = :id',[':id'=> $getType]);           
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
        ->with ([
                    'slide_detail' => function ($query) {
                        $query->andWhere ( [
                                'lang_id' => '1'
                        ]);			
                    },
                    
                    'slide_type'=>function ($query) {
                        $query->select ( [
                                'id',
                                'name_1'
                        ] );	
                    },

                    'user_created' => function ($query) {
                        $query->select ( [
                                'id',
                                'username'
                        ] );
                    }
                ])
        ->asArray()
        ->all (); 	

        $type_slide = TypeslideModel::find()->select(['id','name_1 as name'])->asArray()->all();

        if($action == 'update_use'){
            $list_id = $_POST['list_id'];
            $id_s = explode(",",$list_id);
            foreach($id_s as $id){
                $sql = 'UPDATE nobi_slide SET use_slide = "0" WHERE id =:id  ';
                Yii::$app->db->createCommand($sql, [':id'=>$id])->execute();  
            }                   
            $id_check = rtrim($_POST['id_check'], ',');
            $id_s = explode(",",$id_check);
            foreach($id_s as $id){
                $sql = 'UPDATE nobi_slide SET nobi_slide.use_slide = "1" WHERE id =:id  ';
                Yii::$app->db->createCommand($sql, [':id'=>$id])->execute();  
            }                   

            $this->genderfile();

        }

        return $this->render ( 'index_2', [
                'name' => $getName,
                'theSlide'=> $the_Slide,
                'pages' => $pages ,
                'type_slide' => $type_slide
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

        $type_slide = TypeslideModel::find()->select(['id','name_1 as name'])->asArray()->all();

        if ($theForm->load(Yii::$app->request->post()) && $theForm->validate() && Yii::$app->request->isPost) {
            
            $post= Yii::$app->request->post();
            
            $model->position = '0';
            $model->created_by = USER_ID;
            $model->updated_by = USER_ID;
            $model->created_at = NOW;
            $model->updated_at = NOW;
            $model->status = '1';
            $model->name = 'null';
            $model->type_slide = $theForm->type;
            $model->use_slide = $theForm->use;
            $theForm->avatar = UploadedFile::getInstance($theForm, 'avatar');
            // var_Dump($model);exit();
            if ($theForm->upload()) {
                $model->avatar = 'upload/slide/'.$theForm->avatar->name;
            }else{
                exit();
            }
  
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
            $this->genderfile();
            return $this->redirect ( '@web/admin/slide' );
        }
        
        return $this->render ( 'slide_c', [ 
            'model' => $model ,
            'theForm' => $theForm,
            'theParent' => $the_Slide,
            'type_slide' => $type_slide
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
        $theForm->scenario = 'create_slide';
        $theForm->setAttributes ( $theSlide->getAttributes (), false );
        
        $theForm->name = $theSlide['slide_detail']['name'];
        $theForm->description = $theSlide['slide_detail']['description'];
        $theForm->content = $theSlide['slide_detail']['content'];			
        $theForm->seo_title = $theSlide ['slide_detail']['seo_title'];
        $theForm->seo_description = $theSlide ['slide_detail']['seo_description'];
        $theForm->type = $theSlide['type_slide'];
        $theForm->use = $theSlide ['use_slide'];
        $theForm->avatar = Yii::$app->urlManager->baseUrl .'/'.$theSlide ['avatar'];

        $type_slide = TypeslideModel::find()->select(['id','name_1 as name'])->asArray()->all();

        if ($theForm->load(Yii::$app->request->post()) && $theForm->validate() && Yii::$app->request->isPost) {

            // var_dump($theForm->type);exit();

            $theSlide->position = '0';
            $theSlide->updated_by = USER_ID;
            $theSlide->updated_at = NOW;
            $theSlide->status = '1';
            $theSlide->name = 'null';
            $theSlide->type_slide = $theForm->type;
            $theSlide->use_slide = $theForm->use;
            $theForm->avatar = UploadedFile::getInstance($theForm, 'avatar');

            if($theForm->avatar!= null){
                if ($theForm->upload()) {
                    $theSlide->avatar = 'upload/slide/'.$theForm->avatar->name;
                }else{
                    exit();
                }
            }
            
            $parent_id = '1';
            
            if($parent_id != $theSlide['parentId']){
                if($theSlide->save()){
                    if(empty($parent_id)){
                        $theSlide->makeRoot();
                    }else { //change root
                        $parent = Slide::findOne($parent_id);
                        $theSlide->appendTo($parent);
                    }					
                }
            }else{
                $theSlide->save();
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
            $this->genderfile();
            return $this->redirect(['index']);
        }
        
        return $this->render ( 'Slide_u', [
                'model' => $theSlide,
                'theForm' => $theForm,
				'type_slide' => $type_slide,
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

    private function Genderfile(){
        $query = Slide::find ()
            ->select('id, avatar')
            ->where (['status' => '1'])
            ->andWhere('depth > 0')
            ->andWhere('use_slide = 1')
            ->orderBy ( 'nobi_slide.lft' )
            ->asArray()
            ->all (); 	

        $myfile = fopen("slide.php", "w") or die("Unable to open file!");
        $txt = "";
        
        foreach($query as $k => $v){
            $txt .= '<div class="mySlides">';
            $txt .= '   <img src="'.$v['avatar'].'" alt="banner" class="img-responsive"> ';
            $txt .= '   <div class="caption"> ';
            $txt .= '       <div class="caption-wrapper">' ;
            $txt .= '           <div class="caption-info"> ' ;
            $txt .= '               <i class="fa fa-coffee fa-5x animated bounceInDown"></i> ';
            $txt .= '               <h1 class="animated bounceInUp">Best place for delicious pizza and coffee</h1>';
            $txt .= '               <p class="animated bounceInLeft">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>';
            $txt .= '               <a href="#menu" class="explore animated bounceInDown">';
            $txt .= '                   <i class="fa fa-angle-down  fa-3x"></i>';
            $txt .= '               </a>';
            $txt .= '           </div>';
            $txt .= '       </div>';
            $txt .= '   </div>';
            $txt .= '</div>';
        }

        fwrite($myfile, $txt);
        fclose($myfile);

        // if (!empty($_SERVER["HTTP_CLIENT_IP"]))
        // {
        // //check for ip from share internet
        //     $ip = $_SERVER["HTTP_CLIENT_IP"];
        // }
        // elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
        // {
        // // Check for the Proxy User
        //     $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        // }
        // else
        // {
        //     $ip = $_SERVER["REMOTE_ADDR"];
        // }

        // return $this->render('view_file', [
        //         'ip' => $ip,
        // ]);    
        // var_dump($query);exit();    
    }

}
