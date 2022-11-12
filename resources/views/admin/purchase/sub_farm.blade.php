@php
    $x = 1;
@endphp
@foreach ($inputs as $input)

    <tr>
        <input type="hidden" name="sub_farm_id[]" value="{{ $input->id }}">
        <td>{{ $input->room_no }}</td>
        <td>{{ $input->name }}</td>
        <td><input class="form-control chicken" step="any" type="number" value="0" name="chicken[]"></td>
        <td><input class="form-control feed" step="any" type="number" value="0" name="feed[]"></td>
    </tr>
@endforeach
<script>
    $('.chicken').keyup(function() {
        let subtotal = 0;
        $('.chicken').each(function() {
            subtotal += parseFloat($(this).val());
        });
        $('#chickenTotal').text(subtotal);
    })
    $('.feed').keyup(function() {
        let subtotal = 0;
        $('.feed').each(function() {
            subtotal += parseFloat($(this).val());
        });
        $('#feedTotal').text(subtotal);
    })
</script>
