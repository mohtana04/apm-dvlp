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
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/css/stylish-portfolio.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic"
          rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        .progress {
            position: relative;
            height: 2px;
            display: block;
            width: 100%;
            background-color: white;
            border-radius: 2px;
            background-clip: padding-box;
            /*margin: 0.5rem 0 1rem 0;*/
            overflow: hidden;

        }

        .progress .indeterminate {
            background-color: black;
        }

        .progress .indeterminate:before {
            content: '';
            position: absolute;
            background-color: #2C67B1;
            top: 0;
            left: 0;
            bottom: 0;
            will-change: left, right;
            -webkit-animation: indeterminate 2.1s cubic-bezier(0.65, 0.815, 0.735, 0.395) infinite;
            animation: indeterminate 2.1s cubic-bezier(0.65, 0.815, 0.735, 0.395) infinite;
        }

        .progress .indeterminate:after {
            content: '';
            position: absolute;
            background-color: #2C67B1;
            top: 0;
            left: 0;
            bottom: 0;
            will-change: left, right;
            -webkit-animation: indeterminate-short 2.1s cubic-bezier(0.165, 0.84, 0.44, 1) infinite;
            animation: indeterminate-short 2.1s cubic-bezier(0.165, 0.84, 0.44, 1) infinite;
            -webkit-animation-delay: 1.15s;
            animation-delay: 1.15s;
        }

        @-webkit-keyframes indeterminate {
            0% {
                left: -35%;
                right: 100%;
            }
            60% {
                left: 100%;
                right: -90%;
            }
            100% {
                left: 100%;
                right: -90%;
            }
        }

        @keyframes indeterminate {
            0% {
                left: -35%;
                right: 100%;
            }
            60% {
                left: 100%;
                right: -90%;
            }
            100% {
                left: 100%;
                right: -90%;
            }
        }

        @-webkit-keyframes indeterminate-short {
            0% {
                left: -200%;
                right: 100%;
            }
            60% {
                left: 107%;
                right: -8%;
            }
            100% {
                left: 107%;
                right: -8%;
            }
        }

        @keyframes indeterminate-short {
            0% {
                left: -200%;
                right: 100%;
            }
            60% {
                left: 107%;
                right: -8%;
            }
            100% {
                left: 107%;
                right: -8%;
            }
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

<!--<div class="progress" id="PreLoaderBar">-->
<!--    <div class="indeterminate"></div>-->
<!--</div>-->

<section id="about" class="header">
    <form action="<?php echo base_url('kontrol_pertama/a_cetaksep'); ?>" method="post">
        <div class="container">
            <div class="col-lg-l2 text-center">
                <h2>Identifikasi data diri Anda !!!</h2>
            </div>
            <?php
            foreach ($pasien_appointment->result() as $row) {
            ?>
            <div class="form-group">
                <label for="varchar" class="col-sm-2 control-label">Nama Pasien </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control"  readonly="true" name="namaPasien" id="namaPasien" placeholder="namaPasien" value="<?php echo $row->nm_pasien;?>" />
                </div>
            </div>
            <div class="form-group">
                <label for="varchar" class="col-sm-2 control-label">No Rekam Medis </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" readonly="true" name="noMr2" id="noMr2" placeholder="No Rekam Medis" value="<?php echo $row->no_mr ?>" />

                    <input type="hidden" class="form-control" readonly="true" name="urut" id="urut" placeholder="urut" value="<?php echo $row->urut; ?>" />
                </div>
            </div>
            <div class="form-group">
                <label for="varchar" class="col-sm-2 control-label">Nama Dokter </label>
                <div class="col-sm-4">
                    <input type="hidden" class="form-control" readonly="true" name="dokterid" id="dokterid" placeholder="kodeDokter" value="<?php echo $row->dokterid; ?>" />
                    <input type="text" class="form-control" readonly="true" name="namaDokter" id="namaDokter" placeholder="namaDokter" value="<?php echo $row->doktername; ?>" />
                </div>
            </div>


            <div class="form-group">
                <label for="varchar" class="col-sm-2 control-label">Poliklinik</label>
                <div class="col-sm-4">
                    <input type="hidden" class="form-control" readonly="true" name="kdPoliBps" id="kdPoliBps" placeholder="kdPoliBps" value="<?php echo $row->kdpolibpjs; ?>" />
                    <input type="hidden" class="form-control" readonly="true" name="kdPoli" id="kdPoli" placeholder="kodePoli" value="<?php echo $row->poliklinikid; ?>" />
                    <input type="text" class="form-control" readonly="true" name="namaPoli" id="namaPoli" placeholder="namaPoli" value="<?php echo $row->poliklinikname; ?>" />
                </div>
            </div>

            <br>
            <br>
            <div class="form-group">
                <label for="varchar" class="col-sm-2 control-label">No Kartu BPJS</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="nokartu" id="nokartu" required placeholder="" value="<?php echo $row->nokartu; ?>" />

                </div>
            </div>



            <div class="form-group">
                <label for="varchar" class="col-sm-2 control-label">No Telpon</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="notelpon" id="notelpon" required placeholder="" value="<?php echo $row->no_telepon; ?>" />
                    <input type="hidden" class="form-control" readonly="true" name="shift" id="shift" placeholder="shiftname" value="<?php echo $row->shiftname; ?>" />
                    <input type="hidden" class="form-control" readonly="true" name="waktu" id="waktu" placeholder="waktu" value="<?php echo $row->waktu_kunjungan; ?>" />
                </div>
            </div>
            <br>
            <br>
                <?php
            }
            ?>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">==== YA SUDAH BENAR ====</button>
                <div class="col-sm-4">

                    <br>
                    <a href="<?php echo base_url(); ?>postrwi"  class="btn btn-danger">====BELUM BENAR====</a>
                </div>
            </div>
        </div>
    </form>
</section>



<!-- Footer -->

<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

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