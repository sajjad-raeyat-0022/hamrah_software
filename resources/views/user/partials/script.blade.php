<script src="{{ asset('/js/jquery.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/fastclick.js') }}"></script>
<script src="{{ asset('/js/adminlte.min.js') }}"></script>
<script src="{{ asset('/js/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('/js/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('/js/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('/js/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('/js/Chart.min.js') }}"></script>
<script src="{{ asset('/js/pages/dashboard2.js') }}"></script>
<script src="{{ asset('/js/demo.js') }}"></script>
<script src="{{ asset('/js/sweetalert.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/js/bootstrap-select.min.js"></script>
<script src="{{ asset('/js/jquery.czMore-latest.js') }}"></script>
<script src="{{ asset('/js/jalaali.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/jquery.Bootstrap-PersianDateTimePicker.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/rating.js') }}"></script>
<script>
    $(function() {
        $(".submit_btn").click(function() {
            // $('.error').hide();
            var message = $("input#message").val();
            var send_message = "true";

            // if (message == "") {
            //     $("label#name_error").show();
            //     $("input#message").focus();
            //     return false;
            // }
            var dataString = 'name='+ message + '&send_message=' + send_message;
            // alert (dataString);return false;
            $.ajax({
            type: "GET",
            url: "",
            data: dataString,
            success: function() {
                $('#contact_form').html("<div id='message'></div>");
                $('#message').html("<h2>Contact Form Submitted!</h2>")
                .append("<p>We will be in touch soon.</p>")
                .hide()
                .fadeIn(1500, function() {
                $('#message').append("<img id='checkmark' src='images/check.png' />");
                });
            }
            });
            return false;
        });
    });
</script>