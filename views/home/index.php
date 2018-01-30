<div id="home">
    <!-- Slider Starts -->
    <div class="banner">
        <!--<div class="mySlides">
            <img src="/assets/front_end/images/back.jpg" alt="banner" class="img-responsive">
            <div class="caption">
                <div class="caption-wrapper">
                    <div class="caption-info">
                        <i class="fa fa-coffee fa-5x animated bounceInDown"></i>
                        <h1 class="animated bounceInUp">Best place for delicious pizza and coffee</h1>
                        <p class="animated bounceInLeft">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                        <a href="#menu" class="explore animated bounceInDown">
                            <i class="fa fa-angle-down  fa-3x"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>-->

        <?php include("slide.php"); ?>
    </div>

    <div class="w3-button w3-display-left w3-black" onclick="plusDivs(-1)" style="font-size:25px">&#10094;</div>
    <div class="w3-button w3-display-right w3-black" onclick="plusDivs(1)"  style="font-size:25px">&#10095;</div>

   
    <!-- #Slider Ends -->
</div>

    <!-- Cirlce Starts -->
<div id="menu" class="container spacer about">
    <h2 class="text-center wowload fadeInUp">Creative photographers of London</h2>
    <div class="row">
        <div class="col-sm-6 wowload fadeInLeft">
            <h4>
                <i class="fa fa-camera-retro"></i> Introduction </h4>
            <p>Creative digital agency for sleek and sophisticated solutions for mobile, websites and software designs,
                lead by passionate and uber progressive team that lives and breathes design. Creative digital agency
                for sleek and sophisticated solutions for mobile, websites and software designs.</p>


            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's
                standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled
                it to make a type specimen book.</p>


        </div>
        <div class="col-sm-6 wowload fadeInRight">

            <h4>
                <i class="fa fa-bars"></i> Menu</h4>

            <!-- menus -->
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <!--     <div class="panel panel-default">
                    <div class="panel-heading" role="tab">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <i class="fa fa-coffee"></i> Tea & Coffee
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel">
                        <div class="panel-body">
                            <div class="clearfix food-list">
                                <div class="pull-left">Tea/Coffee</div>
                                <span class="pull-right">$ 10.00</span>
                            </div>
                            <div class="clearfix food-list">
                                <div class="pull-left">Tea/Coffee</div>
                                <span class="pull-right">$ 10.00</span>
                            </div>
                            <div class="clearfix food-list">
                                <div class="pull-left">Tea/Coffee</div>
                                <span class="pull-right">$ 10.00</span>
                            </div>
                            <div class="clearfix food-list">
                                <div class="pull-left">Tea/Coffee</div>
                                <span class="pull-right">$ 10.00</span>
                            </div>
                        </div>
                    </div>
                </div> -->      
                <?php foreach ($the_category as $cate) { ?> 
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <i class="fa fa-coffee"></i> Tea & Coffee
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel">
                        <div class="panel-body">
                            <div class="clearfix food-list">
                                <div class="pull-left">Tea/Coffee</div>
                                <span class="pull-right">$ 10.00</span>
                            </div>
                            <div class="clearfix food-list">
                                <div class="pull-left">Tea/Coffee</div>
                                <span class="pull-right">$ 10.00</span>
                            </div>
                            <div class="clearfix food-list">
                                <div class="pull-left">Tea/Coffee</div>
                                <span class="pull-right">$ 10.00</span>
                            </div>
                            <div class="clearfix food-list">
                                <div class="pull-left">Tea/Coffee</div>
                                <span class="pull-right">$ 10.00</span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>                
            </div>
            <!-- menus -->



        </div>
    </div>


</div>
    <!-- #Cirlce Ends -->


    <!-- works -->
<div id="foods" class=" clearfix grid">
    <figure class="effect-oscar  wowload fadeInUp">
        <img src="/assets/front_end/images/portfolio/1.jpg" alt="img01" />
        <figcaption>
            <h2>Cappuchino</h2>
            <p>Lily likes to play with crayons and pencils
                <br>
                <a href="/assets/front_end/images/portfolio/1.jpg" title="1" data-gallery>View more</a>
            </p>
        </figcaption>
    </figure>
    <figure class="effect-oscar  wowload fadeInUp">
        <img src="/assets/front_end/images/portfolio/2.jpg" alt="img01" />
        <figcaption>
            <h2>Latte</h2>
            <p>Lily likes to play with crayons and pencils
                <br>
                <a href="/assets/front_end/images/portfolio/2.jpg" title="1" data-gallery>View more</a>
            </p>
        </figcaption>
    </figure>
    <figure class="effect-oscar  wowload fadeInUp">
        <img src="/assets/front_end/images/portfolio/3.jpg" alt="img01" />
        <figcaption>
            <h2>Ambience</h2>
            <p>Lily likes to play with crayons and pencils
                <br>
                <a href="/assets/front_end/images/portfolio/3.jpg" title="1" data-gallery>View more</a>
            </p>
        </figcaption>
    </figure>
    <figure class="effect-oscar  wowload fadeInUp">
        <img src="/assets/front_end/images/portfolio/4.jpg" alt="img01" />
        <figcaption>
            <h2>Fruits</h2>
            <p>Lily likes to play with crayons and pencils
                <br>
                <a href="/assets/front_end/images/portfolio/4.jpg" title="1" data-gallery>View more</a>
            </p>
        </figcaption>
    </figure>

    <figure class="effect-oscar  wowload fadeInUp">
        <img src="/assets/front_end/images/portfolio/5.jpg" alt="img01" />
        <figcaption>
            <h2>Breakfast</h2>
            <p>Lily likes to play with crayons and pencils
                <br>
                <a href="/assets/front_end/images/portfolio/5.jpg" title="1" data-gallery>View more</a>
            </p>
        </figcaption>
    </figure>
    <figure class="effect-oscar  wowload fadeInUp">
        <img src="/assets/front_end/images/portfolio/6.jpg" alt="img01" />
        <figcaption>
            <h2>Kitchen</h2>
            <p>Lily likes to play with crayons and pencils
                <br>
                <a href="/assets/front_end/images/portfolio/6.jpg" title="1" data-gallery>View more</a>
            </p>
        </figcaption>
    </figure>
</div>
    <!-- works -->


<div id="partners" class="container spacer ">
    <h2 class="text-center  wowload fadeInUp">Some of our happy customers</h2>
    <div class="clearfix">
        <div class="col-sm-6 col-sm-offset-3">


            <div id="carousel-testimonials" class="carousel slide testimonails  wowload fadeInRight" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="item active animated bounceInRight row">
                        <div class="animated slideInLeft col-xs-2">
                            <img alt="portfolio" src="/assets/front_end/images/team/1.jpg" width="100" class="img-circle img-responsive">
                        </div>
                        <div class="col-xs-10">
                            <p> I must explain to you how all this mistaken idea of denouncing pleasure and praising pain
                                was born and I will give you a complete account of the system, and expound the actual
                                teachings of the great explorer of the truth, the master-builder of human happiness.
                                </p>
                            <span>Angel Smith -
                                <b>eshop Canada</b>
                            </span>
                        </div>
                    </div>
                    <div class="item  animated bounceInRight row">
                        <div class="animated slideInLeft col-xs-2">
                            <img alt="portfolio" src="/assets/front_end/images/team/2.jpg" width="100" class="img-circle img-responsive">
                        </div>
                        <div class="col-xs-10">
                            <p>No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because
                                those who do not know how to pursue pleasure rationally encounter consequences that are
                                extremely painful.</p>
                            <span>John Partic -
                                <b>Crazy Pixel</b>
                            </span>
                        </div>
                    </div>
                    <div class="item  animated bounceInRight row">
                        <div class="animated slideInLeft  col-xs-2">
                            <img alt="portfolio" src="/assets/front_end/images/team/3.jpg" width="100" class="img-circle img-responsive">
                        </div>
                        <div class="col-xs-10">
                            <p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled
                                and demoralized by the charms of pleasure of the moment, so blinded by desire, that they
                                cannot foresee the pain and trouble that are bound to ensue.</p>
                            <span>Harris David -
                                <b>Jet London</b>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-testimonials" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-testimonials" data-slide-to="1"></li>
                    <li data-target="#carousel-testimonials" data-slide-to="2"></li>
                </ol>
                <!-- Indicators -->
            </div>



        </div>
    </div>


    <!-- team -->
    <h3 class="text-center  wowload fadeInUp">Our Chefs</h3>
    <p class="text-center  wowload fadeInLeft">Our chefs that is making everything possible</p>
    <div class="row grid team  wowload fadeInUpBig">
        <div class=" col-sm-3 col-xs-6">
            <figure class="effect-chico">
                <img src="/assets/front_end/images/team/8.jpg" alt="img01" class="img-responsive" />
                <figcaption>
                    <p>
                        <b>Barbara Husto</b>
                        <br>Senior Chef</p>
                </figcaption>
            </figure>
        </div>

        <div class=" col-sm-3 col-xs-6">
            <figure class="effect-chico">
                <img src="/assets/front_end/images/team/10.jpg" alt="img01" />
                <figcaption>
                    <p>
                        <b>Barbara Husto</b>
                        <br>Chef</p>
                </figcaption>
            </figure>
        </div>

        <div class=" col-sm-3 col-xs-6">
            <figure class="effect-chico">
                <img src="/assets/front_end/images/team/12.jpg" alt="img01" />
                <figcaption>
                    <p>
                        <b>Barbara Husto</b>
                        <br>Asst Chef</p>
                </figcaption>
            </figure>
        </div>

        <div class=" col-sm-3 col-xs-6">
            <figure class="effect-chico">
                <img src="/assets/front_end/images/team/17.jpg" alt="img01" />
                <figcaption>
                    <p>
                        <b>Barbara Husto</b>
                        <br>Asst Chef</p>
                </figcaption>
            </figure>
        </div>


    </div>
    <!-- team -->

</div>

    <!-- About Starts -->
<div class="highlight-info">
    <div class="overlay spacer">
        <div class="container">
            <div class="row text-center  wowload fadeInDownBig">
                <div class="col-sm-3 col-xs-6">
                    <i class="fa fa-smile-o  fa-5x"></i>
                    <h4>24152 Clients</h4>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <i class="fa fa-thumbs-up  fa-5x"></i>
                    <h4>25 Variety</h4>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <i class="fa fa-history  fa-5x"></i>
                    <h4>15 yrs old</h4>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <i class="fa fa-map-marker fa-5x"></i>
                    <h4>2 Locations</h4>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- About Ends -->

<div id="contact" class="spacer">
    <!--Contact Starts-->
    <div class="container contactform center">
        <h2 class="text-center  wowload fadeInUp">Reservation</h2>
        <div class="row wowload fadeInLeftBig">
            <div class="col-sm-6 col-sm-offset-3 col-xs-12">
                <input type="text" placeholder="Name">
                <input type="text" placeholder="Company">
                <textarea rows="5" placeholder="Message"></textarea>
                <button class="btn btn-primary">
                    <i class="fa fa-paper-plane"></i> Send</button>
            </div>
        </div>
    </div>
</div>
<div id="map"></div>
    <!--Contact Ends-->
