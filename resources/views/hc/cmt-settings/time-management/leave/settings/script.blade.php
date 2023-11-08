<script>
    const settingInit = () => {
        const getFormData = () => {
            return {
                quotas: $('#sett-edit [name="quotas"]').val(),
                min_works: $('#sett-edit [name="min_works"]').val(),
                expired: $('#sett-edit [name="expired"]').val(),
            };
        }

        $('#sett-editbtn').on('click', function() {
            $('#sett-info').hide();
            $('#sett-edit').fadeIn();
        });

        $('#sett-cancelbtn').on('click', function() {
            $('#sett-info').fadeIn();
            $('#sett-edit').hide();
        });

        $('#sett-confirmbtn').on('click', function() {
            $.ajax({
                url: "{{ route('hc.setting.leave.update') }}",
                type: 'POST',
                data: getFormData(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    toastr.success(data.message, 'Selamat 🚀 !');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                },
                error: function(xhr, status, error) {
                    const data = xhr.responseJSON;
                    toastr.error(data.message, 'Opps!');
                }
            });
        });

        $('#sett-edit').hide();
    }
</script>
