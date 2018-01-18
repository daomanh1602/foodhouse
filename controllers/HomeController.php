<?php

namespace app\controllers;

use Yii;
use app\models\admin\Category;
use app\models\admin\PostModel;
use app\models\admin\PostdetailsModel;
use yii\web\HttpException;
use yii\data\Pagination;
/**
 * MenuController implements the CRUD actions for Menu model.
 */
class HomeController extends MyfrontController {
    
    public function actionIndex() {

        $query_category = Category::find ()->select('id, lft')->where (['status' => '1'])->andWhere('depth > 0');

        $countQuery_category = clone $query_category;
        $pages = new Pagination ( [
                'totalCount' => $countQuery_category->count (),
                'pageSize' => 10
        ] );
        
        $the_category = $query_category
        ->orderBy ( 'nobi_category.lft' )
        ->offset ( $pages->offset )
        ->limit ( $pages->limit )
        ->with ( [
                    'category_detail' => function ($query) {
                        $query->andWhere ( [
                                'lang_id' => '1'
                        ]);			
                    },                  
                ] )
        ->asArray()
        ->all (); 	
        //select post 
        $query_post = PostModel::find()->where ( [ 
            'status' => '1' 
        ] );

        $countQuery_post = clone $query_post;
        $pages = new Pagination ( [ 
                'totalCount' => $countQuery_post->count (),
                'pageSize' => 10 
        ] );
        
        $the_post = $query_post
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

        return $this->render ('index', [
               'the_category' => $the_category,
               'the_post' => $the_post,
        ] );
    }
}
