@extends('admin.layouts.admin')

@section('title', 'پنل مدیریت')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-aqua">
                    <div class="inner">
                      <h3>{{ count($orders) }}</h3>

                      <p>سفارشات</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-cart-arrow-down fa-sm"></i>
                    </div>
                    <a href="{{ route('admin.orders.index') }}" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-green">
                    <div class="inner">
                      <h3>{{ count($courses) }}</h3>

                      <p>دوره ها</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-book fa-sm"></i>
                    </div>
                    <a href="{{ route('admin.courses.index') }}" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-yellow">
                    <div class="inner">
                      <h3>{{ count($users) }}</h3>

                      <p>کاربران ثبت شده</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users fa-sm"></i>
                    </div>
                    <a href="{{ route('admin.users.index') }}" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-red">
                    <div class="inner">
                      <h4>{{ number_format($transactions->sum('amount')) }} تومان</h4>

                      <p>کل درآمد</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-landmark fa-sm"></i>
                    </div>
                    <a href="{{ route('admin.transactions.index') }}" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
                  </div>
                </div>
                <!-- ./col -->
              </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">گزارش ماهانه</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-times"></i></button>
                            </div>
                        </div>

                        <div class="box-footer">
                            <div class="row">
                                <div class="col-sm-3 col-xs-6 mt-3">
                                    <div class="description-block">
                                        <h5 class="description-header text-green">{{ count($successTr) }} <i class="fa fa-caret-up"></i></h5>
                                        <span class="description-text">تعداد فروش</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 col-xs-6">
                                    <div class="description-block border-right">
                                         <span class="description-percentage text-green"><i class="fa fa-caret-up"></i>
                                            {{ count($successTr) }}</span>
                                        <h5 class="description-header">{{ number_format($successTr->sum('amount')) }} تومان</h5>
                                        <span class="description-text">پرداخت های موفق</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 col-xs-6">
                                    <div class="description-block border-right">
                                         <span class="description-percentage text-red"><i class="fa fa-caret-down"></i>
                                            {{ count($unsuccessTr) }}</span>
                                        <h5 class="description-header">{{ number_format($unsuccessTr->sum('amount')) }} تومان</h5>
                                        <span class="description-text">پرداخت های ناموفق</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 col-xs-6">
                                    <div class="description-block border-right">
                                         <span class="description-percentage text-warning">
                                            20%</span>
                                        <h5 class="description-header text-green">{{ number_format($successTr->sum('amount') * 0.20) }} تومان <i class="fa fa-caret-up"></i></h5>
                                        <span class="description-text">میزان سود</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <div class="row">
                <div class="col-md-6">
                    <!-- DIRECT CHAT -->
                    <div class="box box-warning direct-chat direct-chat-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">تماس با ما (ایمیل های ارسال شده)</h3>

                            <div class="box-tools pull-right">
                                <span data-toggle="tooltip" class="label bg-yellow">{{ count($contact_us) }} پیام</span>
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <!-- Conversations are loaded here -->
                            <div class="direct-chat-messages">

                                @foreach ($contact_us as $contact)


                                    <div class="direct-chat-msg">
                                        <div class="direct-chat-info clearfix">
                                            <span class="direct-chat-name pull-right">{{ $contact->name }}</span>
                                            <span
                                                class="direct-chat-timestamp pull-left">{{ verta($contact->created_at) }}</span>
                                        </div>
                                        <!-- /.direct-chat-info -->
                                        <img class="direct-chat-img" src="/img/2730042.png" alt="message user image">
                                        <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            <div class="d-flex justify-content-start">
                                                <b>{{ $contact->subject }}</b>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <b>{{ $contact->email }}</b>
                                            </div>
                                            {{ $contact->text }}

                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>
                                    <hr>
                                @endforeach

                            </div>
                            <!--/.direct-chat-messages-->

                        </div>
                        <!-- /.box-body -->
                        {{-- <div class="box-footer">
                            <form action="#" method="post">
                                <div class="input-group">
                                    <input type="text" name="message" placeholder="پیام..." class="form-control">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-warning btn-flat">ارسال</button>
                                    </span>
                                </div>
                            </form>
                        </div> --}}
                        <!-- /.box-footer-->
                    </div>
                    <!--/.direct-chat -->
                </div>
                <!-- /.col -->

                <div class="col-md-6">
                    <!-- USERS LIST -->
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">آخرین کاربران</h3>

                            <div class="box-tools pull-right">
                                <span class="label label-danger">{{ count($users) }} کاربر</span>
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <ul class="users-list clearfix">

                                @php
                                    foreach ($users as $key => $user):
                                @endphp
                                    <li>
                                        <img style="height: 100px; width:100px" src="@php
                                        if($user->avatar == null){
                                            echo '/img/2730042.png';
                                        }
                                        elseif($user->provider == 'google'){
                                            echo $user->avatar;
                                        }else{
                                            echo $user->avatar;
                                        }
                                        @endphp" alt="User Image">
                                        <a class="users-list-name" href="#">{{ $user->name == null ? $user->phone_number : $user->name }}</a>
                                        <span class="users-list-date">{{ verta($user->created_at) }}</span>
                                    </li>
                                @php
                                    if($key == 3){
                                        break;
                                    }
                                endforeach;
                                @endphp

                            </ul>
                            <!-- /.users-list -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-center">
                            <a href="{{ route('admin.users.index') }}" class="uppercase">نمایش همه کاربران</a>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!--/.box -->
                </div>
                <!-- /.col -->
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">نمرات کسب شده کاربران</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-times"></i></button>
                            </div>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body" id="user_score_table" style="text-align:center;">
                            <div class="table-responsive" style="text-align:center;">
                                <table class="table table-bordered table-striped table-secondary text-center no-margin" style="text-align:center;direction:rtl;">

                                    <thead>
                                        <tr>
                                            <th>ردیف</th>
                                            <th>نام کاربر</th>
                                            <th>نام دوره</th>
                                            <th> نمره کسب شده/ نمره امتحان </th>
                                            <th>دفعات شرکت در آزمون</th>
                                            <th>وضعیت</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users_score as $key => $score)
                                            <tr>
                                                <th>
                                                    {{ $key+1 }}
                                                </th>
                                                <th>
                                                    {{ $score->user->name == null ? 'کاربر گرامی' : $score->user->name }}
                                                </th>
                                                <th>
                                                   {{ $score->course->name }}
                                                </th>
                                                <th>
                                                    {{ $score->total_grade .' از ' .$score->exam->final_grade }}
                                                </th>
                                                <th>
                                                    {{ $score->exam_visit }}
                                                </th>
                                                <th>
                                                    @if ($score->total_grade > $score->exam->final_grade/2)
                                                        <span class="label label-success"> موفق به دریافت مدرک </span>
                                                    @else
                                                        <span class="label label-danger"> ناموفق در دریافت مدرک </span>
                                                    @endif
                                                </th>

                                            </tr>
                                            @php
                                                if($key == 6){
                                                    break;
                                                }
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <div class="box-footer text-center">
                            <a class="uppercase btn text-primary" onclick="prt()"> دریافت خروجی </a>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                </div>
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">آخرین سفارشات</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" id="user_orders_table" style="text-align:center;">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-secondary text-center no-margin" style="text-align:center;direction:rtl;">

                                    <thead>
                                        <tr>
                                            <th>ردیف</th>
                                            <th>نام کاربر</th>
                                            <th>وضعیت</th>
                                            <th>مبلغ</th>
                                            <th>نوع پرداخت</th>
                                            <th>وضعیت پرداخت</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $key => $order)
                                            <tr>
                                                <th>
                                                    {{ $key+1 }}
                                                </th>
                                                <th>
                                                    {{ $order->user->name == null ? 'کاربر' : $order->user->name }}
                                                </th>
                                                <th>
                                                   <span class="label {{ $order->status == 'در انتظار پرداخت' ? 'label-warning' : 'label-success' }}"> {{ $order->status }}</span>
                                                </th>
                                                <th>
                                                    {{ number_format($order->total_amount) }}
                                                </th>
                                                <th>
                                                    {{ $order->payment_type }}
                                                </th>
                                                <th>
                                                   <span class="label {{ $order->payment_status == 'ناموفق' ? 'label-danger' : 'label-success' }}"> {{ $order->payment_status }} </span>
                                                </th>
                                            </tr>
                                            @php
                                                if($key == 6){
                                                    break;
                                                }
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <div class="box-footer text-center">
                            <a href="{{ route('admin.orders.index') }}" class="uppercase">نمایش همه</a>
                            <a class="uppercase btn text-primary mx-3" onclick="prt2()"> دریافت خروجی </a>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">آخرین دوره ها</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <ul class="products-list product-list-in-box">
                                @foreach ($courses as $key => $course)
                                <li class="item">
                                    <div class="product-img">
                                        <img src="{{ url(env('EDU_COURSE_IMAGE_UPLOAD_PATH') . $course->primary_image) }}" alt="Product Image">
                                    </div>
                                    <div class="product-info">
                                        <a href="{{ route('admin.courses.show', ['course' => $course->id]) }}" class="product-title">{{ $course->name }}</a>
                                            <span class="label label-warning pull-left">{{ $course->is_sale ? number_format($course->sale_price) : number_format($course->price) }} تومان</span>
                                            @if ($course->is_sale)
                                            <br>
                                            <span class="label label-danger pull-left">{{ $course->persent_sale }}% تخفیف</span>
                                            @endif

                                        <span class="product-description">
                                            @php
                                            echo $course->description;
                                            @endphp
                                        </span>
                                    </div>
                                </li>
                                @php
                                    if($key == 3){
                                        break;
                                    }
                                @endphp
                                @endforeach
                            </ul>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-center">
                            <a href="{{ route('admin.courses.index') }}" class="uppercase">نمایش همه</a>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                </div>
            </div>



        </section>


        <!-- /.content -->
    </div>
