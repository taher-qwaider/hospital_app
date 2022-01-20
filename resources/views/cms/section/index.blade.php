@extends('cms.parent')

@section('title', 'القسام')

@section('styles')
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/js/toastr/build/toastr.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('sub-title', 'القسام')

@section('main-content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <div class="m-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="m-portlet m-portlet--tab">
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group row align-items-center">
{{--                                <div class="col-md-4">--}}
{{--                                    <div class="m-input-icon m-input-icon--left">--}}
{{--                                        <input type="text" class="form-control m-input" placeholder="بحث..."--}}
{{--                                               id="generalSearch">--}}
{{--                                        <span class="m-input-icon__icon m-input-icon__icon--left">--}}
{{--                                            <span><i class="la la-search"></i></span>--}}
{{--                                        </span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="my_datatable">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>الأسم</th>
                                            <th>إعدادات</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/toastr/build/toastr.min.js') }}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('assets/js/datatables.bundle.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(function () {
            var table = $('.my_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('sections.list') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    // {data: 'email', name: 'email'},
                    // {data: 'phone', name: 'phone'},
                    // {data: 'section.full_name', name: 'section.full_name'},
                    // {data: 'gender', name: 'gender'},
                    // {data: 'city.name', name: 'city.name'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });

        });
    </script>

    <script>

        function showAlert(id){
            Swal.fire({
                title: 'هل انت متأكد',
                text: "لن تستطيع المستخدم",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'إحذف'
            }).then((result) => {
                if (result.isConfirmed) {
                    destroy(id);
                }
            })
        }
        function destroy(id){
            axios.delete('/panel/admin/sections/'+id)
                .then(function (response) {
                    console.log(response.data.message);
                    showConfirm(response.data.message, true);
                    window.location.href = '';
                })
                .catch(function (error) {
                    console.log(error.response.data.message);
                    showConfirm(error.response.data.message, false);
                })
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
