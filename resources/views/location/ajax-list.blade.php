@if( $tagArr->count() > 0)
	@foreach( $tagArr as $value )
	<option value="{{ $value->id }}" {{ $value->id == $id_selected ? "selected" : "" }}>{{ $value->name }}</option>
	@endforeach
@endif