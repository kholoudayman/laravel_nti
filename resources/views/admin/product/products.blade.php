@extends('admin.template.layout')
@section('title', 'Products')

@section('links')
    <!-- DataTables -->
  <link rel="stylesheet" href="{{url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection


@section('content')
@include('admin.includes.session')
    <div class="col-md-12">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Code</th>
              <th>Price</th>
              <th>Status</th>
              <th>Creation Date</th>
              <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($products as $key=>$product)
            <tr>
              <td>{{$product->id}}</td>
              <td>{{$product->name}}</td>
              <td>{{$product->code}}</td>
              <td>{{$product->price}}</td>
              <td>{{$product->status == 1?'Active':'Not Active'}}</td>
              <td>{{$product->created_at}}</td>
              <td>
                  <div class="d-flex justify-content-center">
                      <div class="mr-3">
                        <a href="{{url('dashboard/products/edit/'. $product->id)}}" style="color:#fd7e14"><i class="fas fa-edit"></i></a>
                      </div>
                      <div>
                        <form method="POST" action="{{url('dashboard/products/destroy/'.$product->id)}}">
                          @method('DELETE')
                          @csrf
                          <button type="submit" style="color:#dc3545; border:0;"><i class="far fa-trash-alt"></i></button>
                        </form>
                      </div>
                  </div>
              </td>
            </tr>
                
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Code</th>
                <th>Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </tfoot>
          </table>
    </div>
@endsection

@section('scripts')

<!-- DataTables  & Plugins -->
<script src="{{url('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{url('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{url('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{url('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{url('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{url('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{url('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{url('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{url('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>


<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
@endsection