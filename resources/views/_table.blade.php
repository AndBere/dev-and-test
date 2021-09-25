<tr id="tr_{{$question->id}}">
    
    <td class="text-center">
        {{ $loop->iteration }}
    </td>
    <td><input type="checkbox" class="sub_chk" data-id="{{$question->id}}"></td>
    <td>
        {{ $question->message }}
    </td>
    <td>
        {{-- <a href="{{ url('questions',$question->id) }}" class="btn btn-danger btn-sm"
            data-tr="tr_{{$question->id}}"
            data-toggle="confirmation"
            data-btn-ok-label="Delete" data-btn-ok-icon="fa fa-remove"
            data-btn-ok-class="btn btn-sm btn-danger"
            data-btn-cancel-label="Cancel"
            data-btn-cancel-icon="fa fa-chevron-circle-left"
            data-btn-cancel-class="btn btn-sm btn-default"
            data-title="Are you sure you want to delete ?"
            data-placement="left" data-singleton="true">
             Delete
         </a> --}}
        <a class="text-danger" data-toggle="modal" data-target="#modal{{ $question->id }}delete">
            <i class="far fa-trash-alt"></i>
        </a>
        @include('_delete_modal')
    </td>
    <td>
        {{ $question->created_at->format('d.m.Y H:i') }}
    </td>
    <td>
        {{ $question->name }}<br>
        {{ $question->phone }}<br>
        {{ $question->email }}
    </td>
</tr>
