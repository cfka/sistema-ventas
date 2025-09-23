@if ($errors->has('general'))
    <div class="alert alert-danger col-12 float-sm-left alert-dismissible fade show" id="general-error-alert" role="alert">
        <i class="fas fa-exclamation-triangle mr-2"></i>
            {{ $errors->first('general') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>

    <script>
        const alertElement = document.getElementById('general-error-alert');
        const closeButton = alertElement.querySelector('.close');

        setTimeout(() => {
            if (alertElement.classList.contains('show')) {
            closeButton.click(); // Simula un clic en el botón de cerrar
            }
        }, 5000); // Ajusta el tiempo de espera según sea necesario (en milisegundos)

    </script>
@endif
