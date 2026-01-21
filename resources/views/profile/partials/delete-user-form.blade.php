<section>
    <p class="text-muted mb-3">
        Uma vez que sua conta for excluída, todos os seus recursos e dados serão permanentemente deletados. Antes de excluir sua conta, baixe quaisquer dados ou informações que deseja manter.
    </p>

    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirm-user-deletion">
        <i class="fas fa-trash"></i> Excluir Conta
    </button>

    <!-- Modal -->
    <div class="modal fade" id="confirm-user-deletion" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-header bg-danger">
                        <h5 class="modal-title">Tem certeza que deseja excluir sua conta?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <p>
                            Uma vez que sua conta for excluída, todos os seus recursos e dados serão permanentemente deletados. 
                            Digite sua senha para confirmar que deseja excluir permanentemente sua conta.
                        </p>

                        <div class="form-group">
                            <label for="password">Senha</label>
                            <input id="password" name="password" type="password" class="form-control @error('password', 'userDeletion') is-invalid @enderror" placeholder="Senha">
                            @error('password', 'userDeletion')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit" class="btn btn-danger">
                            Excluir Conta
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if($errors->userDeletion->isNotEmpty())
        <script>
            $(document).ready(function() {
                $('#confirm-user-deletion').modal('show');
            });
        </script>
    @endif
</section>
