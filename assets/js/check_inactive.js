$(document).ready(function() {
    setInterval(function() {
        $.ajax({
            type: 'GET',
            async: true,
            url: '/assets/includes/checkinactive.ajax.php',
            success: function(response) {
                if (response == 'logout_redirect') {
                    location.href = "/login/";
                } else
                //if (response == 'session_issue') {
                    //location.reload(true);
                //}
            }
        });
    }, 5000);
});
