@extends('cms.parent')

@section('title', 'الرسائل')

@section('styles')
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

@endsection

@section('sub-title', 'الرسائل')

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
                                @if($messages->total())
                                    @foreach($messages as $message)
                                        <div class="form-group m-form__group row mb-25">
                                            <label for="example-text-input" class="col-3 col-form-label">رقم المرسل</label>
                                            <div class="col-9">
                                                <input class="form-control m-input" value="{{ $message->user->id }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row mb-25">
                                            <label for="example-text-input" class="col-3 col-form-label">إسم المرسل</label>
                                            <div class="col-9">
                                                <input class="form-control m-input" value="{{ $message->user->full_name }}" disabled/>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row mb-25">
                                            <label for="example-text-input" class="col-3 col-form-label">العنوان</label>
                                            <div class="col-9">
                                                <input class="form-control m-input" value="{{ $message->title }}" disabled/>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row mb-25">
                                            <label for="example-text-input" class="col-3 col-form-label">نص الرسالة</label>
                                            <div class="col-9">
                                                <textarea class="form-control m-input" rows="5" placeholder="نص الاشعار" disabled>{{ $message->text }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row mb-25">
                                            <button class="btn btn-info" type="button" onclick="markAsRead({!! $message->id !!})">تعليم كمقرؤءة</button>
                                        </div>
                                    @endforeach
                                    @else
                                        <label class="col-3 col-form-label">لا يوجد رسائل</label>
                                @endif
                            </div>
                            <div class="m-portlet__foot">
                                {{ $messages->links() }}
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
    function markAsRead(id) {
        axios.get('/panel/admin/messages/'+id+'/markRead')
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
