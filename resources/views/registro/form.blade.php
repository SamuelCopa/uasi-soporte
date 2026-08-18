<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="fecha" class="form-label">{{ __('Fecha') }}</label>
            <input type="text" name="fecha" class="form-control @error('fecha') is-invalid @enderror" value="{{ old('fecha', $registro?->fecha) }}" id="fecha" placeholder="Fecha">
            {!! $errors->first('fecha', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="fecha_asignacion" class="form-label">{{ __('Fecha Asignacion') }}</label>
            <input type="text" name="fecha_asignacion" class="form-control @error('fecha_asignacion') is-invalid @enderror" value="{{ old('fecha_asignacion', $registro?->fecha_asignacion) }}" id="fecha_asignacion" placeholder="Fecha Asignacion">
            {!! $errors->first('fecha_asignacion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="fecha_inicio" class="form-label">{{ __('Fecha Inicio') }}</label>
            <input type="text" name="fecha_inicio" class="form-control @error('fecha_inicio') is-invalid @enderror" value="{{ old('fecha_inicio', $registro?->fecha_inicio) }}" id="fecha_inicio" placeholder="Fecha Inicio">
            {!! $errors->first('fecha_inicio', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="fecha_entrega" class="form-label">{{ __('Fecha Entrega') }}</label>
            <input type="text" name="fecha_entrega" class="form-control @error('fecha_entrega') is-invalid @enderror" value="{{ old('fecha_entrega', $registro?->fecha_entrega) }}" id="fecha_entrega" placeholder="Fecha Entrega">
            {!! $errors->first('fecha_entrega', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="cod_registro" class="form-label">{{ __('Cod Registro') }}</label>
            <input type="text" name="cod_registro" class="form-control @error('cod_registro') is-invalid @enderror" value="{{ old('cod_registro', $registro?->cod_registro) }}" id="cod_registro" placeholder="Cod Registro">
            {!! $errors->first('cod_registro', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="falla" class="form-label">{{ __('Falla') }}</label>
            <input type="text" name="falla" class="form-control @error('falla') is-invalid @enderror" value="{{ old('falla', $registro?->falla) }}" id="falla" placeholder="Falla">
            {!! $errors->first('falla', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="respaldo" class="form-label">{{ __('Respaldo') }}</label>
            <input type="text" name="respaldo" class="form-control @error('respaldo') is-invalid @enderror" value="{{ old('respaldo', $registro?->respaldo) }}" id="respaldo" placeholder="Respaldo">
            {!! $errors->first('respaldo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="observaciones" class="form-label">{{ __('Observaciones') }}</label>
            <input type="text" name="observaciones" class="form-control @error('observaciones') is-invalid @enderror" value="{{ old('observaciones', $registro?->observaciones) }}" id="observaciones" placeholder="Observaciones">
            {!! $errors->first('observaciones', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="otro" class="form-label">{{ __('Otro') }}</label>
            <input type="text" name="otro" class="form-control @error('otro') is-invalid @enderror" value="{{ old('otro', $registro?->otro) }}" id="otro" placeholder="Otro">
            {!! $errors->first('otro', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="cpu_id" class="form-label">{{ __('Cpu Id') }}</label>
            <input type="text" name="cpu_id" class="form-control @error('cpu_id') is-invalid @enderror" value="{{ old('cpu_id', $registro?->cpu_id) }}" id="cpu_id" placeholder="Cpu Id">
            {!! $errors->first('cpu_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="impresora_id" class="form-label">{{ __('Impresora Id') }}</label>
            <input type="text" name="impresora_id" class="form-control @error('impresora_id') is-invalid @enderror" value="{{ old('impresora_id', $registro?->impresora_id) }}" id="impresora_id" placeholder="Impresora Id">
            {!! $errors->first('impresora_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="raton_id" class="form-label">{{ __('Raton Id') }}</label>
            <input type="text" name="raton_id" class="form-control @error('raton_id') is-invalid @enderror" value="{{ old('raton_id', $registro?->raton_id) }}" id="raton_id" placeholder="Raton Id">
            {!! $errors->first('raton_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="parlante_id" class="form-label">{{ __('Parlante Id') }}</label>
            <input type="text" name="parlante_id" class="form-control @error('parlante_id') is-invalid @enderror" value="{{ old('parlante_id', $registro?->parlante_id) }}" id="parlante_id" placeholder="Parlante Id">
            {!! $errors->first('parlante_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="teclado_id" class="form-label">{{ __('Teclado Id') }}</label>
            <input type="text" name="teclado_id" class="form-control @error('teclado_id') is-invalid @enderror" value="{{ old('teclado_id', $registro?->teclado_id) }}" id="teclado_id" placeholder="Teclado Id">
            {!! $errors->first('teclado_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="laptop_id" class="form-label">{{ __('Laptop Id') }}</label>
            <input type="text" name="laptop_id" class="form-control @error('laptop_id') is-invalid @enderror" value="{{ old('laptop_id', $registro?->laptop_id) }}" id="laptop_id" placeholder="Laptop Id">
            {!! $errors->first('laptop_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="monitor_id" class="form-label">{{ __('Monitor Id') }}</label>
            <input type="text" name="monitor_id" class="form-control @error('monitor_id') is-invalid @enderror" value="{{ old('monitor_id', $registro?->monitor_id) }}" id="monitor_id" placeholder="Monitor Id">
            {!! $errors->first('monitor_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="audifono_id" class="form-label">{{ __('Audifono Id') }}</label>
            <input type="text" name="audifono_id" class="form-control @error('audifono_id') is-invalid @enderror" value="{{ old('audifono_id', $registro?->audifono_id) }}" id="audifono_id" placeholder="Audifono Id">
            {!! $errors->first('audifono_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="estabilizador_id" class="form-label">{{ __('Estabilizador Id') }}</label>
            <input type="text" name="estabilizador_id" class="form-control @error('estabilizador_id') is-invalid @enderror" value="{{ old('estabilizador_id', $registro?->estabilizador_id) }}" id="estabilizador_id" placeholder="Estabilizador Id">
            {!! $errors->first('estabilizador_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="ups_id" class="form-label">{{ __('Ups Id') }}</label>
            <input type="text" name="ups_id" class="form-control @error('ups_id') is-invalid @enderror" value="{{ old('ups_id', $registro?->ups_id) }}" id="ups_id" placeholder="Ups Id">
            {!! $errors->first('ups_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="user_id" class="form-label">{{ __('User Id') }}</label>
            <input type="text" name="user_id" class="form-control @error('user_id') is-invalid @enderror" value="{{ old('user_id', $registro?->user_id) }}" id="user_id" placeholder="User Id">
            {!! $errors->first('user_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="resultado_id" class="form-label">{{ __('Resultado Id') }}</label>
            <input type="text" name="resultado_id" class="form-control @error('resultado_id') is-invalid @enderror" value="{{ old('resultado_id', $registro?->resultado_id) }}" id="resultado_id" placeholder="Resultado Id">
            {!! $errors->first('resultado_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>