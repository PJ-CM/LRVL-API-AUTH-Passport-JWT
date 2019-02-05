
                            <!-- Modal-inserto -->
                            <div class="modal fade" id="regInsModal" tabindex="-1" role="dialog" aria-labelledby="regInsModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">

                                        <form action="{{ route('users_insertar') }}" method="post" class="needs-validation" novalidate>
                                            @csrf

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="regInsModalLabel">Insertar registro</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="form-row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="validationCustom01">Nombre</label>
                                                    <input type="text" class="form-control" name="name" id="validationCustom01" placeholder="Nombre" value="{{ old('name') }}" required>
                                                    <div class="valid-feedback">
                                                        ¡OK!
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Por favor, teclea un NOMBRE.
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="validationCustom02">Email</label>
                                                    <input type="text" class="form-control" name="email" id="validationCustom02" placeholder="Email" value="{{ old('email') }}" required>
                                                    <div class="valid-feedback">
                                                        ¡OK!
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Por favor, teclea un EMAIL.
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="validationCustomUsername">Nick</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                        </div>
                                                        <input type="text" class="form-control borde_redondeo_lateral_dcho" name="username" id="validationCustomUsername" placeholder="Nick" value="{{ old('username') }}" aria-describedby="inputGroupPrepend" required>
                                                        <div class="valid-feedback">
                                                            ¡OK!
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Por favor, teclea un NICK.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="pass_id">Contraseña</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroupPass">&bull;</span>
                                                        </div>
                                                        <input type="password" class="form-control borde_redondeo_lateral_dcho" name="password" id="pass_id" placeholder="Contraseña" aria-describedby="inputGroupPass" required>
                                                        <div class="valid-feedback">
                                                            ¡OK!
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Por favor, teclea una CONTRASEÑA.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="pass_confirm_id">Confirmar contraseña</label>
                                                    <input type="password" class="form-control" name="password_confirmation" id="pass_confirm_id" placeholder="Confirmar contraseña" required>
                                                    <div class="valid-feedback">
                                                        ¡OK!
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Por favor, confirma la CONTRASEÑA.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-3 mb-3">
                                                    <label for="validationCustom03">Dirección</label>
                                                    <input type="text" class="form-control" name="direction" id="validationCustom03" placeholder="Dirección" value="{{ old('direction') }}">
                                                    <div class="valid-feedback">
                                                        ¡OK!
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Por favor, teclea una DIRECCIÓN.
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="validationCustom04">País</label>
                                                    <input type="text" class="form-control" name="country" id="validationCustom04" placeholder="País" value="{{ old('country') }}">
                                                    <div class="valid-feedback">
                                                        ¡OK!
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Por favor, teclea un PAÍS.
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="validationCustom05">Teléfono</label>
                                                    <input type="text" class="form-control" name="phone" id="validationCustom05" placeholder="Teléfono" value="{{ old('phone') }}">
                                                    <div class="valid-feedback">
                                                        ¡OK!
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Por favor, teclea un TElÉFONO.
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
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
