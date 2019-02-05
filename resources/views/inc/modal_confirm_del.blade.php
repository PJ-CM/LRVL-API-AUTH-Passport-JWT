
                                                    <!-- Modal-confirmación -->
                                                    <div class="modal fade" id="{{ $modal_id }}" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel_{{ $valor->id }}" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="confirmModalLabel_{{ $valor->id }}">Eliminar registro</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    ¿Está seguro de eliminar este registro definitivamente?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                    <a href="{{ route($ruta_nom, ['id' => $valor->id]) }}" class="btn btn-danger" role="button" title="Confirmar borrado">Confirmar</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
