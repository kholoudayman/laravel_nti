<div class="row">
    <div class="col-md-12 mt-2">
    @if(Session()->has('Success'))
      <div class="alert alert-success">{{Session()->get('Success')}}</div>
    @elseif(Session()->has('Error'))
      <div class="alert alert-danger">{{Session()->get('Error')}}</div>
    @endif
    </div>
</div>