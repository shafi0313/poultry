@php
    $x = 1;
@endphp
@foreach ($inputs as $input)

    <tr>
        <input type="hidden" name="sub_farm_id[]" value="{{ $input->id }}">
        <td>{{ $x++ }}</td>
        <td>{{ $input->room_no }}</td>
        <td>{{ $input->name }}</td>
        <td><input class="form-control chicken" type="number" value="0" name="chicken[]"></td>
        <td><input class="form-control feed" type="number" value="0" name="feed[]"></td>
    </tr>
@endforeach
<script>
    $('.chicken').keyup(function() {
        let subtotal = 0;
        $('.chicken').each(function() {
            subtotal += parseFloat($(this).val());
        });
        // console.log($(this).val())
        $('#chickenTotal').text(subtotal);
    })
    $('.feed').keyup(function() {
        let subtotal = 0;
        $('.feed').each(function() {
            subtotal += parseFloat($(this).val());
        });
        // console.log($(this).val())
        $('#feedTotal').text(subtotal);
    })
</script>