<div class="modal" tabindex="-1" role="dialog" id="editModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h5 class="modal-title">Editar Projeto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" id="form_edit">
            @csrf
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <input type="hidden" name="_method" id="_method" value="PUT">
            {{ method_field('PUT') }}
            <div class="modal-body">
                <label for="projeto">Nome do Projeto*</label>
                <input class="form-control" type="text" name="projeto" id="edit_projeto" required>

                <label for="description">Descrição do projeto</label>
                <input class="form-control" type="text" name="description" id="edit_description">

                <label for="dead_line">Data Limite</label>
                <input class="form-control" type="date" name="dead_line" id="edit_dead_line">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">fechar</button>
                <button type="submit" class="btn btn-warning">Editar</button>
            </div>
        </form>
      </div>
    </div>
  </div>