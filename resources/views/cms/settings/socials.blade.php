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
                                                <label for="googlePlay" class="col-3 col-form-label">رابط Google Play</label>
                                                <div class="col-9">
                                                    <input class="form-control m-input" type="text" placeholder="phone" value="{{$social->value}}" id="phone">
                                                </div>
                                            </div>
                                        @break
                                        @case('email')
                                            <div class="form-group m-form__group row mb-25">
                                                <label for="appStore" class="col-3 col-form-label">رابط App Store</label>
                                                <div class="col-9">
                                                    <input class="form-control m-input" type="email" placeholder="email" value="{{$social->value}}" id="email">
                                                </div>
                                            </div>
                                        @break
                                        @case('facebook')
                                            <div class="form-group m-form__group row mb-25">
                                                <label for=facebook" class="col-3 col-form-label">رابط Facebook</label>
                                                <div class="col-9">
                                                    <input class="form-control m-input" type="text" placeholder="رابط Facebook" value="{{$social->value}}" id="facebook">
                                                </div>
                                            </div>
                                        @break
                                        @case('about_us')
                                            <div class="form-group m-form__group row mb-25">
                                                <label for="youtube" class="col-3 col-form-label">رابط Youtube</label>
                                                <div class="col-9">
                                                    <textarea class="form-control m-input" type="text" placeholder="about_us" value="{{$social->value}}" id="about_us"></textarea>
                                                </div>
                                            </div>
                                        @break
                                        @case('board_directors')
                                        <div class="form-group m-form__group row mb-25">
                                            <label for="youtube" class="col-3 col-form-label">board_directors</label>
                                            <div class="col-9">
                                                <textarea class="form-control m-input" type="text" placeholder="board_directors" value="{{$social->value}}" id="board_directors"></textarea>
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
        axios.put('/panel/admin/settings/'+subject, {
            @foreach($socials as $social)
                '{!! $social->key !!}' : document.getElementById('{!! $social->key !!}').value,
            @endforeach
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
