@extends('layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dish    
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ route('dish.index') }}">Dish</a></li>
      <li class="active">Add new</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default btn-sm" href="{{ route('dish.index') }}" style="margin-bottom:5px">Back</a>
    <form role="form" method="POST" action="{{ route('dish.store') }}" id="dataForm">
    <div class="row">
      <!-- left column -->

      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Add new</h3>
          </div>
          <!-- /.box-header -->               
            {!! csrf_field() !!}

            <div class="box-body">
              @if (count($errors) > 0)
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif  
              <div class="form-group">
               <label>Branch</label>
                  <select name="branch_id" id="branch_id" class="form-control select2">
                    @foreach($branchList as $beach)
                    <option value="{{ $beach->id }}" {{ old('branch_id') == $beach->id ? "selected" : "" }}>{{ $beach->name }}</option>
                    @endforeach                      
                  </select>
             </div>          
                <div class="form-group">
                  <label>Category<span class="red-star">*</span></label>
                  <select name="category_id" id="category_id" class="form-control select2">
                    @foreach($cateList as $cate)
                    <option value="{{ $cate->id }}" {{ old('category_id') == $cate->id ? "selected" : "" }}>{{ $cate->name }} - 
                      @php
                      if($cate->branch_id == 1){
                        echo "Boroda";
                      }elseif($cate->branch_id == 2){
                        echo "Night Market";
                      }else{
                        echo "River view";
                      }                      
                      @endphp
                    </option>
                    @endforeach
                  </select>
                </div>  
                 <!-- text input -->
                <div class="form-group">
                  <label>Dish name<span class="red-star">*</span></label>
                  <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                </div>                   
                <div class="form-group">
                  <label>Price<span class="red-star">*</span></label>
                  <input type="text" class="form-control number" name="price" id="price" value="{{ old('price') }}">
                </div>
                 <div class="form-group">
                  <label>Display order<span class="red-star">*</span></label>
                  <input type="text" class="form-control" name="display_order" id="display_order" value="{{ old('display_order') }}">
                </div>
                <div class="form-group">
                  <label>Description</label>
                  <textarea type="text" class="form-control" name="description" id="description">{{ old('description') }}</textarea>
                </div>
                                     
            </div>                        
            <div class="box-footer">
              <button type="submit" class="btn btn-primary btn-sm">Save</button>
              <a class="btn btn-default btn-sm" class="btn btn-primary btn-sm" href="{{ route('dish.index')}}">Cancel</a>
            </div>
            
        </div>
        <!-- /.box -->     

      </div>
      </div>
      <!--/.col (left) -->      
    </div>
    </form>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>

@stop