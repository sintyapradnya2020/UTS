<?php
    session_start();
    if(!isset($_SESSION["login"])) {
        header("Location: ../login");
    }

    $username = $_SESSION["user"];

    include('../view/header.php');
?>
<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="homepage">
                    <div class="text-center">
                        <h2>About Laundry Sintya</h2>
                        <p>
                            Pemilik dari web ini adalah Putu Sintya Pradnya Paramitha (1915051102), Silahkan kontak admin di IG : Siintyaa_p
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    include('../view/footer.php');
?>