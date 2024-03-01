@if (session()->has('success'))
<div class="alert alert-success" role="alert">
    {{ session()->get('success') }}
</div>
@endif

@if (session()->has('update'))
<div class="alert alert-warning" role="alert">
    {{ session()->get('update') }}
</div>
@endif

@if (session()->has('delete'))
<div class="alert alert-danger" role="alert">
    {{ session()->get('delete') }}
</div>
@endif