@if (session('message'))
@php
    $message =session('message');
@endphp
    <div class="alert alert-{{ $message['type'] }} alert-dismissible fade show" role="alert">
  <strong>Thông báo! </strong>{{ $message['msg'] }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@else
    
@endif