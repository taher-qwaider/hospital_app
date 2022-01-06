@extends('cms.parent')

@section('title', 'إنشاء مستخدم')

@section('styles')
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
@endsection

@section('sub-title', 'إنشاء')

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
                                    <label for="date" class="col-3 col-form-label">التاريخ</label>
                                    <div class="col-9">
                                        <input class="form-control m-input" type="date" placeholder="التاريخ" id="date">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row mb-25">
                                    <label for="saved" class="col-3 col-form-label">الحفظ</label>
                                    <div class="col-9">
                                        <input class="form-control m-input" type="text" placeholder="الحفظ" id="saved">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row mb-25">
                                    <label for="revision" class="col-3 col-form-label">المراجعة</label>
                                    <div class="col-9">
                                        <input class="form-control m-input" type="text" placeholder="المراجعة" id="revision">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row mb-25">
                                    <label for="city" class="col-3 col-form-label">الحالة</label>
                                    <div class="col-9">
                                        <select class="form-control m-select2" id="status" name="param">
                                                <option value="A">حاضر</option>
                                                <option value="N">غائب</option>
                                                <option value="M">مأذون</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row mb-25">
                                    <label for="address" class="col-3 col-form-label">التقيم</label>
                                    <div class="col-9">
                                        <input class="form-control m-input" type="number" min="1" max="5" value="5" id="rate">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="m-portlet m-portlet--tab mb-25">
                            <div class="m-portlet__body">
                                <div class="m-portlet__head-title col-sm-12">
                                    <button type="button" class="btn btn-success col-sm-12" onclick="save({!! $user->id !!})">حفظ</button>
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
            $('#status').select2({
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
            var formData = new FormData();
            formData.append('date', document.getElementById('date').value);
            formData.append('saved', document.getElementById('saved').value);
            formData.append('revision', document.getElementById('revision').value);
            formData.append('status', document.getElementById('status').value);
            formData.append('rate', document.getElementById('rate').value);
            axios.post('{!! route('users.homeworks.create', $user->id) !!}', formData)
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
