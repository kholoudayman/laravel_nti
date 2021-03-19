@extends('admin.template.layout')
@section('title', 'Edit Product')
    
@section('content')
<div class="col-md-8" style="margin: auto">
    <!-- general form elements -->
    <div class="card card-warning">
      <div class="card-header">
        <h3 class="card-title">Edit Product</h3>
      </div>
      @include('admin.includes.session')
      <!-- /.card-header -->
      <!-- form start -->
      <form method="POST" enctype="multipart/form-data" action="{{url('dashboard/products/update')}}">
        @method('PUT')
        @csrf
        <input type="hidden" name="id" value="{{$product->id}}">
        <div class="card-body">
          <div class="form-group">
            <label for="input">Product Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="input" placeholder="Enter Product Name" name="name" value="{{$product->name}}">
          </div>
          @error('name')
          <div class="form-group alert alert-danger">{{$message}}</div>    
          @enderror
          <div class="form-group">
            <label for="input">Product Code</label>
            <input type="text" class="form-control @error('code') is-invalid @enderror" id="input" placeholder="Enter Product Code" name="code" value="{{$product->code}}">
          </div>
          @error('code')
          <div class="form-group alert alert-danger">{{$message}}</div>    
          @enderror
          <div class="form-group">
            <label for="input">Stock</label>
            <input type="number" class="form-control @error('stock') is-invalid @enderror" id="input" placeholder="Enter Quantity" name="stock" value="{{$product->stock}}">
          </div>
          @error('stock')
          <div class="form-group alert alert-danger">{{$message}}</div>    
          @enderror
          <div class="form-group">
            <label for="input">Price</label>
            <input type="number" class="form-control @error('stock') is-invalid @enderror" id="input" placeholder="Enter Product Price" name="price" value="{{$product->price}}">
          </div>
          @error('price')
          <div class="form-group alert alert-danger">{{$message}}</div>    
          @enderror
          <div class="form-group">
            <label for="input">Details</label>
            <textarea name="details" class="form-control @error('details') is-invalid @enderror" cols="10" rows="2" id="input">{{$product->details}}</textarea>
          </div>
          @error('details')
          <div class="form-group alert alert-danger">{{$message}}</div>    
          @enderror
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="input">Status</label>
                <select name="status" class="form-control @error('status') is-invalid @enderror" id="input">
                    <option {{$product->status == 1? 'selected':''}} value="1">Active</option>
                    <option {{$product->status == 0? 'selected':''}} value="0">Not Active</option>
                </select>
              </div>
              @error('status')
                <div class="form-group alert alert-danger">{{$message}}</div>    
              @enderror
              <div class="form-group">
                <label for="input">Sub-Category</label>
                <select name="sub_categories_id" class="form-control @error('sub_categories_id') is-invalid @enderror" id="input">
                    @forelse ($sub_categories_id as $key=>$sub_category_id)
                      <option {{$product->sub_categories_id == $sub_category_id->id?'selected':''}} value="{{$sub_category_id->id}}">{{$sub_category_id->name}}</option>    
                    @empty
                    <option value="" disabled>No Subcategory added Yet</option>
                    @endforelse
                </select>
              </div>
              @error('sub_categories_id')
                <div class="form-group alert alert-danger">{{$message}}</div>    
              @enderror
              <div class="form-group">
                <label for="exampleInputFile">File input</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input name="photo" type="file" class="custom-file-input @error('photo') is-invalid @enderror" id="exampleInputFile">
                    <label class="custom-file-label" for="input">Choose file</label>
                  </div>
                  @error('photo')
                    <div class="form-group alert alert-danger">{{$message}}</div>    
                  @enderror
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <div class="input-group">
                    
                  <img src="{{url('images/products/'. $product->photo)}}" alt="{{$product->name}}" style="" class="">
                </div>
              </div>
            </div>
          </div>
          
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-warning">Update</button>
        </div>
      </form>
    </div>
    <!-- /.card -->
</div>
@endsection