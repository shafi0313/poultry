@php
    $x = 1;
@endphp
@foreach ($inputs as $input)
    <tr>
        <input type="hidden" name="sub_farm_id[]" value="{{ $input->id }}">
        <td>{{ $input->room_no }}</td>
        <td>{{ $input->name }}</td>
        <td><input class="form-control quantity" type="number" value="0" name="quantity[]"></td>
    </tr>
@endforeach
<script>
    $('.quantity').keyup(function() {
        let subtotal = 0;
        $('.quantity').each(function() {
            subtotal += parseFloat($(this).val());
        });
        $('#quantityTotal').text(subtotal);
    })
</script>
