@extends('cms.parent')

@section('title', 'الصلاحيات')

@section('styles')

@endsection

@section('sub-title', 'الصلاحيات')

@section('main-content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <div class="m-content">
            <!--begin::Form-->
            <form action="">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="m-portlet m-portlet--tab">
                            <div class="m-portlet__body">
                                <div class="form-group">
                                    <h5>دورات الادارة</h5>
                                    <fieldset>
                                        <legend>
{{--                                            <label class="m-checkbox">--}}
{{--                                                <input type="checkbox" class="checkAll" id="checkAll">--}}
{{--                                                <span class="first"></span>--}}
{{--                                            </label>--}}
                                        </legend>
                                        <div class="row">
                                            @foreach($permissions->where('guard_name', 'admin') as $permission)
                                                <div class="col-md-6 mb-4">
                                                    <label class="m-checkbox">
                                                        <input type="checkbox" @if($permission->active) checked  @endif onclick="add('{{ $permission->id }}')"> {{ $permission->name }}
                                                        <span></span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="m-portlet m-portlet--tab mb-25">
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
    <script src="{{ asset('assets/js/jquery.tagsinput.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}" type="text/javascript"></script>
    <script>
        const ids = [];
        $(".checkAll").click(function () {
            $(this).closest('.form-group').find('input:checkbox').not(this).prop('checked', this.checked);
        });

        function add(id){
            if (ids.find(e => e === id)){
                ids.pop(id);
            }else {
                ids.push(id);
            }
        }
    </script>
    <script>
        function save(id){
            axios.post('/panel/admin/roles/'+id+'/permissions', {
                ids:ids,
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
