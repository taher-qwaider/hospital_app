@extends('cms.parent')

@section('title', 'تعديل الدور')

@section('styles')

@endsection

@section('sub-title', 'تعديل الدور')

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
                                            تعديل الدور
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row mb-25">
                                    <label for="example-text-input" class="col-3 col-form-label">الأسم</label>
                                    <div class="col-9">
                                        <input class="form-control m-input" type="text" value="{{ $role->name }}" id="name">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row mb-25">
                                    <label for="guard" class="col-3 col-form-label">ل</label>
                                    <div class="col-9">
                                        <select class="form-control m-select2" style="width: 200px" id="guard" name="guard">
                                            <option value="admin" @if($role->guard_name == 'admin') selected @endif>مسؤوول</option>
                                            <option value="teacher" @if($role->guard_name == 'teacher') selected @endif>محفظ</option>
                                            <option value="user" @if($role->guard_name == 'user') selected @endif>طالب</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="m-portlet m-portlet--tab">
                            <div class="m-portlet__body">
                                <div class="m-portlet__head-title col-sm-12">
                                    <button type="button" class="btn btn-success col-sm-12" onclick="save({{ $role->id }})">حفظ</button>
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
            $('#guard').select2({
                placeholder: "اختر المدينة",
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
            axios.put('/panel/admin/roles/'+id, {
                name:document.getElementById('name').value,
                guard:document.getElementById('guard').value,
            })
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
