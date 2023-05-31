let showproduct = document.getElementById('productview');
    function OpenProduct(){
        showproduct.classList.add('open-product');
        var inputName = document.querySelector('.input_name');
        var inputStock = document.querySelector('.input_stock');
        var inputExpired = document.querySelector('.input_expired');
        var inputSku = document.querySelector('.input_sku');
        var inputCategory = document.querySelector('.input_category');
        var file    = document.querySelector('input[type=file]').files[0];
        var showImg = document.querySelector('.show_img');
        var reader  = new FileReader();
        document.querySelector('.show_name').innerText = inputName.value ;
        document.querySelector('.show_stock').innerText = inputStock.value;
        document.querySelector('.show_expired').innerText = inputExpired.value;
        document.querySelector('.show_sku').innerText = inputSku.value;
        document.querySelector('.show_categery').innerText = inputCategory.options[inputCategory.selectedIndex].text;
        reader.onloadend = function () {
            showImg.setAttribute("src", this.result);
        }
        if (file) {
         reader.readAsDataURL(file);
            }
    }

    function CloseProduct(){
        showproduct.classList.remove('open-product');
    }


///DELETE AJAX PRODUCTS//////

$(document).ready(function() {
    $('.form_delete_product').on('submit', function(e) {
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
                window.location='/user/products'
              });
            }
          });
        }
      });

    })
    });



///DELETE AJAX CATEGORY//////

$(document).ready(function(message) {
    $('.form_delete_category').on('submit', function(e) {
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
                window.location='/user/category'
              });
            }
          });
        }
      });

    })
    });
