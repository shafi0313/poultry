@php
    $x = 1;
@endphp
<option selected value disabled>Select</option>
@foreach ($inputs as $input)
    <option value="{{ $input->id }}">{{ $input->room_no }}-{{ $input->name }}</option>
@endforeach
