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
                                    <label for="current_password" class="col-3 col-form-label">كامة المرور الحالية</label>
                                    <div class="col-9">
                                        <input class="form-control m-input" type="password" id="current_password">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row mb-25">
                                    <label for="new_password" class="col-3 col-form-label">كامة المرور الجديدة</label>
                                    <div class="col-9">
                                        <input class="form-control m-input" type="password" id="new_password">
                                    </div>
                                </div>

                                <div class="form-group m-form__group row mb-25">
                                    <label for="new_password_confirmation" class="col-3 col-form-label">تأكيد كامة المرور</label>
                                    <div class="col-9">
                                        <input class="form-control m-input" type="password" id="new_password_confirmation">
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
                    </div>
                </div>
            </form>
            <!--end::Form-->
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        function save(id){
            var formData = new FormData();
            formData.append('current_password', document.getElementById('current_password').value);
            formData.append('new_password', document.getElementById('new_password').value);
            formData.append('new_password_confirmation', document.getElementById('new_password_confirmation').value);

            axios.post('/panel/admin/changePassword', formData)
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
