<div class="modal fade" id="crearc" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xxl">
    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
        <div class="modal-header bg-primary text-white border-0 py-3">
            <h4>REGISTRAR</h4>
        <button type="button" class="btn-close bg-primary" data-dismiss="modal" aria-label="Cerrar"><i class="fas fa-times"></i></button>
        </div>
        <section class="content container-fluid">
        <div class="card">
            <div class="col-md-12">
                <form method="POST" autocomplete="off" action="{{ route('registro-cpus.store') }}">
                @csrf
                <div class="row padding-1 p-1">
                <div class="contenedor">
                    <hr class="hr"> 
                        <fieldset class="fieldset1">
                            <legend class="legend1">DATOS DEL SOLICITANTE</legend>
                            <div class="fila-3">
                                <div class="title div">
                                    <label for="funcionario_activo" class="form-label">{{ __('TIPO DE FUNCIONARIO:') }}<span class="required">*</span></label>
                                <select name="funcionario_activo" class="form-control" required id="miSelect">
                                    <option value="" disabled {{ 'selected' }}>SELECCIONE UNA OPCION</option>
                                    <option value="1" >FUNCIONARIO ACTIVO</option>
                                        <option value="0" >EX FUNCIONARIO</option>
                                    </select>
                                </div>
                            </div>
                        <div id="formularioc">  
                            <div class="fila-2">
                                <div class="div title">
                                    <label for="ci" class="form-label">{{ __('C.I.') }}<span class="required">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                        <input type="number" name="ci" class="form-control @error('ci') is-invalid @enderror" id="ci" placeholder="Ci" required>
                                        {!! $errors->first('ci', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                    </div>
                                </div>
                                <div class="div title">
                                    <label for="expedido" class="form-label">{{ __('EXPEDIDO:') }}<span class="required">*</span></label>
                                    <select name="expedido" class="form-control">
                                        <option value="" disabled {{ 'selected' }}>SELECCIONE UNA OPCION</option>
                                        <option value="QR" >QR</option>
                                        <option value="LP" >LA PAZ</option>
                                        <option value="CB">COCHABAMBA</option>
                                        <option value="SC">SANTA CRUZ</option>
                                        <option value="OR">ORURO</option>
                                        <option value="CH">CHUQUISACA</option>
                                        <option value="PO">POTOSI</option>
                                        <option value="T">TARIJA</option>
                                        <option value="B" >BENI</option>
                                        <option value="P" >PANDO</option>
                                    </select>
                                </div>
                        <div class="div title">
                            <label for="celular" class="form-label">{{ __('CELULAR') }}<span class="required">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                                <input type="number" name="celular" class="form-control @error('celular') is-invalid @enderror" id="celular" placeholder="Celular" required>
                                {!! $errors->first('celular', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="fila-4">
                        <div class="div title">
                            <label for="grado_academico" class="form-label">{{ __('GRADO ACADEMICO:') }}<span class="required">*</span></label>
                            <select name="grado_academico" class="form-control" required>
                                <option value="" disabled {{ 'selected' }}>SELECCIONE UNA OPCION</option>
                                <option value="Abg." >ABG.</option>
                                <option value="Arq.">ARQ.</option>
                                <option value="Dr.">DR.</option>
                                <option value="Dra.">DRA.</option>
                                <option value="Ing.">ING.</option>
                                <option value="Lic.">LIC.</option>
                                <option value="Tec.">TEC.</option>
                                <option value="Sr.">SR.</option>
                                <option value="Sra.">SRA.</option>
                            </select>
                        </div>
                        <div class="div title">
                              <label for="paterno" class="form-label">{{ __('APELLIDO PATERNO') }}<span class="required">*</span></label>
                              <div class="input-group">
                                  <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" name="paterno" class="form-control @error('paterno') is-invalid @enderror" id="paterno" placeholder="Paterno" oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')" require>
                              </div>
                              {!! $errors->first('paterno', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                          </div>
                          <div class="div title">
                              <label for="materno" class="form-label">{{ __('APELLIDO MATERNO') }}<span class="required">*</span></label>
                              <div class="input-group">
                                  <span class="input-group-text"><i class="fas fa-user"></i></span>
                                  <input type="text" name="materno" class="form-control @error('materno') is-invalid @enderror" id="materno" placeholder="Materno" oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')" require>
                              </div>
                              {!! $errors->first('materno', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                          </div>
                          <div class="div title">
                              <label for="nombre" class="form-label">{{ __('NOMBRE(S)') }}<span class="required">*</span></label>
                              <div class="input-group">
                                  <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                                  <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" id="nombre" placeholder="Nombre" oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')">
                              </div>
                              {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                          </div>
                        </div>
                        <div class="fila-1">            
                            <div class="div title" id="cargoA">
                                <label for="cargo" class="form-label">{{ __('CARGO') }}<span class="required">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-briefcase"></i></span>
                                    <input type="text" name="cargo" class="form-control @error('cargo') is-invalid @enderror" id="cargo" placeholder="Cargo" oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')" require>
                                    {!! $errors->first('cargo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                </div>
                            </div>
                        <div class="div title" id="emailC">
                          <label for="email" class="form-label">{{ __('CORREO ELECTRONICO') }}<span class="required">*</span></label>
                          <div class="input-group">
                              <span class="input-group-text"><i class="fa fa-briefcase"></i></span>
                              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Correo electrónico">
                              {!! $errors->first('email', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                          </div>
                        </div>
                    </div>
                    <div class="fila-1">
                            <div class="div title" id="search-inputCC">
                                <label for="search-inputC" class="form-label">DEPENDENCIA</label>
                                <input type="text" id="search-inputC" list="optionsC" placeholder="Buscar dependencia ..." class="form-control" required>
                                <datalist name="dependencia_id" id="optionsC" style="display: none">
                                    <option value="" ></option>
                                    @foreach ($dependencia as $item)
                                        <option value="{{ $item->dependencias }}"data-id="{{ $item->id }}"></option>
                                    @endforeach
                                    <option value=" ">QUITAR</option>
                                </datalist>
                                <input type="hidden" id="id-selectedC" name="dependencia_id">
                            </div>
                            <div class="div title">
                            <label for="fecha" class="form-label">{{ __('FECHA DE RECEPCIÓN') }}<span class="required">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    <input type="datetime-local" name="fecha" class="form-control @error('fecha') is-invalid @enderror" value="{{ old('fecha_hora', date('Y-m-d\TH:i:s')) }}" id="fecha" placeholder="Fecha" readonly>
                                {!! $errors->first('fecha', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                            </div>
                        </div>
                        </fieldset>
                    </div>  
                    </div>  

                <div id="formularioc2">
                            <fieldset class="fieldset1">
                                <legend class="legend1">DATOS DEL CPU</legend>
                            <div class="fila-1">
                                <div class="div title">
                                    <label for="usuario" class="form-label">{{ __('USUARIO :') }}</label>
                                    <input type="text" name="usuario" class="form-control @error('usuario') is-invalid @enderror" id="usuario" placeholder="Usuario">
                                    {!! $errors->first('usuario', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                </div>
                                <div class="div title">
                                    <label for="contrasena" class="form-label">{{ __('CONTRASEÑA :') }}</label>
                                    <input type="text" name="contrasena" class="form-control @error('contrasena') is-invalid @enderror" id="contrasena" placeholder="Contraseña">
                                    {!! $errors->first('contrasena', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                </div>
                            </div>

                            <div class="fila-1">
                                <div class="div title">
                                    <label for="cod_gamea" class="form-label">{{ __('CODIGO GAMEA :') }}<span class="required">*</span></label>
                                    <input type="number" name="cod_gamea" class="form-control @error('cod_gamea') is-invalid @enderror" id="cod_gamea" placeholder="Cod Gamea" required>
                                    {!! $errors->first('cod_gamea', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                </div>
                            </div> 
                            <hr class="hr">    
                            <div class="fila-5">
                                        {{--CASE --}}
                               <div class="div title">
                                    <span class="mif-chevron-left mif-3x boton"></span>
                                    <nav id="boton-desplegar">
                                        <ul id="menu_principal" class="ul">
                                            <li>
                                            <label for="drop-2" class="text-center principales">{{ __('CASE') }}</label>
                                            <input type="checkbox" id="drop-2">
                                                <ul class="ul">
                                                <label for="marcacase_id" class="form-label">{{ __('MARCA :') }}</label>
                                                @foreach ($marcacase as $marca)
                                                <li>
                                                    <a href="" class="nivel-2" data-id="{{ $marca->id }}">{{ $marca->marca }}</a>
                                                    <ul id="submenu-color" class="ul nivel-3" style="display: none;">
                                                        <label for="colorcase_id" class="form-label">{{ __('COLOR :') }}</label>
                                                        @foreach ($colorcase as $color)
                                                        <li>
                                                            <a href="" class="nivel-4" data-id="{{ $color->id }}">{{ $color->color }}</a>
                                                        </li>
                                                        @endforeach
                                                        <li>
                                                        <a href="#" class="nivel-4" data-id="otroColorcase">Otro...</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                @endforeach
                                                <li>
                                                <a href="#" class="nivel-2" data-id="otroMarcacase">Otro...</a>
                                                </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </nav>
                                    <input type="hidden" id="marcacase_id" name="marcacase_id">
                                    <input type="hidden" id="colorcase_id" name="colorcase_id">
                                    <input type="text" name="otra_marca" class="otra_marca form-control mt-2" placeholder="Especificar otro" style="display:none;">
                                    <input type="text" name="otro_color" class="otro_color form-control mt-2" placeholder="Especificar otro" style="display:none;">

                                    <ul id="selecciones" class="ul">
                                            @if(old('marcacase_id') && old('colorcase_id'))
                                            <li >MARCA: {{ $marcacase->find(old('marcacase_id'))->marca }}</li>
                                            <li >COLOR: {{ $colorcase->find(old('colorcase_id'))->color }}</li>
                                            @else
                                            <li id="marcacase"></li>
                                            <li id="colorcase"></li>
                                            @endif
                                    </ul>
                                </div>
                                {{-- PROCESADOR --}}
                                <div class="div title">
                                    <nav>
                                        <ul id="menu_principal" class="ul">
                                            <li>
                                                <label for="drop-2" class="text-center principales">{{ __('PROCESADOR') }}</label>
                                                <input type="checkbox" id="drop-2">

                                                <ul class="ul">
                                                    <label for="marcaprocesador_id" class="form-label">{{ __('MARCA :') }}</label>

                                                    @foreach ($marcaprocesador as $marca)
                                                    <li>
                                                        <a href="#" class="nivel-5" data-id="{{ $marca->id }}">{{ $marca->marca }}</a>

                                                        <ul id="submenu-modelo" class="ul nivel-6" style="display: none;">
                                                            <label for="modeloprocesador_id" class="form-label">{{ __('MODELO :') }}</label>

                                                            @php
                                                                $modelos_filtrados = $marca->marca == 'INTEL' 
                                                                    ? $modprocesador->filter(fn($m) => strpos($m->modelo, 'C') === 0)
                                                                    : ($marca->marca == 'AMD'
                                                                        ? $modprocesador->filter(fn($m) => strpos($m->modelo, 'R') === 0)
                                                                        : collect());
                                                            @endphp

                                                            @foreach ($modelos_filtrados as $modelo)
                                                            <li>
                                                                <a href="#" class="nivel-7" data-id="{{ $modelo->id }}">{{ $modelo->modelo }}</a>

                                                                <ul id="submenu-generacion" class="ul nivel-8" style="display: none;">
                                                                    <label for="genprocesador_id" class="form-label">{{ __('GENERACION :') }}</label>
                                                                    @foreach ($genprocesador as $procesador)
                                                                    <li>
                                                                        <a href="#" class="nivel-9" data-id="{{ $procesador->id }}">{{ $procesador->generacion }}</a>
                                                                    </li>
                                                                    @endforeach
                                                                    {{-- Opción "Otro" generacion --}}
                                                                    <li>
                                                                        <a href="#" class="nivel-9" data-id="otroGenpro">Otro...</a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            @endforeach
                                                            
                                                            {{-- Opción "Otro" modelo --}}
                                                            <li>
                                                                <a href="#" class="nivel-7" data-id="otroModpro">Otro...</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    @endforeach
                                                    
                                                    {{-- Opción "Otro" marca --}}
                                                    <li>
                                                        <a href="#" class="nivel-5" data-id="otroMarcapro">Otro...</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </nav>
                                    {{-- Campos ocultos --}}
                                    <input type="hidden" id="marcaprocesador_id" name="marcaprocesador_id">
                                    <input type="hidden" id="modeloprocesador_id" name="modeloprocesador_id">
                                    <input type="hidden" id="genprocesador_id" name="genprocesador_id">
                                    <input type="text" name="otra_marca_procesador" class="otra_marca_procesador form-control mt-2" placeholder="Especificar otro" style="display:none;">
                                    <input type="text" name="otro_modelo_procesador" class="otro_modelo_procesador form-control mt-2" placeholder="Especificar otro " style="display:none;">
                                    <input type="text" name="otra_generacion" class="otra_generacion form-control mt-2" placeholder="Especificar otro " style="display:none;">
                                    <ul id="seleccionesp" class="ul">
                                            @if(old('marcaprocesador_id') && old('modeloprocesador_id') && old('genprocesador_id'))
                                                <li>MARCA: {{ $marcaprocesador->find(old('marcaprocesador_id'))->marca }}</li>
                                                <li>MODELO: {{ $modprocesador->find(old('modeloprocesador_id'))->modelo }}</li>
                                                <li>GENERACIÓN: {{ $genprocesador->find(old('genprocesador_id'))->generacion }}</li>
                                                @else
                                                <li id="marcaprocesador"></li>
                                                <li id="modeloprocesador"></li>
                                                <li id="genprocesador"></li>
                                            @endif
                                    </ul>
                                </div>

                                {{-- DISCO DURO --}}
                                <div class="div title">
                                    <nav>
                                        <ul id="menu_principal" class="ul">
                                            <li>
                                            <label for="drop-2" class="text-center principales">{{ __('DISCO DURO') }}</label>
                                            <input type="checkbox" id="drop-2">
                                                <ul class="ul">
                                                <label for="marcadisco_id" class="form-label">{{ __('MARCA :') }}</label>
                                                @foreach ($marcadisco as $marca)
                                                <li>
                                                    <a href="" class="nivel-13" data-id="{{ $marca->id }}">{{ $marca->marca }}</a>
                                                    <ul id="submenu-cdisco" class="ul nivel-14" style="display: none;">
                                                        <label for="capacdisco_id" class="form-label">{{ __('CAPACIDAD :') }}</label>
                                                        @foreach ($capdisco as $capacidad)
                                                        <li>
                                                            <a href="" class="nivel-15" data-id="{{ $capacidad->id }}">{{ $capacidad->capacidad }}</a>
                                                            <ul id="submenu-tdisco"  class="ul nivel-16" style="display: none;">
                                                                <label for="tipodisco_id" class="form-label">{{ __('TIPO :') }}</label>
                                                                @foreach ($tipodisco as $tipo)
                                                                <li>
                                                                    <a href="" class="nivel-17 a" data-id="{{ $tipo->id }}">{{ $tipo->tipo }}</a>
                                                                </li>
                                                                @endforeach
                                                                <li>
                                                                    <a href="#" class="nivel-17" data-id="otroTipodisco">Otro...</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        @endforeach
                                                        <li>
                                                            <a href="#" class="nivel-15" data-id="otroCapdisco">Otro...</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                @endforeach
                                                <li>
                                                    <a href="#" class="nivel-13" data-id="otroMarcadisco">Otro...</a>
                                                </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </nav>
                                        <input type="hidden" id="marcadisco_id" name="marcadisco_id">
                                        <input type="hidden" id="capacdisco_id" name="capacdisco_id">
                                        <input type="hidden" id="tipodisco_id" name="tipodisco_id" >
                                        <input type="text" name="otra_marca_disco" class="otra_marca_disco form-control mt-2" placeholder="Especificar otro" style="display:none;">
                                        <input type="text" name="otra_capacidad_disco" class="otra_capacidad_disco form-control mt-2" placeholder="Especificar otro" style="display:none;">
                                        <input type="text" name="otro_tipo_disco" class="otro_tipo_disco form-control mt-2" placeholder="Especificar otro" style="display:none;">

                                    <ul id="seleccionesdd" class="ul">
                                        @if(old('marcadisco_id') && old('capacdisco_id') && old('tipodisco_id'))
                                            <li>MARCA: {{ $marcadisco->find(old('marcadisco_id'))->marca }}</li>
                                            <li>CAPACIDAD: {{ $capdisco->find(old('capacdisco_id'))->capacidad }}</li>
                                            <li>TIPO: {{ $tipodisco->find(old('tipodisco_id'))->tipo }}</li>
                                        @else
                                            <li id="marcadisco"></li>
                                            <li id="capdisco"></li>
                                            <li id="tipodisco"></li>
                                        @endif
                                    </ul>
                                </div>
                                    {{-- TARJETA MADRE --}}
                                <div class="div title">
                                    <nav>
                                        <ul id="menu_principal1" class="ul">
                                            <li>
                                                <label for="drop-2" class="text-center principales">{{ __('TARJETA  MADRE') }}</label>
                                                <input type="checkbox" id="drop-2">

                                                <ul class="ul">
                                                    <label for="marcatmadre_id" class="form-label">{{ __('MARCA :') }}</label>

                                                    @foreach ($marcatmadre as $marca)
                                                    <li>
                                                        <a href="#" class="nivel-10" data-id="{{ $marca->id }}">{{ $marca->marca }}</a>

                                                        <ul id="submenu-mtmadre" class="ul nivel-11" style="display: none;">
                                                            <label for="modtmadre_id" class="form-label">{{ __('MODELO :') }}</label>

                                                            @foreach ($modelotmadre as $modelo)
                                                            <li>
                                                                <a href="#" class="nivel-12" data-id="{{ $modelo->id }}">{{ $modelo->modelo }}</a>
                                                            </li>
                                                            @endforeach

                                                            {{-- Opción "Otro" modelo --}}
                                                            <li>
                                                                <a href="#" class="nivel-12" data-id="otroModtm">Otro...</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    @endforeach

                                                    {{-- Opción "Otro" marca --}}
                                                    <li>
                                                        <a href="#" class="nivel-10" data-id="otroMarcatm">Otro...</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </nav>
                                    {{-- Campos ocultos --}}
                                    <input type="hidden" id="marcatmadre_id" name="marcatmadre_id">
                                    <input type="hidden" id="modtmadre_id" name="modtmadre_id">
                                    <input type="text" name="otra_marcatm" class="otra_marcatm form-control mt-2" placeholder="Especificar otro" style="display:none;">
                                    <input type="text" name="otro_modtm" class="otro_modtm form-control mt-2" placeholder="Especificar otro modelo" style="display:none;">
                                    <ul id="seleccionestm" class="ul">
                                            @if(old('marcatmadre_id') && old('modtmadre_id'))
                                                <li>MARCA: {{ $marcatmadre->find(old('marcatmadre_id'))->marca }}</li>
                                                <li>MODELO: {{ $modelotmadre->find(old('modtmadre_id'))->modelo }}</li>
                                            @else
                                                <li id="marcatmadre"></li>
                                                <li id="modtmadre"></li>
                                            @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="fila-5">
                                {{-- MEMORIA RAM --}}
                                <div class="div title">
                                    <nav>
                                        <ul id="menu_principal" class="ul">
                                            <li>
                                                <label for="drop-2" class="text-center principales">{{ __('MEMORIA RAM') }}</label>
                                                <input type="checkbox" id="drop-2">
                                                <ul class="ul">
                                                <label for="disipador_id" class="form-label">{{ __('DISIPADOR :') }}</label>
                                                @foreach ($disipadorram as $disipador)
                                                    <li>
                                                        <a href="" class="nivel-18" data-id="{{ $disipador->id }}">{{ $disipador->opcion }}</a>
                                                        <ul id="submenu-marcaram" class="ul nivel-19" style="display: none;">
                                                        <label for="marcaram_id" class="form-label">{{ __('MARCA :') }}</label>
                                                        @foreach ($marcaram as $marca)
                                                        <li>
                                                            <a href="" class="nivel-20" data-id="{{ $marca->id }}">{{ $marca->marca }}</a>
                                                            <ul id="submenu-capacidadram" class="ul nivel-21" style="display: none;">
                                                                <label for="capacram_id" class="form-label">{{ __('CAPACIDAD:') }}</label>
                                                                @foreach ($capram as $capacidad)
                                                                <li>
                                                                    <a href="" class="nivel-22" data-id="{{ $capacidad->id }}">{{ $capacidad->capacidad }}</a>
                                                                    <ul id="submenu-tiporam" class="ul nivel-23" style="display: none;">
                                                                        <label for="tiporam_id" class="form-label">{{ __('TIPO DE CONEXION :') }}</label>
                                                                        @foreach ($tiporam as $tipo)
                                                                        <li>
                                                                            <a href="" class="nivel-24" data-id="{{ $tipo->id }}">{{ $tipo->tipo }}</a>
                                                                            <ul id="submenu-cantidadram" class="ul nivel-25" style="display: none;">
                                                                                <label for="cantidad_id" class="form-label">{{ __('CANTIDAD :') }}</label>
                                                                                @foreach ($cantidadram as $cantidad)
                                                                                    <li>
                                                                                        <a href="" class="nivel-26" data-id="{{ $cantidad->id }}">{{ $cantidad->cantidad }}</a>
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </li>
                                                                        @endforeach
                                                                        <li>
                                                                            <a href="" class="nivel-24" data-id="otroTiporam">Otro...</a>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                                @endforeach
                                                                <li>
                                                                    <a href="#" class="nivel-22" data-id="otroCapram">Otro...</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        @endforeach
                                                        <li>
                                                            <a href="#" class="nivel-20" data-id="otroMarcaram">Otro...</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                                    <input type="hidden" id="disipador_id" name="disipador_id">
                                    <input type="hidden" id="marcaram_id" name="marcaram_id">
                                    <input type="hidden" id="capacram_id" name="capacram_id">
                                    <input type="hidden" id="tiporam_id" name="tiporam_id">
                                    <input type="hidden" id="cantidad_id" name="cantidad_id">
                                    <input type="text" name="otra_marca_ram" class="otra_marca_ram form-control" placeholder="Especificar otro" style="display:none;">
                                    <input type="text" name="otra_capacidad_ram" class="otra_capacidad_ram form-control" placeholder="Especificar otro" style="display:none;">
                                    <input type="text" name="otra_tipo_ram" class="otra_tipo_ram form-control" placeholder="Especificar otro" style="display:none;">
                                    
                                    <ul id="seleccionesram" class="ul">
                                            @if(old('disipador_id') && old('marcaram_id') && old('capacram_id') && old('tiporam_id') && old('cantidad_id'))
                                            <li>DISIPADOR: {{ $disipadorram->find(old('disipador_id'))->opcion }}</li>
                                            <li>MARCA: {{ $marcaram->find(old('marcaram_id'))->marca }}</li>
                                            <li>CAPACIDAD: {{ $capram->find(old('capacram_id'))->capacidad }}</li>
                                            <li>TIPO: {{ $tiporam->find(old('tiporam_id'))->tipo }}</li>
                                            <li>CANTIDAD: {{ $cantidad->find(old('cantidad_id'))->cantidad }}</li>
                                            @else
                                            <li id="disipadorram"></li>
                                            <li id="marcaram"></li>
                                            <li id="capacidadram"></li>
                                            <li id="tiporam"></li>
                                            <li id="cantidad"></li>
                                            @endif
                                    </ul>
                                </div>
                                {{-- TARJETA DE VIDEO --}}
                                <div class="div title">
                                    <nav>
                                        <ul id="menu_principal" class="ul">
                                            <li>
                                            <label for="drop-2" class="text-center principales">{{ __('TARJETA DE VIDEO') }}</label>
                                            <input type="checkbox" id="drop-2">
                                                <ul class="ul">
                                                <label for="marcatvideo_id" class="form-label">{{ __('MARCA :') }}</label>
                                                @foreach ($marcatvideo as $marca)
                                                    <li>
                                                        <a href="" class="nivel-27" data-id="{{ $marca->id }}">{{ $marca->marca }}</a>
                                                        <ul class="ul nivel-28" style="display: none;">
                                                            <label for="capactvideo_id" class="form-label">{{ __('CAPACIDAD :') }}</label>
                                                            @foreach ($captvideo as $capacidad)
                                                                <li>
                                                                    <a href="" class="nivel-29" data-id="{{ $capacidad->id }}">{{ $capacidad->capacidad }}</a>
                                                                    <ul class="ul nivel-30" style="display: none;">
                                                                    <label for="tipotvideo_id" class="form-label">{{ __('TIPO :') }}</label>
                                                                    @foreach ($tipotvideo as $tipo)
                                                                    <li>
                                                                        <a href="" class="nivel-31" data-id="{{ $tipo->id }}">{{ $tipo->tipo }}</a>
                                                                    </li>
                                                                    @endforeach
                                                                    </ul>
                                                                </li>
                                                            @endforeach
                                                            <li>
                                                                <a href="#" class="nivel-29" data-id="otroCaptv">Otro...</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    @endforeach
                                                    <li>
                                                        <a href="#" class="nivel-27" data-id="otroMarcatv">Otro...</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </nav>
                                        <input type="hidden" id="marcatvideo_id" name="marcatvideo_id">
                                        <input type="hidden" id="capactvideo_id" name="capactvideo_id">
                                        <input type="hidden" id="tipotvideo_id" name="tipotvideo_id">
                                        <input type="text" name="otra_marca_tvideo" class="otra_marca_tvideo form-control" placeholder="Especificar otro" style="display:none;">
                                        <input type="text" name="otra_capacidad_tvideo" class="otra_capacidad_tvideo form-control" placeholder="Especificar otro" style="display:none;">
                                    <ul id="seleccionestvideo" class="ul">
                                            @if(old('marcatvideo_id') && old('capactvideo_id') && old('tipotvideo_id'))
                                            <li>MARCA: {{ $marcatvideo->find(old('marcatvideo_id'))->marca }}</li>
                                            <li>CAPACIDAD: {{ $captvideo->find(old('capactvideo_id'))->capacidad }}</li>
                                            <li>TIPO: {{ $tipotvideo->find(old('tipotvideo_id'))->tipo }}</li>
                                            @else
                                            <li id="marcatvideo"></li>
                                            <li id="capacidadtvideo"></li>
                                            <li id="tipotvideo"></li>
                                            @endif
                                    </ul>
                                </div>
                                {{-- TARJETA DE RED --}}
                                <div class="div title">
                                    <nav>
                                        <ul id="menu_principal" class="ul">
                                            <li>
                                            <label for="drop-2" class="text-center principales">{{ __('TARJETA DE RED') }}</label>
                                            <input type="checkbox" id="drop-2">
                                                <ul class="ul">
                                                <label for="marcatred_id" class="form-label">{{ __('MARCA :') }}</label>
                                                @foreach ($marcatred as $marca)
                                                    <li>
                                                        <a href="" class="nivel-40" data-id="{{ $marca->id }}">{{ $marca->marca }}</a>
                                                        <ul class="ul nivel-41" style="display: none;">
                                                        <label for="modtred_id" class="form-label">{{ __('MODELO :') }}</label>
                                                            @foreach ($modelotred as $modelo)
                                                            <li>
                                                                <a href="" class="nivel-42" data-id="{{ $modelo->id }}">{{ $modelo->modelo }}</a>
                                                            </li>
                                                            @endforeach
                                                            <li>
                                                                <a href="#" class="nivel-42" data-id="otroModtred">Otro...</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    @endforeach
                                                    <li>
                                                        <a href="#" class="nivel-40" data-id="otroMarcatred">Otro...</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </nav>
                                        <input type="hidden" id="marcatred_id" name="marcatred_id">
                                        <input type="hidden" id="modtred_id" name="modtred_id">
                                        <input type="text" id="" name="otra_marca_tred" class="otra_marca_tred form-control" placeholder="Especificar otro" style="display:none;">
                                        <input type="text" id="" name="otro_modelo_tred" class="otro_modelo_tred form-control" placeholder="Especificar otro" style="display:none;">
                                    <ul id="seleccionestred" class="ul">
                                            @if(old('marcatred_id') && old('modtred_id'))
                                            <li>MARCA: {{ $marcatred->find(old('marcatred_id'))->marca }}</li>
                                            <li>MODELO: {{ $modelotred->find(old('modtred_id'))->modelo }}</li>
                                            @else
                                            <li id="marcatred"></li>
                                            <li id="modelotred"></li>
                                            @endif

                                    </ul>
                                </div>
                                {{-- TARJETA WIFI --}}
                                <div class="div title">
                                    <nav>
                                        <ul id="menu_principal1" class="ul">
                                            <li>
                                            <label for="drop-2" class="text-center principales">{{ __('TARJETA  WIFI') }}</label>
                                            <input type="checkbox" id="drop-2">
                                                <ul class="ul">
                                                <label for="marcawifi_id" class="form-label">{{ __('MARCA :') }}</label>
                                                @foreach ($marcatwifi as $marca)
                                                    <li>
                                                        <a href="" class="nivel-43" data-id="{{$marca->id }}">{{ $marca->marca }}</a>
                                                        <ul class="ul nivel-44" style="display: none;">
                                                        <label for="modcawifi_id" class="form-label">{{ __('MODELO :') }}</label>
                                                        @foreach ($modelowifi as $modelo)
                                                            <li>
                                                                <a href="" class="nivel-45" data-id="{{ $modelo->id }}">{{ $modelo->modelo }}</a>
                                                                    <ul class="ul nivel-80" style="display: none;">
                                                                    <label for="antena_id" class="form-label">{{ __('ANTENA :') }}</label>
                                                                        @foreach ($disipadorram as $antena)
                                                                        <li>
                                                                            <a href="" class="nivel-81" data-id="{{$antena->id }}">{{ $antena->opcion }}</a>
                                                                        </li>
                                                                        @endforeach
                                                                    </ul>
                                                            </li>
                                                        @endforeach
                                                        <li>
                                                            <a href="#" class="nivel-45" data-id="otroModwifi">Otro...</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                @endforeach
                                                <li>
                                                    <a href="#" class="nivel-43" data-id="otroMarcawifi">Otro...</a>
                                                </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </nav>
                                        <input type="hidden" id="marcawifi_id" name="marcawifi_id">
                                        <input type="hidden" id="modcawifi_id" name="modcawifi_id">
                                        <input type="hidden" id="antena_id" name="antena_id">
                                        <input type="text" id="" name="otra_marca_wifi" class="otra_marca_wifi form-control" placeholder="Especificar otro" style="display:none;">
                                        <input type="text" id="" name="otra_modelo_wifi" class="otra_modelo_wifi form-control" placeholder="Especificar otro" style="display:none;">
                                    <ul id="seleccioneswifi" class="ul">
                                            @if(old('marcawifi_id') && old('modcawifi_id') && old('antena_id'))
                                            
                                            <li>MARCA: {{ $marcaTwifi->find(old('marcawifi_id'))->marca }}</li>
                                            <li>MODELO: {{ $modeloWifi->find(old('modcawifi_id'))->modelo }}</li>
                                            <li>ANTENA: {{ $antena->find(old('antena_id'))->antena }}</li>
                                            @else
                                            <li id="marcaTwifi"></li>
                                            <li id="modeloWifi"></li>
                                            <li id="antena"></li>
                                            @endif
                                    </ul>
                                </div>
                            </div>
                            
                                {{---------------BOTON AÑADIR RAM 2-3-4------------------ --}}

                                {{-- <div class="fila-5">
                                    <div class="col-md-12 mt20 mt-2">
                                        <button type="button" class="btn btn-primary" id="boton">{{ __('AÑADIR MEMORIA RAM') }}</button>               
                                        <button type="button" class="btn btn-primary" id="boton3">{{ __('RAM 3') }}</button>               
                                        <button type="button" class="btn btn-primary" id="boton4">{{ __('RAM 4') }}</button>
                                    </div>
                                </div> --}}

                                {{--------------MEMORIA RAM 2-3-4------------------ --}}
                                {{-- <div id="div-oculto" style="display: none;" class="fila-5"> --}}
                                <div class="fila-5">
                                    {{-- MEMORIA RAM 2DO SLOT --}}
                                    <div  class="div title">
                                        <nav>
                                            <ul id="menu_principal" class="ul">
                                                <li>
                                                <label for="drop-2" class="text-center principales">{{ __('MEMORIA RAM 2') }}</label>
                                                <input type="checkbox" id="drop-2">
                                                    <ul class="ul">
                                                    <label for="disipador2_id" class="form-label">{{ __('DISIPADOR :') }}</label>
                                                    @foreach ($disipadorram as $disipador)
                                                        <li>
                                                            <a href="" class="nivel-51" data-id="{{ $disipador->id }}">{{ $disipador->opcion }}</a>
                                                            <ul id="submenu-marcaram2" class="ul nivel-52" style="display: none;">
                                                            <label for="marcaram2_id" class="form-label">{{ __('MARCA :') }}</label>
                                                            @foreach ($marcaram as $marca)
                                                                <li>
                                                                    <a href="" class="nivel-53" data-id="{{ $marca->id }}">{{ $marca->marca }}</a>
                                                                    <ul id="submenu-capacidadram2" class="ul nivel-54" style="display: none;">
                                                                    <label for="capacram2_id" class="form-label">{{ __('CAPACIDAD:') }}</label>
                                                                    @foreach ($capram as $capacidad)
                                                                    <li>
                                                                        <a href="" class="nivel-55" data-id="{{ $capacidad->id }}">{{ $capacidad->capacidad }}</a>
                                                                        <ul id="submenu-tiporam2" class="ul nivel-56" style="display: none;">
                                                                            <label for="tiporam2_id" class="form-label">{{ __('TIPO DE CONEXION :') }}</label>
                                                                            @foreach ($tiporam as $tipo)
                                                                            <li>
                                                                                <a href="" class="nivel-57" data-id="{{ $tipo->id }}">{{ $tipo->tipo }}</a>
                                                                                <ul id="submenu-cantidadram2" class="ul nivel-58" style="display: none;">
                                                                                    <label for="cantidad2_id" class="form-label">{{ __('CANTIDAD :') }}</label>
                                                                                    @foreach ($cantidadram as $cantidad)
                                                                                    <li>
                                                                                        <a href="" class="nivel-59" data-id="{{ $cantidad->id }}">{{ $cantidad->cantidad }}</a>
                                                                                    </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </li>
                                                                            @endforeach
                                                                            <li>
                                                                                <a href="" class="nivel-57" data-id="otroTiporam2">Otro...</a>
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                    @endforeach
                                                                    <li>
                                                                        <a href="#" class="nivel-55" data-id="otroCapram2">Otro...</a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            @endforeach
                                                            <li>
                                                                <a href="#" class="nivel-53" data-id="otroMarcaram2">Otro...</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    @endforeach
                                                    </ul>
                                                </li>
                                            </ul>
                                        </nav>
                                            <input type="hidden" id="disipador2_id" name="disipador2_id">
                                            <input type="hidden" id="marcaram2_id" name="marcaram2_id">
                                            <input type="hidden" id="capacram2_id" name="capacram2_id">
                                            <input type="hidden" id="tiporam2_id" name="tiporam2_id">
                                            <input type="hidden" id="cantidad2_id" name="cantidad2_id">
                                            <input type="text" id="" name="otra_marca_ram2" class="otra_marca_ram2 form-control" placeholder="Especificar otro" style="display:none;">
                                            <input type="text" id="" name="otra_capacidad_ram2" class="otra_capacidad_ram2 form-control" placeholder="Especificar otro" style="display:none;">
                                            <input type="text" id="" name="otra_tipo_ram2" class="otra_tipo_ram2 form-control" placeholder="Especificar otro" style="display:none;">
                                        <ul id="seleccionesram2" class="ul">
                                                @if(old('disipador2_id') && old('marcaram2_id') && old('capacram2_id') && old('tiporam2_id') && old('cantidad2_id'))
                                                <li>DISIPADOR: {{ $disipadorram2->find(old('disipador2_id'))->opcion }}</li>
                                                <li>MARCA: {{ $marcaram2->find(old('marcaram2_id'))->marca }}</li>
                                                <li>CAPACIDAD: {{ $capacidadram2->find(old('capacram2_id'))->capacidad }}</li>
                                                <li>TIPO: {{ $tiporam2->find(old('tiporam2_id'))->tipo }}</li>
                                                <li>CANTIDAD: {{ $cantidad2->find(old('cantidad2_id'))->cantidad }}</li>
                                                @else
                                                <li id="disipadorram2"></li>
                                                <li id="marcaram2"></li>
                                                <li id="capacidadram2"></li>
                                                <li id="tiporam2"></li>
                                                <li id="cantidad2"></li>
                                                @endif
                                        </ul>
                                    </div>
                                    {{-- MEMORIA RAM 3ER SLOT --}}
                                    <div class="div title">
                                        <nav>
                                            <ul id="menu_principal" class="ul">
                                                <li>
                                                <label for="drop-2" class="text-center principales">{{ __('MEMORIA RAM 3') }}</label>
                                                <input type="checkbox" id="drop-2">
                                                    <ul class="ul">
                                                    <label for="disipador3_id" class="form-label">{{ __('DISIPADOR :') }}</label>
                                                    @foreach ($disipadorram as $disipador)
                                                    <li>
                                                        <a href="" class="nivel-60" data-id="{{ $disipador->id }}">{{ $disipador->opcion }}</a>
                                                        <ul id="submenu-marcaram3" class="ul nivel-61" style="display: none;">
                                                            <label for="marcaram3_id" class="form-label">{{ __('MARCA :') }}</label>
                                                            @foreach ($marcaram as $marca)
                                                            <li>
                                                                <a href="" class="nivel-62" data-id="{{ $marca->id }}">{{ $marca->marca }}</a>
                                                                <ul id="submenu-capacidadram3" class="ul nivel-63" style="display: none;">
                                                                    <label for="capacram3_id" class="form-label">{{ __('CAPACIDAD:') }}</label>
                                                                    @foreach ($capram as $capacidad)
                                                                    <li>
                                                                        <a href="" class="nivel-64" data-id="{{ $capacidad->id }}">{{ $capacidad->capacidad }}</a>
                                                                        <ul id="submenu-tiporam3" class="ul nivel-65" style="display: none;">
                                                                            <label for="tiporam3_id" class="form-label">{{ __('TIPO DE CONEXION :') }}</label>
                                                                            @foreach ($tiporam as $tipo)
                                                                            <li>
                                                                                <a href="" class="nivel-66" data-id="{{ $tipo->id }}">{{ $tipo->tipo }}</a>
                                                                                <ul id="submenu-cantidadram3" class="ul nivel-67" style="display: none;">
                                                                                    <label for="cantidad3_id" class="form-label">{{ __('CANTIDAD :') }}</label>
                                                                                    @foreach ($cantidadram as $cantidad)
                                                                                    <li>
                                                                                        <a href="" class="nivel-68" data-id="{{ $cantidad->id }}">{{ $cantidad->cantidad }}</a>
                                                                                    </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </li>
                                                                            @endforeach
                                                                            <li>
                                                                                <a href="" class="nivel-66" data-id="otroTiporam3">Otro...</a>
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                    @endforeach
                                                                    <li>
                                                                        <a href="#" class="nivel-64" data-id="otroCapram3">Otro...</a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            @endforeach
                                                            <li>
                                                                <a href="#" class="nivel-62" data-id="otroMarcaram3">Otro...</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    @endforeach
                                                    </ul>
                                                </li>
                                            </ul>
                                        </nav>
                                            <input type="hidden" id="disipador3_id" name="disipador3_id">
                                            <input type="hidden" id="marcaram3_id" name="marcaram3_id">
                                            <input type="hidden" id="capacram3_id" name="capacram3_id">
                                            <input type="hidden" id="tiporam3_id" name="tiporam3_id">
                                            <input type="hidden" id="cantidad3_id" name="cantidad3_id">
                                            <input type="text" id="" name="otra_marca_ram3" class="otra_marca_ram3 form-control" placeholder="Especificar otro" style="display:none;">
                                            <input type="text" id="" name="otra_capacidad_ram3" class="otra_capacidad_ram3 form-control" placeholder="Especificar otro" style="display:none;">
                                            <input type="text" id="" name="otra_tipo_ram3" class="otra_tipo_ram3 form-control" placeholder="Especificar otro" style="display:none;">
                                        <ul id="seleccionesram3" class="ul">
                                                @if(old('disipador3_id') && old('marcaram3_id') && old('capacram3_id') && old('tiporam3_id') && old('cantidad3_id'))
                                                <li>DISIPADOR: {{ $disipadorram3->find(old('disipador3_id'))->opcion }}</li>
                                                <li>MARCA: {{ $marcaram3->find(old('marcaram3_id'))->marca }}</li>
                                                <li>CAPACIDAD: {{ $capacidadram3->find(old('capacram3_id'))->capacidad }}</li>
                                                <li>TIPO: {{ $tiporam3->find(old('tiporam3_id'))->tipo }}</li>
                                                <li >CANTIDAD: {{ $cantidad3->find(old('cantidad3_id'))->cantidad }}</li>
                                                @else
                                                <li id="disipadorram3"></li>
                                                <li id="marcaram3"></li>
                                                <li id="capacidadram3"></li>
                                                <li id="tiporam3"></li>
                                                <li id="cantidad3"></li>
                                                @endif
                                        </ul>
                                    </div>
                                    {{-- MEMORIA RAM 4TO SLOT --}}
                                    <div class="div title">
                                        <nav id="nav">
                                            <ul id="menu_principal" class="ul">
                                                <li>
                                                <label for="drop-2" class="text-center principales">{{ __('MEMORIA RAM 4') }}</label>
                                                <input type="checkbox" id="drop-2">
                                                    <ul class="ul">
                                                    <label for="disipador4_id" class="form-label">{{ __('DISIPADOR :') }}</label>
                                                    @foreach ($disipadorram as $disipador)
                                                    <li>
                                                        <a href="" class="nivel-69" data-id="{{ $disipador->id }}">{{ $disipador->opcion }}</a>
                                                        <ul class="ul nivel-70" style="display: none;">
                                                            <label for="marcaram4_id" class="form-label">{{ __('MARCA :') }}</label>
                                                            @foreach ($marcaram as $marca)
                                                            <li>
                                                                <a href="" class="nivel-71" data-id="{{ $marca->id }}">{{ $marca->marca }}</a>
                                                                <ul class="ul nivel-72" style="display: none;">
                                                                    <label for="capacram4_id" class="form-label">{{ __('CAPACIDAD:') }}</label>
                                                                    @foreach ($capram as $capacidad)
                                                                    <li>
                                                                        <a href="" class="nivel-73" data-id="{{ $capacidad->id }}">{{ $capacidad->capacidad }}</a>
                                                                        <ul class="ul nivel-74" style="display: none;">
                                                                            <label for="tiporam4_id" class="form-label">{{ __('TIPO DE CONEXION :') }}</label>
                                                                            @foreach ($tiporam as $tipo)
                                                                            <li>
                                                                                <a href="" class="nivel-75" data-id="{{ $tipo->id }}">{{ $tipo->tipo }}</a>
                                                                                <ul class="ul nivel-76" style="display: none;">
                                                                                    <label for="cantidad4_id" class="form-label">{{ __('CANTIDAD :') }}</label>
                                                                                    @foreach ($cantidadram as $cantidad)
                                                                                    <li>
                                                                                        <a href="" class="nivel-77" data-id="{{ $cantidad->id }}">{{ $cantidad->cantidad }}</a>
                                                                                    </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </li>
                                                                            @endforeach
                                                                            <li>
                                                                                <a href="" class="nivel-75" data-id="otroTiporam4">Otro...</a>
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                    @endforeach
                                                                    <li>
                                                                        <a href="#" class="nivel-73" data-id="otroCapram4">Otro...</a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            @endforeach
                                                            <li>
                                                                <a href="#" class="nivel-71" data-id="otroMarcaram4">Otro...</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    @endforeach
                                                    </ul>
                                                </li>
                                            </ul>
                                        </nav>
                                            <input type="hidden" id="disipador4_id" name="disipador4_id">
                                            <input type="hidden" id="marcaram4_id" name="marcaram4_id">
                                            <input type="hidden" id="capacram4_id" name="capacram4_id">
                                            <input type="hidden" id="tiporam4_id" name="tiporam4_id">
                                            <input type="hidden" id="cantidad4_id" name="cantidad4_id">
                                            <input type="text" id="" name="otra_marca_ram4" class="otra_marca_ram4 form-control" placeholder="Especificar otro" style="display:none;">
                                            <input type="text" id="" name="otra_capacidad_ram4" class="otra_capacidad_ram4 form-control" placeholder="Especificar otro" style="display:none;">
                                            <input type="text" id="" name="otra_tipo_ram4" class="otra_tipo_ram4 form-control" placeholder="Especificar otro" style="display:none;">
                                        <ul id="seleccionesram4" class="ul">
                                                @if(old('disipador4_id') && old('marcaram4_id') && old('capacram4_id') && old('tiporam4_id') && old('cantidad4_id'))
                                                <li>DISIPADOR: {{ $disipadorram4->find(old('disipador4_id'))->opcion }}</li>
                                                <li>MARCA: {{ $marcaram4->find(old('marcaram4_id'))->marca }}</li>
                                                <li>CAPACIDAD: {{ $capacidadram4->find(old('capacram4_id'))->capacidad }}</li>
                                                <li>TIPO: {{ $tiporam4->find(old('tiporam4_id'))->tipo }}</li>
                                                <li>CANTIDAD: {{ $cantidad4->find(old('cantidad4_id'))->cantidad }}</li>
                                                @else
                                                <li id="disipadorram4"></li>
                                                <li id="marcaram4"></li>
                                                <li id="capacidadram4"></li>
                                                <li id="tiporam4"></li>
                                                <li id="cantidad4"></li>
                                                @endif
                                        </ul>
                                    </div>
                                    <div class="div"></div>
                                </div>
                                <div class="fila-5">
                                    {{-- FUENTE DE PODER --}}
                                    <div class="div title">
                                        <nav>
                                            <ul id="menu_principal" class="ul">
                                                <li>
                                                <label for="drop-2" class="text-center principales">{{ __('FUENTE DE PODER') }}</label>
                                                <input type="checkbox" id="drop-2">
                                                    <ul class="ul">
                                                        <label for="marcafuente_id" class="form-label">{{ __('MARCA :') }}</label>
                                                        @foreach ($marcafuente as $marca)
                                                        <li>
                                                            <a href="" class="nivel-46" data-id="{{ $marca->id }}">{{ $marca->marca }}</a>
                                                            <ul class="ul nivel-47" style="display: none;">
                                                                <label for="potfuente_id" class="form-label">{{ __('MODELO :') }}</label>
                                                                @foreach ($potenciafuente as $potencia)
                                                                <li>
                                                                    <a href="" class="nivel-48" data-id="{{  $potencia->id }}">{{ $potencia->potencia}}</a>
                                                                    <ul class="ul nivel-78" style="display: none;">
                                                                    <label for="cable_id" class="form-label">{{ __('CABLE DE PODER :') }}</label>
                                                                        @foreach ($disipadorram as $cable)
                                                                        <li>
                                                                            <a href="" class="nivel-79" data-id="{{$cable->id }}">{{ $cable->opcion}}</a>
                                                                        </li>
                                                                        @endforeach
                                                                    </ul>
                                                            </li>
                                                            @endforeach
                                                            <li>
                                                                <a href="#" class="nivel-48" data-id="otroPotenciafuente">Otro...</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    @endforeach
                                                    <li>
                                                        <a href="#" class="nivel-46" data-id="otroMarcafuente">Otro...</a>
                                                    </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </nav>
                                            <input type="hidden" id="marcafuente_id" name="marcafuente_id">
                                            <input type="hidden" id="potfuente_id" name="potfuente_id">
                                            <input type="hidden" id="cable_id" name="cable_id">
                                            <input type="text" id="" name="otra_marca_fuente" class="otra_marca_fuente form-control" placeholder="Especificar otro" style="display:none;">
                                            <input type="text" id="" name="otra_potencia_fuente" class="otra_potencia_fuente form-control" placeholder="Especificar otro" style="display:none;">
                                        <ul id="seleccionesfuente" class="ul">
                                                @if(old('marcafuente_id') && old('potfuente_id' ) && old('cable_id' ))
                                                <li>MARCA: {{ $marcafuente->find(old('marcafuente_id'))->marca }}</li>
                                                <li>POTENCIA: {{ $potenciafuente->find(old('potfuente_id'))->potencia }}</li>
                                                <li>CABLE: {{ $cable->find(old('cable_id'))->opcion }}</li>
                                                @else
                                                <li id="marcafuente"></li>
                                                <li id="potenciafuente"></li>
                                                <li id="cable"></li>
                                                @endif
                                        </ul>
                                    </div>
                                    {{-- LECTOR CD --}}
                                    <div class="div title">
                                        <nav>
                                            <ul id="menu_principal" class="ul">
                                                <li>
                                                <label for="drop-2" class="text-center principales">{{ __('LECTOR CD/DVD') }}</label>
                                                <input type="checkbox" id="drop-2">
                                                    <ul class="ul">
                                                    <label for="marcacd_id" class="form-label">{{ __('MARCA :') }}</label>
                                                    @foreach ($marcalectorcd as $marca)
                                                    <li>
                                                        <a href="" class="nivel-49" data-id="{{ $marca->id }}">{{ $marca->nombre }}</a>
                                                    </li>
                                                    @endforeach
                                                    <li>
                                                        <a href="#" class="nivel-49" data-id="otroMarcacd">Otro...</a>
                                                    </li>
                                                </ul>
                                                </li>
                                            </ul>
                                        </nav>
                                            <input type="hidden" id="marcacd_id" name="marcacd_id">
                                            <input type="text" id="" name="otro_marca_cd" class="otro_marca_cd form-control" placeholder="Especificar otro" style="display:none;">
                                        <ul id="seleccionescd" class="ul">
                                                @if(old('marcacd_id'))
                                                <li>MARCA: {{ $marcalectorcd->find(old('marcacd_id'))->nombre }}</li>
                                                @else
                                                <li id="marcalectorcd"></li>
                                                @endif
                                        </ul>
                                    </div>
                                    <div class="div title">
                                    </div>
                                    <div class="div title">
                                    </div>
                                    </div>
                                    <div class="fila-1">
                                    <div class="div title">
                                        <label for="falla" class="form-label">{{ __('TIPO DE FALLA') }}<span class="required">*</span></label>
                                        <input type="text" name="falla" class="form-control @error('falla') is-invalid @enderror" id="falla" placeholder="Tipo de Falla">
                                        {!! $errors->first('falla', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                    </div>
                                    <div class="div title">
                                        <label for="respaldo" class="form-label">{{ __('REQUIERE RESPALDO ...?') }} <span class="required">*</span></label>
                                        <select name="respaldo" class="form-control @error('respaldo') is-invalid @enderror" id="respaldo" required>
                                            <option value="" disabled {{'selected' }}>Seleccione una opción</option>
                                            <option value="SI" >SI</option>
                                            <option value="NO" >NO</option>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="fila-1">
                                        <div class="div title">
                                            <label for="otro" class="form-label">{{ __('OTROS') }}</label>
                                            <input type="text" name="otro" class="form-control @error('otro') is-invalid @enderror" id="otro" placeholder="Otros">
                                            {!! $errors->first('otro', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                        </div>
                                        <div class="div title">
                                            <label for="observaciones" class="form-label">{{ __('OBSERVACIONES') }}</label>
                                                <input type="textarea" name="observaciones" class="form-control @error('observaciones') is-invalid @enderror" id="observaciones" placeholder="Observaciones">
                                            {!! $errors->first('observaciones', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                        </div>
                                    </div>
                                    <div class="fila-3">
                                            {{-- --------ESTADO--------------}}
                                            <div class="div title">
                                                <div class="">
                                                <label for="terminos_text">TÉRMINOS Y CONDICIONES</label>
                                                <div id="terminos_text" class="condiciones">
                                                <p>
                                                Al entregar su equipo a , el usuario acepta los siguientes términos y condiciones:
                                                </p>
                                                <p>
                                                1. Recepción y Diagnóstico del Equipo

                                                    Inspección Inicial: En el momento de la recepción, se realizará una inspección visual básica del equipo junto con el cliente, dejando constancia escrita de su estado aparente y los accesorios entregados. El taller no se hace responsable de defectos o daños ocultos que puedan surgir durante el proceso de reparación.
                                                    Diagnóstico y Presupuesto: Se informará al cliente del costo del diagnóstico (si aplica). Una vez diagnosticada la avería, se emitirá un presupuesto detallado. El cliente debe aprobar este presupuesto por escrito (incluyendo correo electrónico o mensaje) antes de que se inicie cualquier reparación.
                                                    Costos de Diagnóstico: Si el cliente no acepta el presupuesto, deberá abonar el costo del diagnóstico (si existe) para retirar su equipo. 
                                                </p>
                                                <p>
                                                2. Proceso de Reparación y Garantía

                                                    Autorización Implícita: La aceptación del presupuesto autoriza al taller a realizar las reparaciones necesarias y a desechar las piezas dañadas sustituidas (salvo que el cliente solicite lo contrario por escrito).
                                                    Garantía: La reparación tiene una garantía de [ej. 3 meses] en la mano de obra efectuada y sobre las piezas nuevas instaladas, las cuales tendrán la garantía ofrecida por el fabricante. La garantía no cubre averías causadas por un uso inadecuado, subidas de tensión, condiciones ambientales anormales o reparaciones realizadas por terceros sin autorización.
                                                    Defectos Ocultos: El taller no se responsabiliza por daños o fallas que surjan durante el mantenimiento debido a defectos ocultos del equipo no detectados en la revisión inicial. 
                                                </p>
                                                <p>
                                                3. Limitación de Responsabilidad

                                                    Pérdida de Información: El cliente es el único responsable de realizar una copia de seguridad de la información contenida en el equipo antes de su entrega. El taller no se responsabiliza por la pérdida total o parcial de datos que pueda ocurrir durante el servicio.
                                                    Daños al Equipo: La responsabilidad del taller se limita al valor de la reparación o, en su caso, al valor de mercado del equipo en su estado actual antes de la avería, excluyendo cualquier pérdida de beneficio u otros daños indirectos.
                                                    Equipos Externos/Periféricos: El taller no se hace responsable de daños a equipos periféricos o software que no hayan sido entregados para revisión. 
                                                </p>
                                                <p>
                                                4. Plazos y Retirada del Equipo

                                                    Plazos: Los plazos de reparación son estimados y pueden variar en función de la disponibilidad de repuestos.
                                                    Abandono del Equipo: Si el equipo no es retirado por el cliente en un plazo de [ej. 60 o 90 días] a partir de la fecha de notificación de finalización del servicio o no aceptación del presupuesto, se considerará abandonado. El taller quedará facultado para disponer del equipo (incluyendo su venta o desecho) para cubrir los gastos de almacenamiento y reparación, perdiendo el cliente todo derecho a reclamo o indemnización. 
                                                </p>
                                                <p>
                                                5. Confidencialidad y Datos Personales

                                                    El taller se compromete a tratar de forma confidencial cualquier información personal o contenida en el equipo del cliente, y a cumplir con la normativa de protección de datos aplicable. 
                                                    </p>
                                                </div>
                                                </div>
                                                <div class="div">
                                                    <label class="checkbox-bounce">
                                                    <input type="checkbox" name="condiciones" value="1" required>
                                                <span></span>
                                                He leído y acepto los Términos y Condiciones
                                                </label>
                                                </div>

                                            </div>
                                    </div>
                                    <div class="fila-2">
                                            {{-- --------ESTADO--------------}}
                                            <div class="div title" style="display:none;">
                                                <input type="hidden" name="estado_id" value="{{ $estado?->first()->id }}">
                                            </div>
                                    </div>
                                </fielset>

                        </div>
                        </div>
                    
                    <div class="modal-footer">
                        <button id="btnEnviar" type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm"><i class="fa fa-fw fa-save"></i> GUARDAR</button>
                        <button type="button" class="btn btn-danger rounded-pill px-4 shadow-sm" data-dismiss="modal"><i class="fas fa-times"></i>  CANCELAR</button>
                    </div>
                </div> 
                </form>
            </div>
            </div>
        </section>
        </div>
        </div>
    </div>

