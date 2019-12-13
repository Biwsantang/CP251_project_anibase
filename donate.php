<?php
session_start();
?>
<html>
<head>
    <meta charset="utf-8">
    <link rel="icon" href="https://emojipedia-us.s3.dualstack.us-west-1.amazonaws.com/thumbs/240/apple/237/money-bag_1f4b0.png">
    <title>Donate - Anibase</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script   src="https://code.jquery.com/jquery-3.3.1.js"   integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="   crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/53acdcc4e3.js" crossorigin="anonymous">
    </script>
    <?php 
    if (isset($_SESSION['level'])) {
        echo '<link rel="stylesheet" type="text/css" href="/dark.css">';
    }
    ?>
    <script>
    $(document).ready(function (){
        var amount=50;
        amount=$('#range_amount').val();
        $('#amount').text(amount+' ฿');
        $('#range_amount').on('input',function() {
            $('#amount').addClass("text-danger");
            amount = $('#range_amount').val();
            $('#amount').text(amount+' ฿');
            if (amount==0) {
                $('#amount').text("Amount on Bank's app");
            }
            console.log(amount);
        });
        $('#generate').click(function() {
            console.log('generate'+amount);
            $.post("/promptpay.php",{amount: amount},function(data) {
                console.log(data);
                var qrcode='https://api.qrserver.com/v1/create-qr-code/?size=500x500&data='+data;
                $('#qrcode').html('<img class="img-fluid w-100" src="'+qrcode+'">');
                $('#amount').removeClass("text-danger");
                $('#amount').addClass("text-success");
            });
        })
    });

    </script>
</head>
    <body class="<?php echo $_COOKIE['color'] ?>">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-4 mx-auto mt-3">
                        <label for="range_amount">Amount: <h2 id="amount" class="text-danger"></h2></label>
                        <input type="range" class="custom-range col-12" id="range_amount">
                        <button id="generate" type="button" class="btn btn-primary col-12 mt-3">Generate</button>
                        <div id="qrcode" class="mt-3"></div>
                </div>
            </div>
        </div>
    </body>
</html>