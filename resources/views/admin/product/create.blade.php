@extends('admin.template.layout')
@section('title', 'Create Product')
    
@section('content')
<div class="col-md-12">
  @if(Session()->has('Success'))
    <div class="alert alert-success">{{Session()->get('Success')}}</div>
  @elseif(Session()->has('Error'))
    <div class="alert alert-danger">{{Session()->get('Error')}}</div>
  @endif
</div>
<div class="col-md-8" style="margin: auto">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Create Product</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form method="POST" action="{{url('/dashboard/products/store')}}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="input">Product Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="input" placeholder="Enter Product Name" name="name" value="{{old('name')}}">
          </div>
          @error('name')
            <div class="form-group alert alert-danger">{{$message}}</div>    
          @enderror
          <div class="form-group">
            <label for="input">Product Code</label>
            <input type="text" class="form-control @error('code') is-invalid @enderror" id="input" placeholder="Enter Product Code" name="code" value="{{old('code')}}">
          </div>
          @error('code')
            <div class="form-group alert alert-danger">{{$message}}</div>    
          @enderror
          <div class="form-group">
            <label for="input">Stock</label>
            <input type="number" class="form-control @error('stock') is-invalid @enderror" id="input" placeholder="Enter Quantity" name="stock" value="{{old('stock')}}">
          </div>
          @error('stock')
            <div class="form-group alert alert-danger">{{$message}}</div>    
          @enderror
          <div class="form-group">
            <label for="input">Price</label>
            <input type="number" class="form-control @error('price') is-invalid @enderror" id="input" placeholder="Enter Product Price" name="price" value="{{old('price')}}">
          </div>
          @error('price')
            <div class="form-group alert alert-danger">{{$message}}</div>    
          @enderror
          <div class="form-group">
            <label for="input">Details</label>
            <textarea name="details" class="form-control @error('details') is-invalid @enderror" cols="10" rows="2" id="input">{{old('details')}}</textarea>
          </div>
          @error('details')
            <div class="form-group alert alert-danger">{{$message}}</div>    
          @enderror
          <div class="form-group">
            <label for="input">Status</label>
            <select name="status" class="form-control @error('status') is-invalid @enderror" id="input">
                <option {{old('status') == 1?'selected':''}} value="1">Active</option>
                <option {{old('status') == 0?'selected':''}} value="0">Not Active</option>
            </select>
          </div>
          @error('status')
            <div class="form-group alert alert-danger">{{$message}}</div>    
          @enderror
          <div class="form-group">
            <label for="input">Sub-Category</label>
            <select name="sub_categories_id" class="form-control @error('sub_categories_id') is-invalid @enderror" id="input">
                @forelse ($sub_categories_id as $key=>$sub_category_id)
                  <option {{old('sub_categories_id') == $sub_category_id->id?'selected':''}} value="{{$sub_category_id->id}}">{{$sub_category_id->name}}</option>    
                @empty
                <option value="" disabled>No Subcategory added Yet</option>
                @endforelse
            </select>
          </div>
          @error('sub_category_id')
            <div class="form-group alert alert-danger">{{$message}}</div>    
          @enderror
          <div class="form-group">
            <label for="exampleInputFile">File input</label>
            <div class="input-group">
              <div class="custom-file">
                <input name="photo" type="file" class="custom-file-input @error('photo') is-invalid @enderror" id="exampleInputFile">
                <label class="custom-file-label" for="input">Choose file</label>
              </div>
            </div>
          </div>
          @error('photo')
            <div class="form-group alert alert-danger">{{$message}}</div>    
          @enderror
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </form>
    </div>
    <!-- /.card -->
</div>
@endsection