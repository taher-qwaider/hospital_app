@extends('cms.parent')

@section('title', 'الإعدادات')

@section('styles')

@endsection

@section('sub-title', 'الإعدادات')

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
                                            الإعدادات
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                @if(count($generals) >0)
                                @foreach($generals as $item)
                                    <div class="form-group m-form__group row mb-25">
                                        <label for="{!! $item->id !!}" class="col-3 col-form-label">{!! $item->key !!}</label>
                                        <div class="col-9">
                                            <input class="form-control m-input" type="text" placeholder="" value="{{$item->value}}" id="{!! $item->id !!}">
                                        </div>
                                    </div>
                                @endforeach
                                @else
                                    <h3 class="text text-center" >لا يوجد بيانات</h3>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="m-portlet m-portlet--tab">
                            <div class="m-portlet__body">
                                <div class="m-portlet__head-title col-sm-12">
                                    <button type="button" onclick="save('{!! $subject !!}')" class="btn btn-success col-sm-12">حفظ</button>
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
            @foreach($generals as $item)
                '{!! $item->key !!}' : document.getElementById('{!! $item->key !!}').value,
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
