@extends('cms.parent')

@section('title', 'تعديل مسؤول')

@section('styles')
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
@endsection

@section('sub-title', 'تعديل مسؤول ')

@section('main-content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <div class="m-content">
            <!--begin::Form-->
            <form action="">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="m-portlet m-portlet--tab">
                            <div class="m-portlet__body">
                                <!--begin::Section-->
                                <div class="form-group m-form__group row mb-25">
                                    <label for="first_name" class="col-3 col-form-label">الاسم</label>
                                    <div class="col-9">
                                        <input class="form-control m-input" type="text" value="{{ $admin->first_name }}" id="first_name">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row mb-25">
                                    <label for="example-text-input" class="col-3 col-form-label">العائلة</label>
                                    <div class="col-9">
                                        <input class="form-control m-input" type="text" value="{{ $admin->last_name }}" id="last_name">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row mb-25">
                                    <label for="example-text-input" class="col-3 col-form-label">البريد الالكتروني</label>
                                    <div class="col-9">
                                        <input class="form-control m-input" type="text" value="{{ $admin->email }}" id="email">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row mb-25">
                                    <label for="example-text-input" class="col-3 col-form-label">الرقم</label>
                                    <div class="col-9">
                                        <input class="form-control m-input" type="tel" value="{{ $admin->phone }}" id="phone">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row mb-25">
                                    <label for="example-text-input" class="col-3 col-form-label">الصورة</label>
                                    <div class="col-9">
                                        <input class="form-control m-input" type="file" placeholder="الصورة" id="image">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row mb-25">
                                    <label for="example-text-input" class="col-3 col-form-label">المدينة</label>
                                    <div class="col-9">
                                        <select class="form-control m-select2" id="city" name="param">
                                            @foreach($cities as $city)
                                                <option value="{{ $city->id }}" @if($admin->city->id == $city->id) selected  @endif>{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row mb-25">
                                    <label for="address" class="col-3 col-form-label">العنوان</label>
                                    <div class="col-9">
                                        <textarea class="form-control m-input" rows="5" type="text" id="address">{{ $admin->address }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="m-portlet m-portlet--tab mb-25">
                            <div class="m-portlet__body">
                                <div class="m-portlet__head-title col-sm-12">
                                    <button type="button" class="btn btn-success col-sm-12" onclick="save({{ $admin->id }})">حفظ</button>
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
    <script src="{{ asset('assets/js/select2.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('#city').select2({
                placeholder: "اختر المدينة",
                dir: "rtl",
                language: {
                    "noResults": function () {
                        return "لا توجد نتائج";
                    }
                }
            });
        });
        $(document).ready(function() {
            $('#level').select2({
                placeholder: "اختر ",
                dir: "rtl",
                language: {
                    "noResults": function () {
                        return "لا توجد نتائج";
                    }
                }
            });
        });
    </script>
    <script>
        function save(id){
            var formData = new FormData();
            formData.append('first_name', document.getElementById('first_name').value);
            formData.append('last_name', document.getElementById('last_name').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('phone', document.getElementById('phone').value);
            formData.append('image', document.getElementById('image').files[0]);
            formData.append('city_id', document.getElementById('city').value);
            formData.append('address', document.getElementById('address').value);
            axios.post('/panel/admin/admins/'+id+'/update', formData)
                .then(function (response) {
                    console.log(response);
                    showConfirm(response.data.message, true);
                    // document.getElementById('name').value = '';
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
