@extends('cms.parent')

@section('title', 'إعدادات')

@section('styles')

@endsection

@section('sub-title', 'إعدادات')

@section('main-content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">


        <div class="m-content">
            <!--begin::Form-->
            <form action="">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="m-portlet m-portlet--tab">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            إعدادات
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                @foreach($socials as $social)
                                    @switch($social->key)
                                        @case('phone')
                                            <div class="form-group m-form__group row mb-25">
                                                <label for="phone" class="col-3 col-form-label">الهاتف</label>
                                                <div class="col-9">
                                                    <input class="form-control m-input" type="text" placeholder="phone" value="{{$social->value}}" id="phone">
                                                </div>
                                            </div>
                                        @break
                                        @case('email')
                                            <div class="form-group m-form__group row mb-25">
                                                <label for="email" class="col-3 col-form-label">البريد الإلكتروني</label>
                                                <div class="col-9">
                                                    <input class="form-control m-input" type="email" placeholder="email" value="{{$social->value}}" id="email">
                                                </div>
                                            </div>
                                        @break
                                        @case('facebook')
                                            <div class="form-group m-form__group row mb-25">
                                                <label for=facebook" class="col-3 col-form-label"> الفيسبوك</label>
                                                <div class="col-9">
                                                    <input class="form-control m-input" type="text" placeholder="رابط Facebook" value="{{$social->value}}" id="facebook">
                                                </div>
                                            </div>
                                        @break
                                        @case('about_us')
                                            <div class="form-group m-form__group row mb-25">
                                                <label for="about_us" class="col-3 col-form-label">نظرة عن المستشفى</label>
                                                <div class="col-9">
                                                    <textarea class="form-control m-input" type="text" placeholder="about_us" id="about_us">{{$social->value}}</textarea>
                                                </div>
                                            </div>
                                        @break
                                        @case('board_directors')
                                        <div class="form-group m-form__group row mb-25">
                                            <label for="board_directors" class="col-3 col-form-label">مجلس الإدارة</label>
                                            <div class="col-9">
                                                <textarea class="form-control m-input" type="text" placeholder="" id="board_directors">{{$social->value}}</textarea>
                                            </div>
                                        </div>
                                        @break
                                        @case('reservation_email')
                                        <div class="form-group m-form__group row mb-25">
                                            <label for="reservation_email" class="col-3 col-form-label">اللإيميل الحجوزات</label>
                                            <div class="col-9">
                                                <textarea class="form-control m-input" type="text" placeholder="" id="reservation_email">{{$social->value}}</textarea>
                                            </div>
                                        </div>
                                        @break
                                    @endswitch
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="m-portlet m-portlet--tab">
                            <div class="m-portlet__body">
                                <div class="m-portlet__head-title col-sm-12">
                                    <button type="button" onclick="save()" class="btn btn-success col-sm-12">حفظ</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!--end::Form-->
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function save(subject) {
        axios.put('/panel/admin/settings/update', {
            'phone' : document.getElementById('phone').value,
            'reservation_email' : document.getElementById('reservation_email').value,
            'email' : document.getElementById('email').value,
            'facebook' : document.getElementById('facebook').value,
            'about_us' : document.getElementById('about_us').value,
            'board_directors' : document.getElementById('board_directors').value,

        })
            .then(function (response) {
                console.log(response);
                showConfirm(response.data.message, true);
                document.getElementById('id').value = response.data.id;
            })
            .catch(function (error) {
                console.log(error);
                showConfirm(error.response.data.message, false);
            });
    }
    function showConfirm(message, status){
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": true,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        if (status){
            toastr.success(message);
        }else
            toastr.error(message);
    }
</script>
@endsection
