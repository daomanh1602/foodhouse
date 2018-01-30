<?php
Yii::$app->params['page_title'] = Yii::$app->params['page_title'] == '' ? $this->title : Yii::$app->params['page_title'];
Yii::$app->params['page_small_title'] = Yii::$app->params['page_small_title'] == '' ? '': Yii::$app->params['page_small_title'];
Yii::$app->params['page_meta_title'] = Yii::$app->params['page_meta_title'] == '' ? Yii::$app->params['page_title'] : Yii::$app->params['page_meta_title'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Coffee and Pizza</title>

    <!-- Google fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Josefin+Sans:600' rel='stylesheet' type='text/css'>

    <!-- font awesome -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- bootstrap -->
    <link rel="stylesheet" href="/assets/front_end/bootstrap/css/bootstrap.min.css" />

    <!-- animate.css -->
    <link rel="stylesheet" href="/assets/front_end/animate/animate.css" />
    <link rel="stylesheet" href="/assets/front_end/animate/set.css" />

    <!-- gallery -->
    <link rel="stylesheet" href="/assets/front_end/gallery/blueimp-gallery.min.css">

    <!-- favicon -->
    <link rel="shortcut icon" href="/assets/front_end/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/assets/front_end/images/favicon.ico" type="image/x-icon">


    <link rel="stylesheet" href="/assets/front_end/style.css">
    <link rel="stylesheet" href="/assets/front_end/slide.css">

    <style>
        .mySlides {display:none}
        .w3-left, .w3-right, .w3-badge {cursor:pointer}
        .w3-badge {height:13px;width:13px;padding:0}
    </style>

</head>

<body>
    <div class="topbar animated fadeInLeftBig"></div>

    <!-- Header Starts -->
    <div class="navbar-wrapper">
        <div class="container">

            <div class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="top-nav">
                <div class="container">
                    <div class="navbar-header">
                        <!-- Logo Starts -->
                        <a class="navbar-brand" href="#home">
                            <img src="/assets/front_end/images/logo.png" alt="logo">
                        </a>
                        <!-- #Logo Ends -->


                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                    </div>


                    <!-- Nav Starts -->
                    <div class="navbar-collapse  collapse">
                        <ul class="nav navbar-nav navbar-right scroll">
                            <!--<li class="active">
                                <a href="#home">Home</a>
                            </li>
                            <li>
                                <a href="#menu">Menu</a>
                            </li>
                            <li>
                                <a href="#foods">Foods</a>
                            </li>
                            <li>
                                <a href="#partners">Partners</a>
                            </li>
                            <li>
                                <a href="#contact">Contact</a>
                            </li>-->
                            <?php include('menu.php'); ?>
                        </ul>
                    </div>
                    <!-- #Nav Ends -->

                </div>
            </div>

        </div>
    </div>
    <!-- #Header Starts -->
    
        <?php echo $content;?>  

    <!-- Footer Starts -->
    <div class="footer text-center spacer">
        <p class="wowload flipInX">
            <a href="#">
                <i class="fa fa-facebook fa-2x"></i>
            </a>
            <a href="#">
                <i class="fa fa-instagram fa-2x"></i>
            </a>
            <a href="#">
                <i class="fa fa-twitter fa-2x"></i>
            </a>
            <a href="#">
                <i class="fa fa-flickr fa-2x"></i>
            </a>
        </p>
        Copyright 2014 Cyrus Creative Studio. All rights reserved.
    </div>
    <!-- # Footer Ends -->
    <a href="#home" class="gototop ">
        <i class="fa fa-angle-up  fa-3x"></i>
    </a>

    <!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
    <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
        <!-- The container for the modal slides -->
        <div class="slides"></div>
        <!-- Controls for the borderless lightbox -->
        <h3 class="title">Title</h3>
        <a class="prev">‹</a>
        <a class="next">›</a>
        <a class="close">×</a>
        <!-- The modal dialog, which will be used to wrap the lightbox content -->
    </div>

    <!-- jquery -->
    <script src="/assets/front_end/jquery.js"></script>

    <!-- wow script -->
    <script src="/assets/front_end/wow/wow.min.js"></script>

    <!-- boostrap -->
    <script src="/assets/front_end/bootstrap/js/bootstrap.js" type="text/javascript"></script>

    <!-- jquery mobile -->
    <script src="/assets/front_end/mobile/touchSwipe.min.js"></script>
    <script src="/assets/front_end/respond/respond.js"></script>

    <!-- gallery -->
    <script src="/assets/front_end/gallery/jquery.blueimp-gallery.min.js"></script>

    <script src='https://maps.googleapis.com/maps/api/js?key=&sensor=false&extension=.js'></script>

    <!-- custom script -->
    <script src="/assets/front_end/script.js"></script>

    <script>

        var myIndex = 0;
        var x = document.getElementsByClassName("mySlides");
       
        carousel();
        showDivs(myIndex);

        function plusDivs(n) {
            showDivs(myIndex += n);
        }

        function currentDiv(n) {
            showDivs(myIndex = n);
        }

        function showDivs(n) {
            var i;
            
            if (n > x.length) {
                myIndex = 1
            }    
            if (n < 1) {
                myIndex = x.length
            }
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";  
            }
            x[myIndex-1].style.display = "block";  
          
            setTimeout(2500);
        }
        
        function carousel() {
            var i;

            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";  
            }
            myIndex++;
            if (myIndex > x.length) {
                myIndex = 1
            }    
           
            x[myIndex-1].style.display = "block";  
            
            setTimeout(carousel, 2500); // Change image every 2 seconds
        }
    </script>

</body>

</html>
