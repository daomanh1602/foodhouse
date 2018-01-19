<?php 
Yii::$app->params['page_title'] = Yii::$app->params['page_title'] == '' ? $this->title : Yii::$app->params['page_title'];
Yii::$app->params['page_small_title'] = Yii::$app->params['page_small_title'] == '' ? '': Yii::$app->params['page_small_title'];
Yii::$app->params['page_meta_title'] = Yii::$app->params['page_meta_title'] == '' ? Yii::$app->params['page_title'] : Yii::$app->params['page_meta_title'];
// use yii\helpers\Html;
app\assets\MainAsset::register($this);

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
// use app\assets\AppAsset;

// AppAsset::register($this);

$this->beginPage();
?>
<!--
Author: Nbita
Author URL: bienngoc.com
License: bienngoc
License URL: bienngoc.com
-->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= Yii::$app->params['page_title'] ?> | Admin</title>
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

        <link href="/admin_layout/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
        <!-- Custom Theme files -->
        <link href="/admin_layout/css/style.css" rel='stylesheet' type='text/css' />
        <link href="/admin_layout/css/font-awesome.css" rel="stylesheet">
        <script src="/admin_layout/js/jquery.min.js"> </script>
        <script src="/admin_layout/js/bootstrap.min.js"> </script>

        <!-- Mainly scripts -->
        <script src="/admin_layout/js/jquery.metisMenu.js"></script>
        <script src="/admin_layout/js/jquery.slimscroll.min.js"></script>
        <!-- Custom and plugin javascript -->
        <link href="/admin_layout/css/custom.css" rel="stylesheet">
        <script src="/admin_layout/js/custom.js"></script>
        <script src="/admin_layout/js/screenfull.js"></script>


        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <?php $this->head() ?>
    </head>
    
    <body>
        <?php $this->beginBody() ?>
            <div id="wrapper">

        <nav class="navbar-default navbar-static-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span> <span
                        class="icon-bar"></span> <span class="icon-bar"></span> <span
                        class="icon-bar"></span>
                </button>
                <h1>
                    <a class="navbar-brand" href="index.html">Minimal</a>
                </h1>
            </div>
            <div class=" border-bottom">
                <div class="full-left">
                    <section class="full-top">
                        <button id="toggle">
                            <i class="fa fa-arrows-alt"></i>
                        </button>
                    </section>
                    <form class=" navbar-left-right">
                        <input type="text" value="Search..." onfocus="this.value = '';"
                            onblur="if (this.value == '') {this.value = 'Search...';}"> <input
                            type="submit" value="" class="fa fa-search">
                    </form>
                    <div class="clearfix"></div>
                </div>
                
                <div class="drop-men">
                    <ul class=" nav_1">

                        <li class="dropdown at-drop"><a href="#"
                            class="dropdown-toggle dropdown-at " data-toggle="dropdown"><i
                                class="fa fa-globe"></i> <span class="number">5</span></a>
                            <ul class="dropdown-menu menu1 " role="menu">
                                <li><a href="#">

                                        <div class="user-new">
                                            <p>New user registered</p>
                                            <span>40 seconds ago</span>
                                        </div>
                                        <div class="user-new-left">

                                            <i class="fa fa-user-plus"></i>
                                        </div>
                                        <div class="clearfix"></div>
                                </a></li>
                                <li><a href="#">
                                        <div class="user-new">
                                            <p>Someone special liked this</p>
                                            <span>3 minutes ago</span>
                                        </div>
                                        <div class="user-new-left">

                                            <i class="fa fa-heart"></i>
                                        </div>
                                        <div class="clearfix"></div>
                                </a></li>
                                <li><a href="#">
                                        <div class="user-new">
                                            <p>John cancelled the event</p>
                                            <span>4 hours ago</span>
                                        </div>
                                        <div class="user-new-left">

                                            <i class="fa fa-times"></i>
                                        </div>
                                        <div class="clearfix"></div>
                                </a></li>
                                <li><a href="#">
                                        <div class="user-new">
                                            <p>The server is status is stable</p>
                                            <span>yesterday at 08:30am</span>
                                        </div>
                                        <div class="user-new-left">

                                            <i class="fa fa-info"></i>
                                        </div>
                                        <div class="clearfix"></div>
                                </a></li>
                                <li><a href="#">
                                        <div class="user-new">
                                            <p>New comments waiting approval</p>
                                            <span>Last Week</span>
                                        </div>
                                        <div class="user-new-left">

                                            <i class="fa fa-rss"></i>
                                        </div>
                                        <div class="clearfix"></div>
                                </a></li>
                                <li><a href="#" class="view">View all messages</a></li>
                            </ul></li>
                        <li class="dropdown"><a href="#"
                            class="dropdown-toggle dropdown-at" data-toggle="dropdown"><span
                                class=" name-caret"><?= Yii::$app->user->identity->username?><i class="caret"></i></span><img
                                src="images/wo.jpg"></a>
                            <ul class="dropdown-menu " role="menu">
                                <li><a href="profile.html"><i class="fa fa-user"></i>Edit
                                        Profile</a></li>
                                <li><a href="inbox.html"><i class="fa fa-envelope"></i>Inbox</a></li>
                                <li><a href="calendar.html"><i class="fa fa-calendar"></i>Calender</a></li>
                                <li><a href="inbox.html"><i class="fa fa-clipboard"></i>Tasks</a></li>
                            </ul></li>              
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
                <div class="clearfix"></div>
