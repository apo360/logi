@props(['type', 'message'])

@if ($message)
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="text/javascript">
        Swal.fire({
            icon: '{{ $type }}',
            text: '{{ $message }}'
        });
    </script>
@else
    {{--  --}}
@endif
