@foreach ($cvs as $cv)
	<tr id="{{ $cv->id }}">
		<td>{{ $cv->name }}</td>
		<td>{{ $cv->created_at }}</td>
		<td>
			<a href="{{ route('student.cv.destroy', $cv->id) }}" data-id="{{ $cv->id }}" id="delete"><abbr title="Xóa"><i class="fa fa-trash" aria-hidden="true"></i></abbr></a>
		</td>
	</tr>
@endforeach