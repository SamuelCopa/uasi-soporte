<div class="row padding-1 p-1">
    <div class="contenedor">

       <fieldset class="fieldset1">
            <legend class="legend1">DATOS DEL SOLICITANTE</legend>
            <div class="fila-3">
                <div class="title div">
                    <label for="funcionario_activo" class="form-label">{{ __('tipo de funcionario:') }}</label>
                    <select name="funcionario_activo" class="form-control">
                        <option value=""disabled {{'selected' }}>SELECCIONE UNA OPCION</option>
                        <option value="1" {{ old('funcionario_activo', $upese->funcionario_activo) == 1 ? 'selected' : '' }}>FUNCIONARIO ACTIVO</option>
                        <option value="0" {{ old('funcionario_activo', $upese->funcionario_activo) == 0 ? 'selected' : '' }}>EX FUNCIONARIO</option>
                    </select>
                </div>
            </div>
        <div class="fila-4">
        <div class="div title">
            <label for="grado_academico" class="form-label">{{ __('GRADO ACADEMICO:') }}</label>
            <select name="grado_academico" class="form-control">
                <option value="" disabled {{ 'selected' }}>SELECCIONE UNA OPCION</option>
                <option value="QR" {{ old('expedido', $upese->funcionario->expedido ?? '') == 'QR' ? 'selected' : '' }} >QR</option>
                <option value="Abg." {{ old('grado_academico', $upese->funcionario->grado_academico ?? '') == 'Abg.' ? 'selected' : '' }} >ABG.</option>
                <option value="Arq." {{ old('grado_academico', $upese->funcionario->grado_academico ?? '') == 'Arq.' ? 'selected' : '' }}>ARQ.</option>
                <option value="Dr." {{ old('grado_academico', $upese->funcionario->grado_academico ?? '') == 'Dr.' ? 'selected' : '' }}>DR.</option>
                <option value="Dra." {{ old('grado_academico', $upese->funcionario->grado_academico ?? '') == 'Dra.' ? 'selected' : '' }}>DRA.</option>
                <option value="Ing." {{ old('grado_academico', $upese->funcionario->grado_academico ?? '') == 'Ing.' ? 'selected' : '' }}>ING.</option>
                <option value="Lic." {{ old('grado_academico', $upese->funcionario->grado_academico ?? '') == 'Lic.' ? 'selected' : '' }}>LIC.</option>
                <option value="Tec." {{ old('grado_academico', $upese->funcionario->grado_academico ?? '') == 'Tec.' ? 'selected' : '' }}>TEC.</option>
                <option value="Sr." {{ old('grado_academico', $upese->funcionario->grado_academico ?? '') == 'Sr.' ? 'selected' : '' }} >SR.</option>
                <option value="Sra." {{ old('grado_academico', $upese->funcionario->grado_academico ?? '') == 'Sra.' ? 'selected' : '' }} >SRA.</option>
            </select>
        </div>
        <div class="div title">
            <label for="paterno" class="form-label">{{ __('APELLIDO PATERNO') }}</label>
            <input type="text" name="paterno" class="form-control @error('paterno') is-invalid @enderror" value="{{ old('paterno', $upese->funcionario?->paterno) }}" id="paterno" placeholder="Paterno">
            {!! $errors->first('paterno', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="div title">
            <label for="materno" class="form-label">{{ __('APELLIDO MATERNO') }}</label>
            <input type="text" name="materno" class="form-control @error('materno') is-invalid @enderror" value="{{ old('materno', $upese->funcionario?->materno) }}" id="materno" placeholder="Materno">
            {!! $errors->first('materno', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="div title">
            <label for="nombre" class="form-label">{{ __('NOMBRE(S)') }}</label>
            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $upese->funcionario?->nombre) }}" id="nombre" placeholder="Nombre">
            {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        </div>
        <div class="fila-2">
        <div class="div title">
            <label for="ci" class="form-label">{{ __('C.I.') }}</label>
            <input type="text" name="ci" class="form-control @error('ci') is-invalid @enderror" value="{{ old('ci', $upese->funcionario?->ci) }}" id="ci" placeholder="Ci">
            {!! $errors->first('ci', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="div title">
            <label for="expedido" class="form-label">{{ __('EXPEDIDO:') }}<span class="required">*</span></label>
            <select name="expedido" class="form-control">
                <option value="" disabled {{ 'selected' }}>SELECCIONE UNA OPCION</option>
                <option value="QR" {{ old('expedido', $upese->funcionario->expedido ?? '') == 'QR' ? 'selected' : '' }} >QR</option>
                <option value="LP" {{ old('expedido', $upese->funcionario->expedido ?? '') == 'LP' ? 'selected' : '' }} >LA PAZ</option>
                <option value="CB" {{ old('expedido', $upese->funcionario->expedido ?? '') == 'CB' ? 'selected' : '' }}>COCHABAMBA</option>
                <option value="SC" {{ old('expedido', $upese->funcionario->expedido ?? '') == 'SC' ? 'selected' : '' }}>SANTA CRUZ</option>
                <option value="OR" {{ old('expedido', $upese->funcionario->expedido ?? '') == 'OR' ? 'selected' : '' }}>ORURO</option>
                <option value="CH" {{ old('expedido', $upese->funcionario->expedido ?? '') == 'CH' ? 'selected' : '' }}>CHUQUISACA</option>
                <option value="PO" {{ old('expedido', $upese->funcionario->expedido ?? '') == 'PO' ? 'selected' : '' }}>POTOSI</option>
                <option value="T" {{ old('expedido', $upese->funcionario->expedido ?? '') == 'T' ? 'selected' : '' }}>TARIJA</option>
                <option value="B" {{ old('expedido', $upese->funcionario->expedido ?? '') == 'B' ? 'selected' : '' }} >BENI</option>
                <option value="P" {{ old('expedido', $upese->funcionario->expedido ?? '') == 'P' ? 'selected' : '' }} >PANDO</option>
            </select>
        </div>
        <div class="div title">
            <label for="celular" class="form-label">{{ __('CELULAR') }}</label>
            <input type="text" name="celular" class="form-control @error('celular') is-invalid @enderror" value="{{ old('celular', $upese->funcionario?->celular) }}" id="celular" placeholder="Celular">
            {!! $errors->first('celular', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        </div>
        <div class="fila-2">            
        <div class="div title">
            <label for="cargo" class="form-label">{{ __('CARGO') }}</label>
            <input type="text" name="cargo" class="form-control @error('cargo') is-invalid @enderror" value="{{ old('cargo', $upese->funcionario?->cargo) }}" id="cargo" placeholder="Cargo">
            {!! $errors->first('cargo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="div title">
            <label for="email" class="form-label">{{ __('CORREO ELECTRÓNICO') }}</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $upese->funcionario?->email) }}" id="email" placeholder="CORREO ELECTRÓNICO">
            {!! $errors->first('email', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
            <input type="hidden" name="funcionario_id" class="form-control @error('funcionario_id') is invalid @enderror" value="{{ old('funcionario_id', $upese?->funcionario_id) }}" id="estado_id"> 

        <div class="div title">
            <label for="fecha" class="form-label">{{ __('FECHA DE RECEPCIÓN') }}</label>
            <input type="datetime-local" name="fecha" class="form-control @error('fecha') is-invalid @enderror" value="{{ old('fecha',date('Y-m-d\TH:i', strtotime($upese?->fecha))) }}" id="fecha" placeholder="Fecha Recepción">
        </div>
        </div>

        <div class="fila-2">
            <div class="div title">
                <label for="user_id" class="form-label">TECNICO A CARGO</label>
                <select name="user_id" id="user_id" class="form-control mi-select">
                    <option value="" disabled {{ old('user_id',$upese?->user_id) ? '' : 'selected'}}>Seleccionar</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $user->id == $upese->user_id ? 'selected' : '' }}>
                            {{ $user->name }} {{ $user->paterno }} {{ $user->materno }}
                        </option>
                    @endforeach
                    <option value="">QUITAR</option>
                </select>
            </div>
            <div class="div title">
                <label for="fecha_asignacion" class="form-label">{{ __('FECHA DE ASIGNACIÓN') }}</label>
                @if(! $upese->fecha_asignacion)
                <input type="datetime-local" name="fecha_asignacion" class="form-control @error('fecha_asignacion') is-invalid @enderror" id="fecha_asignacion" >
                @else
                <input type="datetime-local" name="fecha_asignacion" class="form-control @error('fecha_asignacion') is-invalid @enderror" value="{{ old('fecha_asignacion',date('Y-m-d\TH:i', strtotime($upese?->fecha_asignacion))) }}" id="fecha_asignacion" >
                @endif
            </div>
            <div class="div title">
                <label for="fecha_inicio" class="form-label">{{ __('FECHA DE INICIO') }}</label>
                @if(! $upese->fecha_inicio)
                <input type="datetime-local" name="fecha_inicio" class="form-control @error('fecha_inicio') is-invalid @enderror" id="fecha_inicio" >
                @else
                <input type="datetime-local" name="fecha_inicio" class="form-control @error('fecha_inicio') is-invalid @enderror" value="{{ old('fecha_inicio',date('Y-m-d\TH:i', strtotime($upese?->fecha_inicio))) }}" id="fecha_inicio" >
                @endif
            </div>
        </div>
        <div class="fila-3">
        <div class="div title">
            <label for="dependencia_id" class="form-label">{{ __('DEPENDENCIA') }}</label>
            <select name="dependencia_id" class="form-control @error('dependencia_id') is invalid @enderror" id="dependencia_id"> 
                <option value="" disabled {{ old('dependencia_id',$upese?->dependencia_id) ? '' : 'selected' }}>Seleccionar </option> 
                @foreach ($dependencia as $item)
                <option value="{{ $item->id }}" {{ (old('dependencia_id',$upese?->dependencia_id)== $item->id ) ? 'selected' : '' }}> 
                    {{ $item->dependencias}}
                </option> 
                @endforeach                 
            </select>  
            {!! $errors->first('dependencia_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        </fieldset>
        <fieldset class="fieldset1">
            <legend class="legend1">DATOS DEL U.P.S.</legend>
        <div class="fila-1">
            <div class="div title">
                <label for="cod_gamea" class="form-label">{{ __('CODIGO GAMEA') }}</label>
                <input type="text" name="cod_gamea" class="form-control @error('cod_gamea') is-invalid @enderror" value="{{ old('cod_gamea', $upese?->cod_gamea) }}" id="cod_gamea" placeholder="Cod Gamea">
                {!! $errors->first('cod_gamea', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
            @if($upese->id)
            <div class="div title">
                <label for="cod_registro" class="form-label">{{ __('NÚMERO DE RECEPCIÓN') }}</label>
                <input type="text" name="cod_registro" class="form-control @error('cod_registro') is-invalid @enderror" value="{{ old('cod_registro', $upese?->cod_registro) }}" id="cod_registro" placeholder="Número de Recepción">
                {!! $errors->first('cod_registro', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
            @endif
        </div>
        <div class="fila-1">
            <div class="div title">
                <label for="marca" class="form-label">{{ __('MARCA') }}</label>
                <input type="text" name="marca" class="form-control @error('marca') is-invalid @enderror" value="{{ old('marca', $upese?->marca) }}" id="marca" placeholder="Marca">
                {!! $errors->first('marca', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
            <div class="div title">
                <label for="modelo" class="form-label">{{ __('MODELO') }}</label>
                <input type="text" name="modelo" class="form-control @error('modelo') is-invalid @enderror" value="{{ old('modelo', $upese?->modelo) }}" id="modelo" placeholder="Modelo">
                {!! $errors->first('modelo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
        </div>
        <div class="fila-1">
            <div class="div title">
                <label for="falla" class="form-label">{{ __('FALLA') }}</label>
                <input type="text" name="falla" class="form-control @error('falla') is-invalid @enderror" value="{{ old('falla', $upese?->falla) }}" id="falla" placeholder="Falla">
                {!! $errors->first('falla', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
            <div class="div title">
                <label for="observaciones" class="form-label">{{ __('OBSERVACIONES') }}</label>
                <input type="text" name="observaciones" class="form-control @error('observaciones') is-invalid @enderror" value="{{ old('observaciones', $upese?->observaciones) }}" id="observaciones" placeholder="Observaciones">
                {!! $errors->first('observaciones', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
        </div>
        <div class="fila-1">
        @if($upese->id)
        <div class="div title">
            <label for="estado_id" class="form-label">{{ __('ESTADO') }}</label>
            <select name="estado_id" class="form-control @error('estado_id') is invalid @enderror" id="estado_id"> 
                <option value="" disabled {{ old('estado_id',$upese?->estado_id) ? '' : 'selected' }}>Seleccionar </option> 
                @foreach ($estado as $estados)
                <option value="{{ $estados->id }}" {{ (old('estado_id',$upese?->estado_id)== $estados->id ) ? 'selected' : '' }}> 
                    {{ $estados->nombre}}
                </option> 
                @endforeach  
            </select>
            {!! $errors->first('estado_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        @else
        <div class="div title" style="display:none;">
            <input type="hidden" name="estado_id" value="{{ $estado?->first()->id }}">
        </div>
        @endif
        </div>
        </fieldset>
    </div>
    {{-- <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('GUARDAR') }}</button>
        <a class="btn btn-danger" href="{{ route('upeses.index') }}"> {{ __('CANCELAR') }}</a>
    </div> --}}
</div>
