<script>
    function commonDelete(url) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(function (result) {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'post',
                    data: {
                        _method: 'delete'
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    error: function (jqXHR, textStatus) {
                        // will fire when timeout is reached
                        if (textStatus === 'timeout') {
                            alert('Failed from timeout');
                            $(".loading-overlay").hide();
                            //do something. Try again perhaps?
                        }
                    },
                    success: function (data) {
                        if (data.result) {
                            window.location.href = data.redirection;
                        }
                    },
                });
            }
        });
    }
</script>