<!-- MENU -->
                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">

                            <p style="text-align: center;" class="hide">
                                <a style="display: inline" class="btn-vi" href="/select/lang/vi"><img alt="vietnamese" src="/admin_layout/images/icon/icon_vn.svg" style="width: 30px; height: 50px"></a> | <a href="/select/lang/en" class="btn-en" style="display: inline"><img alt="english" src="/admin_layout/images/icon/icon_en.svg" style="width: 25px; height: 50px"></a>
                            </p>
                            
                            <li>
                                <a href="index.html" class=" hvr-bounce-to-right">
                                    <i class="fa fa-dashboard nav_icon "></i><span class="nav-label">Dashboards</span>
                                </a>
                            </li>
<!-- item menu -->
                            <li>
                                <a href="#" class=" hvr-bounce-to-right">
                                    <i class="fa fa-indent nav_icon"></i> 
                                    <span class="nav-label">Danh Muc</span>
                                    <span class="fa arrow"></span>
                                </a>
                                
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="/admin/category" class=" hvr-bounce-to-right"> 
                                            <i class="fa fa-area-chart nav_icon"></i> - Danh sách danh mục
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/admin/category/c" class=" hvr-bounce-to-right">
                                            <i class="fa fa-map-marker nav_icon"></i> - Thêm danh mục 
                                        </a>
                                    </li>									
                                </ul>
                            </li>													
<!-- END ITEM MENU -->
                            <li>
                                <a href="#" class=" hvr-bounce-to-right">
                                    <i class="fa fa-indent nav_icon"></i> 
                                    <span class="nav-label">Bai viet</span>
                                    <span class="fa arrow"></span>
                                </a>
                                
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="/admin/post" class=" hvr-bounce-to-right"> 
                                            <i class="fa fa-area-chart nav_icon"></i> - Danh sách bài viết
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/admin/post/c" class=" hvr-bounce-to-right">
                                            <i class="fa fa-map-marker nav_icon"></i> - Thêm bài viết
                                        </a>
                                    </li>									
                                </ul>
                            </li>

                            <li>
                                <a href="#" class=" hvr-bounce-to-right">
                                    <i class="fa fa-indent nav_icon"></i> 
                                    <span class="nav-label">Slide</span>
                                    <span class="fa arrow"></span>
                                </a>
                                
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="/admin/slide" class=" hvr-bounce-to-right"> 
                                            <i class="fa fa-area-chart nav_icon"></i> - Danh sách Slide
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/admin/slide/c" class=" hvr-bounce-to-right">
                                            <i class="fa fa-map-marker nav_icon"></i> - Thêm Slide
                                        </a>
                                    </li>									
                                </ul>
                            </li>
                            
                            <li>
                                <a href="#" class=" hvr-bounce-to-right">
                                    <i class="fa fa-indent nav_icon"></i> 
                                    <span class="nav-label">Tai khoan</span>
                                    <span class="fa arrow"></span>
                                </a>
                                
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="/admin/user" class=" hvr-bounce-to-right"> 
                                            <i class="fa fa-area-chart nav_icon"></i>Danh sách tai khoan
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/admin/user/c" class=" hvr-bounce-to-right">
                                            <i class="fa fa-map-marker nav_icon"></i>Tạo tài quản quản lý
                                        </a>
                                    </li>									
                                </ul>
                            </li>
                            
                        </ul>
                    </div>
                </div>
<!-- END MENU		 -->
        </nav>
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="content-main">
               <!--banner-->
              <div class="banner">
                <h2>
                  <a href="index.html">Home</a> <i class="fa fa-angle-right"></i> <span><?= Yii::$app->params['page_title'] ?></span> <i class="fa fa-angle-right"></i> <span><?= Yii::$app->params['page_small_title'] ?></span>
                </h2>
              </div>
              <!--//banner-->
              <!--faq-->
              <!-- main -->
                
              <div class="blank">
                <div class="blank-page">
                  <?php echo $content;?>						
                </div>
              </div>

              <!--//faq-->
              
              <div class="copy">
                <p>
                  &copy; 2016  | Design by <a href="#" target="_blank">Nobi</a>
                </p>
              </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

   
    <!--scrolling js-->
    <script src="/admin_layout/js/jquery.nicescroll.js"></script>
    <script src="/admin_layout/js/scripts.js"></script>
    <!--//scrolling js-->
    
    <!-- Click button change language -->
    <script>
        $('.btn-vi').on('click', function(){
            var lang = "vi";
            $.ajax({
                method: "POST",
                url: <?php echo 'a' ?>/'change_lang',
                data: lang
            })		    		   
            return true;
        });
        $('.btn-en').on('click', function(){
            var lang = "en";
            $.ajax({
                method: "POST",
                url: 'change_lang',
                data: lang
            })		    		   
            return true;
        });
    </script>	

        <?php $this->endBody() ?>
    </body>
    
</html>

<?php $this->endPage() ?>