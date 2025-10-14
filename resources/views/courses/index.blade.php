@extends('layout')
@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Khóa học
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{ route( 'w-articles.index' ) }}">Khóa học</a></li>
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
      <a href="{{ route('courses.create') }}" class="btn btn-info btn-sm" style="margin-bottom:5px">Add new</a>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Bộ lọc</h3>
        </div>
        <div class="panel-body">
          <form class="form-inline" role="form" method="GET" action="{{ route('w-articles.index') }}" id="searchForms">           
            <div class="form-group">
              <label for="email">Danh mục </label>
              <select class="form-control get-child" data-child="child_id" data-mod="courses_child" data-col="cate_id"  name="cate_id" id="cate_id">
                <option value="">--Tất cả--</option>
                 <?php 
              $parentList = DB::table('courses_cate')->orderBy('display_order')->get();

              ?>
                @if( !empty($parentList))
                  @foreach( $parentList as $value )
                  <option value="{{ $value->id }}" {{ $value->id == $cate_id ? "selected" : "" }}>{{ $value->name }}</option>
                  @endforeach
                @endif
              </select>
            </div> 
            <div class="form-group">
                  <label for="email">Danh mục con</label>                
                  <select class="form-control" name="child_id" id="child_id">
                    <option value="">--Tất cả--</option> 
                    @if( !empty($childList))
                  @foreach( $childList as $value )
                  <option value="{{ $value->id }}" {{ $value->id == $child_id ? "selected" : "" }}>{{ $value->name }}</option>
                  @endforeach
                @endif                  
                </select>                 
                </div>           
            <div class="form-group">
              <label for="email">Từ khóa :</label>
              <input type="text" class="form-control" name="name" value="{{ $name }}">
            </div>
            <button type="submit" class="btn btn-default btn-sm">Lọc</button>
          </form>         
        </div>
      </div>
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">List ( <span class="value">{{ $items->total() }} khóa học )</span></h3>
        </div>
        
        <!-- /.box-header -->
        <div class="box-body">
          <div style="text-align:center">
            {{ $items->appends( [ 'name' => $name] )->links() }}
          </div>  
          <table class="table table-bordered" id="table-list-data">
            <tr>
              <th style="width: 1%">#</th>              
              <th width="200">Thumbnail</th>
              <th>Tên khóa học</th>
              <th>Mục lục</th>              
              <th width="1%;white-space:nowrap">Thao tác</th>
            </tr>
            <tbody>
            @if( $items->count() > 0 )
              <?php $i = 0; ?>
              @foreach( $items as $item )
                <?php $i ++; ?>
              <tr id="row-{{ $item->id }}">
                <td><span class="order">{{ $i }}</span></td>       
                <td>
                  <img class="img-thumbnail" src="{{ Helper::showImage($item->image_url)}}" width="145">
                </td>        
                <td>     
                  @if($item->score > 0)
                  <label class="label label-success" style="font-size:16px">{{ $item->score }} điểm</label>
                  @elseif($item->is_share == 1)
                  <label class="label label-warning" style="font-size:16px">Share FB</label>
                  @else
                  <label class="label label-default" style="font-size:16px">Free</label>
                  @endif
                  <a style="font-size:17px" href="{{ route( 'courses.edit', [ 'id' => $item->id ]) }}">{{ $item->name }}</a>
                  
                  @if( $item->is_hot == 1 )
                  <label class="label label-danger">HOT</label>
                  @endif                  
                  <p>{{ $item->description }}</p>
                </td>
                <td style="white-space: nowrap;">
                  <a class="btn btn-primary btn-sm" href="{{ route('courses-part.index', ['courses_id' => $item->id])}}" ><span class="badge">{{ $item->part->count() }}</span> Mục lục </a>
                  <a class="btn btn-primary btn-sm" href="{{ route('courses-lession.index', ['courses_id' => $item->id])}}" ><span class="badge">{{ $item->lession->count() }}</span> Bài học </a>
                </td>
                
                <td style="white-space:nowrap"> 
                  <a class="btn btn-default btn-sm" href="{{ route('courses-detail', ['slug' => $item->slug, 'id' => $item->id ]) }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i> Xem</a>                 
                  <a href="{{ route( 'courses.edit', [ 'id' => $item->id ]) }}" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>                 
                  
                  <a onclick="return callDelete('{{ $item->name }}','{{ route( 'courses.destroy', [ 'id' => $item->id ]) }}');" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></a>
                  
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
          <div style="text-align:center">
            {{ $items->appends( ['name' => $name] )->links() }}
          </div>  
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