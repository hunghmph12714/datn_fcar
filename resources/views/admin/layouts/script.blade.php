s
<!-- jQuery -->
<script src="{{ asset('adminlte') }}/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ 'http://localhost:8000/tuanhophh/app' . '/public/adminlte/' }}plugins/jquery-ui/jquery-ui.min.js">
</script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('ckeditor') }}/ckeditor.js"></script>
<!-- ChartJS -->
<script src="{{ asset('adminlte') }}/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{ asset('adminlte') }}/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="{{ asset('adminlte') }}/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{ asset('adminlte') }}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('adminlte') }}/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{ asset('adminlte') }}/plugins/moment/moment.min.js"></script>
<script src="{{ asset('adminlte') }}/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('adminlte') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{ asset('adminlte') }}/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('adminlte') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte') }}/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
{{-- <script src="{{asset('adminlte')}}/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('adminlte')}}/dist/js/pages/dashboard.js"></script> --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>


{{-- Tổng doanh thu --}}
<script>
var datacot = {
    labels: [`Số tiền nhập (${$('#sotiennhap').val()})`, `Số tiền lãi (${$('#sotienlai').val()})`],
    datasets: [{
        label: 'Tổng doanh thu',
        backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
        ],
        data: [$('#sotiennhap').val(), $('#sotienlai').val()],
    }]
};

var config = {
    type: 'pie',
    data: datacot,
    options: {}
};
var doanhthuchart = new Chart(
    document.getElementById('doanhthuchart'),
    config
);
</script>

{{-- Tổng doanh thu sửa --}}
<script>
var datasuachua = {
    labels: [`Số tiền nhập (${$('#sotiennhapsuachua').val()})`,
        `Số tiền lãi (${$('#sotienlaisuachua').val()})`
    ],
    datasets: [{
        label: 'Tổng doanh thu',
        backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
        ],
        data: [$('#sotiennhapsuachua').val(), $('#sotienlaisuachua').val()],
    }]
}
var configsuachua = {
    type: 'pie',
    data: datasuachua,
    options: {}
};
var doanhthusuachua = new Chart(
    document.getElementById('doanhthusuachua'),
    configsuachua
);
</script>

