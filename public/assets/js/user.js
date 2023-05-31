///DELETE AJAX USER//////

$(document).ready(function() {
    $('.form_delete_user').on('submit', function(e) {
      e.preventDefault();
      var button = $(this);
      Swal.fire({
        icon: 'warning',
          title: 'Are you sure you want to delete this product?',
          showDenyButton: false,
          showCancelButton: true,
          confirmButtonText: 'Yes'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: button.data('route'),
            data: {
              '_method': 'delete'
            },
            success: function (response, textStatus, xhr) {
              Swal.fire({
                icon: 'success',
                  title: response,
                  showDenyButton: false,
                  showCancelButton: false,
                  confirmButtonText: 'Yes'
              }).then((result) => {
                window.location='/admin/users'
              });
            }
          });
        }
      });

    })
    });

