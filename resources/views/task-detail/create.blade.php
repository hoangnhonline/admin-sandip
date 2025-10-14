@extends('layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Quản lý công việc
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route( 'dashboard' ) }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('task-detail.index') }}">Quản lý công việc</a></li>
            <li class="active">Add new</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <a class="btn btn-default btn-sm" href="{{ route('task-detail.index', ['task_id' => $task_id]) }}"
            style="margin-bottom:5px">Quay lại</a>
        <form role="form" method="POST" action="{{ route('task-detail.store') }}" id="dataForm">
            <div class="row">
                <!-- left column -->

                <div class="col-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title col-md-12">Add new</h3>
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
                            <div class="form-group col-md-12">
                                <label>Ngày <span class="red-star">*</span></label>
                                <input type="text" class="form-control datepicker" name="task_date" id="task_date"
                                    value="{{ old('task_date', date('d/m/Y')) }}" autocomplete="off">
                            </div>                       
                            <div class="form-group input-group" style="padding-left: 15px;">
                                <label for="task_id">Công việc<span class="red-star">*</span></label>
                                <select class="form-control select2" name="task_id" id="task_id">
                                  <option value="">--Tất cả--</option>
                                  @if( $taskArr->count() > 0)
                                    @foreach( $taskArr as $value )
                                    <option value="{{ $value->id }}" {{ $value->id == old('task_id') ? "selected" : "" }}>
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
                                  <option value="{{ $value->id }}" {{ $value->id == old('staff_id') ? "selected" : "" }}>
                                      {{ $value->name }}</option>
                                  @endforeach
                                  @endif
                              </select>

                            </div>

                            @endif

                            <div style="clear:both"></div>

                            <div class="form-group col-md-6">
                                <label>Chi tiết công việc <span class="red-star">*</span></label>
                                <textarea class="form-control" rows="5" name="content">{{ old('content') }}</textarea>
                            </div>
                            <div class="form-group  col-md-6">
                                <label>Ghi chú</label>
                                <textarea class="form-control" rows="5" name="notes"
                                    id="notes">{{ old('notes') }}</textarea>
                            </div>
                            <!-- <div class="form-group col-md-12">
                                <label>Kết quả công việc ( dẫn link bài viết/kết quả - nếu có)</label>
                                <textarea class="form-control" rows="3" name="content_result"
                                    id="content">{{ old('content_result') }}</textarea>
                            </div> -->
                            <div class="form-group col-md-12">
                                <label>Tiến độ </label>
                                <select class="form-control select2" name="percent" id="percent">
                                    <option value="0">0%</option>
                                    @for($i = 5; $i <= 100; $i = $i+5)
                                    <option value="{{ $i }}" {{ old('percent') == $i ?? "selected" }}>{{ $i }}%</option>
                                    @endfor
                                </select>
                            </div>
                            
                            
                                <div class="form-group col-xs-8">
                                    <label>Deadline </label>
                                    <input type="text" class="form-control datepicker" name="task_deadline"
                                        id="task_deadline" value="{{ old('task_deadline') }}" autocomplete="off">
                                </div>
                                <div class="form-group col-xs-4">
                                    <label>Giờ</label>
                                    <input type="text" class="form-control" name="hour"
                                        id="hour" value="{{ old('hour') }}" autocomplete="off" placeholder="Giờ:phút">
                                </div>
                            
                            <input type="hidden" id="editor" value="content">
                        </div>

                        <div class="box-footer">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-sm">Lưu</button>
                                <a class="btn btn-default btn-sm" class="btn btn-primary btn-sm"
                                href="{{ route('task-detail.index', ['task_id' => $task_id])}}">Hủy</a>    
                            </div>
                            
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
        CKEDITOR.replace( 'object', {
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