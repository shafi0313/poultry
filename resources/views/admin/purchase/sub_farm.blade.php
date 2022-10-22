@php
    $x = 1;
@endphp
@foreach ($inputs as $input)

    <tr>
        <input type="hidden" name="sub_farm_id[]" value="{{ $input->id }}">
        <td>{{ $x++ }}</td>
        <td>{{ $input->room_no }}</td>
        <td>{{ $input->name }}</td>
        <td><input class="form-control single_product" type="number" value="0" name="quantity[]"></td>
    </tr>
@endforeach
<script>
    $('.single_product').keyup(function() {
        let subtotal = 0;
        $('.single_product').each(function() {
            subtotal += parseFloat($(this).val());
        });
        console.log($(this).val())
        $('#subtotal').text(subtotal);
    })
</script>