@endsection
@section('javascript-code')
    <script>
        function prt(){
            printJS('user_score_table', 'html')
        }

        function prt2(){
            printJS('user_orders_table', 'html')
        }
    </script>
@endsection

{{-- @section('javascript-code')
    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito',
            '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        function number_format(number, decimals, dec_point, thousands_sep) {
            // *     example: number_format(1234.56, 2, ',', ' ');
            // *     return: '1 234,56'
            number = (number + '').replace(',', '').replace(' ', '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }

        // Area Chart Example
        var ctx = document.getElementById("myAreaChart");
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($labels),
                datasets: [{
                        label: "تراکنش های موفق",
                        lineTension: 0.3,
                        backgroundColor: "rgba(78, 115, 223, 0.05)",
                        borderColor: "rgba(78, 115, 223, 1)",
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointBorderColor: "rgba(78, 115, 223, 1)",
                        pointHoverRadius: 3,
                        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        data: @json($successTransactions),
                    },
                    {
                        label: "تراکنش های ناموفق",
                        lineTension: 0.3,
                        backgroundColor: "rgba(255, 99, 132, 0.05)",
                        borderColor: "rgba(255, 99, 132, 1)",
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(255, 99, 132, 1)",
                        pointBorderColor: "rgba(255, 99, 132, 1)",
                        pointHoverRadius: 3,
                        pointHoverBackgroundColor: "rgba(255, 99, 132, 1)",
                        pointHoverBorderColor: "rgba(255, 99, 132, 1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        data: @json($unsuccessTransactions),
                    }
                ],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            // maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            maxTicksLimit: 5,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return number_format(value) + ' تومان ';
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ' : ' + number_format(tooltipItem.yLabel) + ' تومان ';
                        }
                    }
                }
            }
        });

    </script>

    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito',
            '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        // Pie Chart Example
        var ctx = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["Direct", "Referral", "Social"],
                datasets: [{
                    data: [55, 30, 15],
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 80,
            },
        });

    </script>

@endsection --}}
