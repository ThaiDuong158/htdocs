<?php
include("../css/head.php");
?>
<link rel="stylesheet" href="../css/tkb.css">

<body>
    <div class="main container-fluid">
        <?php
        include("../TrangMau/header.php");
        ?>
        <div class="row">
            <?php
            include("../TrangMau/sidebar.php");
            ?>
            <div class="col table-responsive bg-light d-flex flex-column justify-content-between">
                <div class="content row container-fluid">
                    <div class="">
                        <div class="row">
                            <div class="col-4">
                                <div class="SearchInput"><input id="telegram-search-input" type="text" dir="auto" placeholder="Search" class="form-control" autocomplete="off">
                                    <div class="Transition icon-container">
                                        <div class="Transition_slide Transition_slide-active"><i class="icon icon-search search-icon"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">

                            </div>
                            <div class="col-8">asds</div>
                        </div>
                    </div>

                </div>

                <?php
                include("../TrangMau/footer.php");
                ?>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.sidebar-mini').click();
        });
    </script>


</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/main.js"></script>

</html>