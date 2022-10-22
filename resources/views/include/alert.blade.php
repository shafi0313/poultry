<script>
    $(function() {
        @if ($errors->any())
            @foreach ($errors->all() as $i => $error)
            $.growl.error1({
                message: '{{ $error }}'
            });
            @endforeach
        @endif

        @if (session('success'))
            $.growl.notice1({
                title: 'Success',
                message: '{{ session('success') }}'
            });
        @endif
        @if (session('warning'))
            $.growl.warning1({
                title: 'Warning',
                message: '{{ session('warning') }}'
            });
        @endif
        @if (session('error'))
            $.growl.error1({
                title: 'Error',
                message: '{{ session('error') }}'
            });
        @endif
    });
</script>
