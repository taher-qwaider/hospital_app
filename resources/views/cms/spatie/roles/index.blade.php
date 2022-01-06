@extends('cms.parent')

@section('title', 'دور')

@section('styles')
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/js/toastr/build/toastr.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('sub-title', 'دور')

@section('main-content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <div class="m-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="m-portlet m-portlet--tab">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        <button type="button" class="btn btn-success" data-toggle="modal"
                                                data-target="#m_modal_6"><i class="fa fa-plus pr-2 pt-1"></i>اضافة دور
                                        </button>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group row align-items-center">
                                <div class="col-md-4">
                                    <div class="m-input-icon m-input-icon--left">
                                        <input type="text" class="form-control m-input" placeholder="بحث..."
                                               id="generalSearch">
                                        <span class="m-input-icon__icon m-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="my_datatable"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('popScreen')
    <div class="modal fade" id="m_modal_6" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">إنشاء دور</h5>
                    <button type="button" class="close pt-4" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group m-form__group mb-25">
                        <label for="name">الاسم :</label>
                        <input type="text" class="form-control m-input" id="name" placeholder="الاسم">
                    </div>
                    <div class="form-group m-form__group row mb-25">
                        <label for="guard" class="col-3 col-form-label">ل</label>
                        <div class="col-9">
                            <select class="form-control m-select2" style="width: 200px" id="guard" name="guard">
                                <option value="admin">مسؤوول</option>
                                <option value="teacher">محفظ</option>
                                <option value="user">طالب</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary m-btn m-btn--custom" data-dismiss="modal">الغاء
                    </button>
                    <button type="button" class="btn btn-primary m-btn m-btn--custom" onclick="save()">حفظ</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/toastr/build/toastr.min.js') }}" type="text/javascript"></script>
    {{--    <script src="{{ asset('assets/js/toastr.js') }}" type="text/javascript"></script>--}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('assets/js/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
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
        $(document).ready(function () {
            $('.my_datatable').mDatatable({
                data: {
                    type: 'remote',
                    source: {
                        read: {
                            url: '{{ route('role.list') }}',
                            "columnDefs": [{
                                "targets": -1,
                                "data": null,
                                "defaultContent":
                                    '<button class="btn-view" type="button">View Posted Jobs</button>'
                                    + '<button class="btn-delete"  type="button">Delete</button>'
                            }],
                            method: 'GET',
                            // custom headers

                            params: {
                                // custom parameters
                                generalSearch: '',
                                EmployeeID: 1,
                                someParam: 'someValue',
                                token: 'token-value'
                            },
                            map: function (raw) {
                                // sample data mapping
                                var dataSet = raw;
                                if (typeof raw.data !== 'undefined') {
                                    dataSet = raw.data;
                                }
                                return dataSet;
                            },
                        }
                    },
                    pageSize: 10,
                    saveState: {
                        cookie: true,
                        webstorage: true
                    },

                    serverPaging: false,
                    serverFiltering: false,
                    serverSorting: false,
                    autoColumns: false
                },

                layout: {
                    theme: 'default',
                    class: 'm-datatable--brand',
                    scroll: true,
                    height: null,
                    footer: false,
                    header: true,
                    smoothScroll: {
                        scrollbarShown: true
                    },
                    spinner: {
                        overlayColor: '#000000',
                        opacity: 0,
                        type: 'loader',
                        state: 'brand',
                        message: true
                    },
                    icons: {
                        sort: {asc: 'la la-arrow-up', desc: 'la la-arrow-down'},
                        pagination: {
                            next: 'la la-angle-right',
                            prev: 'la la-angle-left',
                            first: 'la la-angle-double-left',
                            last: 'la la-angle-double-right',
                            more: 'la la-ellipsis-h'
                        },
                        rowDetail: {expand: 'fa fa-caret-down', collapse: 'fa fa-caret-right'}
                    }
                },
                sortable: true,
                pagination: true,
                search: {
                    // enable trigger search by keyup enter
                    onEnter: false,
                    // input text for search
                    input: $('#generalSearch'),
                    // search delay in milliseconds
                    delay: 400,
                },
                rows: {
                    callback: function () {
                    },
                    // auto hide columns, if rows overflow. work on non locked columns
                    autoHide: false,
                },
                // columns definition
                columns: [{
                    field: "id",
                    title: "id",
                    sortable: true,
                    width: 40,
                }, {
                    field: "name",
                    title: "الإسم",
                    sortable: 'asc',
                    filterable: true,
                    sortable: true,
                }, {
                    field: "guard_name",
                    title: "ل",
                    sortable: 'asc',
                    filterable: true,
                    sortable: true,
                },
                    {
                        field: "permission",
                        title: "الصلاحيات",
                        sortable: false,
                        template: function (row){
                            return `
                                <div class="d-inline-flex">
                                    <a href="/panel/admin/roles/` + row.id + `/permissions" class="btn btn-dark m-btn--custom d-flex align-items-center justify-content-center fs-10 p-3 w-100 h-30 mr-3">
                                        <i class="fa fa-user pr-2 fs-10"></i><span>الصلاحيات</span>
                                    </a>
                                </div>
                            `
                        }
                    },
                    {
                        field: "created_at",
                        title: "تاريخ الإنشاء",
                        sortable: 'asc',
                        filterable: true,
                        sortable: true,
                        template: function (data) {
                            return new Date(data.created_at).toLocaleDateString();
                        }
                    },
                    {
                        field: "updated_at",
                        title: "تاريخ التعديل",
                        sortable: 'asc',
                        filterable: true,
                        sortable: true,
                        template: function (data) {
                            return new Date(data.updated_at).toLocaleDateString();
                        }
                    },
                    {
                        field: "settings",
                        title: "خيارات",
                        overflow: 'visible',
                        sortable: false,
                        template: function (row) {
                            return `
                        <div class="d-inline-flex">
                            <a href="/panel/admin/roles/` + row.id + `/edit" class="btn btn-primary m-btn--custom d-flex align-items-center justify-content-center fs-10 p-0 w-65 h-30 mr-3">
                                <i class="fa fa-edit pr-2 fs-10"></i><span>تعديل</span>
                            </a>
                            <button class="btn btn-danger m-btn--custom d-flex align-items-center justify-content-center fs-10 p-0 w-65 h-30" onclick="showAlert(` + row.id + `)">
                                <i class="fa fa-trash-alt pr-2 fs-10"></i><span>حذف</span>
                            </button>
                        </div>`
                        }
                    }],
                toolbar: {
                    layout: ['pagination', 'info'],

                    placement: ['bottom'],  //'top', 'bottom'

                    items: {
                        pagination: {
                            type: 'default',

                            pages: {
                                desktop: {
                                    layout: 'default',
                                    pagesNumber: 6
                                },
                                tablet: {
                                    layout: 'default',
                                    pagesNumber: 3
                                },
                                mobile: {
                                    layout: 'compact'
                                }
                            },

                            navigation: {
                                prev: true,
                                next: true,
                                first: true,
                                last: true
                            },

                            pageSizeSelect: [10, 20, 30, 50, 100]
                        },

                        info: true
                    }
                },

                translate: {
                    records: {
                        processing: 'جاري التحميل...',
                        noRecords: 'لا توجد نتائج'
                    },
                    toolbar: {
                        pagination: {
                            items: {
                                default: {
                                    first: 'First',
                                    prev: 'Previous',
                                    next: 'Next',
                                    last: 'Last',
                                    more: 'More pages',
                                    input: 'Page number',
                                    select: 'Select page size'
                                },
                                info: ''
                            }
                        }
                    }
                }
            });
        });

    </script>

    <script>
        function save() {
            axios.post('/panel/admin/roles', {
                name: document.getElementById('name').value,
                guard: document.getElementById('guard').value
            })
                .then(function (response) {
                    console.log(response);
                    showConfirm(response.data.message, true);
                    document.getElementById('name').value = '';
                })
                .catch(function (error) {
                    console.log(error);
                    showConfirm(error.response.data.message, false);
                });
        }

        function showAlert(id) {
            Swal.fire({
                title: 'هل انت متأكد',
                text: "لن تستطيع إسترجاع المدينة",
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

        function destroy(id) {
            axios.delete('/panel/admin/roles/' + id)
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

        function showConfirm(message, status) {
            if (status) {
                toastr.success(message);
            } else
                toastr.error(message);
        }

    </script>
@endsection
