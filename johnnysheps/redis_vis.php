<?php
    //Connecting to Redis server on localhost 
    include("redis_config.php");

    /* print_r("sBTC Holders: " . $redis->get("sbtc_holders") . "<br/>");
        print_r("sBTC TS: " . $sbtc_total_supply . "<br/>");
        print_r("bBTC TB: " . $bbtc_tb . "<br/>");
        print_r("bBTC Price: " . $redis->get("bbtc_price") ."<br/>");
        print_r("sBTC Price: " . $redis->get("sbtc_price")); */

    $susd_holders = $redis->get("susd_holders");
    $susd_price = $redis->get("susd_price");
    $busd_price = $redis->get("busd_price");

    $seth_holders = $redis->get("seth_holders");
    $seth_price = $redis->get("seth_price");
    $beth_price = $redis->get("beth_price");

    $sbtc_holders = $redis->get("sbtc_holders");
    $sbtc_price = $redis->get("sbtc_price");
    $bbtc_price = $redis->get("bbtc_price");

    $sada_holders = $redis->get("sada_holders");
    $sada_price = $redis->get("sada_price");
    $bada_price = $redis->get("bada_price");

?>

<!doctype html>
<html>
<head>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-VGB53QK33N"></script>
  <script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-VGB53QK33N');
  </script>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>xSurge - True Decentralized Finance. </title>
  <link rel="icon" type="image/x-icon" href="assets/img/logo.ico"/>
  <link href="assets/css/loader.css" rel="stylesheet" type="text/css" />
  <script src="assets/js/loader.js"></script>
  
  <!-- BEGIN GLOBAL MANDATORY STYLES -->
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

  <!-- <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> -->
  <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <!-- END GLOBAL MANDATORY STYLES -->

  <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
  <link href="plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
  <link href="assets/css/dashboard/dash_1.css?v=1.69" rel="stylesheet" type="text/css" />
  <link href="assets/css/structure.css?v=1.94" rel="stylesheet" type="text/css" />
  <link href="assets/css/masonry_2.css?v=1.29" rel="stylesheet" type="text/css">
  <link href="assets/css/pages/coming-soon/style.css?v=1.03" rel="stylesheet" type="text/css">
  <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

  
</head>

<body>
     
    <div class="container">
        <div class="header-container2">
            <header class="header navbar navbar-expand-sm">
                <div class="nav-logo align-self-center">
                    <div class="navLogo">
                        <a class="navbar-brand" href="index.html"><img class="logoNav1" src="assets/img/xsurge.png" ></a>
                    </div>
                </div>
            </header>
        </div>

        <div>


        </div>
    </div>


    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <!-- <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script> -->
    <script src="assets/js/app.js"></script>

