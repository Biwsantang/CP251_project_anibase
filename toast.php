<?php
session_start();
if (!isset($_SESSION['level'])) {
    $signintext= "<a id='signin' href='/manager.php'>Sign In📝</a>";
    $withtext= "with Google";
    $premium_color="badge-warning";
} else {
    
    $signintext= "<a id='signout' href='/manager.php'>Manage⚙️</a>";
    $withtext= "as ".$_SESSION['email'];
    $premium_color="badge-success";
}
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="google-signin-client_id" content="378364946748-kp0gpj590v2i7ist8b5ptohadlp1cesb.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
</head>
<div aria-live="polite" aria-atomic="true">
    <div style="position: absolute; bottom: 0; right: 0;" class="p-1 pb-2">
    <div id="show" style="width: 0rem" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false">
    <div class="toast-header">
        <div id="signin_header">Sign in <?php echo $withtext?></div>
        <button type="button" class="ml-auto mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div id="signin_toast" class="toast-body">
    <?php echo $signintext ?>
    <a href='/donate.php' target="_blank" target="popup" 
  onclick="window.open('/donate.php','popup','width=504,height=760'); return false;">donate💰</a>
    </div>
    </div>

    <div id="show1" class="toast bg-transparent" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false">
    <div class="toast-header d-flex bg-transparent">
        <span id="permium_badge" class="badge <?php echo $premium_color ?> ml-auto">Premium</span>
    </div>
    </div>
    </div>
</div>
</body>
</html>