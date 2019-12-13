<?php
    session_start();
    if (empty($_GET["id"])) {
        header("Location: /index.php");
    }
    else {
        $id = $_GET["id"];
    }
    if (isset($_SESSION['level'])) {
        header("Location: /p/anime.php?id=$id");
    }

    $base_url = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on' ? 'https' : 'http' ) . '://' .  $_SERVER['HTTP_HOST'];
    $url = $base_url . $_SERVER["REQUEST_URI"];
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
    <script src="/info.js"></script>
    <script src="/search.js"></script>
    <link rel="stylesheet" type="text/css" href="/adult.css">
    <style>
        img:not([src]) {
            /*display: none;*/
            height: 20vw;
        }

        @media (min-width: 768px) {
            .mt-md-cover {
                margin-top: -10rem !important;
            }
        }

        .card-columns {
            column-count: 1;
        }
    </style>
</head>

<body>
    <nav class="navbar sticky-top navbar-light justify-content-between">
        <a class="navbar-brand text-black" href="/index.php">
            Anibase
        </a>
        <a class="navbar-brand">
            <span>
                <i class="fas fa-search" data-toggle="modal" data-target="#search_modal"></i>
            </span>
        </a>
    </nav>
    <div class="container-fluid">
        <div id="bannerImage_parant" class="row">
            <div class="mx-auto d-none d-md-block">
                <img id="bannerImage" src="" class="img-fluid">
            </div>
        </div>
        <div class="container py-3">
            <div class="row rounded-lg">
                <div class="col-md-3">
                    <img id="coverImage_extraLarge" class="img-fluid mx-auto d-block shadow mt-md-cover rounded-lg">
                </div>
                <div class="col-md-9">
                    <div class="pt-4">
                        <h2 id="title_main">--------</h2>
                        <h4 id="title_second" class="text-muted">----</h4>
                        <h6 id="adult_tag"></h6>
                        <p id="description"></p>
                    </div>
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-md-3 rounded-lg mb-3">
                    <div class="p-3 d-flex d-md-block overflow-auto text-nowrap">
                        <div class="pr-4 pb-0 pb-md-3">
                            <small class="text-muted">Format</small>
                            <div id="format"></div>
                        </div>
                        <div class="pr-4 pb-0 pb-md-3">
                            <small class="text-muted">Episodes</small>
                            <div id="episodes">-</div>
                        </div>
                        <div class="pr-4 pb-0 pb-md-3">
                            <small class="text-muted">Episode Duration</small>
                            <div id="duration">-</div>
                        </div>
                        <div class="pr-4 pb-0 pb-md-3">
                            <small class="text-muted">Status</small>
                            <div id="status">-</div>
                        </div>
                        <div class="pr-4 pb-0 pb-md-3">
                            <small class="text-muted">Start Date</small>
                            <div id="startDate">-</div>
                        </div>
                        <div class="pr-4 pb-0 pb-md-3">
                            <small class="text-muted">End Date</small>
                            <div id="endDate">-</div>
                        </div>
                        <div class="pr-4 pb-0 pb-md-3">
                            <small class="text-muted">Season</small>
                            <div id="season">-</div>
                        </div>
                        <div class="pr-4 pb-0 pb-md-3">
                            <small class="text-muted">Studio</small>
                            <div id="studios_nodes_name">-</div>
                        </div>
                        <div class="pr-4 pb-0 pb-md-3">
                            <small class="text-muted">Genres</small>
                            <div id="genres">-</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 mb-3">
                    <!--<div class="form-group">
                        <label for="comment_box">Review</label>
                        <textarea class="form-control bg-light border-0 rounded-lg" id="comment_box" rows="3"></textarea>
                        <div class="d-flex flex-row-reverse mt-2">
                            <button class="btn btn-primary ml-2" type="button">Post</button>
                            <span id="char_counter" class="badge align-self-center ml-2">250</span>
                        </div>
                    </div>--->
                    <div id="disqus_thread"></div>
                    <script>
                    /**
                    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
                    function disqus_start(title) {
                    var title = title;
                    console.log('comment on '+title);
                    var disqus_config = function () {
                    //this.page.url = '<?php Print($url); ?>'; // Replace PAGE_URL with your page's canonical URL variable
                    this.page.identifier = <?php Print($id); ?>;
                    this.page.title = title;
                     // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                    };
                    
                    (function() { // DON'T EDIT BELOW THIS LINE
                    var d = document, s = d.createElement('script');
                    s.src = 'https://biwsantang.disqus.com/embed.js';
                    s.setAttribute('data-timestamp', +new Date());
                    (d.head || d.body).appendChild(s);
                    })();
                }
                    </script>
                    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                </div>
            </div>
        </div>
    </div>
    <div id="search_modal" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl ">
            <div class="modal-content bg-transparent border-0">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="input-group shadow">
                                <input class="form-control form-control-lg border-0 bg-white" id="search_box" type="text"
                                    placeholder="Search">
                                <div class="input-group-append bg-white" id="close_modal">
                                    <button class="btn boder-0" type="button" id="close_modal_button"><i
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
            </div>
        </div>
    </div>
    <div id='login' class='fixed-bottom'></div>
</body>
<script src="/toast.js"></script>
<script>
    info( <?php Print($id); ?> );
    
</script>

</html>