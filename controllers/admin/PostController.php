<?php

namespace app\controllers\admin;

use Yii;
use app\models\admin\PostModel;
use app\models\admin\PostdetailsModel;
use app\models\admin\PostForm;
use app\models\admin\CategorydetailsModel;
use app\models\admin\Category;
use yii\web\HttpException;
use yii\data\Pagination;
use yii\web\UploadedFile;

class PostController extends MyController {
    public function actionIndex() {
        $query = PostModel::find ()->where ( [ 
                'status' => '1' 
        ] );
        
        $getName = Yii::$app->request->get ('g_name', '' );
        
        if($getName != ''){
            $query->innerJoinwith('post_detail')->andWhere('name like :name',[':name'=> '%'.$getName.'%']);
        }
        
        $countQuery = clone $query;
        $pages = new Pagination ( [ 
                'totalCount' => $countQuery->count (),
                'pageSize' => 10 
        ] );
        
        $the_post = $query
            ->orderBy ( 'nobi_post.id' )
            ->offset ( $pages->offset )
            ->limit ( $pages->limit )
            ->with ( [ 
                'post_detail' => function ($query) {
                    $query->andWhere ( [ 
                            'lang_id' => '1' 
                    ]);
                    
                },	
                
                'category_detail' => function ($query) {
                    $query->andWhere ( [ 
                            'lang_id' => '1' 
                    ] );
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

        return $this->render ( 'index', [ 
                'the_post' => $the_post,
                'pages' => $pages ,
                'name' => $getName
        ] );
    }
    public function actionC() {
        $thePost = new PostModel ();
        $theCategoryHas =Category::find ()
            ->select('id, depth')
            ->where (['status' => '1'])
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
            	
        $thePostForm = new PostForm ();
        $thePostForm->scenario = 'create';
        
        if ($thePostForm->load ( Yii::$app->request->post () ) && $thePostForm->validate ()) {
            
            $thePost->created_at = NOW;
            $thePost->created_by = USER_ID;
            $thePost->updated_at = NOW;
            $thePost->updated_by = USER_ID;
            $thePost->status = 1;
            $thePost->cate_id = $thePostForm->cate_id;
// 			$thePost->avatar = $thePostForm->avatar;
            
            $thePostForm->avatar = UploadedFile::getInstance($thePostForm, 'avatar');
            if ($thePostForm->upload()) {
                $thePost->avatar = 'upload/post/'.$thePostForm->avatar->name; 
            }
            
            $result = $thePost->save ( false );
            
            if ($result) {
                $id = $thePost->id;
                
                if ($id != '') {
                    $r2 = Yii::$app->db->createCommand ()->insert ( 'nobi_post_detail', [ 
                            'post_id' => $id,
                            'name' => $thePostForm->name,
                            'description' => $thePostForm->description,
                            'content' => $thePostForm->content,
                            'tags' => $thePostForm->tag,
                            'slug' => str_replace(' ','-',$thePostForm->name),
                            'seo_title' =>  $thePostForm->seo_title,
                            'seo_description' =>  $thePostForm->seo_description
                    ] )->execute ();
                    
                    if ($r2) {
                        $action = 'Created post id :' . $id;
                        $result = '1';
                        MyController::actionSavelog ( $action, $result );
                    }
                }
            } else {
                $action = 'Created post id :' . $id;
                $result = '0';
                MyController::actionSavelog ( $action, $result );
            }
            
            return $this->redirect ( '@web/admin/post' );
        }
        
        return $this->render ( 'post_c', [ 
                'thePost' => $thePost,
                'theCategoryHas' => $theCategoryHas,
                'thePostForm' => $thePostForm 
        ] );
    }
    
    public function actionU($id = '') {
        $thePost = PostModel::find ()->where ( [ 
                'id' => $id 
        ] )->with ( [ 
                'post_detail' => function ($query) {
                    $query->andWhere ( [ 
                            'lang_id' => '1' 
                    ] );
                },
                'category_detail' => function ($query) {
                    $query->andWhere ( [ 
                            'lang_id' => '1' 
                    ] );
                } 
        ] )->one ();
        
        if (! $thePost || $thePost ['status'] === 0) {
            throw new HttpException ( 404, 'Category not found' );
        }
        
        $theCategoryHas = Category::find ()
            ->select('id, depth')
            ->where (['status' => '1'])
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
            
        $thePostForm = new PostForm ();
        $thePostForm->scenario = 'create';
        $thePostForm->setAttributes ( $thePost->getAttributes (), false );
        
        
        $thePostForm->name = $thePost ['post_detail']['name'];
        $thePostForm->description = $thePost ['post_detail']['description'];
        $thePostForm->content = $thePost ['post_detail']['content'];
        $thePostForm->tag = $thePost ['post_detail']['tags'];
        $thePostForm->seo_title = $thePost ['post_detail']['seo_title'];
        $thePostForm->seo_description = $thePost ['post_detail']['seo_description'];
        
        if ($thePostForm->load ( Yii::$app->request->post () ) && $thePostForm->validate ()) {
            
            $thePost->updated_at = NOW;
            $thePost->updated_by = USER_ID;
            $thePost->status = 1;
            $thePost->cate_id = $thePostForm->cate_id;
            $thePost->avatar = $thePostForm->avatar;
            
            $result = $thePost->save ( false );
            
            if ($result) {
                $id = $thePost->id;
                
                if ($id != '') {
                    $r2 = Yii::$app->db->createCommand ()->update ( 'nobi_post_detail', [ 
                            'name' => $thePostForm->name,
                            'description' => $thePostForm->description,
                            'content' => $thePostForm->content,
                            'tags' => $thePostForm->tag,
                            'slug' => str_replace(' ','-',$thePostForm->name),
                            'seo_title' =>  $thePostForm->seo_title,
                            'seo_description' =>  $thePostForm->seo_description
                    ], 'post_id =:p_id', array (
                            ':p_id' => $id 
                    ) )->execute ();
                    
                    if ($r2) {
                        $action = 'Update post id :' . $id;
                        $result = '1';
                        MyController::actionSavelog ( $action, $result );
                    }
                }
            } else {
                $action = 'Update post id :' . $id;
                $result = '0';
                MyController::actionSavelog ( $action, $result );
            }
            
            return $this->redirect ( '@web/admin/post' );
        }
        
        return $this->render ( 'post_u', [ 
                'thePost' => $thePost,
                'theCategoryHas' => $theCategoryHas,
                'thePostForm' => $thePostForm 
        ] );
    }
    
    public function actionD($id = '') {
        $Post = PostModel::find ()->where ( [ 
                'id' => $id 
        ] )->one ();
        
        if (! $Post || $Post ['status'] === 0) {
            throw new HttpException ( 404, 'Post not found' );
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