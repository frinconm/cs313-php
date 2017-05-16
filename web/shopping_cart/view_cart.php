<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script
            src="https://code.jquery.com/jquery-3.2.1.js"
            integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
            crossorigin="anonymous"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="view_cart_style.css">
    <title>View cart</title>
</head>
<body>
<div class="container-fluid">
    <div class="row top-short-buffer">
        <div class="col-md-1"></div>
        <div class="col-md-10"><h1>Shopping cart</h1></div>
        <div class="col-md-1"></div>
    </div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-10"><h1><small>We do not really sell stuff :)</small></h1></div>
    </div>
    <?php
    /*echo "I7: " . $_SESSION["i7"] . "<br>";
    echo "GTX1080TI: " . $_SESSION["gtx1080ti"] . "<br>";
    echo "MOTHERBOARD: " . $_SESSION["motherboard"] . "<br>";
    echo "psu: " . $_SESSION["psu"] . "<br>";
    echo "samsung: " . $_SESSION["samsung"] . "<br>";
    echo "ddr4: " . $_SESSION["ddr4"] . "<br>";*/
    ?>
    <?php if (($_SESSION["i7"] > 0) && isset($_SESSION["i7"])) :?>
    <div class="row top-buffer">
        <div class="col-md-3"></div>
        <div class="col-md-1"><img class="img-thumbnail" src="img/i7-6950x.jpg" alt="i7"></div>
        <div class="col-md-5"><h4>Intel Boxed Core i7-6950X Processor Extreme Edition (25M Cache, up to 3.50 GHz) 3.0 10 BX80671I76950X</h4>
            <h5 class="text-danger">$1604.64</h5>
            <div class="list-left">
            <ul>
                <li class="text-success">In Stock</li>
                <li class="text-muted">Eligible for FREE Shipping</li></ul>
            </div>
            <div class="something-right">
                <b>Quantity: </b><span id="quantity"><?php echo $_SESSION["i7"]; ?></span>
            </div>
        </div>
        <div class="col-md-3"> </div>
    </div>
    <?php endif; ?>
    <?php if (($_SESSION["gtx1080ti"] > 0) && isset($_SESSION["gtx1080ti"])) :?>
    <div class="row top-buffer">
        <div class="col-md-3"> </div>
        <div class="col-md-1"><img class="img-thumbnail" src="img/gtx_1080ti.jpg" alt="gtx1080ti"></div>
        <div class="col-md-5"><h4>EVGA GeForce GTX 1080 Ti FOUNDERS EDITION GAMING, 11GB GDDR5X, LED, DX12 OSD Support (PXOC) Graphic Cards 11G-P4-6390-KR</h4>
            <h5 class="text-danger">$699.99</h5>
            <div class="list-left">
                <ul>
                    <li class="text-success">In Stock</li>
                    <li class="text-muted">Eligible for FREE Shipping</li></ul>
            </div>
            <div class="something-right">
                <b>Quantity: </b><span id="quantity"><?php echo $_SESSION["gtx1080ti"]; ?></span>
            </div></div>
        <div class="col-md-3"> </div>
    </div>
    <?php endif; ?>
    <?php if (($_SESSION["motherboard"] > 0) && isset($_SESSION["motherboard"])):?>
    <div class="row top-buffer">
        <div class="col-md-3"> </div>
        <div class="col-md-1"><img class="img-thumbnail" src="img/motherboard.jpg" alt="motherboard"></div>
        <div class="col-md-5"><h4>ASUS LGA2011 5Way Optimization SafeSlot X99 EATX Motherboard (Rampage V Edition 10)</h4>
            <h5 class="text-danger">$568.99</h5>
            <div class="list-left">
                <ul>
                    <li class="text-success">In Stock</li>
                    <li class="text-muted">Eligible for FREE Shipping</li></ul>
            </div>
            <div class="something-right">
                <b>Quantity: </b><span id="quantity"><?php echo $_SESSION["motherboard"]; ?></span>
            </div></div>
        <div class="col-md-3"> </div>
    </div>
    <?php endif; ?>
    <?php if (($_SESSION["psu"] > 0) && isset($_SESSION["psu"])): ?>
    <div class="row top-buffer">
        <div class="col-md-3"> </div>
        <div class="col-md-1"><img class="img-thumbnail" src="img/psu.jpg" alt="psu"></div>
        <div class="col-md-5"><h4>FSP Group U.S.A. PT FM Series 1000W ATX 12V v2.4 and EPS 12V v2.92 80 Plus Platinum Certified Full Modular Active PFC Power Supply 1000 Energy Star Certified PT-1000FM</h4>
            <h5 class="text-danger">$189.99</h5>
            <div class="list-left">
                <ul>
                    <li class="text-success">In Stock</li>
                    <li class="text-muted">Eligible for FREE Shipping</li></ul>
            </div>
            <div class="something-right">
                <b>Quantity: </b><span id="quantity"><?php echo $_SESSION["psu"]; ?></span>
            </div></div>
        <div class="col-md-3"> </div>
    </div>
    <?php endif; ?>
    <?php if (($_SESSION["samsung"] > 0) && isset($_SESSION["samsung"])): ?>
    <div class="row top-buffer">
        <div class="col-md-3"> </div>
        <div class="col-md-1"><img class="img-thumbnail" src="img/samsuns_ssd.jpg" alt="samsung"></div>
        <div class="col-md-5"><h4>Samsung 960 PRO Series - 2TB PCIe NVMe - M.2 Internal SSD (MZ-V6P2T0BW)</h4>
            <h5 class="text-danger">$324.00</h5>
            <div class="list-left">
                <ul>
                    <li class="text-success">In Stock</li>
                    <li class="text-muted">Eligible for FREE Shipping</li></ul>
            </div>
            <div class="something-right">
                <b>Quantity: </b><span id="quantity"><?php echo $_SESSION["samsung"]; ?></span>
            </div></div>
        <div class="col-md-3"> </div>
    </div>
    <?php endif; ?>
    <?php if (($_SESSION["ddr4"] > 0) && isset($_SESSION["ddr4"])) : ?>
    <div class="row top-buffer bottom-buffer">
        <div class="col-md-3"> </div>
        <div class="col-md-1"><img class="img-thumbnail" src="img/ddr4_ram.jpg" alt="ddr4"></div>
        <div class="col-md-5"><h4>32GB G.Skill DDR4 Trident Z 4000Mhz PC4-32000 CL18 1.35V Quad Channel Kit (4x8GB) for Intel Z270 Model G.Skill-F4-4000C18Q-32GTZ</h4>
            <h5 class="text-danger">$559.97</h5>
            <div class="list-left">
                <ul>
                    <li class="text-success">In Stock</li>
                    <li class="text-muted">Eligible for FREE Shipping</li></ul>
            </div>
            <div class="something-right">
                <b>Quantity: </b><span id="quantity"><?php echo $_SESSION["ddr4"]; ?></span>
            </div></div>
        <div class="col-md-3"> </div>
    </div>
    <?php endif; ?>
    <?php if (($_SESSION["ddr4"] + $_SESSION["samsung"] + $_SESSION["psu"] + $_SESSION["motherboard"] + $_SESSION["gtx1080ti"] + $_SESSION["i7"]) == 0) : ?>
    <div class="row top-buffer bottom-buffer">
        <div class="col-md-3"> </div>
        <div class="col-md-6">
            <div class="jumbotron text-center"><h3>Your cart is empty :(</h3></div>
        </div>
        <div class="col-md-3"> </div>
    </div>
    <?php endif; ?>
    <div class="row top-buffer bottom-buffer">
        <div class="col-md-4"> </div>
        <?php if (($_SESSION["ddr4"] + $_SESSION["samsung"] + $_SESSION["psu"] + $_SESSION["motherboard"] + $_SESSION["gtx1080ti"] + $_SESSION["i7"]) != 0) : ?>
        <div class="col-md-2">
            <a class="btn btn-primary center-block" href="checkout.php">Proceed to checkout</a>
        </div>
            <div class="col-md-2">
        <?php else : ?>
            <div class="col-md-4">
        <?php endif; ?>
            <button type="button" class="btn btn-primary center-block" onclick="window.location='index.php';">Keep looking</button>
        </div>
        <div class="col-md-4"> </div>
    </div>
    </div>
</div>
</body>
</html>
