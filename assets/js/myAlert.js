// sweatalert login (allog: alert login)
const flashdata = $('.allog').data('al');
if (flashdata) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
    })

    Toast.fire({
        type: 'success',
        title: flashdata
    })
}

// alert iuran jika gagal
const iuranG = $('.iuranG').data('iuran');
if( iuranG ){
    Swal({
        title: 'Pembayaran Iuran ' + iuranG,
        text:  'Silahkan bayar bulan depan.',
        type: 'error'
    });
}

// alert iuran berhasil
const iuranB = $('.iuranB').data('iuran');
if( iuranB ){
    Swal({
        title: iuranB,
        text:  'Berhasil dilakukan',
        type: 'success'
    });
}
