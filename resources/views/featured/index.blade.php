@extends('layout')
@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Tính năng nổi bật
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{ route( 'w-featured.index' ) }}">Tính năng nổi bật</a></li>
    <li class="active">List</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      @if(Session::has('message'))
      <p class="alert alert-info" >{{ Session::get('message') }}</p>
      @endif
      <!-- <a href="{{ route('w-featured.create') }}" class="btn btn-info btn-sm" style="margin-bottom:5px">Add new</a> -->
      
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">List</span></h3>
        </div>
        
        <!-- /.box-header -->
        <div class="box-body">
           
          <table class="table table-bordered" id="table-list-data">
            <tr>
              <th style="width: 1%">#</th>                        
              <th>Ảnh</th>             
              <th>Mô tả</th>
              <th width="1%;white-space:nowrap">Thao tác</th>
            </tr>
            <tbody>
            @if( $items->count() > 0 )
              <?php $i = 0; ?>
              @foreach( $items as $item )
                <?php $i ++; ?>
              <tr id="row-{{ $item->id }}">
                <td><span class="order">{{ $i }}</span></td>   
                 
                <td width="150">
                  <img class="img-thumbnail" src="{{ Helper::showImage($item->image_url)}}" width="145">
                </td>        
               
                <td>                  
                  <a style="font-size:17px" href="{{ route( 'w-featured.edit', [ 'id' => $item->id ]) }}">{{ $item->name }}</a>
                
                  <p>{{ $item->description }}</p>
                </td>
                <td style="white-space:nowrap"> 
                                 
                  <a href="{{ route( 'w-featured.edit', [ 'id' => $item->id ]) }}" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>                 
                  
                  <a onclick="return callDelete('{{ $item->name }}','{{ route( 'w-featured.destroy', [ 'id' => $item->id ]) }}');" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></a>
                  
                </td>
              </tr> 
              @endforeach
            @else
            <tr>
              <td colspan="9">Không có dữ liệu.</td>
            </tr>
            @endif

          </tbody>
          </table>
           
        </div>        
      </div>
      <!-- /.box -->     
    </div>
    <!-- /.col -->  
  </div> 
</section>
<!-- /.content -->
</div>
<input type="hidden" id="table_name" value="articles">
@stop