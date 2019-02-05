                            {{-- Habiendo mensajes de acción :: INI --}}
                                @php
                                    $accion_datos = explode('_', $accion);
                                    switch ($accion_datos[0]) {
                                        case 'insertar':
                                            $modal_tit = 'Inserto satisfactorio';
                                            $modal_msg = 'El post con ID ['.$accion_datos[1].'] fue insertado correctamente.';
                                            break;

                                        case 'editar':
                                            $modal_tit = 'Edición satisfactoria';
                                            $modal_msg = 'El post con ID ['.$accion_datos[1].'] fue editado correctamente.';
                                            break;

                                        case 'borrar':
                                            $modal_tit = 'Borrado satisfactorio';
                                            $modal_msg = 'El post con ID ['.$accion_datos[1].'] fue borrado correctamente.';
                                            break;
                                    }
                                @endphp
                            <!-- Modal-acción -->
                            <div class="modal fade" id="accion-modal" tabindex="-1" role="dialog" aria-labelledby="accion-modalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content bg-info text-white">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="accion-modalLabel">{{ $modal_tit }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            {{ $modal_msg }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Habiendo mensajes de acción :: INI --}}