{{-- Tổng doanh thu bán --}}
<script>
var databan = {
    labels: [`Số tiền nhập (${$('#sotiennhapban').val()})`,
        `Số tiền lãi (${$('#sotienlaiban').val()})`
    ],
    datasets: [{
        label: 'Tổng doanh thu',
        backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
        ],
        data: [$('#sotiennhapban').val(), $('#sotienlaiban').val()],
    }]
}
var configban = {
    type: 'pie',
    data: databan,
    options: {}
};
var doanhthuban = new Chart(
    document.getElementById('doanhthuban'),
    configban
);
</script>
<script>
    $(function() {
        $('#search_date').click(() => {
            var timestart = $('#datetimestart').val()
            var timeend = $('#datetimeend').val()
            //ajax widget
            $.ajax({
                url: 'http://127.0.0.1:8000/api/laydulieutheongay?timestart=' + timestart +
                    '&timeend=' + timeend + '',
                type: 'POST',
                dataType: 'json',
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            }).done(function(ketqua) {
                $('#total_category').text(ketqua.total_category)
                $('#total_product').text(ketqua.total_product)
                $('#total_user').text(ketqua.total_user)
                $('#total_mua_hang').text(ketqua.total_mua_hang)
                $('#total_user').text(ketqua.total_user)
                $('#total_danh_muc_linh_kien').text(ketqua.total_danh_muc_linh_kien)
                $('#total_linh_kien').text(ketqua.total_linh_kien)
                $('#total_dat_lich').text(ketqua.total_dat_lich)

              
                if (ketqua.datasanphamban.length != 0) {
                    $("#listtopdata").empty()
                    ketqua.datasanphamban.forEach(function callback(value, index) {
                        $("#listtopdata").append(
                            ` <li class="list-group-item d-flex justify-content-between align-items-center">

                                    ${value[index]['name']}<span class="badge badge-primary badge-pill">${value[index]['quaty']}</span></li>`
                    );
                })
            } else {
                $("#listtopdata").empty()
            }
            if (ketqua.datanhanvien.length != 0) {
                $("#listtopdatanhanvien").empty()
                ketqua.datanhanvien.forEach(function callback(value, index) {
                    $("#listtopdatanhanvien").append(
                        ` <li class="list-group-item d-flex justify-content-between align-items-center">
                                    ${value[index]['name']}<span class="badge badge-primary badge-pill">${value[index]['quaty']}</span></li>`
                    );
                })
            } else {
                $("#listtopdatanhanvien").empty()
            }
        });
        //ajax chartjs doanh thu
        $.ajax({
            url: 'http://127.0.0.1:8000/api/bieudo',
            type: 'POST',
            dataType: 'json',
            data: {
                timestart: timestart,
                timeend: timeend
            },
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        }).done(function(ketqua) {
            $('#tongdoanhthu').text(ketqua.doanhthutong)

                datacot.datasets[0].data = [ketqua.sotiennhap, ketqua.sotienlai]
                datacot.labels = [`Số tiền nhập (${ketqua.sotiennhap})`,
                    `Số tiền lãi (${ketqua.sotienlai})`
                ]
                doanhthuchart.update()
            });

            //ajax sửa chữa
            $.ajax({
                url: 'http://127.0.0.1:8000/api/bieudosuachua',
                type: 'POST',
                dataType: 'json',
                data: {
                    timestart: timestart,
                    timeend: timeend
                },
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            }).done(function(ketqua) {
                $('#tongdoanhthusuachua').text(ketqua.doanhthutong)

                datasuachua.datasets[0].data = [ketqua.sotiennhap, ketqua.sotienlai]
                datasuachua.labels = [`Số tiền nhập (${ketqua.sotiennhap})`,
                    `Số tiền lãi (${ketqua.sotienlai})`
                ]
                doanhthusuachua.update()
            });

            //ajax bán
            $.ajax({
                url: 'http://127.0.0.1:8000/api/bieudoban',
                type: 'POST',
                dataType: 'json',
                data: {
                    timestart: timestart,
                    timeend: timeend
                },
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            }).done(function(ketqua) {
                $('#doanhthutongban').text(ketqua.doanhthutong)


            databan.datasets[0].data = [ketqua.sotiennhap, ketqua.sotienlai]
            databan.labels = [`Số tiền nhập (${ketqua.sotiennhap})`,
                `Số tiền lãi (${ketqua.sotienlai})`
            ]
            doanhthuban.update()
        });
    })
})
</script>
<script>
$(".js-select2").select2({
    'placeholder': 'Chọn vai trò'
});
</script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    
// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('40b36816c265fa47e39d', {
    cluster: 'ap1'
});
    
var channel = pusher.subscribe('my-channel');
channel.bind('my-event', function(data) {
    var newNotificationHtml = `
                <a href="${data.url}" style="background:#f8f9fa;" class="dropdown-item">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                            ${data.title}
                              
                            </h3>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 1 giây trước
                            <span class="float-right text-sm text-primary"><i class="fa fa-circle" aria-hidden="true"></i></span>   
                        </p>
                        </div>
                    </div>
                </a>
        `;
    $('#dropdown-notification').prepend(newNotificationHtml);
    document.getElementById('NotificationBadge').innerHTML = parseInt(document.getElementById(
        'NotificationBadge').innerHTML) + 1;
    matches = document.title.match(/\d+/);
    matches = parseInt(matches);
    one = parseInt(1);
    add = matches + one;

    var pattern = /\d+/;
    if (pattern.test(document.title)) {
        // update the counter
        document.title = document.title.replace(pattern,   add  );
    } else {
        // prepend the counter
        document.title = "(" + one + ")" + " Thông báo mới";
    }
});
</script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
