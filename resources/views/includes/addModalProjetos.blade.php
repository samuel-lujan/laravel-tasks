<div class="modal" tabindex="-1" role="dialog" id="addModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title">Informações</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('store.project')}}" method="POST">
            @csrf
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <div class="modal-body">
                <label for="projeto">Nome do Projeto*</label>
                <input class="form-control" type="text" name="projeto" id="projeto" required>

                <label for="description">Descrição do projeto</label>
                <input class="form-control" type="text" name="description" id="description">

                <label for="dead_line">Data Limite</label>
                <input class="form-control" type="date" name="dead_line" id="dead_line">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Entendi</button>
                <button type="submit" class="btn btn-success">Cadastrar</button>
            </div>
        </form>
      </div>
    </div>
  </div>