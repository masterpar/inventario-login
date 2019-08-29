                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre: </label>

                            <div class="col-md-6">
                                {!!Form::text('name',null,['class'=>'form-control','required' ,'autofocus'])!!}

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('cc') ? ' has-error' : '' }}">
                            <label for="cc" class="col-md-4 control-label">NIT/CC: </label>

                            <div class="col-md-6">
                                {!!Form::text('cc',null,['class'=>'form-control','required'])!!}

                                @if ($errors->has('cc'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cc') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                            <label for="telefono" class="col-md-4 control-label">Teléfono: </label>

                            <div class="col-md-6">
                                {!!Form::text('telefono',null,['class'=>'form-control','required'])!!}

                                @if ($errors->has('telefono'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('telefono') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                         <div class="form-group{{ $errors->has('tipo') ? ' has-error' : '' }}">
                            <label for="tipo" class="col-md-4 control-label">Seleccione tipo de usuario</label>
                             
                            <div class="col-md-6">
                                
                                <select class="form-control" id="tipo" class="form-control" name="tipo" value="{{ old('tipo') }}" required>
                                    <option>Admin</option>
                                    <option>Empleado</option>
                                    <option>Particular</option>
                                </select>

                                

                                @if ($errors->has('tipo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tipo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                {!!Form::email('email',null,['class'=>'form-control', 'required'])!!}
                                
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" >
                                
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmación de Contraseña</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                                
                            </div>
                        </div>

                        
