<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Title</title>
	
	<?php require_once("../model/index_rel.php") ?>
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />	
	<link rel="stylesheet" href="../vender/owl.slider/css/slider.css">

</head>

<body>


    <!-- Reviews -->
    <section class="reviews">
        <h4 class="main-title text-center font-weight-bold pb-4">WHAT CUSTOMERS SAY</h4>

        <div class="container">
            <div class="owl-carousel">

                <!-- card -->
                <div class="item">
                    <div class=" card">
                        <div class="row">
                            <div class="col-xs-7 col-7 info-col">
                                <h4 class="title">JOHN CHARLES</h4>
                                <h6 class="sub-title">Creative Marketer</h6>
                                <ul>
                                    <li>
                                        <i class="fa fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fa fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fa fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fa fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fa fa-star"></i>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4 img-col">
                                <div class="user" style="background-image: url('../vender/owl.slider/images/user.jpg')"></div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 p-col">
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ipsa libero eveniet,
                                    voluptatibus
                                    qui facere aut!</p>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- card -->
                <div class="item">
                    <div class=" card">
                        <div class="row">
                            <div class="col-xs-7 col-7 info-col">
                                <h4 class="title">JOHN CHARLES</h4>
                                <h6 class="sub-title">Creative Marketer</h6>
                                <ul>
                                    <li>
                                        <i class="fa fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fa fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fa fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fa fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fa fa-star"></i>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4 img-col">

                                <div class="user" style="background-image: url('../vender/owl.slider/images/user-1.jpg')"></div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 p-col">
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ipsa libero eveniet,
                                    voluptatibus
                                    qui facere aut!</p>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- card -->
                <div class="item">
                    <div class=" card">
                        <div class="row">
                            <div class="col-xs-7 col-7 info-col">
                                <h4 class="title">JOHN CHARLES</h4>
                                <h6 class="sub-title">Creative Marketer</h6>
                                <ul>
                                    <li>
                                        <i class="fa fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fa fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fa fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fa fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fa fa-star"></i>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4 img-col">
                                <div class="user" style="background-image: url('../vender/owl.slider/images/user-2.jpg')"></div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 p-col">
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ipsa libero eveniet,
                                    voluptatibus
                                    qui facere aut!</p>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>




	<?php require_once("../model/index_js.php") ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha256-pTxD+DSzIwmwhOqTFN+DB+nHjO4iAsbgfyFq5K5bcE0=" crossorigin="anonymous"></script>

<script>
// Reviews slider
    $(".reviews .owl-carousel").owlCarousel({
        loop: true,
        margin: 35,
        nav: true,
        center: true,
        autoplay: true,
        navText: [
            '<i class="fa fa-angle-left"></i>',
            '<i class="fa fa-angle-right"></i>'
        ],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            750: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });
</script>

</body>

</html>