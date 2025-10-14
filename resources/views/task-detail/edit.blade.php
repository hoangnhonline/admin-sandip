@extends('layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Quản lý công việc: @if($task) <span style="color:#e8a23e">{{ $task->name }}</span> @endif
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route( 'dashboard' ) }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('task-detail.index') }}">Quản lý công việc</a></li>
            <li class="active">Cập nhật</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <a class="btn btn-default btn-sm" href="{{ route('task-detail.index', $arrSearch) }}" style="margin-bottom:5px">Quay lại</a>
        <div class="block-author edit">
            <ul>
                <li>
                    <span>Ngày tạo:</span>
                    <span class="name">{!! date('d/m/Y H:i', strtotime($detail->created_at)) !!}</span>

                </li>
                <li>
                    <span>Cập nhật lần cuối:</span>
                    <span class="name">( {!! date('d/m/Y H:i', strtotime($detail->updated_at)) !!} )</span>
                </li>
            </ul>
        </div>
        <form role="form" method="POST" action="{{ route('task-detail.update', $arrSearch) }}" id="dataForm">
            <div class="row">
                <!-- left column -->
                <input name="id" value="{{ $detail->id }}" type="hidden">
                <div class="col-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            Chỉnh sửa
                        </div>
                        <!-- /.box-header -->
                        {!! csrf_field() !!}

                        <div class="box-body">
                            @if(Session::has('message'))
                            <p class="alert alert-info">{{ Session::get('message') }}</p>
                            @endif
                            @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            @php
                              if($detail->task_date){
                                  $task_date = old('task_date', date('d/m/Y', strtotime($detail->task_date)));
                              }else{
                                  $task_date = old('task_date');
                              }

                              if($detail->task_deadline){
                                  $task_deadline = old('task_deadline', date('d/m/Y', strtotime($detail->task_deadline)));
                              }else{
                                  $task_deadline = old('task_deadline');
                              }
                            @endphp 
                            

                            <div class="form-group col-md-6">
                                <label>Status <span class="red-star">*</span></label>
                                <select class="form-control" name="status" id="status">
                                    <option value="2" {{ $detail->status == 2 ? "selected" : "" }}>Đã hoàn thành
                                    </option>
                                    <option value="1" {{ $detail->status == 1 ? "selected" : "" }}>Chưa hoàn thành</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                              <label>Ngày <span class="red-star">*</span></label>
                              <input type="text" class="form-control datepicker" name="task_date" id="task_date" value="{{ $task_date }}" autocomplete="off">
                            </div> 
                            <div class="form-group input-group" style="padding-left: 15px;">
                                <label for="task_id">Công việc<span class="red-star">*</span></label>
                                <select class="form-control select2" name="task_id" id="task_id">
                                  <option value="">--Tất cả--</option>
                                  @if( $taskArr->count() > 0)
                                    @foreach( $taskArr as $value )
                                    <option value="{{ $value->id }}" {{ $value->id == old('task_id', $task_id) ? "selected" : "" }}>
                                        {{ $value->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <span class="input-group-btn">
                                    <button style="margin-top:24px" class="btn btn-primary btn-sm" id="btnAddTask" type="button" data-value="3">
                                      Thêm  
                                    </button>
                                  </span>
                              </div>
                            @if (Auth::user()->role == 1)
                              <div class="form-group" style="padding-left: 15px;">
                              <label for="task">Nhân viên <span class="red-star">*</span></label>
                              <select class="form-control select2" name="staff_id" id="staff_id">
                                  <option value="">--Chọn--</option>
                                  @if( $staffArr->count() > 0)
                                  @foreach( $staffArr as $value )
                                  <option value="{{ $value->id }}"
                                      {{ $value->id == $detail->staff_id ? "selected" : "" }}>
                                      {{ $value->name }}</option>
                                  @endforeach
                                  @endif
                              </select>
                              </div>
                            @endif

                            <div style="clear:both"></div>

                            <div class="form-group col-md-6">
                                <label>Chi tiết công việc <span class="red-star">*</span></label>
                                <textarea class="form-control" rows="5"
                                    name="content">{{ old('content',$detail->content) }}</textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Ghi chú</label>
                                <textarea class="form-control" rows="5" name="notes"
                                    id="notes">{{ old('notes',$detail->notes) }}</textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Kết quả công việc <span style="color: red">( dẫn link bài viết/kết quả - nếu có)</span></label>
                                <textarea class="form-control" rows="6" name="content_result"
                                    id="content_result">{{ old('content_result',$detail->content_result) }}</textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Tiến độ </label>
                                <select class="form-control select2" name="percent" id="percent">
                                    <option value="0">0%</option>
                                    @for($i = 5; $i <= 100; $i = $i+5)
                                    <option value="{{ $i }}" {{ old('percent', $detail->percent) == $i ? "selected" :""}}>{{ $i }}%</option>
                                    @endfor
                                </select>
                            </div>
                       
                            <div class="form-group col-xs-8">
                                <label>Deadline </label>
                                <input type="text" class="form-control datepicker" name="task_deadline"
                                    id="task_deadline" value="{{ $task_deadline }}" autocomplete="off">
                            </div>
                            <div class="form-group col-xs-4">
                                <label>Giờ </label>
                                <input type="text" class="form-control" name="hour"
                                    id="hour" value="{{ $detail->task_deadline ? date('H:i', strtotime($detail->task_deadline)) : ""}}" autocomplete="off" placeholder="Giờ:phút">
                            </div>
                            <input type="hidden" id="editor" value="content">
                            {{-- <input type="hidden" name="arrSearch" value="{{ $arrSearch }}"> --}}

                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary btn-sm">Lưu</button>
                            <a class="btn btn-default btn-sm" class="btn btn-primary btn-sm"
                                href="{{ route('task-detail.index',$arrSearch)}}">Hủy</a>
                        </div>

                    </div>
                    <!-- /.box -->

                </div>

        </form>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- Modal -->
<div id="modalNewTask" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    <form method="POST" action="{{ route('task.ajax-save')}}" id="formAjaxTaskInfo">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add new công việc</h4>
      </div>
      <div class="modal-body" id="contentTag">
          <input type="hidden" name="type" value="1">
           <!-- text input -->
          <div class="col-md-12">
            <div class="form-group">
              <label>Công việc<span class="red-star">*</span></label>
              <input type="text" autocomplete="off" class="form-control" id="add_name" value="{{ old('name') }}" name="name"></textarea>
            </div>
            <div class="form-group">
              <label>Loại công việc <span class="red-star">*</span></label>
              <select class="form-control" name="type" id="type">                  
                <option value="1" {{ old('type', 2) == 1 ? "selected" : "" }}>Việc cố định</option>
                <option value="2" {{ old('type', 2) == 2 ? "selected" : "" }}>Việc phát sinh</option>
              </select>
            </div>            
          </div>
      </div>
      <div class="modal-footer" style="text-align:center">
        <button type="button" class="btn btn-primary btn-sm" id="btnSaveTaskAjax"> Save</button>
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" id="btnCloseModalTag">Close</button>
      </div>
      </form>
    </div>

  </div>
</div>
@stop

@section('js')
<script type="text/javascript">
    $(document).ready(function(){
    if($('#content_result').length == 1){
        CKEDITOR.replace( 'content_result', {
          height : 200
        });
      }
    });
  $(document).on('click', '#btnSaveTaskAjax', function(){
    $(this).attr('disabled', 'disabled');
      $.ajax({
        url : $('#formAjaxTaskInfo').attr('action'),
        data: $('#formAjaxTaskInfo').serialize(),
        type : "post", 
        success : function(id){
          $('#btnCloseModalTag').click();
          $.ajax({
            url : "{{ route('task.ajax-list') }}",
            data: {
              id : id
            },
            type : "get", 
            success : function(data){
                $('#task_id').html(data);
                $('#task_id').select2('refresh');                
            }
          });
        },error: function (error) {
          var errrorMess = jQuery.parseJSON(error.responseText);        
          if(errrorMess.message == 'The given data was invalid.'){
            alert('Nhập đầy đủ thông tin có dấu *');      
            $('#btnSaveTaskAjax').removeAttr('disabled');      
          }
          //console.log(error);
      }
      });
   });  
</script>
<script type="text/javascript">
  $(document).ready(function(){
     $('#btnAddTask').click(function(){
          $('#modalNewTask').modal('show');
      }); 
  });
</script>
@stop