 $('.modal-footer').on('click', '.delete', function() {
  $.ajax({
    type: 'post',
    url: '/deletedata',
    data: {
      '_token': $('input[name=_token]').val(),
      'id': $('.did').text()
    },
    success: function(data) {
      $('#item' + $('.did').text()).remove();
      $.notify({
        message: 'Success , Aspirasi anda berhasil dihapus.'
      },{
        type: 'success',
        timer: 4000
      });
    }
  });
});