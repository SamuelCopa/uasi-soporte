<div class="row padding-1 p-1">
    <div class="contenedor">
       <fieldset class="fieldset1">
            <legend class="legend1">DATOS DEL SOLICITANTE</legend>
            <div class="fila-3">
                <div class="title div">
                    <label for="funcionario_activo" class="form-label">{{ __('TIPO DE FUNCIONARIO:') }}</label>
                    <select name="funcionario_activo" class="form-control">
                        <option value=""disabled {{'selected' }}>SELECCIONE UNA OPCION</option>
                        <option value="1" {{ old('funcionario_activo', $registroCpu->funcionario_activo) == 1 ? 'selected' : '' }}>FUNCIONARIO ACTIVO</option>
                        <option value="0" {{ old('funcionario_activo', $registroCpu->funcionario_activo) == 0 ? 'selected' : '' }}>EX FUNCIONARIO</option>
                    </select>
                </div>
            </div>
        <div class="fila-4">
        <div class="div title">
            <label for="grado_academico" class="form-label">{{ __('GRADO ACADEMICO:') }}</label>
            <select name="grado_academico" class="form-control">
                <option value="" disabled {{ 'selected' }}>SELECCIONE UNA OPCION</option>
                <option value="QR" {{ old('expedido', $RegistroCpu->funcionario->expedido ?? '') == 'QR' ? 'selected' : '' }} >QR</option>
                <option value="Abg." {{ old('grado_academico', $registroCpu->funcionario->grado_academico ?? '') == 'Abg.' ? 'selected' : '' }} >ABG.</option>
                <option value="Arq." {{ old('grado_academico', $registroCpu->funcionario->grado_academico ?? '') == 'Arq.' ? 'selected' : '' }}>ARQ.</option>
                <option value="Dr." {{ old('grado_academico', $registroCpu->funcionario->grado_academico ?? '') == 'Dr.' ? 'selected' : '' }}>DR.</option>
                <option value="Dra." {{ old('grado_academico', $registroCpu->funcionario->grado_academico ?? '') == 'Dra.' ? 'selected' : '' }}>DRA.</option>
                <option value="Ing." {{ old('grado_academico', $registroCpu->funcionario->grado_academico ?? '') == 'Ing.' ? 'selected' : '' }}>ING.</option>
                <option value="Lic." {{ old('grado_academico', $registroCpu->funcionario->grado_academico ?? '') == 'Lic.' ? 'selected' : '' }}>LIC.</option>
                <option value="Tec." {{ old('grado_academico', $registroCpu->funcionario->grado_academico ?? '') == 'Tec.' ? 'selected' : '' }}>TEC.</option>
                <option value="Sr." {{ old('grado_academico', $registroCpu->funcionario->grado_academico ?? '') == 'Sr.' ? 'selected' : '' }} >SR.</option>
                <option value="Sra." {{ old('grado_academico', $registroCpu->funcionario->grado_academico ?? '') == 'Sra.' ? 'selected' : '' }} >SRA.</option>
            </select>
        </div>
        <div class="div title">
            <label for="paterno" class="form-label">{{ __('APELLIDO PATERNO') }}</label>
            <input type="text" name="paterno" class="form-control @error('paterno') is-invalid @enderror" value="{{ old('paterno', $registroCpu->funcionario?->paterno) }}" id="paterno" placeholder="Paterno">
            {!! $errors->first('paterno', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="div title">
            <label for="materno" class="form-label">{{ __('APELLIDO MATERNO') }}</label>
            <input type="text" name="materno" class="form-control @error('materno') is-invalid @enderror" value="{{ old('materno', $registroCpu->funcionario?->materno) }}" id="materno" placeholder="Materno">
            {!! $errors->first('materno', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="div title">
            <label for="nombre" class="form-label">{{ __('NOMBRE(S)') }}</label>
            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $registroCpu->funcionario?->nombre) }}" id="nombre" placeholder="Nombre">
            {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        </div>
        <div class="fila-2">
        <div class="div title">
            <label for="ci" class="form-label">{{ __('C.I.') }}</label>
            <input type="text" name="ci" class="form-control @error('ci') is-invalid @enderror" value="{{ old('ci', $registroCpu->funcionario?->ci) }}" id="ci" placeholder="Ci">
            {!! $errors->first('ci', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="div title">
            <label for="expedido" class="form-label">{{ __('EXPEDIDO:') }}<span class="required">*</span></label>
            <select name="expedido" class="form-control">
                <option value="" disabled {{ 'selected' }}>SELECCIONE UNA OPCION</option>
                <option value="LP" {{ old('expedido', $registroCpu->funcionario->expedido ?? '') == 'LP' ? 'selected' : '' }} >LA PAZ</option>
                <option value="CB" {{ old('expedido', $registroCpu->funcionario->expedido ?? '') == 'CB' ? 'selected' : '' }}>COCHABAMBA</option>
                <option value="SC" {{ old('expedido', $registroCpu->funcionario->expedido ?? '') == 'SC' ? 'selected' : '' }}>SANTA CRUZ</option>
                <option value="OR" {{ old('expedido', $registroCpu->funcionario->expedido ?? '') == 'OR' ? 'selected' : '' }}>ORURO</option>
                <option value="CH" {{ old('expedido', $registroCpu->funcionario->expedido ?? '') == 'CH' ? 'selected' : '' }}>CHUQUISACA</option>
                <option value="PO" {{ old('expedido', $registroCpu->funcionario->expedido ?? '') == 'PO' ? 'selected' : '' }}>POTOSI</option>
                <option value="T" {{ old('expedido', $registroCpu->funcionario->expedido ?? '') == 'T' ? 'selected' : '' }}>TARIJA</option>
                <option value="B" {{ old('expedido', $registroCpu->funcionario->expedido ?? '') == 'B' ? 'selected' : '' }} >BENI</option>
                <option value="P" {{ old('expedido', $registroCpu->funcionario->expedido ?? '') == 'P' ? 'selected' : '' }} >PANDO</option>
                <option value="QR" {{ old('expedido', $registroCpu->funcionario->expedido ?? '') == 'QR' ? 'selected' : '' }} >QR</option>
            </select>
        </div>
        <div class="div title">
            <label for="celular" class="form-label">{{ __('CELULAR') }}</label>
            <input type="text" name="celular" class="form-control @error('celular') is-invalid @enderror" value="{{ old('celular', $registroCpu->funcionario?->celular) }}" id="celular" placeholder="Celular">
            {!! $errors->first('celular', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        </div>
        <div class="fila-2">            
        <div class="div title">
            <label for="cargo" class="form-label">{{ __('CARGO') }}</label>
            <input type="text" name="cargo" class="form-control @error('cargo') is-invalid @enderror" value="{{ old('cargo', $registroCpu->funcionario?->cargo) }}" id="cargo" placeholder="Cargo">
            {!! $errors->first('cargo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="div title">
            <label for="email" class="form-label">{{ __('CORREO ELECTRÓNICO') }}</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $registroCpu->funcionario?->email) }}" id="email" placeholder="CORREO ELECTRÓNICO">
            {!! $errors->first('email', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
            <input type="hidden" name="funcionario_id" class="form-control @error('funcionario_id') is invalid @enderror" value="{{ old('funcionario_id', $registroCpu?->funcionario_id) }}" id="estado_id"> 

        <div class="div title">
            <label for="fecha" class="form-label">{{ __('FECHA DE RECEPCIÓN') }}</label>
            <input type="datetime-local" name="fecha" class="form-control @error('fecha') is-invalid @enderror" value="{{ old('fecha',date('Y-m-d\TH:i', strtotime($registroCpu?->fecha))) }}" id="fecha" placeholder="Fecha Recepción">
        </div>
        </div>

        <div class="fila-2">
            <div class="div title">
                <label for="user_id" class="form-label">TECNICO A CARGO</label>
                <select name="user_id" id="user_id" class="form-control mi-select">
                    <option value="" disabled {{ old('user_id',$registroCpu?->user_id) ? '' : 'selected'}}>Seleccionar</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $user->id == $registroCpu->user_id ? 'selected' : '' }}>
                            {{ $user->name }} {{ $user->paterno }} {{ $user->materno }}
                        </option>
                    @endforeach
                    <option value="">QUITAR</option>
                </select>
            </div>
            <div class="div title">
                <label for="fecha_asignacion" class="form-label">{{ __('FECHA DE ASIGNACIÓN') }}</label>
                @if(! $registroCpu->fecha_asignacion)
                <input type="datetime-local" name="fecha_asignacion" class="form-control @error('fecha_asignacion') is-invalid @enderror" id="fecha_asignacion" >
                @else
                <input type="datetime-local" name="fecha_asignacion" class="form-control @error('fecha_asignacion') is-invalid @enderror" value="{{ old('fecha_asignacion',date('Y-m-d\TH:i', strtotime($registroCpu?->fecha_asignacion))) }}" id="fecha_asignacion" >
                @endif
            </div>
            <div class="div title">
                <label for="fecha_inicio" class="form-label">{{ __('FECHA DE INICIO') }}</label>
                @if(! $registroCpu->fecha_inicio)
                <input type="datetime-local" name="fecha_inicio" class="form-control @error('fecha_inicio') is-invalid @enderror" id="fecha_inicio" >
                @else
                <input type="datetime-local" name="fecha_inicio" class="form-control @error('fecha_inicio') is-invalid @enderror" value="{{ old('fecha_inicio',date('Y-m-d\TH:i', strtotime($registroCpu?->fecha_inicio))) }}" id="fecha_inicio" >
                @endif
            </div>
        </div>
        <div class="fila-3">
        <div class="div title">
            <label for="dependencia_id" class="form-label">{{ __('DEPENDENCIA') }}</label>
            <select name="dependencia_id" class="form-control @error('dependencia_id') is invalid @enderror" id="dependencia_id"> 
                <option value="" disabled {{ old('dependencia_id',$registroCpu?->dependencia_id) ? '' : 'selected' }}>Seleccionar </option> 
                @foreach ($dependencia as $item)
                <option value="{{ $item->id }}" {{ (old('dependencia_id',$registroCpu?->dependencia_id)== $item->id ) ? 'selected' : '' }}> 
                    {{ $item->dependencias}}
                </option> 
                @endforeach                 
            </select>  
            {!! $errors->first('dependencia_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        </fieldset>

        <fieldset class="fieldset1">
            <legend class="legend1">DATOS DEL CPU</legend>
        <div class="fila-1">
            <div class="div title">
                <label for="usuario" class="form-label">{{ __('USUARIO :') }}</label>
                <input type="text" name="usuario" class="form-control @error('usuario') is-invalid @enderror" value="{{ old('usuario', $registroCpu?->usuario) }}" id="usuario" placeholder="Usuario">
                {!! $errors->first('usuario', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
            <div class="div title">
                <label for="contrasena" class="form-label">{{ __('CONTRASEÑA :') }}</label>
                <input type="text" name="contrasena" class="form-control @error('contrasena') is-invalid @enderror" value="{{ old('contrasena', $registroCpu?->contrasena) }}" id="contrasena" placeholder="Contraseña">
                {!! $errors->first('contrasena', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
        </div>

        <div class="fila-1">
            <div class="div title">
                <label for="cod_gamea" class="form-label">{{ __('CODIGO GAMEA :') }}</label>
                <input type="text" name="cod_gamea" class="form-control @error('cod_gamea') is-invalid @enderror" value="{{ old('cod_gamea', $registroCpu?->cod_gamea) }}" id="cod_gamea" placeholder="Cod Gamea" required>
                {!! $errors->first('cod_gamea', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
            @if($registroCpu->id) 
            <div class="div title">
                <label for="cod_registro" class="form-label">{{ __('NUMERO DE RECEPCIÓN :') }}</label>
                <input type="text" name="cod_registro" class="form-control @error('cod_registro') is-invalid @enderror" value="{{ old('cod_registro', $registroCpu?->cod_registro) }}" id="cod_registro" placeholder="No. DE RECEPCIÓN">
                {!! $errors->first('cod_registro', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>  
            @endif
        </div> 
        <hr class="hr">            

            <div class="fila-5" >  
                {{-- -----------------CASE----------- --}}
                <div class="columna3">
                    <label class="text-center" >{{ __('CASE:') }}</label>
                    <div class="div title">
                        <label for="marcacase_id" class="form-label">{{ __('MARCA :') }}</label>
                        <select name="marcacase_id" class="form-control miSelect @error('marcacase_id') is invalid @enderror" id="marcacase_id"> 
                            <option value="" disabled {{ old('marcacase_id',$registroCpu?->marcacase_id) ? '' : 'selected' }}>Seleccionar </option> 
                            @foreach ($marcacase as $marca)
                            <option value="{{ $marca->id }}" {{ (old('marcacase_id',$registroCpu?->marcacase_id)== $marca->id ) ? 'selected' : '' }}> 
                                {{ $marca->marca }}
                            </option> 
                            @endforeach  
                        </select> 
                        {!! $errors->first('marcacase_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>
                    <div class="div title">
                        <label for="colorcase_id" class="form-label">{{ __('COLOR :') }}</label>
                        <select name="colorcase_id" class="form-control @error('colorcase_id') is invalid @enderror" id="colorcase_id"> 
                            <option value="" disabled {{ old('colorcase_id',$registroCpu?->colorcase_id) ? '' : 'selected' }}>Seleccionar </option> 
                            @foreach ($colorcase as $color)
                            <option value="{{ $color->id }}" {{ (old('colorcase_id',$registroCpu?->colorcase_id)== $color->id ) ? 'selected' : '' }}> 
                                {{ $color->color}}
                            </option> 
                            @endforeach
                            <option value="">QUITAR</option>                   
                        </select> 
                        <input type="text" name="colorcase_otro" class="form-control" id="colorcase_otro" style="display:none;" placeholder="Ingrese el color">
                        {!! $errors->first('colorcase_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>
                </div>

                {{-- ----------------PROCESADOR----------------- --}}
                <div class="columna3">
                        <label class="text-center" >{{ __('PROCESADOR:') }}</label>
                    <div class="div title">
                        <label for="marcaprocesador_id" class="form-label" >{{ __('MARCA :') }}</label>                   
                        <select name="marcaprocesador_id" class="form-control @error('marcaprocesador_id') is invalid @enderror" id="marcaprocesador_id"> 
                            <option value="" disabled {{ old('marcaprocesador_id',$registroCpu?->marcaprocesador_id) ? '' : 'selected' }}>Seleccionar </option> 
                            @foreach ($marcaprocesador as $marca)
                            <option value="{{ $marca->id }}" {{ (old('marcaprocesador_id',$registroCpu?->marcaprocesador_id)== $marca->id ) ? 'selected' : '' }}> 
                                {{ $marca->marca}}
                            </option> 
                            @endforeach
                            <option value="">QUITAR</option>                  
                        </select> 
                        <input type="text" name="marcaprocesador_otro" class="form-control" id="marcaprocesador_otro" style="display:none;" placeholder="Ingrese la marca">
                        {!! $errors->first('marcaprocesador_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>
    
                    <div class="div title">
                        <label for="modeloprocesador_id" class="form-label">{{ __('MODELO :') }}</label>
                        <select name="modeloprocesador_id" class="form-control @error('modeloprocesador_id') is invalid @enderror" id="modeloprocesador_id"> 
                            <option value="" disabled {{ old('modeloprocesador_id',$registroCpu?->modeloprocesador_id) ? '' : 'selected' }}>Seleccionar </option> 
                            @foreach ($modprocesador as $modelo)
                            <option value="{{ $modelo->id }}" {{ (old('modeloprocesador_id',$registroCpu?->modeloprocesador_id)== $modelo->id ) ? 'selected' : '' }}> 
                                {{ $modelo->modelo}}
                            </option> 
                            @endforeach
                            <option value="">QUITAR</option>                 
                        </select>
                        <input type="text" name="modeloprocesador_otro" class="form-control" id="modeloprocesador_otro" style="display:none;" placeholder="Ingrese el modelo">
                        {!! $errors->first('modeloprocesador_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>
    
                    <div class="div title">
                        <label for="genprocesador_id" class="form-label">{{ __('GENERACION :') }}</label>
                        <select name="genprocesador_id" class="form-control @error('genprocesador_id') is invalid @enderror" id="genprocesador_id"> 
                            <option value="" disabled {{ old('genprocesador_id',$registroCpu?->genprocesador_id) ? '' : 'selected' }}>Seleccionar </option> 
                            @foreach ($genprocesador as $generacion)
                            <option value="{{ $generacion->id }}" {{ (old('genprocesador_id',$registroCpu?->genprocesador_id)== $generacion->id ) ? 'selected' : '' }}> 
                                {{ $generacion->generacion}}
                            </option> 
                            @endforeach
                            <option value="">QUITAR</option>                  
                        </select>
                        <input type="text" name="genprocesador_otro" class="form-control" id="genprocesador_otro" style="display:none;" placeholder="Ingrese la generación">
                        {!! $errors->first('genprocesador_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>
                </div>
                {{-- -----------TARJETA MADRE-------------- --}}
                <div class="columna3"> 
                        <label class="text-center" >{{ __('TARJETA MADRE:') }}</label>
                    <div class="div title">
                        <label for="marcatmadre_id" class="form-label">{{ __('MARCA :') }}</label>
                        <select name="marcatmadre_id" class="form-control @error('marcatmadre_id') is invalid @enderror" id="marcatmadre_id"> 
                            <option value="" disabled {{ old('marcatmadre_id',$registroCpu?->marcatmadre_id) ? '' : 'selected' }}>Seleccionar </option> 
                            @foreach ($marcatmadre as $marca)
                            <option value="{{ $marca->id }}" {{ (old('marcatmadre_id',$registroCpu?->marcatmadre_id)== $marca->id ) ? 'selected' : '' }}> 
                                {{ $marca->marca}}
                            </option>                        
                            @endforeach 
                            <option value="">QUITAR</option>                 
                        </select>
                        <input type="text" name="marcatmadre_otro" class="form-control" id="marcatmadre_otro" style="display:none;" placeholder="Ingrese la marca">
                        {!! $errors->first('marcatmadre_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>
    
                    <div class="div title">
                        <label for="modtmadre_id" class="form-label">{{ __('MODELO') }}</label>
                        <select name="modtmadre_id" class="form-control @error('modtmadre_id') is invalid @enderror" id="modtmadre_id"> 
                            <option value="" disabled {{ old('modtmadre_id',$registroCpu?->modtmadre_id) ? '' : 'selected' }}>Seleccionar </option> 
                            @foreach ($modelotmadre as $modelo)
                            <option value="{{ $modelo->id }}" {{ (old('modtmadre_id',$registroCpu?->modtmadre_id)== $modelo->id ) ? 'selected' : '' }}> 
                                {{ $modelo->modelo}}
                            </option> 
                            @endforeach
                            <option value="">QUITAR</option>                  
                        </select>
                        <input type="text" name="modtmadre_otro" class="form-control" id="modtmadre_otro" style="display:none;" placeholder="Ingrese la marca">
                        {!! $errors->first('modtmadre_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>
                </div>
                {{-- ---------------DISCO DURO---------------------- --}}
                <div class="columna3">
                        <label class="text-center" >{{ __('DISCO DURO:') }}</label>
                    <div class="div title">
                        <label for="marcadisco_id" class="form-label">{{ __('MARCA :') }}</label>                    
                        <select name="marcadisco_id" class="form-control @error('marcadisco_id') is invalid @enderror" id="marcadisco_id"> 
                            <option value="" disabled {{ old('marcadisco_id',$registroCpu?->marcadisco_id) ? '' : 'selected' }}>Seleccionar </option> 
                            @foreach ($marcadisco as $marca)
                            <option value="{{ $marca->id }}" {{ (old('marcadisco_id',$registroCpu?->marcadisco_id)== $marca->id ) ? 'selected' : '' }}> 
                                {{ $marca->marca}}
                            </option> 
                            @endforeach
                            <option value="">QUITAR</option>   
                        </select>
                        <input type="text" name="marcadisco_otro" class="form-control" id="marcadisco_otro" style="display:none;" placeholder="Ingrese la marca">
                        {!! $errors->first('marcadisco_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>

                    <div class="div title">
                        <label for="capacdisco_id" class="form-label">{{ __('CAPACIDAD :') }}</label>
                        <select name="capacdisco_id" class="form-control @error('capacdisco_id') is invalid @enderror" id="capacdisco_id"> 
                            <option value="" disabled {{ old('capacdisco_id',$registroCpu?->capacdisco_id) ? '' : 'selected' }}>Seleccionar </option> 
                            @foreach ($capdisco as $capacidad)
                            <option value="{{ $capacidad->id }}" {{ (old('capacdisco_id',$registroCpu?->capacdisco_id)== $capacidad->id ) ? 'selected' : '' }}> 
                                {{ $capacidad->capacidad}}
                            </option> 
                            @endforeach
                            <option value="">QUITAR</option>  
                        </select>
                        <input type="text" name="capacdisco_otro" class="form-control" id="capacdisco_otro" style="display:none;" placeholder="Ingrese la marca">
                        {!! $errors->first('capacdisco_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>
    
                    <div class="div title">
                        <label for="tipodisco_id" class="form-label">{{ __('TIPO :') }}</label>
                        <select name="tipodisco_id" class="form-control @error('tipodisco_id') is invalid @enderror" id="tipodisco_id"> 
                            <option value="" disabled {{ old('tipodisco_id',$registroCpu?->tipodisco_id) ? '' : 'selected' }}>Seleccionar </option> 
                            @foreach ($tipodisco as $tipo)
                            <option value="{{ $tipo->id }}" {{ (old('tipodisco_id',$registroCpu?->tipodisco_id)== $tipo->id ) ? 'selected' : '' }}> 
                                {{ $tipo->tipo}}
                            </option> 
                            @endforeach
                            <option value="">QUITAR</option>  
                        </select>
                        <input type="text" name="tipodisco_otro" class="form-control" id="tipodisco_otro" style="display:none;" placeholder="Ingrese la marca">
                        {!! $errors->first('tipodisco_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>
                </div>

            </div> 
            <hr class="hr"> 
        <div class="fila-5">
                {{-- --------------MEMORIA RAM------------- --}}
            <div class="columna3">
                    <label class="text-center" >{{ __('MEMORIA RAM:') }}</label>
                <div class="div title">
                    <label for="disipador_id" class="form-label">{{ __('DISIPADOR :') }}</label>
                    <select name="disipador_id" class="form-control @error('disipador_id') is invalid @enderror" id="disipador_id"> 
                        <option value="" disabled {{ old('disipador_id',$registroCpu?->disipador_id) ? '' : 'selected' }}>Seleccionar </option> 
                        @foreach ($disipadorram as $disip)
                        <option value="{{ $disip->id }}" {{ (old('disipador_id',$registroCpu?->disipador_id)== $disip->id ) ? 'selected' : '' }}> 
                            {{ $disip->opcion}}
                        </option> 
                        @endforeach  
                        <option value="">QUITAR</option>
                    </select>
                    {!! $errors->first('disipador_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
                <div class="div title">
                    <label for="marcaram_id" class="form-label">{{ __('MARCA :') }}</label>                    
                    <select name="marcaram_id" class="form-control @error('marcaram_id') is invalid @enderror" id="marcaram_id"> 
                        <option value="" disabled {{ old('marcaram_id',$registroCpu?->marcaram_id) ? '' : 'selected' }}>Seleccionar </option> 
                        @foreach ($marcaram as $marca)
                        <option value="{{ $marca->id }}" {{ (old('marcaram_id',$registroCpu?->marcaram_id)== $marca->id ) ? 'selected' : '' }}> 
                            {{ $marca->marca}}
                        </option> 
                        @endforeach 
                        <option value="">QUITAR</option>
                    </select>
                    <input type="text" name="marcaram_otro" class="form-control" id="marcaram_otro" style="display:none;" placeholder="Ingrese la marca">
                    {!! $errors->first('marcaram_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>

                <div class="div title">
                    <label for="capacram_id" class="form-label">{{ __('CAPACIDAD :') }}</label>
                    <select name="capacram_id" class="form-control @error('capacram_id') is invalid @enderror" id="capacram_id"> 
                        <option value="" disabled {{ old('capacram_id',$registroCpu?->capacram_id) ? '' : 'selected' }}>Seleccionar </option> 
                        @foreach ($capram as $capacidad)
                        <option value="{{ $capacidad->id }}" {{ (old('capacram_id',$registroCpu?->capacram_id)== $capacidad->id ) ? 'selected' : '' }}> 
                            {{ $capacidad->capacidad}}
                        </option> 
                        @endforeach
                        <option value="">QUITAR</option>
                    </select>
                    <input type="text" name="capacram_otro" class="form-control" id="capacram_otro" style="display:none;" placeholder="Ingrese la marca">
                    {!! $errors->first('capacram_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>

                <div class="div title">
                    <label for="tiporam_id" class="form-label">{{ __('TIPO DE CONEXION :') }}</label>                    
                    <select name="tiporam_id" class="form-control @error('tiporam_id') is invalid @enderror" id="tiporam_id"> 
                        <option value="" disabled {{ old('tiporam_id',$registroCpu?->tiporam_id) ? '' : 'selected' }}>Seleccionar </option> 
                        @foreach ($tiporam as $tipo)
                        <option value="{{ $tipo->id }}" {{ (old('tiporam_id',$registroCpu?->tiporam_id)== $tipo->id ) ? 'selected' : '' }}> 
                            {{ $tipo->tipo}}
                        </option>                         
                        @endforeach 
                        <option value="">QUITAR</option>
                    </select>
                    <input type="text" name="modram_otro" class="form-control" id="modram_otro" style="display:none;" placeholder="Ingrese la marca">
                    {!! $errors->first('tiporam_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>

                <div class="div title">
                    <label for="cantidad_id" class="form-label">{{ __('CANTIDAD :') }}</label>
                    <select name="cantidad_id" class="form-control @error('cantidad_id') is invalid @enderror" id="cantidad_id"> 
                        <option value="" disabled {{ old('cantidad_id',$registroCpu?->cantidad_id) ? '' : 'selected' }}>Seleccionar </option> 
                        @foreach ($cantidadram as $cantidad)
                        <option value="{{ $cantidad->id }}" {{ (old('cantidad_id',$registroCpu?->cantidad_id)== $cantidad->id ) ? 'selected' : '' }}> 
                            {{ $cantidad->cantidad}}
                        </option>                         
                        @endforeach 
                        <option value="">QUITAR</option>
                    </select>
                    <input type="text" name="modram_otro" class="form-control" id="modram_otro" style="display:none;" placeholder="Ingrese la marca">
                    {!! $errors->first('cantidad_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>
                {{-- --------------MEMORIA RAM2------------- --}}
            <div class="columna3">
                    <label class="text-center" >{{ __('MEMORIA RAM 2:') }}</label>
                <div class="div title">
                    <label for="disipador2_id" class="form-label">{{ __('DISIPADOR :') }}</label>
                    <select name="disipador2_id" class="form-control @error('disipador2_id') is invalid @enderror" id="disipador2_id"> 
                        <option value="" disabled {{ old('disipador2_id',$registroCpu?->disipador2_id) ? '' : 'selected' }}>Seleccionar </option> 
                        @foreach ($disipadorram as $disip)
                        <option value="{{ $disip->id }}" {{ (old('disipador2_id',$registroCpu?->disipador2_id)== $disip->id ) ? 'selected' : '' }}> 
                            {{ $disip->opcion}}
                        </option> 
                        @endforeach  
                    </select>
                    {!! $errors->first('disipador2_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
                <div class="div title">
                    <label for="marcaram2_id" class="form-label">{{ __('MARCA :') }}</label>                    
                    <select name="marcaram2_id" class="form-control @error('marcaram2_id') is invalid @enderror" id="marcaram2_id"> 
                        <option value="" disabled {{ old('marcaram2_id',$registroCpu?->marcaram2_id) ? '' : 'selected' }}>Seleccionar </option> 
                        @foreach ($marcaram as $marca)
                        <option value="{{ $marca->id }}" {{ (old('marcaram2_id',$registroCpu?->marcaram2_id)== $marca->id ) ? 'selected' : '' }}> 
                            {{ $marca->marca}}
                        </option> 
                        @endforeach 
                        <option value="">QUITAR</option>
                    </select>
                    <input type="text" name="marcaram_otro" class="form-control" id="marcaram_otro" style="display:none;" placeholder="Ingrese la marca">
                    {!! $errors->first('marcaram2_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>

                <div class="div title">
                    <label for="capacram2_id" class="form-label">{{ __('CAPACIDAD :') }}</label>
                    <select name="capacram2_id" class="form-control @error('capacram2_id') is invalid @enderror" id="capacram2_id"> 
                        <option value="" disabled {{ old('capacram2_id',$registroCpu?->capacram2_id) ? '' : 'selected' }}>Seleccionar </option> 
                        @foreach ($capram as $capacidad)
                        <option value="{{ $capacidad->id }}" {{ (old('capacram2_id',$registroCpu?->capacram2_id)== $capacidad->id ) ? 'selected' : '' }}> 
                            {{ $capacidad->capacidad}}
                        </option> 
                        @endforeach
                        <option value="">QUITAR</option>
                    </select>
                    <input type="text" name="capacram_otro" class="form-control" id="capacram_otro" style="display:none;" placeholder="Ingrese la marca">
                    {!! $errors->first('capacram2_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>

                <div class="div title">
                    <label for="tiporam2_id" class="form-label">{{ __('TIPO DE CONEXION :') }}</label>                    
                    <select name="tiporam2_id" class="form-control @error('tiporam2_id') is invalid @enderror" id="tiporam2_id"> 
                        <option value="" disabled {{ old('tiporam2_id',$registroCpu?->tiporam2_id) ? '' : 'selected' }}>Seleccionar </option> 
                        @foreach ($tiporam as $tipo)
                        <option value="{{ $tipo->id }}" {{ (old('tiporam2_id',$registroCpu?->tiporam2_id)== $tipo->id ) ? 'selected' : '' }}> 
                            {{ $tipo->tipo}}
                        </option>                         
                        @endforeach 
                        <option value="">QUITAR</option>
                    </select>
                    <input type="text" name="modram_otro" class="form-control" id="modram_otro" style="display:none;" placeholder="Ingrese la marca">
                    {!! $errors->first('tiporam2_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>

                <div class="div title">
                    <label for="cantidad2_id" class="form-label">{{ __('CANTIDAD :') }}</label>
                    <select name="cantidad2_id" class="form-control @error('cantidad2_id') is invalid @enderror" id="cantidad2_id"> 
                        <option value="" disabled {{ old('cantidad2_id',$registroCpu?->cantidad2_id) ? '' : 'selected' }}>Seleccionar </option> 
                        @foreach ($cantidadram as $cantidad)
                        <option value="{{ $cantidad->id }}" {{ (old('cantidad2_id',$registroCpu?->cantidad2_id)== $cantidad->id ) ? 'selected' : '' }}> 
                            {{ $cantidad->cantidad}}
                        </option>                         
                        @endforeach 
                        <option value="">QUITAR</option> 
                    </select>
                    <input type="text" name="modram_otro" class="form-control" id="modram_otro" style="display:none;" placeholder="Ingrese la marca">
                    {!! $errors->first('cantidad2_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>
                {{-- --------------MEMORIA RAM3------------- --}}
            <div class="columna3">
                    <label class="text-center" >{{ __('MEMORIA RAM 3:') }}</label>
                <div class="div title">
                    <label for="disipador3_id" class="form-label">{{ __('DISIPADOR :') }}</label>
                    <select name="disipador3_id" class="form-control @error('disipador3_id') is invalid @enderror" id="disipador3_id"> 
                        <option value="" disabled {{ old('disipador3_id',$registroCpu?->disipador3_id) ? '' : 'selected' }}>Seleccionar </option> 
                        @foreach ($disipadorram as $disip)
                        <option value="{{ $disip->id }}" {{ (old('disipador3_id',$registroCpu?->disipador3_id)== $disip->id ) ? 'selected' : '' }}> 
                            {{ $disip->opcion}}
                        </option> 
                        @endforeach  
                        <option value="">QUITAR</option>
                    </select>
                    {!! $errors->first('disipador3_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
                <div class="div title">
                    <label for="marcaram3_id" class="form-label">{{ __('MARCA :') }}</label>                    
                    <select name="marcaram3_id" class="form-control @error('marcaram3_id') is invalid @enderror" id="marcaram3_id"> 
                        <option value="" disabled {{ old('marcaram3_id',$registroCpu?->marcaram3_id) ? '' : 'selected' }}>Seleccionar </option> 
                        @foreach ($marcaram as $marca)
                        <option value="{{ $marca->id }}" {{ (old('marcaram3_id',$registroCpu?->marcaram3_id)== $marca->id ) ? 'selected' : '' }}> 
                            {{ $marca->marca}}
                        </option> 
                        @endforeach 
                        <option value="">QUITAR</option>
                    </select>
                    <input type="text" name="marcaram_otro" class="form-control" id="marcaram_otro" style="display:none;" placeholder="Ingrese la marca">
                    {!! $errors->first('marcaram3_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>

                <div class="div title">
                    <label for="capacram3_id" class="form-label">{{ __('CAPACIDAD :') }}</label>
                    <select name="capacram3_id" class="form-control @error('capacram3_id') is invalid @enderror" id="capacram3_id"> 
                        <option value="" disabled {{ old('capacram3_id',$registroCpu?->capacram3_id) ? '' : 'selected' }}>Seleccionar </option> 
                        @foreach ($capram as $capacidad)
                        <option value="{{ $capacidad->id }}" {{ (old('capacram3_id',$registroCpu?->capacram3_id)== $capacidad->id ) ? 'selected' : '' }}> 
                            {{ $capacidad->capacidad}}
                        </option> 
                        @endforeach
                        <option value="">QUITAR</option>
                    </select>
                    <input type="text" name="capacram_otro" class="form-control" id="capacram_otro" style="display:none;" placeholder="Ingrese la marca">
                    {!! $errors->first('capacram3_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>

                <div class="div title">
                    <label for="tiporam3_id" class="form-label">{{ __('TIPO DE CONEXION :') }}</label>                    
                    <select name="tiporam3_id" class="form-control @error('tiporam3_id') is invalid @enderror" id="tiporam3_id"> 
                        <option value="" disabled {{ old('tiporam3_id',$registroCpu?->tiporam3_id) ? '' : 'selected' }}>Seleccionar </option> 
                        @foreach ($tiporam as $tipo)
                        <option value="{{ $tipo->id }}" {{ (old('tiporam3_id',$registroCpu?->tiporam3_id)== $tipo->id ) ? 'selected' : '' }}> 
                            {{ $tipo->tipo}}
                        </option>                         
                        @endforeach 
                        <option value="">QUITAR</option>
                    </select>
                    <input type="text" name="modram_otro" class="form-control" id="modram_otro" style="display:none;" placeholder="Ingrese la marca">
                    {!! $errors->first('tiporam3_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>

                <div class="div title">
                    <label for="cantidad3_id" class="form-label">{{ __('CANTIDAD :') }}</label>
                    <select name="cantidad3_id" class="form-control @error('cantidad3_id') is invalid @enderror" id="cantidad3_id"> 
                        <option value="" disabled {{ old('cantidad3_id',$registroCpu?->cantidad3_id) ? '' : 'selected' }}>Seleccionar </option> 
                        @foreach ($cantidadram as $cantidad)
                        <option value="{{ $cantidad->id }}" {{ (old('cantidad3_id',$registroCpu?->cantidad3_id)== $cantidad->id ) ? 'selected' : '' }}> 
                            {{ $cantidad->cantidad}}
                        </option>                         
                        @endforeach 
                        <option value="">QUITAR</option>
                    </select>
                    <input type="text" name="modram_otro" class="form-control" id="modram_otro" style="display:none;" placeholder="Ingrese la marca">
                    {!! $errors->first('cantidad3_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>
                {{-- --------------MEMORIA RAM4------------- --}}
            <div class="columna3">
                    <label class="text-center" >{{ __('MEMORIA RAM 4:') }}</label>
                <div class="div title">
                    <label for="disipador4_id" class="form-label">{{ __('DISIPADOR :') }}</label>
                    <select name="disipador4_id" class="form-control @error('disipador4_id') is invalid @enderror" id="disipador4_id"> 
                        <option value="" disabled {{ old('disipador4_id',$registroCpu?->disipador4_id) ? '' : 'selected' }}>Seleccionar </option> 
                        @foreach ($disipadorram as $disip)
                        <option value="{{ $disip->id }}" {{ (old('disipador4_id',$registroCpu?->disipador4_id)== $disip->id ) ? 'selected' : '' }}> 
                            {{ $disip->opcion}}
                        </option> 
                        @endforeach  
                        <option value="">QUITAR</option>
                    </select>
                    {!! $errors->first('disipador4_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
                <div class="div title">
                    <label for="marcaram4_id" class="form-label">{{ __('MARCA :') }}</label>                    
                    <select name="marcaram4_id" class="form-control @error('marcaram4_id') is invalid @enderror" id="marcaram4_id"> 
                        <option value="" disabled {{ old('marcaram4_id',$registroCpu?->marcaram4_id) ? '' : 'selected' }}>Seleccionar </option> 
                        @foreach ($marcaram as $marca)
                        <option value="{{ $marca->id }}" {{ (old('marcaram4_id',$registroCpu?->marcaram4_id)== $marca->id ) ? 'selected' : '' }}> 
                            {{ $marca->marca}}
                        </option> 
                        @endforeach 
                    <option value="">QUITAR</option> 
                    </select>
                    <input type="text" name="marcaram_otro" class="form-control" id="marcaram_otro" style="display:none;" placeholder="Ingrese la marca">
                    {!! $errors->first('marcaram4_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>

                <div class="div title">
                    <label for="capacram4_id" class="form-label">{{ __('CAPACIDAD :') }}</label>
                    <select name="capacram4_id" class="form-control @error('capacram4_id') is invalid @enderror" id="capacram4_id"> 
                        <option value="" disabled {{ old('capacram4_id',$registroCpu?->capacram4_id) ? '' : 'selected' }}>Seleccionar </option> 
                        @foreach ($capram as $capacidad)
                        <option value="{{ $capacidad->id }}" {{ (old('capacram4_id',$registroCpu?->capacram4_id)== $capacidad->id ) ? 'selected' : '' }}> 
                            {{ $capacidad->capacidad}}
                        </option> 
                        @endforeach
                    <option value="">QUITAR</option>  
                    </select>
                    <input type="text" name="capacram_otro" class="form-control" id="capacram_otro" style="display:none;" placeholder="Ingrese la marca">
                    {!! $errors->first('capacram4_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>

                <div class="div title">
                    <label for="tiporam4_id" class="form-label">{{ __('TIPO DE CONEXION :') }}</label>                    
                    <select name="tiporam4_id" class="form-control @error('tiporam4_id') is invalid @enderror" id="tiporam4_id"> 
                        <option value="" disabled {{ old('tiporam4_id',$registroCpu?->tiporam4_id) ? '' : 'selected' }}>Seleccionar </option> 
                        @foreach ($tiporam as $tipo)
                        <option value="{{ $tipo->id }}" {{ (old('tiporam4_id',$registroCpu?->tiporam4_id)== $tipo->id ) ? 'selected' : '' }}> 
                            {{ $tipo->tipo}}
                        </option>                         
                        @endforeach 
                    <option value="">QUITAR</option>
                    </select>
                    <input type="text" name="modram_otro" class="form-control" id="modram_otro" style="display:none;" placeholder="Ingrese la marca">
                    {!! $errors->first('tiporam4_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>

                <div class="div title">
                    <label for="cantidad4_id" class="form-label">{{ __('CANTIDAD :') }}</label>
                    <select name="cantidad4_id" class="form-control @error('cantidad4_id') is invalid @enderror" id="cantidad4_id"> 
                        <option value="" disabled {{ old('cantidad4_id',$registroCpu?->cantidad4_id) ? '' : 'selected' }}>Seleccionar </option> 
                        @foreach ($cantidadram as $cantidad)
                        <option value="{{ $cantidad->id }}" {{ (old('cantidad4_id',$registroCpu?->cantidad4_id)== $cantidad->id ) ? 'selected' : '' }}> 
                            {{ $cantidad->cantidad}}
                        </option>                         
                        @endforeach 
                        <option value="">QUITAR</option>
                    </select>
                    <input type="text" name="modram_otro" class="form-control" id="modram_otro" style="display:none;" placeholder="Ingrese la marca">
                    {!! $errors->first('cantidad4_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>
        </div>
        <hr class="hr"> 
        <div class="fila-5">
            {{-- ------------TARJETA DE VIDEO--------------- --}}
            <div class="columna3">
                    <label class="text-center" >{{ __('TARJETA DE VIDEO:') }}</label>
                <div class="div title">
                    <label for="marcatvideo_id" class="form-label">{{ __('MARCA :') }}</label>
                    <select name="marcatvideo_id" class="form-control @error('marcatvideo_id') is invalid @enderror" id="marcatvideo_id"> 
                        <option value="" disabled {{ old('marcatvideo_id',$registroCpu?->marcatvideo_id) ? '' : 'selected' }}>Seleccionar </option> 
                        @foreach ($marcatvideo as $marca)
                        <option value="{{ $marca->id }}" {{ (old('marcatvideo_id',$registroCpu?->marcatvideo_id)== $marca->id ) ? 'selected' : '' }}> 
                            {{ $marca->marca}}
                        </option> 
                        @endforeach
                        <option value="">QUITAR</option>
                    </select>
                    <input type="text" name="marcatvideo_otro" class="form-control" id="marcatvideo_otro" style="display:none;" placeholder="Ingrese la marca">
                    {!! $errors->first('marcatvideo_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>

                <div class="div title">
                    <label for="capactvideo_id" class="form-label">{{ __('CAPACIDAD :') }}</label>
                    <select name="capactvideo_id" class="form-control @error('capactvideo_id') is invalid @enderror" id="capactvideo_id"> 
                        <option value="" disabled {{ old('capactvideo_id',$registroCpu?->capactvideo_id) ? '' : 'selected' }}>Seleccionar </option> 
                        @foreach ($captvideo as $capacidad)
                        <option value="{{ $capacidad->id }}" {{ (old('capactvideo_id',$registroCpu?->capactvideo_id)== $capacidad->id ) ? 'selected' : '' }}> 
                            {{ $capacidad->capacidad}}
                        </option> 
                        @endforeach
                        <option value="">QUITAR</option> 
                    </select>
                    <input type="text" name="capactvideo_otro" class="form-control" id="capactvideo_otro" style="display:none;" placeholder="Ingrese la marca">
                    {!! $errors->first('capactvideo_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>

                <div class="div title">
                    <label for="tipotvideo_id" class="form-label">{{ __('TIPO :') }}</label>                    
                    <select name="tipotvideo_id" class="form-control @error('tipotvideo_id') is invalid @enderror" id="tipotvideo_id"> 
                        <option value="" disabled {{ old('tipotvideo_id',$registroCpu?->tipotvideo_id) ? '' : 'selected' }}>Seleccionar </option> 
                        @foreach ($tipotvideo as $tipo)
                        <option value="{{ $tipo->id }}" {{ (old('tipotvideo_id',$registroCpu?->tipotvideo_id)== $tipo->id ) ? 'selected' : '' }}> 
                            {{ $tipo->tipo}}
                        </option> 
                        @endforeach
                        <option value="">QUITAR</option>  
                    </select>
                    <input type="text" name="tipotvideo_otro" class="form-control" id="tipotvideo_otro" style="display:none;" placeholder="Ingrese la marca">
                    {!! $errors->first('tipotvideo_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>                
            </div>
            {{-- ------------------TARJETA DE RED-------------------- --}}
            <div class="columna3">
                    <label class="text-center" >{{ __('TARJETA DE RED:') }}</label>
                <div class="div title">
                    <label for="marcatred_id" class="form-label">{{ __('MARCA :') }}</label>
                    <select name="marcatred_id" class="form-control @error('marcatred_id') is invalid @enderror" id="marcatred_id"> 
                        <option value="" disabled {{ old('marcatred_id',$registroCpu?->marcatred_id) ? '' : 'selected' }}>Seleccionar </option> 
                        @foreach ($marcatred as $marca)
                        <option value="{{ $marca->id }}" {{ (old('marcatred_id',$registroCpu?->marcatred_id)== $marca->id ) ? 'selected' : '' }}> 
                            {{ $marca->marca}}
                        </option> 
                        @endforeach
                    <option value="">QUITAR</option>  
                    </select>
                    <input type="text" name="marcatred_otro" class="form-control" id="marcatred_otro" style="display:none;" placeholder="Ingrese la marca">
                    {!! $errors->first('marcatred_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>

                <div class="div title">
                    <label for="modtred_id" class="form-label">{{ __('MODELO :') }}</label>
                    <select name="modtred_id" class="form-control @error('modtred_id') is invalid @enderror" id="modtred_id"> 
                        <option value="" disabled {{ old('modtred_id',$registroCpu?->modtred_id) ? '' : 'selected' }}>Seleccionar </option> 
                        @foreach ($modelotred as $modelo)
                        <option value="{{ $modelo->id }}" {{ (old('modtred_id',$registroCpu?->modtred_id)== $modelo->id ) ? 'selected' : '' }}> 
                            {{ $modelo->modelo}}
                        </option> 
                        @endforeach
                    <option value="">QUITAR</option>  
                    </select>
                    <input type="text" name="modtred_otro" class="form-control" id="modtred_otro" style="display:none;" placeholder="Ingrese la marca">
                    {!! $errors->first('modtred_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>
            {{-- -------------TARJETA WIFI----------------- --}}
            <div class="columna3">
                <label class="text-center" >{{ __('TARJETA WIFI:') }}</label>
                <div class="div title">
                    <label for="marcawifi_id" class="form-label">{{ __('MARCA :') }}</label>    
                    <select name="marcawifi_id" class="form-control @error('marcawifi_id') is invalid @enderror" id="marcawifi_id"> 
                        <option value="" disabled {{ old('marcawifi_id',$registroCpu?->marcawifi_id) ? '' : 'selected' }}>Seleccionar </option> 
                        @foreach ($marcatwifi as $marca)
                        <option value="{{ $marca->id }}" {{ (old('marcawifi_id',$registroCpu?->marcawifi_id)== $marca->id ) ? 'selected' : '' }}> 
                            {{ $marca->marca}}
                        </option> 
                        @endforeach
                    <option value="">QUITAR</option> 
                    </select>
                    <input type="text" name="marcawifi_otro" class="form-control" id="marcawifi_otro" style="display:none;" placeholder="Ingrese la marca">
                    {!! $errors->first('marcawifi_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
                <div class="div title">
                    <label for="modcawifi_id" class="form-label">{{ __('MODELO :') }}</label>    
                    <select name="modcawifi_id" class="form-control @error('modcawifi_id') is invalid @enderror" id="modcawifi_id"> 
                        <option value="" disabled {{ old('modcawifi_id',$registroCpu?->modcawifi_id) ? '' : 'selected' }}>Seleccionar </option> 
                        @foreach ($modelowifi as $modelo)
                        <option value="{{ $modelo->id }}" {{ (old('modcawifi_id',$registroCpu?->modcawifi_id)== $modelo->id ) ? 'selected' : '' }}> 
                            {{ $modelo->modelo}}
                        </option> 
                        @endforeach
                    <option value="">QUITAR</option>                    <option value="">QUITAR</option> 
                    </select>
                    <input type="text" name="marcawifi_otro" class="form-control" id="marcawifi_otro" style="display:none;" placeholder="Ingrese la marca">
                    {!! $errors->first('modcawifi_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
                <div class="div title">
                    <label for="antena_id" class="form-label">{{ __('ANTENA:') }}</label>                    
                    <select name="antena_id" class="form-control @error('antena_id') is invalid @enderror" id="antena_id"> 
                        <option value="" disabled {{ old('antena_id',$registroCpu?->antena_id) ? '' : 'selected' }}>Seleccionar </option> 
                        @foreach ($disipadorram as $antena)
                        <option value="{{ $antena->id }}" {{ (old('antena_id',$registroCpu?->antena_id)== $antena->id ) ? 'selected' : '' }}> 
                            {{ $antena->opcion}}
                        </option> 
                        @endforeach
                    <option value="">QUITAR</option>
                    </select>
                    <input type="text" name="potfuente_otro" class="form-control" id="potfuente_otro" style="display:none;" placeholder="Ingrese la marca">
                    {!! $errors->first('antena_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div> 
            {{-- ---------------------FUENTE---------------------  --}}
            <div class="columna3">
                    <label class="text-center" >{{ __('FUENTE:') }}</label>
                <div class="div title">
                    <label for="marcafuente_id" class="form-label">{{ __('MARCA :') }}</label>
                    <select name="marcafuente_id" class="form-control @error('marcafuente_id') is invalid @enderror" id="marcafuente_id"> 
                        <option value="" disabled {{ old('marcafuente_id',$registroCpu?->marcafuente_id) ? '' : 'selected' }}>Seleccionar </option> 
                        @foreach ($marcafuente as $marca)
                        <option value="{{ $marca->id }}" {{ (old('marcafuente_id',$registroCpu?->marcafuente_id)== $marca->id ) ? 'selected' : '' }}> 
                            {{ $marca->marca}}
                        </option> 
                        @endforeach
                    <option value="">QUITAR</option>              
                    </select>
                    <input type="text" name="marcafuente_otro" class="form-control" id="marcafuente_otro" style="display:none;" placeholder="Ingrese la marca">
                    {!! $errors->first('marcafuente_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
                <div class="div title">
                    <label for="potfuente_id" class="form-label">{{ __('POTENCIA :') }}</label>                    
                    <select name="potfuente_id" class="form-control @error('potfuente_id') is invalid @enderror" id="potfuente_id"> 
                        <option value="" disabled {{ old('potfuente_id',$registroCpu?->potfuente_id) ? '' : 'selected' }}>Seleccionar </option> 
                        @foreach ($potenciafuente as $potencia)
                        <option value="{{ $potencia->id }}" {{ (old('potfuente_id',$registroCpu?->potfuente_id)== $potencia->id ) ? 'selected' : '' }}> 
                            {{ $potencia->potencia}}
                        </option> 
                        @endforeach
                    <option value="">QUITAR</option>
                    </select>
                    <input type="text" name="potfuente_otro" class="form-control" id="potfuente_otro" style="display:none;" placeholder="Ingrese la marca">
                    {!! $errors->first('potfuente_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
                <div class="div title">
                    <label for="cable_id" class="form-label">{{ __('CABLE DE PODER :') }}</label>                    
                    <select name="cable_id" class="form-control @error('cable_id') is invalid @enderror" id="cable_id"> 
                        <option value="" disabled {{ old('cable_id',$registroCpu?->cable_id) ? '' : 'selected' }}>Seleccionar </option> 
                        @foreach ($disipadorram as $cable)
                        <option value="{{ $cable->id }}" {{ (old('cable_id',$registroCpu?->cable_id)== $cable->id ) ? 'selected' : '' }}> 
                            {{ $cable->opcion}}
                        </option> 
                        @endforeach
                    <option value="">QUITAR</option>
                    </select>
                    <input type="text" name="potfuente_otro" class="form-control" id="potfuente_otro" style="display:none;" placeholder="Ingrese la marca">
                    {!! $errors->first('cable_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>
        </div>    
        <hr class="hr"> 
        <div class="fila-5">
            <div class="columna3">
                    <label class="text-center" >{{ __('LECTOR CD:') }}</label>
                <div class="div title">
                    <label for="maracd_id" class="form-label">{{ __('MARCA :') }}</label>
                    <select name="marcacd_id" class="form-control @error('marcacd_id') is invalid @enderror" id="marcacd_id"> 
                        <option value="" disabled {{ old('marcacd_id',$registroCpu?->maracd_id) ? '' : 'selected' }}>Seleccionar </option> 
                        @foreach ($marcalectorcd as $marca)
                        <option value="{{ $marca->id }}" {{ (old('marcacd_id',$registroCpu?->marcacd_id)== $marca->id ) ? 'selected' : '' }}> 
                            {{ $marca->nombre}}
                        </option> 
                        @endforeach
                        <option value="">QUITAR</option> 
                    </select>
                    <input type="text" name="marcacd_otro" class="form-control" id="marcacd_otro" style="display:none;" placeholder="Ingrese la marca">
                    {!! $errors->first('marcacd_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>
            <div class="columna3">
                <label for="falla" class="form-label">{{ __('TIPO DE FALLA') }}</label>
                <input type="text" name="falla" class="form-control @error('falla') is-invalid @enderror" value="{{ old('falla', $registroCpu?->falla) }}" id="falla" placeholder="Falla">
                {!! $errors->first('falla', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
            <div class="columna3">
                <label for="respaldo" class="form-label">{{ __('REQUIERE RESPALDO ...?') }}</label>
                <select name="respaldo" class="form-control @error('respaldo') is-invalid @enderror" id="respaldo">
                    <option value="" disabled {{ old('respaldo', $registroCpu?->respaldo) ? '' : 'selected' }}>Seleccione una opción</option>
                    <option value="SI" {{ (old('respaldo', $registroCpu?->respaldo) == 'SI') ? 'selected' : '' }}>SI</option>
                    <option value="NO" {{ (old('respaldo', $registroCpu?->respaldo) == 'NO') ? 'selected' : '' }}>NO</option>
                </select>
                {!! $errors->first('respaldo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
            <div class="div title">
                <label for="otro" class="form-label">{{ __('OTROS') }}</label>
                <input type="text" name="otro" class="form-control @error('otro') is-invalid @enderror" value="{{ old('otro', $registroCpu?->otro) }}" id="otro" placeholder="Otros">
                {!! $errors->first('otro', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
        </div>    
        <hr class="hr"> 
        <div class="fila-1">
            <div class="div title">
                <label for="observaciones" class="form-label">{{ __('OBSERVACIONES') }}</label>
                    <input type="text" name="observaciones" class="form-control @error('observaciones') is-invalid @enderror" value="{{ old('observaciones', $registroCpu?->observaciones) }}" id="observaciones" placeholder="Observaciones">
                {!! $errors->first('observaciones', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
                <div class="div  title">
                <label for="estado_id" class="form-label">{{ __('ESTADO :') }}</label>
                <select name="estado_id" class="form-control @error('estado_id') is invalid @enderror" id="estado_id"> 
                    <option value="" disabled {{ old('estado_id',$registroCpu?->estado_id) ? '' : 'selected' }}>Seleccionar </option> 
                    @foreach ($estado as $estados)
                    <option value="{{ $estados->id }}" {{ (old('estado_id',$registroCpu?->estado_id)== $estados->id ) ? 'selected' : '' }}> 
                        {{ $estados->nombre}}
                    </option> 
                    @endforeach  
                </select>
                {!! $errors->first('estado_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>
        </div>
        </fieldset>
    </div>
</div>

