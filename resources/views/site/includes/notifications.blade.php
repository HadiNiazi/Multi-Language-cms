<script>
    $(document).ready(function() {
        @if(Session::has('alert-success'))
            toastr["success"]("{{ Session::get('alert-success') }}");
        @endif

        @if(Session::has('alert-info'))
            toastr["info"]("{{ Session::get('alert-info') }}");
        @endif

        @if(Session::has('alert-danger'))
            $.toast({
                type: 'error',
                title: 'Oops',
                content: "{{ Session::get('alert-danger') }}",
                delay: 10000 // Set the delay in milliseconds
            }, 'top-center');
        @endif

    });
</script>
