<?php
session_start();
?>
<html>

<head>
    <meta charset="utf-8">
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
    <script src="search.js"></script>
    <script>
    </script>
    <?php
    if (isset($_SESSION['level'])) {
        echo '<link rel="stylesheet" type="text/css" href="/dark.css">';
        if (!$_COOKIE['nsfw']=="1") {
            echo '<link rel="stylesheet" type="text/css" href="/adult.css">';
        }
    } else {
        echo '<link rel="stylesheet" type="text/css" href="/adult.css">';
    }
    ?>
    
    <style>
        .card-columns {
            column-count: 1;
        }
            #myVideo {
            position: fixed;
            right: 0;
            bottom: 0;
            min-width: 100%; 
            min-height: 100%;
        }
    </style>
</head>

<body id='body' class="<?php echo $_COOKIE['color'] ?>">
    <video autoplay muted loop id="myVideo">
        <source src="https://anilist.co/video/hero.webm" type="video/mp4">
        <source src="https://anilist.co/video/hero.mp4" type="video/mp4">
    </video>
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <div class="input-group shadow">
                    <input class="form-control form-control-lg border-0 bg-white" id="search_box" type="text"
                        placeholder="Search">
                    <div class="input-group-append" id="close_modal">
                        <button class="btn bg-white boder-0" type="button" id="close_modal_button"><i
                                class="fas fa-times-circle"></i></button>
                    </div>
                </div>
                <div class="progress bg-transparent" style="height: 0.5rem">
                    <div id="search_progress" class="progress-bar" role="progressbar" style="width: 0%"></div>
                </div>
            </div>
        </div>
        <div class="row pt-3">
            <div class="card-columns col-12" id="card-columns">
            </div>
        </div>
        <div class="row pt-2">
            <div id="seemore_parent" class="col-12">
            </div>
        </div>
    </div>
    <div id='login' class='fixed-bottom'>
    </div>
</body>
<script src="/toast.js"></script>

</html>