<div class="modal fade" id="excluirModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="excluirLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 16px; border: none; overflow: hidden;">
            <div class="modal-header" style="border-bottom: 0.5px solid rgba(0,0,0,0.1); padding: 1.25rem 1.5rem;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <div style="width: 36px; height: 36px; border-radius: 50%; background: #fdecea; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#c0392b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/>
                        </svg>
                    </div>
                    <h1 class="modal-title fs-5" id="excluirLabel">Confirmar exclusão</h1>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body" style="padding: 1.25rem 1.5rem; color: #6c757d; font-size: 14px;">
                Tem certeza que deseja apagar esta revista? Essa ação não pode ser desfeita.
            </div>
            <div class="modal-footer" style="border-top: 0.5px solid rgba(0,0,0,0.1); background: #f8f9fa; padding: 1rem 1.5rem;">
                <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal">Não</button>
                <a id="confirmar" href="#" class="btn btn-apagar-confirmar">Sim, apagar</a>
            </div>
        </div>
    </div>
</div>