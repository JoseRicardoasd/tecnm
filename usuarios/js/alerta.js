function eliminar(){
    let respuesta = Swal.fire({
        title: 'Editar Categoria',
        text: "Comfirma si deseas aditar la categoria",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Editar!',
      });
        if (respuesta == true) {
            return true.isConfirmed;
        } else {
            return false;
        }
    
}