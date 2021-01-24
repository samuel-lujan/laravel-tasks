<div class="modal" tabindex="-1" role="dialog" id="addModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title">Adicionar Tarefa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('store.task', ['projeto' => $projeto->id])}}" method="POST">
            @csrf
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <div class="modal-body">
                <label for="task">Nome da Tarefa*</label>
                <input class="form-control" type="text" name="task" id="task" required>

                <label for="description">Descrição da tarefa</label>
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