function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload= function(e) {
            $('#previewHolder').attr('src', e.target.result);

        }


        reader.readAsDataURL(input.files[0]);
    }
}


$("#image").change(function() {
    readURL(this);
});

$(function(){
    var alert = $('#alert');
    if(alert.length > 0){
        alert.hide().slideDown(500);
        alert.find('.close').click(function(e){
            e.preventDefault();
            alert.slideUp();
        })
    }
});

$("#username").keyup(function () {

    var username = $(this).val().trim();

    if (username != '') {

        $.ajax({
            url: '../../check/checkuser.php',
            type: 'post',
            data: { username: username },
            success: function (response) {

                // Show response
                $("#info").html(response);

            }
        });
    } else {
        $("#info").html("");
    }

});

