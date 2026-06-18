@if (session()->has('info'))
    <div class="alert bg-info font-13 info-alert" role="alert"><i class="fa fa-info-alert-circle m-r-5"></i>
        {{ session()->get('info') }}</div>
@endif

@if (session()->has('success'))
    <div class="alert bg-success font-13 info-alert" role="alert"><i class="fa fa-check-circle m-r-5"></i>
        {{ session()->get('success') }}</div>
@endif

@if (session()->has('warning'))
    <div class="alert bg-orange font-13 info-alert" role="alert"><i class="fa fa-warning m-r-5"></i>
        {{ session()->get('warning') }}</div>
@endif

@if (session()->has('danger'))
    <div class="alert font-13 info-alert" role="alert" style="background-color: #b01763;"><i class="fa fa-warning m-r-5"></i>
        {{ session()->get('danger') }}</div>
@endif
