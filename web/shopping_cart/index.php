<?php
    session_start();
if (isset($_POST["i7"])) {
    $_SESSION["i7"] = $_POST["i7"];
}

if (isset($_POST["gtx1080ti"])) {
    $_SESSION["gtx1080ti"] = $_POST["gtx1080ti"];
}

if (isset($_POST["motherboard"])) {
    $_SESSION["motherboard"] = $_POST["motherboard"];
}

if (isset($_POST["psu"])) {
    $_SESSION["psu"] = $_POST["psu"];
}

if (isset($_POST["samsung"])) {
    $_SESSION["samsung"] = $_POST["samsung"];
}

if (isset($_POST["ddr4"])) {
    $_SESSION["ddr4"] = $_POST["ddr4"];
}
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
    <!- Spinner -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="shopping_style.css">
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="../bower_components/parsleyjs/dist/parsley.min.js"></script>
    <title>Items</title>
</head>
<body>
<?php
/*echo "I7: " . $_SESSION["i7"] . "<br>";
echo "GTX1080TI: " . $_SESSION["gtx1080ti"] . "<br>";
echo "MOTHERBOARD: " . $_SESSION["motherboard"] . "<br>";
echo "psu: " . $_SESSION["psu"] . "<br>";
echo "samsung: " . $_SESSION["samsung"] . "<br>";
echo "ddr4: " . $_SESSION["ddr4"] . "<br>";*/
?>
<div class="container-fluid">
    <div class="row top-short-buffer">
        <div class="col-md-1"></div>
        <div class="col-md-9"><h1>Shopping cart assignment</h1></div>
        <div class="col-md-2">
            <form method="post" action="view_cart.php">
            <button type="submit" class="btn btn-info btn-lg">
                <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span><span id="cart_items"> Cart
                    <?php echo ($_SESSION["ddr4"] + $_SESSION["samsung"] + $_SESSION["psu"] + $_SESSION["motherboard"] + $_SESSION["gtx1080ti"] + $_SESSION["i7"]);?></span>
            </button>
            </form></div>
    </div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-10"><h1><small>We do not really sell stuff :)</small></h1></div>
    </div>
    <div class="row top-buffer">
        <div class="col-md-2"></div>
        <div class="col-md-3"><img class="img-thumbnail" src="img/i7-6950x.jpg" alt="i7" width="420"></div>
        <div class="col-md-5"><h3>Intel Boxed Core i7-6950X Processor Extreme Edition (25M Cache, up to 3.50 GHz) 3.0 10 BX80671I76950X</h3>
            <h4 class="price">$1604.64</h4>
            <ul>
                <li>10 Core/20 Thread</li>
                <li>LGA 2011-v3</li>
                <li>4 Channels DDR4 2400; one DIMM per Channel</li>
                <li>140W Tdp; Up to 40 Lanes PCIe 3.0 (2x16+1x8).</li></ul>
            <form class="verification" method="post" action="index.php">
                <div class="items-selected">
                    <label for="spinner1"><b>Qty:</b></label><input id="spinner1" class="items-number ui-spinner" min="0" value="<?php if (isset($_SESSION["i7"])) { echo $_SESSION["i7"]; }
                    else echo 0; ?>" name="i7" data-parsley-type="integer">
                    <button type="submit" class="btn btn-primary" onclick="updateCart('spinner1')">Add to cart</button>
                </div>
            </form>
        </div>
        <div class="col-md-2"> </div>
    </div>
    <div class="row top-buffer">
        <div class="col-md-2"> </div>
        <div class="col-md-3"><img class="img-thumbnail" src="img/gtx_1080ti.jpg" alt="gtx1080ti" width="420"></div>
        <div class="col-md-5"><h3>EVGA GeForce GTX 1080 Ti FOUNDERS EDITION GAMING, 11GB GDDR5X, LED, DX12 OSD Support (PXOC) Graphic Cards 11G-P4-6390-KR</h3>
            <h4 class="price">$699.99</h4>
            <ul>
                <li>Real Base Clock: 1480 MHz / Real Boost Clock: 1582 MHz; Memory Detail: 11264 MB GDDR5X</li>
                <li>The EVGA GeForce GTX 1080 Ti is the latest addition to the ultimate gaming platform, this card is packed with extreme horsepower, next-gen 11 Gbps GDDR5X memory, and a massive 11 GB frame buffer.</li>
                <li>What you see is what you get! - No additional software required to achieve listed clock speeds</li>
                <li>DX12 OSD Support with EVGA Precision XOC</li>
                <li>3 Year Warranty & EVGA's 24/7 Technical Support</li>
            </ul>
            <form class="verification" method="post" action="index.php">
            <div class="items-selected">
                <label for="spinner2"><b>Qty:</b></label><input id="spinner2" class="items-number ui-spinner" min="0" value="<?php if (isset($_SESSION["gtx1080ti"])) { echo $_SESSION["gtx1080ti"]; }
                else echo 0; ?>" name="gtx1080ti" data-parsley-type="integer">
                <button type="submit" class="btn btn-primary" onclick="updateCart('spinner2')">Add to cart</button>
            </div>
            </form>
        </div>
        <div class="col-md-2"> </div>
    </div>
    <div class="row top-buffer">
        <div class="col-md-2"> </div>
        <div class="col-md-3"><img class="img-thumbnail" src="img/motherboard.jpg" alt="motherboard" width="420"></div>
        <div class="col-md-5"><h3>ASUS LGA2011 5Way Optimization SafeSlot X99 EATX Motherboard (Rampage V Edition 10)</h3>
            <h4 class="price">$568.99</h4>
            <ul>
                <li>Next-gen connectivity – Includes extensive upgrades including onboard U.2 / M.2 slots that tap into 32Gbps of PCIe bandwidth, 3x3 802.11ac Wi-Fi, dual Intel LAN, and USB 3.1 Type C</li>
                <li>ASUS Aura – Features controllable RGB onboard lighting and 4-pin strip header that can be synced with an ever-growing portfolio of Aura-capable ASUS hardware</li>
                <li>Patent-pending SafeSlot  – Reinvented, strengthened PCIe slot utilizes a new insert-molding process to bind the slot to fortifying metal for superior retention and shearing resistance</li>
                <li>5-Way Optimization – 1-click full system tuning handles everything from overclocking to cooling and beyond</li>
                <li>SupremeFX Audio – ROG-renowned audio with SupremeFX shielding for noise reduction and dual op-amps to drive 32-300 ohms impedance headphones</li>
            </ul>
            <form class="verification" method="post" action="index.php">
            <div class="items-selected">
                <label for="spinner3"><b>Qty:</b></label><input id="spinner3" class="items-number ui-spinner" min="0" value="<?php if (isset($_SESSION["motherboard"])) { echo $_SESSION["motherboard"]; }
                else echo 0; ?>" name="motherboard" data-parsley-type="integer">
                <button type="submit" class="btn btn-primary" onclick="updateCart('spinner3')">Add to cart</button>
            </div>
            </form>
        </div>
        <div class="col-md-2"> </div>
    </div>
    <div class="row top-buffer">
        <div class="col-md-2"> </div>
        <div class="col-md-3"><img class="img-thumbnail" src="img/psu.jpg" alt="psu" width="420"></div>
        <div class="col-md-5"><h3>FSP Group U.S.A. PT FM Series 1000W ATX 12V v2.4 and EPS 12V v2.92 80 Plus Platinum Certified Full Modular Active PFC Power Supply 1000 Energy Star Certified PT-1000FM</h3>
            <h4 class="price">$568.99</h4>
            <ul>
                <li>Complies with the latest ATX12 v2.4 & EPS 12 v2.92 system</li>
                <li>Single +12V offers maximum compatibility with the latest components.</li>
                <li>80 PLUS Platinum Certification | High efficiency 92% ++ reduce your electricity bill</li>
                <li>SATA Array Cable, Optimize airflow and neatness in chassis.</li>
                <li>FSP MIA IC (Multiple Intelligence Ability) Chip Set</li>
                <li>PCI-Express 6+2 pin connector for all VGA cards.</li>
                <li>Compatible with Latest Intel/AMD CPUs | 135mm Quiet Cooling Fan</li>
                <li>A Seven year warranty local RMA service and lifetime access to FSP Group USA tech support and customer service.</li>
            </ul>
            <form class="verification" method="post" action="index.php">
            <div class="items-selected">
                <label for="spinner4"><b>Qty:</b></label><input id="spinner4" class="items-number ui-spinner" min="0" value="<?php if (isset($_SESSION["psu"])) { echo $_SESSION["psu"]; }
                else echo 0;?>" name="psu" data-parsley-type="integer">
                <button type="submit" class="btn btn-primary" onclick="updateCart('spinner4')">Add to cart</button>
            </div>
            </form>
        </div>
        <div class="col-md-2"> </div>
    </div>
    <div class="row top-buffer">
        <div class="col-md-2"> </div>
        <div class="col-md-3"><img class="img-thumbnail" src="img/samsuns_ssd.jpg" alt="samsung" width="420"></div>
        <div class="col-md-5"><h3>Samsung 960 PRO Series - 2TB PCIe NVMe - M.2 Internal SSD (MZ-V6P2T0BW)</h3>
            <h4 class="price">$324.00</h4>
        <ul>
            <li>M.2 (2280) - PCIe 3.0 x4 NVM Express SSD for Client PCs</li>
            <li>V-NAND Client SSD ideal for GAMING, high-performance tower desktops and mdall form factor PC’s</li>
            <li>Sequential Read Speeds up to 3500MB/s and Sequential Write Speeds up to 2100MB/s</li>
            <li>Samsung magician software delivers SSD management and automatic firmware updates</li>
            <li>5 year limited warranty</li>
            <li>Performance may vary based on system hardware & configuration</li>
        </ul>
            <form class="verification" method="post" action="index.php">
            <div class="items-selected">
                <label for="spinner5"><b>Qty:</b></label><input id="spinner5" class="items-number ui-spinner" min="0" value="<?php if (isset($_SESSION["samsung"])) { echo $_SESSION["samsung"]; }
                else echo 0; ?>" name="samsung" data-parsley-type="integer">
                <button type="submit" class="btn btn-primary" onclick="updateCart('spinner5')">Add to cart</button>
            </div>
            </form>
        </div>
        <div class="col-md-2"> </div>
    </div>
    <div class="row top-buffer bottom-buffer">
        <div class="col-md-2"> </div>
        <div class="col-md-3"><img class="img-thumbnail" src="img/ddr4_ram.jpg" alt="ddr4" width="420"></div>
        <div class="col-md-5"><h3>32GB G.Skill DDR4 Trident Z 4000Mhz PC4-32000 CL18 1.35V Quad Channel Kit (4x8GB) for Intel Z270 Model G.Skill-F4-4000C18Q-32GTZ</h3>
            <h4 class="price">$559.97</h4>
        <ul>
            <li>Trident Z is the latest high-performance DDR4 range from G.Skill, designed for gaming and overclocking</li>
            <li>Optimized for the latest 6th Generation Intel Core Processors and Z170 chipsets</li>
            <li>Four matched 8GB modules, designed for use in a quad channel setup</li>
            <li>4000MHz memory speed with full memory timings of CL18-19-19-39 at 1.35V</li>
            <li>Luxury two-colour heatsinks with a new fin design for more effective heat dissipation</li>
        </ul>
            <form class="verification" method="post" action="index.php">
            <div class="items-selected">
                <label for="spinner6"><b>Qty:</b></label><input id="spinner6" class="items-number ui-spinner" min="0" value="<?php if (isset($_SESSION["samsung"])) { echo $_SESSION["ddr4"]; }
                else echo 0; ?>" name="ddr4" data-parsley-type="integer">
                <button type="submit" class="btn btn-primary" onclick="updateCart('spinner6')">Add to cart</button>
            </div>
            </form>
        </div>
        <div class="col-md-2"> </div>
    </div>
</div>
<script>
    $( ".ui-spinner" ).spinner();
    $('.verification').parsley();
</script>
</body>
</html>