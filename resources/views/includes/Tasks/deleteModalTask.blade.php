<div class="modal" tabindex="-1" role="dialog" id="dropTask">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title">Deletar Tarefa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST" id="form_delete_task">
            @csrf
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <input type="hidden" name="_method" id="_method" value="DELETE">
            {{ method_field('DELETE') }}
            <div class="modal-body">
                <p>Tem certeza que deseja apagar <b>para sempre</b> essa tarefa?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger">Deletar</button>
            </div>
        </form>
      </div>
    </div>
  </div>