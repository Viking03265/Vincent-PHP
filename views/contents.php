<?php
    require_once(__DIR__ . '\\..\\libraries\\global_functions.php');               
?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include_once ('Home\\sidebar.php') ?>
        <?php include_once ('Home\\content.php') ?>
    </div>
    <!-- End of Page Wrapper -->    

    <?php include_once ('Home\\footer.php') ?>

    <?php include_once ('Home\\popup.php') ?>    
    
    <?php include_once ('Home\\others.php') ?>   

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/main.js"></script>

    <!-- Page level plugins -->
    <script src="assets/vendor/chart.js/Chart.min.js"></script>

</body>