<script>

        
        function getTokenStats(){
            $.post("get_token_stats2.php").done(function(data){
                var data = JSON.parse(data);

                var sUSDholders, sUSDPrice; 
                var sETHholders, sETHPrice;
                var sBTCholders, sBTCPrice;
                var sADAholders, sADAPrice;

                $.each(data, function(i, item){
                    sUSDholders =  item.susd_holders;
                    sUSDPrice = item.susd_price;
                    sETHholders =  item.seth_holders;
                    sETHPrice = item.seth_price;
                    sBTCholders = item.sbtc_holders;
                    sBTCPrice = item.sbtc_price;
                    sADAholders = item.sada_holders;
                    sADAPrice = item.sada_price;

                    

                    $("#sUSDHolders").html(sUSDholders);
                    $("#sUSDPrice").html(sUSDPrice);
                    $("#sETHHolders").html(sETHholders);
                    $("#sETHPrice").html(sETHPrice);
                    $("#sBTCHolders").html(sBTCholders);
                    $("#sBTCPrice").html(sBTCPrice);
                    $("#sADAHolders").html(sADAholders);
                    $("#sADAPrice").html(sADAPrice);

                });
            
            }); 
        }

  
    

    $(document).ready(function() {

        
        $("#calcBtn").hide();
        $('#calcResults').hide();
        $("#copyMSG").hide();

         //Login Functions   
         $('#userInput').keypress(function (e) {
                var key = e.which;
                if(key == 13)  // the enter key code
                {

                    switch($("#userSelect").val()){
                        case "wallet":
                            var walletAddress = $("#userInput").val();
                            calcWallet(walletAddress);
                            break;
                        case "sUSD":
                        case "sETH":
                        case "sBTC":
                            var ts = $("#userSelect").val();
                            var ta = $("#userInput").val();
                            calcToken(ts, ta);
                            break;
                        default:
                            break;

                    }

                    return false;  
                }
            });

        //initial call for token stats
        getTokenStats();

        //run getTokenStats every 10 seconds
        setInterval(function(){ 
            getTokenStats();
        }, 15000);
       

        $('#userSelect').on('change', function() {

            switch($("#userSelect").val()){
                case "wallet":
                    
                    $('#calcResults').hide();
                    $("#userInput").val(getCookie("user_wallet_address"));
                    $("#userInput").attr("placeholder", "Enter Wallet Address");
                    $("#calcBtn").html("Show");
                    $("#calcBtn").show();
                    $("#tokenBalanceSUSD").html("Loading");
                    $("#tokenValueBNB").html("Loading");
                    $("#tokenValuesusdUSD").html("Loading");
                    $("#tokenBalanceSETH").html("Loading");
                    $("#tokenValueETH").html("Loading");
                    $("#tokenValuesethUSD").html("Loading");
                    $("#tokenBalanceSBTC").html("Loading");
                    $("#tokenValueBTC").html("Loading");
                    $("#tokenValuesbtcUSD").html("Loading");
                    break;
                //For all other tokens
                case "sETH":
                    $('#calcResults').hide();
                    $("#userInput").val(getCookie("sETH"));
                    $("#userInput").attr("placeholder", "Enter Token Amount");
                    $("#calcBtn").html("Calculate");
                    $("#calcBtn").show();
                    $("#tokenBalance").html("Loading");
                    $("#tokenValue").html("Loading");
                    $("#tokenValueUSD").html("Loading");
                    break;
                case "sUSD":
                    $('#calcResults').hide();
                    $("#userInput").val(getCookie("sUSD"));
                    $("#userInput").attr("placeholder", "Enter Token Amount");
                    $("#calcBtn").html("Calculate");
                    $("#calcBtn").show();
                    $("#tokenBalance").html("Loading");
                    $("#tokenValue").html("Loading");
                    $("#tokenValueUSD").html("Loading");
                    break;
                case "sBTC":
                    $('#calcResults').hide();
                    $("#userInput").val(getCookie("sBTC"));
                    $("#userInput").attr("placeholder", "Enter Token Amount");
                    $("#calcBtn").html("Calculate");
                    $("#calcBtn").show();
                    $("#tokenBalance").html("Loading");
                    $("#tokenValue").html("Loading");
                    $("#tokenValueUSD").html("Loading");
                    break;
                case "sADA":
                    $('#calcResults').hide();
                    $("#userInput").val(getCookie("sADA"));
                    $("#userInput").attr("placeholder", "Enter Token Amount");
                    $("#calcBtn").html("Calculate");
                    $("#calcBtn").show();
                    $("#tokenBalance").html("Loading");
                    $("#tokenValue").html("Loading");
                    $("#tokenValueUSD").html("Loading");
                    break;
                default:
                    break;
            }
        });

        $("#calcBtn").click(function(){

            //check if user Chose a token or to enter wallet address
            switch($("#userSelect").val()){
                case "wallet":
                    var walletAddress = $("#userInput").val();
                    calcWallet(walletAddress);
                    break;
                //For all other tokens
                default:
                    var ts = $("#userSelect").val();
                    var ta = $("#userInput").val();
                    calcToken(ts, ta);
                    break;
            }
            
            
        });

        setInterval(function(){ 
            if($("#calcResults").is(":visible")){
                switch($("#userSelect").val()){
                    case "wallet":
                        var walletAddress = $("#userInput").val();
                        calcWallet(walletAddress);
                        break;
                    case "sUSD":
                    case "sETH":
                    case "sBTC":
                        var ts = $("#userSelect").val();
                        var ta = $("#userInput").val();
                        calcToken(ts, ta);
                        break;
                    default:
                        break;
                }
            }
            
        }, 15000);
        
        
    });
</script>




<script src="assets/js/custom.js"></script>
<script src="assets/js/dashboard/dash_1.js"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->
<script src="//unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>

</body>
