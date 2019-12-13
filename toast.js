$('#login').ready(function() {
        $('#login').load('/toast.php', function() {
            var toggle = 0;
            $('#show1').toast('show');
            $('#show1').on('click',function() {
                if (toggle == 0) {
                    $('#show').css('width','15rem');
                    $('#show').toast('show');
                } else {
                    $('#show').toast('hide');
                }
            })
        });
    })