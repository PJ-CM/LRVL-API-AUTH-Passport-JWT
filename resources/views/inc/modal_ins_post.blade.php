
                            <!-- Modal-inserto -->
                            <div class="modal fade" id="regInsModal" tabindex="-1" role="dialog" aria-labelledby="regInsModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">

                                        <form action="{{ route('posts_insertar') }}" method="post" class="needs-validation" novalidate>
                                            @csrf

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="regInsModalLabel">Insertar registro</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="form-row">
                                                <div class="col-md-5 mb-3">
                                                    <label for="validationCustom01">Titulo</label>
                                                    <input type="text" class="form-control" name="titulo" id="validationCustom01" placeholder="Titulo" value="{{ old('name') }}" required>
                                                    <div class="valid-feedback">
                                                        ¡OK!
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Por favor, teclea un TÍTULO.
                                                    </div>
                                                </div>
                                                <div class="col-md-5 mb-3">
                                                    <label for="user_id">Autor</label>
                                                    <select name="user_id" id="user_id" class="custom-select" required>
                                                        <option value=""@empty(old('user_id')) selected @endempty>Seleccionar un usuario</option>
                                                    @foreach ($users_lista as $user)
                                                        <option value="{{ $user->id }}"{{ $user->id == old('user_id') ? ' selected' : '' }}>{{ $user->name }}</option>
                                                    @endforeach
                                                    </select>
                                                    <div class="valid-feedback">¡OK!</div>
                                                    <div class="invalid-feedback">Elegir un usuario</div>
                                                </div>
                                                <div class="col-md-2 mb-3">
                                                    <label for="activo">Activo</label>
                                                    <select name="activo" id="activo" class="custom-select" required>
                                                        <option value=""@empty(old('activo')) selected @endempty>Seleccionar una opción</option>
                                                        <option value="1"{{ old('activo') == 1 ? ' selected' : '' }}>Si</option>
                                                        <option value="0"{{ old('activo') == 0 ? ' selected' : '' }}>No</option>
                                                    </select>
                                                    <div class="valid-feedback">¡OK!</div>
                                                    <div class="invalid-feedback">Elegir una de las opciones</div>
                                                </div>
                                            </div>
                                            {{-- ACTIVO con RadioButtons --}}
                                            {{--
                                            <div class="form-row" style="margin-left: 15px;">
                                                <div class="custom-control custom-radio col-md-5 mb-1" style="margin-left: 75px; padding-left: 50px;">
                                                    <label style="width: 80px;">Activo:</label>
                                                    <input type="radio" class="custom-control-input" id="customControlValidation2" name="radio-stacked" required>
                                                    <label class="custom-control-label" for="customControlValidation2" style="width: 50px;">Si</label>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="custom-control custom-radio col-md-5" style="margin-left: 47.18%;">
                                                    <input type="radio" class="custom-control-input" id="customControlValidation3" name="radio-stacked" required>
                                                    <label class="custom-control-label" for="customControlValidation3" style="width: 50px;">No</label>
                                                    <div class="invalid-feedback">More example invalid feedback text</div>
                                                </div>
                                            </div>--}}
                                            <div class="form-row">
                                                <div class="col-md-12 mb-3">
                                                    <label for="validationTextarea">Texto</label>
                                                    <textarea class="form-control" name="texto" id="validationTextarea" placeholder="Texto" required>{{ old('texto') }}</textarea>
                                                    <div class="valid-feedback">¡OK!</div>
                                                    <div class="invalid-feedback">Por favor, teclea un TEXTO.</div>
                                                </div>
                                            </div>
                                            {{--
                                                Otros tipos de campos que aceptan esta validación de Bootstrap:
                                                    >> https://getbootstrap.com/docs/4.2/components/forms/?#supported-elements
                                                    >> y las de alrededor
                                            --}}
                                            {{--
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck">
                                                    <label class="form-check-label" for="invalidCheck">
                                                        Agree to terms and conditions
                                                    </label>
                                                    <div class="invalid-feedback">
                                                        You must agree before submitting.
                                                    </div>
                                                </div>
                                            </div>
                                            --}}

                                            <div class="col-xs|sm|md|lg|xl-1-12">
                                                @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                @endif
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="modalIns" value="regInsModal">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <button class="btn btn-primary" type="submit" title="Insertar registro">Insertar</button>
                                        </div>

                                        </form>

                                    </div>
                                </div>
                            </div>
