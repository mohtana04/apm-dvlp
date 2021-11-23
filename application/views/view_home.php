<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>APM SEP</title>

    <!-- Bootstrap Core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="assets/css/stylish-portfolio.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic"
          rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">

        body, html {
            height: 100%;
        }

        .bg {
            /* The image used */
            background-image: url("https://s3.envato.com/files/5760033/9-590.jpg");

            /* Full height */
            height: 100%;

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

    </style>
</head>
<body>
<script language="JavaScript">
    function soon() {
        alert("Sorry, This Page We Under Development : IT RS Hermina Depok");
    }

    // document.addEventListener("contextmenu", function(e){
    //     e.preventDefault();
    // }, false);
</script>

<div class="bg">
    <div id="top" class="container">
        <h1></h1>


        <!-- Large modal -->

        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title text-center">SILAHKAN PILIH JENIS KONTROL</h4>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="thumbnail">
                                        <a href="<?php echo base_url(); ?>kontrol_pertama">
                                            <img src="assets/img/portfolio-5.jpg" alt="Lights" style="width:100%">
                                            <div class="caption">
                                                <h4 class="text-uppercase">Kontrol Pertama</h4>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="thumbnail">
                                        <a href="<?php echo base_url(); ?>postrwi">
                                            <img src="assets/img/portfolio-6.jpg" alt="Lights" style="width:100%">
                                            <div class="caption">
                                                <h4 class="text-uppercase">Kontrol Lanjutan</h4>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="panel panel-default">
            <!-- <div class="panel-heading"><center>
                Selamat Datang,<br><b>ANJUNGAN PENDAFTARAN MANDIRI</b><br> RS HERMINA DEPOK</center>
            </div> -->
            <div class="panel-body" style="height:600px">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <img src="assets/img/banner3.jpg" alt="RS Hermina">
                        </div>

                        <div class="item">
                            <img src="assets/img/banner2.jpg" alt="RS Hermina">
                        </div>

                        <div class="item">
                            <img src="assets/img/banner1.jpg" alt="RS Hermina">
                        </div>
                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <!-- <p>Isi panel body<hr></p> -->
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <div class="thumbnail">
                            <a href="<?php echo base_url(); ?>postrwi">
                                <img src="assets/img/portfolio-1.jpg" alt="Lights" style="width:100%">
                                <div class="caption">
                                    <h4 class="text-uppercase">Pasien Post Rawat Inap</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="thumbnail">
                            <a href="" data-toggle="modal" data-target=".bd-example-modal-lg">
                                <!-- <a href="#" onclick="javascript:soon()">-->
                                <img src="assets/img/portfolio-2.jpg" alt="Nature" style="width:100%">
                                <div class="caption">
                                    <h4 class="text-uppercase">Pasien Sudah Appoinment</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="thumbnail">
                            <a href="">
                                <img src="assets/img/portfolio-3.jpg" alt="Fjords" style="width:100%">
                                <div class="caption">
                                    <h4 class="text-uppercase">Pasien Belum Appoinment</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer" style="height:100px">
                <div class="col-md-8 mt-md-0 mt-3">

                    <!-- Content -->
                    <h4 class="text-uppercase">Anjungan Pendaftaran Mandiri (APM)</h4>
                    Adalah Mesin Anjungan yang memberikan kemudahan pasien untuk melakukan pendaftaran secara mandiri
                    dengan sebelumnya
                    telah mendaftarkan diri melalui applikasi mobile dan call center rumah sakit hermina.

                </div>
                <center>


                    <div class="footer-copyright text-center py-3">© 2018 Copyright:
                        <a href="https://www.herminahospitalgroup.com"> IT RS Hermina</a>
                    </div>
                    https://www.herminahospitalgroup.com<br>
                    <br>
                </center>
            </div>
            </footer>
            <!-- Footer -->
        </div>

    </div>
</div>
<script src="assets/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="assets/js/bootstrap.min.js"></script>

<!-- Custom Theme JavaScript -->
<script>
    // Closes the sidebar menu
    $("#menu-close").click(function (e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });
    // Opens the sidebar menu
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });
    // Scrolls to the selected menu item on the page
    $(function () {
        $('a[href*=#]:not([href=#],[data-toggle],[data-target],[data-slide])').click(function () {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1500);
                    return false;
                }
            }
        });
    });
    //#to-top button appears after scrolling
    var fixed = false;
    $(document).scroll(function () {
        if ($(this).scrollTop() > 250) {
            if (!fixed) {
                fixed = true;
                // $('#to-top').css({position:'fixed', display:'block'});
                $('#to-top').show("slow", function () {
                    $('#to-top').css({
                        position: 'fixed',
                        display: 'block'
                    });
                });
            }
        } else {
            if (fixed) {
                fixed = false;
                $('#to-top').hide("slow", function () {
                    $('#to-top').css({
                        display: 'none'
                    });
                });
            }
        }
    });
    // Disable Google Maps scrolling
    // See http://stackoverflow.com/a/25904582/1607849
    // Disable scroll zooming and bind back the click event
    var onMapMouseleaveHandler = function (event) {
        var that = $(this);
        that.on('click', onMapClickHandler);
        that.off('mouseleave', onMapMouseleaveHandler);
        that.find('iframe').css("pointer-events", "none");
    }
    var onMapClickHandler = function (event) {
        var that = $(this);
        // Disable the click handler until the user leaves the map area
        that.off('click', onMapClickHandler);
        // Enable scrolling zoom
        that.find('iframe').css("pointer-events", "auto");
        // Handle the mouse leave event
        that.on('mouseleave', onMapMouseleaveHandler);
    }
    // Enable map zooming with mouse scroll when the user clicks the map
    $('.map').on('click', onMapClickHandler);
</script>
</body>
</html>