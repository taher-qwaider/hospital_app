@extends('cms.parent')

@section('title', 'الأقسام الطبية')

@section('styles')
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
@endsection

@section('sub-title', 'الأقسام الطبية')

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
                                    <label for="name" class="col-3 col-form-label">الإسم</label>
                                    <div class="col-9">
                                        <input class="form-control m-input" type="text" placeholder="الإسم" id="name">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row mb-25">
                                    <label for="body" class="col-3 col-form-label">الوصف</label>
                                    <div class="col-9">
                                        <textarea class="form-control m-input" type="text" id="body"></textarea>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row mb-25">
                                    <label for="image" class="col-3 col-form-label">الصورة</label>
                                    <div class="col-9">
                                        <input class="form-control m-input" type="file" placeholder="الصورة" id="image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="m-portlet m-portlet--tab mb-25">
                            <div class="m-portlet__body">
                                <div class="m-portlet__head-title col-sm-12">
                                    <button type="button" class="btn btn-success col-sm-12" onclick="save()">حفظ</button>
                                </div>
                            </div>
                        </div>
{{--                        <div class="m-portlet m-portlet--tab mb-25">--}}
{{--                            <div class="m-portlet__body">--}}
{{--                                <label class="col-form-label col-sm-12">اختر صورة</label>--}}
{{--                                <div class="col-sm-12">--}}
{{--                                    <div class="m-dropzone dropzone" action="inc/api/dropzone/upload.php" id="m-dropzone-one">--}}
{{--                                        <div class="m-dropzone__msg dz-message needsclick">--}}
{{--                                            <h3 class="m-dropzone__msg-title">اضغط هنا لاختيار الصورة</h3>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
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
        function save(){
            var formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('body', document.getElementById('body').value);
            formData.append('image', document.getElementById('image').files[0]);
            axios.post('{!! route('medicalSections.store') !!}', formData)
                .then(function (response) {
                    console.log(response);
                    showConfirm(response.data.message, true);
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
