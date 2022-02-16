@extends('cms.parent')

@section('title', 'الرئيسية')

@section('styles')

@endsection

@section('sub-title', 'الرئيسية')

@section('main-content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <div class="m-content">
            <!--Begin::Section-->
            <div class="m-portlet" style="width: 50%">
                <div class="m-portlet__body  m-portlet__body--no-padding">
                    <div class="m-row--no-padding m-row--col-separator-xl">
                        <div class="">

                            <!--begin:: Widgets/Stats2-1 -->
                            <div class="m-widget1">
                                <div class="m-widget1__item">
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col">
                                            <h3 class="m-widget1__title">المستخدمين</h3>
{{--                                            <span class="m-widget1__desc">Awerage Weekly Profit</span>--}}
                                        </div>
                                        <div class="col m--align-right">
                                            <span class="m-widget1__number m--font-brand">{{ $users_count }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-widget1__item">
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col">
                                            <h3 class="m-widget1__title">الدكتورز</h3>
{{--                                            <span class="m-widget1__desc">Weekly Customer Orders</span>--}}
                                        </div>
                                        <div class="col m--align-right">
                                            <span class="m-widget1__number m--font-danger">{{ $doctors_count }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-widget1__item">
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col">
                                            <h3 class="m-widget1__title">القسام</h3>
{{--                                            <span class="m-widget1__desc">System bugs and issues</span>--}}
                                        </div>
                                        <div class="col m--align-right">
                                            <span class="m-widget1__number m--font-success">{{ $sections_count }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--end:: Widgets/Stats2-1 -->
                        </div>
{{--                        <div class="col-xl-4">--}}

{{--                            <!--begin:: Widgets/Daily Sales-->--}}
{{--                            <div class="m-widget14">--}}
{{--                                <div class="m-widget14__header m--margin-bottom-30">--}}
{{--                                    <h3 class="m-widget14__title">--}}
{{--                                        Daily Sales--}}
{{--                                    </h3>--}}
{{--                                    <span class="m-widget14__desc">--}}
{{--													Check out each collumn for more details--}}
{{--												</span>--}}
{{--                                </div>--}}
{{--                                <div class="m-widget14__chart" style="height:120px;">--}}
{{--                                    <canvas id="m_chart_daily_sales"></canvas>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <!--end:: Widgets/Daily Sales-->--}}
{{--                        </div>--}}
{{--                        <div class="col-xl-4">--}}

{{--                            <!--begin:: Widgets/Profit Share-->--}}
{{--                            <div class="m-widget14">--}}
{{--                                <div class="m-widget14__header">--}}
{{--                                    <h3 class="m-widget14__title">--}}
{{--                                        Profit Share--}}
{{--                                    </h3>--}}
{{--                                    <span class="m-widget14__desc">--}}
{{--													Profit Share between customers--}}
{{--												</span>--}}
{{--                                </div>--}}
{{--                                <div class="row  align-items-center">--}}
{{--                                    <div class="col">--}}
{{--                                        <div id="m_chart_profit_share" class="m-widget14__chart" style="height: 160px">--}}
{{--                                            <div class="m-widget14__stat">45</div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col">--}}
{{--                                        <div class="m-widget14__legends">--}}
{{--                                            <div class="m-widget14__legend">--}}
{{--                                                <span class="m-widget14__legend-bullet m--bg-accent"></span>--}}
{{--                                                <span class="m-widget14__legend-text">37% Sport Tickets</span>--}}
{{--                                            </div>--}}
{{--                                            <div class="m-widget14__legend">--}}
{{--                                                <span class="m-widget14__legend-bullet m--bg-warning"></span>--}}
{{--                                                <span class="m-widget14__legend-text">47% Business Events</span>--}}
{{--                                            </div>--}}
{{--                                            <div class="m-widget14__legend">--}}
{{--                                                <span class="m-widget14__legend-bullet m--bg-brand"></span>--}}
{{--                                                <span class="m-widget14__legend-text">19% Others</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <!--end:: Widgets/Profit Share-->--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>

            <!--End::Section-->

            <!--Begin::Section-->
{{--            <div class="row">--}}
{{--                <div class="col-xl-4">--}}

{{--                    <!--begin:: Widgets/Blog-->--}}
{{--                    <div class="m-portlet m-portlet--head-overlay m-portlet--full-height   m-portlet--rounded-force mb-0">--}}
{{--                        <div class="m-portlet__head m-portlet__head--fit">--}}
{{--                            <div class="m-portlet__head-caption">--}}
{{--                                <div class="m-portlet__head-title">--}}
{{--                                    <h3 class="m-portlet__head-text m--font-light">--}}
{{--                                        احصائيات الزوار--}}
{{--                                    </h3>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="m-portlet__head-tools">--}}
{{--                                <div class="m-dropdown__wrapper row">--}}
{{--                                    <div class="col-sm-12">--}}
{{--                                        <select class="form-control m-select2" id="select_1" name="param">--}}
{{--                                            <option value="">10/2018</option>--}}
{{--                                            <option value="1">09/2018</option>--}}
{{--                                            <option value="2">08/2018</option>--}}
{{--                                            <option value="3">07/2018</option>--}}
{{--                                            <option value="4">06/2018</option>--}}
{{--                                            <option value="5">05/2018</option>--}}
{{--                                            <option value="6">05/2018</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="m-portlet__body">--}}
{{--                            <div class="m-widget28">--}}
{{--                                <div class="m-widget28__pic m-portlet-fit--sides"></div>--}}
{{--                                <div class="m-widget28__container">--}}
{{--                                    <ul class="m-widget28__nav-items nav nav-pills nav-fill" role="tablist">--}}
{{--                                        <li class="m-widget28__nav-item nav-item">--}}
{{--                                            <a class="nav-link co-000" data-toggle="pill" href="#menu11"><span><i class="fa flaticon-pie-chart"></i></span><span>عدد الزوار</span></a>--}}
{{--                                        </li>--}}
{{--                                        <li class="m-widget28__nav-item nav-item">--}}
{{--                                            <a class="nav-link co-000" data-toggle="pill" href="#menu21"><span><i class="fa flaticon-file-1"></i></span><span>عدد المشتركين</span></a>--}}
{{--                                        </li>--}}
{{--                                        <li class="m-widget28__nav-item nav-item">--}}
{{--                                            <a class="nav-link co-000" data-toggle="pill" href="#menu31"><span><i class="fa flaticon-clipboard"></i></span><span>عدد المستخدمين</span></a>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                    <!-- end::Nav pills -->--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <!--end:: Widgets/Blog-->--}}
{{--                </div>--}}
{{--                <div class="col-xl-4">--}}

{{--                    <!--begin:: Widgets/Blog-->--}}
{{--                    <div class="m-portlet m-portlet--head-overlay m-portlet--full-height   m-portlet--rounded-force mb-0">--}}
{{--                        <div class="m-portlet__head m-portlet__head--fit">--}}
{{--                            <div class="m-portlet__head-caption">--}}
{{--                                <div class="m-portlet__head-title">--}}
{{--                                    <h3 class="m-portlet__head-text m--font-light">--}}
{{--                                        احصائيات الزوار--}}
{{--                                    </h3>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="m-portlet__head-tools">--}}
{{--                                <div class="m-dropdown__wrapper row">--}}
{{--                                    <div class="col-sm-12">--}}
{{--                                        <select class="form-control m-select2" id="select_2" name="param">--}}
{{--                                            <option value="">10/2018</option>--}}
{{--                                            <option value="1">09/2018</option>--}}
{{--                                            <option value="2">08/2018</option>--}}
{{--                                            <option value="3">07/2018</option>--}}
{{--                                            <option value="4">06/2018</option>--}}
{{--                                            <option value="5">05/2018</option>--}}
{{--                                            <option value="6">05/2018</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="m-portlet__body">--}}
{{--                            <div class="m-widget28">--}}
{{--                                <div class="m-widget28__pic m-portlet-fit--sides"></div>--}}
{{--                                <div class="m-widget28__container">--}}
{{--                                    <ul class="m-widget28__nav-items nav nav-pills nav-fill" role="tablist">--}}
{{--                                        <li class="m-widget28__nav-item nav-item">--}}
{{--                                            <a class="nav-link co-000" data-toggle="pill" href="#menu11"><span><i class="fa flaticon-pie-chart"></i></span><span>عدد الزوار</span></a>--}}
{{--                                        </li>--}}
{{--                                        <li class="m-widget28__nav-item nav-item">--}}
{{--                                            <a class="nav-link co-000" data-toggle="pill" href="#menu21"><span><i class="fa flaticon-file-1"></i></span><span>عدد المشتركين</span></a>--}}
{{--                                        </li>--}}
{{--                                        <li class="m-widget28__nav-item nav-item">--}}
{{--                                            <a class="nav-link co-000" data-toggle="pill" href="#menu31"><span><i class="fa flaticon-clipboard"></i></span><span>عدد المستخدمين</span></a>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <!--end:: Widgets/Blog-->--}}
{{--                </div>--}}
{{--                <div class="col-xl-4">--}}
{{--                    <!--begin:: Widgets/Blog-->--}}
{{--                    <div class="m-portlet m-portlet--head-overlay m-portlet--full-height   m-portlet--rounded-force mb-0">--}}
{{--                        <div class="m-portlet__head m-portlet__head--fit">--}}
{{--                            <div class="m-portlet__head-caption">--}}
{{--                                <div class="m-portlet__head-title">--}}
{{--                                    <h3 class="m-portlet__head-text m--font-light">--}}
{{--                                        احصائيات الزوار--}}
{{--                                    </h3>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="m-portlet__head-tools">--}}
{{--                                <div class="m-dropdown__wrapper row">--}}
{{--                                    <div class="col-sm-12">--}}
{{--                                        <select class="form-control m-select2" id="select_3" name="param">--}}
{{--                                            <option value="">10/2018</option>--}}
{{--                                            <option value="1">09/2018</option>--}}
{{--                                            <option value="2">08/2018</option>--}}
{{--                                            <option value="3">07/2018</option>--}}
{{--                                            <option value="4">06/2018</option>--}}
{{--                                            <option value="5">05/2018</option>--}}
{{--                                            <option value="6">05/2018</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="m-portlet__body">--}}
{{--                            <div class="m-widget28">--}}
{{--                                <div class="m-widget28__pic m-portlet-fit--sides"></div>--}}
{{--                                <div class="m-widget28__container">--}}
{{--                                    <ul class="m-widget28__nav-items nav nav-pills nav-fill" role="tablist">--}}
{{--                                        <li class="m-widget28__nav-item nav-item">--}}
{{--                                            <a class="nav-link co-000" data-toggle="pill" href="#menu11"><span><i class="fa flaticon-pie-chart"></i></span><span>عدد الزوار</span></a>--}}
{{--                                        </li>--}}
{{--                                        <li class="m-widget28__nav-item nav-item">--}}
{{--                                            <a class="nav-link co-000" data-toggle="pill" href="#menu21"><span><i class="fa flaticon-file-1"></i></span><span>عدد المشتركين</span></a>--}}
{{--                                        </li>--}}
{{--                                        <li class="m-widget28__nav-item nav-item">--}}
{{--                                            <a class="nav-link co-000" data-toggle="pill" href="#menu31"><span><i class="fa flaticon-clipboard"></i></span><span>عدد المستخدمين</span></a>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!--end:: Widgets/Blog-->--}}
{{--                </div>--}}
{{--            </div>--}}
            <!--End::Section-->

            <!--Begin::Section-->
            <div class="row">
                <div class="col-xl-6 col-lg-12">

                    <!--Begin::Portlet-->


                    <!--End::Portlet-->
                </div>
            </div>

            <!--End::Section-->

        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/dashboard.js') }}" type="text/javascript"></script>

    <script src="{{ asset('assets/js/select2.js') }}" type="text/javascript"></script>

    <script>

        $(document).ready(function() {
            $('#select_1').select2({
                placeholder: "اختر السنة",
                dir: "rtl",

                language: {
                    "noResults": function () {
                        return "لا توجد نتائج";
                    }
                }
            });


            $('#select_2').select2({
                placeholder: "اختر السنة",
                dir: "rtl",

                language: {
                    "noResults": function () {
                        return "لا توجد نتائج";
                    }
                }
            });
            $('#select_3').select2({
                placeholder: "اختر السنة",
                dir: "rtl",

                language: {
                    "noResults": function () {
                        return "لا توجد نتائج";
                    }
                }
            });

        });



    </script>
@endsection
