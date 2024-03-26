@if (count($errors) > 0)
    <p class="alert alert-danger text-center alert-dismissible fade show" style="padding-top: 8px; text-align: center;font-size: x-large; height: 40px;background-color: #d8422e"> @lang('lang.error') </p>
@endif


@if (session()->has('success'))
    <p class="alert alert-success text-center alert-dismissible fade show" style="padding-top: 8px; text-align: center;font-size: x-large; height: 40px;background-color: #42d542">{{session('success')}} </p>
@endif
