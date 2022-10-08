<script src="{{ asset('client') }}/js/map.js"></script>
<script src="{{ asset('client') }}/js/vendor/jquery-3.6.0.min.js"></script>
<script src="{{ asset('client') }}/js/vendor/jquery-migrate-3.3.2.min.js"></script>
<!-- Bootstrap framework js -->
<script src="{{ asset('client') }}/js/bootstrap.bundle.min.js"></script>
<!-- jquery.nivo.slider js -->
<script src="{{ asset('client') }}/lib/js/jquery.nivo.slider.js"></script>
<!-- All js plugins included in this file. -->
<script src="{{ asset('client') }}/js/plugins.js"></script>
<!-- Main js file that contents all jQuery plugins activation. -->
<script src="{{ asset('client') }}/js/main.js"></script>
<script>
    $('#btn-timkiem').on('click',function(){
        
    window.location.replace('http://127.0.0.1:8000/cua-hang/tim-kiem/'+$('#timkiem').val())

    })
</script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}

<script>
    $(document).ready(function() {
        $("#show-password").change(function(){
            $(this).prop("checked") ?  $(".upassword").prop("type", "text") : $(".upassword").prop("type", "password");    
        });
    });
</script>
