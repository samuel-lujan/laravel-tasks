<div class="modal" tabindex="-1" role="dialog" id="checkAll">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title">Marcar Todas Como Feita</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('check.all', ['projeto'=>$projeto->id])}}" method="POST" id="form_delete_task">
            @csrf
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <input type="hidden" name="_method" id="_method" value="PUT">
            {{ method_field('PUT') }}
            <div class="modal-body">
                <p>Deseja Atualizar todas as tarefas como <b>Feita</b>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-info">Sim</button>
            </div>
        </form>
      </div>
    </div>
  </div>