@if (session()->has('message'))
<div class="success-alert-bar p-15 m-b-20 green white-text center" style="display: block;">
    {{ session('message') }}
</div>
@endif
