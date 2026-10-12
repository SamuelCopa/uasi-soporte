<div class="row padding-1 p-1">
    <div class="col-md-12">
        <fieldset class="fieldset1">
            <legend class="legend1">DATOS DEL FUNCIONARIO</legend>
            <div class="fila-4">
                <div class="div title">
                    <label for="grado_academico" class="form-label">{{ __('GRADO ACADEMICO:') }}</label>
                    <select name="grado_academico" class="form-control">
                        <option value="" disabled {{ 'selected' }}>SELECCIONE UNA OPCION</option>
                        <option value="Abg." {{ old('grado_academico', $funcionario->grado_academico ?? '') == 'Abg.' ? 'selected' : '' }} >ABG.</option>
                        <option value="Arq." {{ old('grado_academico', $funcionario->grado_academico ?? '') == 'Arq.' ? 'selected' : '' }}>ARQ.</option>
                        <option value="Dr." {{ old('grado_academico', $funcionario->grado_academico ?? '') == 'Dr.' ? 'selected' : '' }}>DR.</option>
                        <option value="Dra." {{ old('grado_academico', $funcionario->grado_academico ?? '') == 'Dra.' ? 'selected' : '' }}>DRA.</option>
                        <option value="Ing." {{ old('grado_academico', $funcionario->grado_academico ?? '') == 'Ing.' ? 'selected' : '' }}>ING.</option>
                        <option value="Lic." {{ old('grado_academico', $funcionario->grado_academico ?? '') == 'Lic.' ? 'selected' : '' }}>LIC.</option>
                        <option value="Tec." {{ old('grado_academico', $funcionario->grado_academico ?? '') == 'Tec.' ? 'selected' : '' }}>TEC.</option>
                        <option value="Sr." {{ old('grado_academico', $funcionario->grado_academico ?? '') == 'Sr.' ? 'selected' : '' }} >SR.</option>
                        <option value="Sra." {{ old('grado_academico', $funcionario->grado_academico ?? '') == 'Sra.' ? 'selected' : '' }} >SRA.</option>
                    </select>
                </div>
                <div class="div title">
                    <label for="paterno" class="form-label">{{ __('PATERNO') }}</label>
                    <input type="text" name="paterno" class="form-control @error('paterno') is-invalid @enderror" value="{{ old('paterno', $funcionario?->paterno) }}" id="paterno" placeholder="Paterno">
                    {!! $errors->first('paterno', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
                <div class="div title">
                    <label for="materno" class="form-label">{{ __('MATERNO') }}</label>
                    <input type="text" name="materno" class="form-control @error('materno') is-invalid @enderror" value="{{ old('materno', $funcionario?->materno) }}" id="materno" placeholder="Materno">
                    {!! $errors->first('materno', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
                <div class="div title">
                    <label for="nombre" class="form-label">{{ __('NOMBRE') }}</label>
                    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $funcionario?->nombre) }}" id="nombre" placeholder="Nombre">
                    {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>
            <div class="fila-2">
                <div class="div title">
                    <label for="ci" class="form-label">{{ __('C.I.') }}</label>
                    <input type="text" name="ci" class="form-control @error('ci') is-invalid @enderror" value="{{ old('ci', $funcionario?->ci) }}" id="ci" placeholder="Ci">
                    {!! $errors->first('ci', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
            <div class="div title">
                <label for="expedido" class="form-label">{{ __('EXPEDIDO:') }}<span class="required">*</span></label>
                <select name="expedido" class="form-control">
                    <option value="" disabled {{ 'selected' }}>SELECCIONE UNA OPCION</option>
                    <option value="QR" {{ old('expedido', $funcionario->expedido ?? '') == 'QR' ? 'selected' : '' }} >QR</option>
                    <option value="LP" {{ old('expedido', $funcionario->expedido ?? '') == 'LP' ? 'selected' : '' }} >LA PAZ</option>
                    <option value="CB" {{ old('expedido', $funcionario->expedido ?? '') == 'CB' ? 'selected' : '' }}>COCHABAMBA</option>
                    <option value="SC" {{ old('expedido', $funcionario->expedido ?? '') == 'SC' ? 'selected' : '' }}>SANTA CRUZ</option>
                    <option value="OR" {{ old('expedido', $funcionario->expedido ?? '') == 'OR' ? 'selected' : '' }}>ORURO</option>
                    <option value="CH" {{ old('expedido', $funcionario->expedido ?? '') == 'CH' ? 'selected' : '' }}>CHUQUISACA</option>
                    <option value="PO" {{ old('expedido', $funcionario->expedido ?? '') == 'PO' ? 'selected' : '' }}>POTOSI</option>
                    <option value="T" {{ old('expedido', $funcionario->expedido ?? '') == 'T' ? 'selected' : '' }}>TARIJA</option>
                    <option value="B" {{ old('expedido', $funcionario->expedido ?? '') == 'B' ? 'selected' : '' }} >BENI</option>
                    <option value="P" {{ old('expedido', $funcionario->expedido ?? '') == 'P' ? 'selected' : '' }} >PANDO</option>
                </select>
                </div>
                <div class="div title">
                    <label for="celular" class="form-label">{{ __('CELULAR') }}</label>
                    <input type="number" name="celular" class="form-control @error('celular') is-invalid @enderror" value="{{ old('celular', $funcionario?->celular) }}" id="celular" placeholder="Celular">
                    {!! $errors->first('celular', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>
            <div class="fila-1">
                <div class="div title">
                    <label for="cargo" class="form-label">{{ __('CARGO') }}</label>
                    <input type="text" name="cargo" class="form-control @error('cargo') is-invalid @enderror" value="{{ old('cargo', $funcionario?->cargo) }}" id="cargo" placeholder="Cargo">
                    {!! $errors->first('cargo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
                <div class="div title">
                    <label for="email" class="form-label">{{ __('CORREO ELECTRÓNICO') }}</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $funcionario?->email) }}" id="email" placeholder="Correo Electrónico">
                    {!! $errors->first('email', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>
            <div class="fila-3">
                <div class="div title">
                    <label for="dependencia_id" class="form-label">{{ __('DEPENDENCIA') }}</label>
                    <select name="dependencia_id" class="form-control @error('dependencia_id') is invalid @enderror" id="dependencia_id"> 
                        <option value="" disabled {{ old('dependencia_id',$funcionario?->dependencia_id) ? '' : 'selected' }}>Seleccionar </option> 
                        @foreach ($dependencia as $item)
                        <option value="{{ $item->id }}" {{ (old('dependencia_id',$funcionario?->dependencia_id)== $item->id ) ? 'selected' : '' }}> 
                            {{ $item->dependencias}}
                        </option> 
                        @endforeach                 
                    </select>  
                    {!! $errors->first('dependencia_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>
        </fieldset>
    </div>

</div>