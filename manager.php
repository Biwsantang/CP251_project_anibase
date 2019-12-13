<?php
session_start();
if (isset($_SESSION['level'])) {
    $google_button= "d-none";
    $signout_button= "";
    if (!isset($_COOKIE['color'])) {
        $_COOKIE['color']="1";
    }
    if (!isset($_COOKIE['nsfw'])) {
        $_COOKIE['nsfw']="0";
    }
    $control_status = '';
} else {
    $google_button= "";
    $signout_button="d-none";
    $control_status = 'd-none';
}

?>
<html>
<head>
<meta charset="utf-8">
    <title>Loading - Anibase</title>
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
    <link rel="stylesheet" type="text/css" href="/dark.css">
    <meta name="google-signin-client_id" content="378364946748-kp0gpj590v2i7ist8b5ptohadlp1cesb.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script>
    function onSignIn(googleUser) {

        var id_token = googleUser.getAuthResponse().id_token;
        console.log(id_token);

        $.get( 
                 "https://oauth2.googleapis.com/tokeninfo", { 
                     id_token: id_token 
                 }, 
                 function(data) { 
                    console.log(data);
                    $.post("/login.php", {email: data['email'],sub: data['sub']},
                        function(data){
                            data = JSON.parse(data);
                            console.log(data['sub']);
                            console.log(data['email']);
                            console.log(data['level']);
                            console.log(data['status']);
                            console.log(data['re']);
                            if (data['re']==1) {
                                window.location = document.referrer;
                            }
                            })
                 });
    }
    function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
        $.post("/logout.php",
        function (){
            window.location = document.referrer;
        })
    });
  }
    </script>
    <script>
        function colorcheck() {
                if (!$('#darksystem').is(":checked")) {
                    //$( "#dark" ).prop( "disabled", false );
                    if ($('#dark').is(":checked")) {
                    $('body').removeClass('white');
                    $('body').addClass('dark');
                    document.cookie = "color=dark";
                    } else {
                        $('body').removeClass('dark');
                        $('body').addClass('white');
                        document.cookie = "color=white";
                    }
                } else {
                    //$( "#dark" ).prop( "disabled", true );
                    $('body').removeClass('dark');
                    $('body').removeClass('white');
                    document.cookie = "color=1";
                }
            }
            function nsfwcheck() {
                if (!$('#nsfw').is(":checked")) {
                    //$( "#dark" ).prop( "disabled", false );
                    document.cookie = "nsfw=0";
                    } else {
                    document.cookie = "nsfw=1";
                    }
            }
        $(document).ready(function() {
            var colorcome = "<?php echo $_COOKIE['color'] ?>";
            if (colorcome == "1") {
                console.log('colorcome');
                $('#darksystem').prop("checked",true);
                } else if (colorcome == "white") {
                    console.log('colorcome');
                    $('#dark').prop("checked",false);
                } else if (colorcome == "dark") {
                    console.log('colorcome');
                    $('#dark').prop("checked",true);
                }
                colorcheck();
            $('#dark,#darksystem').on('input',function() {
                colorcheck();
            })

            var nsfwcome = "<?php echo $_COOKIE['nsfw'] ?>";
            if (nsfwcome == "1") {
                console.log('nsfwcome');
                $('#nsfw').prop("checked",true);
                } else if (nsfwcome == "0") {
                    console.log('nsfwcome');
                    $('#nsfw').prop("checked",false);
                }
                nsfwcheck();
            $('#nsfw').on('input',function() {
                nsfwcheck();
            })
            
        });
    </script>
</head>
<body>
<div class="container py-5">
<div class="row">
<div class="col-lg-4 mx-auto">
    <div id="control" class="<?php echo $control_status ?>">
<div class="custom-control custom-switch pt-2">
  <input type="checkbox" class="custom-control-input" id="nsfw">
  <label class="custom-control-label" for="nsfw">NSFW mode</label>
</div>
<div class="pt-2">
<div class="custom-control custom-switch">
  <input type="checkbox" class="custom-control-input" id="dark">
  <label class="custom-control-label" for="dark">Dark mode</label>
</div>
<div class="form-check ml-4">
  <input class="form-check-input" type="checkbox" id="darksystem" value="option1">
  <label class="form-check-label" for="darksystem">Prefer System</label>
</div>
</div>
    </div>
<div class="pt-5">
<div class="mx-auto" style="width: 27%">
<div class='g-signin2 <?php echo $google_button;?>' data-onsuccess='onSignIn'></div>
</div>
<button type='button' class='btn btn-danger <?php echo $signout_button;?> col-12' onclick='signOut();'>Sign out</a>
<button type="button" class="btn btn-link col-12" onclick="window.location = document.referrer;">Go back</button>
</div>
</div>
</div>
</div>
</body>
<html>