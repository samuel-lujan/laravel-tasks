<div class="modal" tabindex="-1" role="dialog" id="changeStatus">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-dark">
          <h5 class="modal-title">Mudar Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST" id="form_change_status">
            @csrf
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <input type="hidden" name="_method" id="_method" value="PUT">
            {{ method_field('PUT') }}
            <div class="modal-body">
                <p> Ao mudar o Status para <b>feito</b>, <b>não será</b> possível desfazer, nem editar nem apagar essa tarefa.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-dark">Alterar</button>
            </div>
        </form>
      </div>
    </div>
  </div>