window.showCustomToast = function (message, type = 'success') {
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    icon: type
  })

  Toast.fire({
    title: message
  })
}

window.deleteItem = function (deleteRoute, redirectRoute) {
  Swal.fire({
    title: 'Está seguro?',
    text: 'Esta acción es irreversible!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, eliminar!',
    cancelButtonText: 'No'
  }).then(result => {
    if (result.isConfirmed) {
      axios
        .delete(deleteRoute)
        .then(function (response) {
          Swal.fire('Eliminado!', 'Ha sido eliminado correctamente.', 'success').then(() => {
            window.location.href = redirectRoute
          })
        })
        .catch(function (error) {
          Swal.fire('Uy!', 'Algo ha ido mal. Por favor, inténtelo de nuevo', 'error')

          console.error(error)
        })
    }
  })
}

function validateTwoDigitDecimalNumber(event) {
  const regex = /^[+-]?\d*\.?\d{0,2}$/g
  const specialKeys = ['Backspace', 'Tab', 'End', 'Home', 'ArrowLeft', 'ArrowRight', 'Del', 'Delete']

  if (specialKeys.indexOf(event.key) !== -1) {
    return
  }

  const current = event.target.value
  const position = event.target.selectionStart
  const next = [current.slice(0, position), event.key === 'Decimal' ? '.' : event.key, current.slice(position)].join('')

  if (next && !String(next).match(regex)) {
    event.preventDefault()
  }
}
