@if( $taskList->count() > 0)
	@foreach( $taskList as $value )
	<option value="{{ $value->id }}" {{ $value->id == $id_selected ? "selected" : "" }}>{{ $value->name }}</option>
	@endforeach
@endif