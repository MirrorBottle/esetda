@foreach ($inboxes as $inbox)
    <tr>
        <td data-order="{{ $loop->iteration }}" data-checked="{{ $inbox->instruction === null ? 'true' : 'false' }}" data-id="{{ $inbox->id }}">
            <input type="checkbox" class="checkbox" value="{{ $inbox->id }}" {{ $inbox->instruction === null ? 'checked="checked"' : '' }}>
        </td>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $inbox->no }}</td>
        <td>{{ $inbox->sender }}</td>
        <td>{{ $inbox->title }}</td>
        <td>{{ date("d/m/Y", strtotime($inbox->date)) }}</td>
        <td class="cell_to_textarea" data-toggle="tooltip" title="Klik untuk mengubah">
            <textarea class="form-control custom-textarea" data-id="{{ $inbox->id }}" name="instruction[{{ $inbox->id }}]" rows="2">{{ $inbox->instruction ?? '' }}</textarea>
        </td>
    </tr>
@endforeach
