@extends('cms.parent')

@section('title', 'تعديل المحفظ')

@section('styles')
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
@endsection

@section('sub-title', 'تعديل المحفظ ')

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
                                        <input class="form-control m-input" type="text" value="{{ $teacher->first_name }}" id="first_name">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row mb-25">
                                    <label for="example-text-input" class="col-3 col-form-label">العائلة</label>
                                    <div class="col-9">
                                        <input class="form-control m-input" type="text" value="{{ $teacher->last_name }}" id="last_name">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row mb-25">
                                    <label for="example-text-input" class="col-3 col-form-label">البريد الالكتروني</label>
                                    <div class="col-9">
                                        <input class="form-control m-input" type="text" value="{{ $teacher->email }}" id="email">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row mb-25">
                                    <label for="example-text-input" class="col-3 col-form-label">الرقم</label>
                                    <div class="col-9">
                                        <input class="form-control m-input" type="tel" value="{{ $teacher->phone }}" id="phone">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row mb-25">
                                    <label for="example-text-input" class="col-3 col-form-label">الصورة</label>
                                    <div class="col-9">
                                        <input class="form-control m-input" type="file" placeholder="الصورة" id="image">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row mb-25">

                                    <div class="col-1">
                                        <label for="male">Male
                                            <input class="form-control m-input col-md-5" name="gender" type="radio" id="male" @if($teacher->gender == 'M') checked @endif>
                                        </label>
                                        <label for="female">Female
                                            <input class="form-control m-input col-md-4" name="gender" type="radio" id="female" @if($teacher->gender == 'F') checked @endif>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row mb-25">
                                    <label for="level" class="col-3 col-form-label">المرحلة</label>
                                    <div class="col-9">
                                        <select class="form-control m-select2" id="level" name="param">
                                                <option value="A" @if($teacher->teach_level == 'A') selected @endif>الإبتدائية</option>
                                                <option value="B" @if($teacher->teach_level == 'B') selected @endif>الأعدادية</option>
                                                <option value="C" @if($teacher->teach_level == 'C') selected @endif>الثانوية</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row mb-25">
                                    <label for="example-text-input" class="col-3 col-form-label">المدينة</label>
                                    <div class="col-9">
                                        <select class="form-control m-select2" id="city" name="param">
                                            @foreach($cities as $city)
                                                <option value="{{ $city->id }}" @if($teacher->city->id == $city->id) selected  @endif>{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row mb-25">
                                    <label for="address" class="col-3 col-form-label">العنوان</label>
                                    <div class="col-9">
                                        <textarea class="form-control m-input" rows="5" type="text" id="address">{{ $teacher->address }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="m-portlet m-portlet--tab mb-25">
                            <div class="m-portlet__body">
                                <div class="m-portlet__head-title col-sm-12">
                                    <button type="button" class="btn btn-success col-sm-12" onclick="save({{ $teacher->id }})">حفظ</button>
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
            formData.append('gender', document.getElementById('male').checked ? 'M' : 'F');
            formData.append('teach_level', document.getElementById('level').value);
            formData.append('city_id', document.getElementById('city').value);
            formData.append('address', document.getElementById('address').value);
            axios.post('{!! route('teacher.data.update', $teacher->id) !!}', formData)
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
