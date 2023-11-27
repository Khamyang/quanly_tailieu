
  function swal_succ(text_succ) {
    Swal.fire({
      toast: false,
      position: 'top-end',
      icon: 'success',
      title: text_succ,
      showConfirmButton: false,
      timer: 1500
    });
  }
  function swal_err(title, txt_err) {
    Swal.fire({
      // toast: true,
      position: 'center',
      icon: 'error',
      title: title,
      text: txt_err,
      showConfirmButton: true,
    });
  }
