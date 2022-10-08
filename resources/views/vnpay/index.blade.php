<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Tạo mới đơn hàng</title>
        <style>
            /* Space out content a bit */
            body {
            padding-top: 20px;
            padding-bottom: 20px;
            }

            /* Everything but the jumbotron gets side spacing for mobile first views */
            .header,
            .marketing,
            .footer {
            padding-right: 15px;
            padding-left: 15px;
            }

            /* Custom page header */
            .header {
            padding-bottom: 20px;
            border-bottom: 1px solid #e5e5e5;
            }
            /* Make the masthead heading the same height as the navigation */
            .header h3 {
            margin-top: 0;
            margin-bottom: 0;
            line-height: 40px;
            }

            /* Custom page footer */
            .footer {
            padding-top: 19px;
            color: #777;
            border-top: 1px solid #e5e5e5;
            }

            /* Customize container */
            @media (min-width: 768px) {
            .container {
                max-width: 970px;
            }
            }
            .container-narrow > hr {
            margin: 30px 0;
            }

            /* Main marketing message and sign up button */
            .jumbotron {
            text-align: center;
            border-bottom: 1px solid #e5e5e5;
            }
            .jumbotron .btn {
            padding: 14px 24px;
            font-size: 21px;
            }

            /* Supporting marketing content */
            .marketing {
            margin: 40px 0;
            }
            .marketing p + h4 {
            margin-top: 28px;
            }

            /* Responsive: Portrait tablets and up */
            @media screen and (min-width: 768px) {
            /* Remove the padding we set earlier */
            .header,
            .marketing,
            .footer {
                padding-right: 0;
                padding-left: 0;
            }
            /* Space out the masthead */
            .header {
                margin-bottom: 30px;
            }
            /* Remove the bottom border on the jumbotron for visual effect */
            .jumbotron {
                border-bottom: 0;
            }
            }
            .pay-success{ color: blue;}
            .pay-unsuccess{ color:black;}
            .pay-error{ color:red;}
            .footer{text-align:center}
            /* Pager */
            .pager
            {
                margin: 8px 3px;
                padding: 3px;
            }

            .pager .disabled
            {
                border: 1px solid #ddd;
                color: #999;
                margin-top: 4px;
                padding: 3px;
                text-align: center;
            }

            .pager .current
            {
                background-color: #6ea9bf;
                border: 1px solid #6e99aa;
                color: #fff;
                font-weight: bold;
                margin-top: 4px;
                padding: 3px 5px;
                text-align: center;
            }

            .pager span, .pager a
            {
                margin: 4px 3px;
            }

            .pager a
            {
                border: 1px solid #aaa;
                padding: 3px 5px;
                text-align: center;
                text-decoration: none;
            }
        </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <!-- Bootstrap core CSS -->
        <!-- <link href="{{ URL::to('/vnpay_php/assets/bootstrap.min.css') }}" rel="stylesheet"/> -->
        <!-- Custom styles for this template -->
        <!-- <link href="{{ URL::to('/vnpay_php/assets/jumbotron-narrow.css') }}" rel="stylesheet">   -->
        <!-- <script src="{{ URL::to('/vnpay_php/assets/jquery-1.11.3.min.js') }}"></script> -->
    </head>

    <body>
        @include('vnpay.config')
        <div class="container">
            <div class="header clearfix">
                <h3 class="text-muted">VNPAY DEMO</h3>
            </div>
            <h3>Tạo mới đơn hàng</h3>
            <div class="table-responsive">
                <form action="{{ route('payment.online') }}" id="create_form" method="post">
                    @csrf
                    <input type="hidden" name='vnp_TxnRef' value="{{$code_length}}">
                    <input type="hidden" name="email" value="{{$email}}">
                    <div class="form-group">
                        <label for="language">Loại hàng hóa </label>
                        <select name="order_type" id="order_type" class="form-control">
                            <option value="topup">Nạp tiền điện thoại</option>
                            <option value="billpayment">Thanh toán hóa đơn</option>
                            <option value="fashion">Thời trang</option>
                            <option value="other">Khác - Xem thêm tại VNPAY</option>
                        </select>
                    </div>
                    <!-- <div class="form-group">
                        <label for="bill_id">Mã hóa đơn</label>
                        <input class="form-control" id="bill_id" name="order_id" type="text" value=""/>
                    </div> -->
                    <div class="form-group">
                        <label for="amount">Số tiền</label>
                        <input disabled class="form-control" id="amount"
                               name="amount" type="number" value="{{ $totalBill }}"/>
                    </div>
                    <div class="form-group">
                        <label for="order_desc">Nội dung thanh toán</label>
                        <textarea class="form-control" cols="20" id="order_desc" name="order_desc" rows="2">Thanh toán cho đơn hàng: {{$code_length}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="bank_code">Ngân hàng</label>
                        <select name="bank_code" id="bank_code" class="form-control">
                            <option value="">Không chọn</option>
                            <option value="NCB"> Ngan hang NCB</option>
                            <option value="AGRIBANK"> Ngan hang Agribank</option>
                            <option value="SCB"> Ngan hang SCB</option>
                            <option value="SACOMBANK">Ngan hang SacomBank</option>
                            <option value="EXIMBANK"> Ngan hang EximBank</option>
                            <option value="MSBANK"> Ngan hang MSBANK</option>
                            <option value="NAMABANK"> Ngan hang NamABank</option>
                            <option value="VNMART"> Vi dien tu VnMart</option>
                            <option value="VIETINBANK">Ngan hang Vietinbank</option>
                            <option value="VIETCOMBANK"> Ngan hang VCB</option>
                            <option value="HDBANK">Ngan hang HDBank</option>
                            <option value="DONGABANK"> Ngan hang Dong A</option>
                            <option value="TPBANK"> Ngân hàng TPBank</option>
                            <option value="OJB"> Ngân hàng OceanBank</option>
                            <option value="BIDV"> Ngân hàng BIDV</option>
                            <option value="TECHCOMBANK"> Ngân hàng Techcombank</option>
                            <option value="VPBANK"> Ngan hang VPBank</option>
                            <option value="MBBANK"> Ngan hang MBBank</option>
                            <option value="ACB"> Ngan hang ACB</option>
                            <option value="OCB"> Ngan hang OCB</option>
                            <option value="IVB"> Ngan hang IVB</option>
                            <option value="VISA"> Thanh toan qua VISA/MASTER</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="language">Ngôn ngữ</label>
                        <select name="language" id="language" class="form-control">
                            <option value="vn">Tiếng Việt</option>
                            <option value="en">English</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary" id="btnPopup">Xác nhận thanh toán</button>
                    <button type="submit" name="redirect" id="redirect" class="btn btn-default">Quay lại</button>

                </form>
            </div>
            <p>
                &nbsp;
            </p>
            <footer class="footer">
                <p>&copy; VNPAY <?php echo date('Y') ?></p>
            </footer>
        </div>

    </body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
