
<div class="form-group body100">

        <div class="fila-3">
        <div class="div title">
            <label for="resultado_id" class="form-label">{{ __('TIPO DE INFORME') }}</label>
            <select name="resultado_id" class="form-control @error('resultado_id') is invalid @enderror" id="resultado_id"> 
                <option value="">SELECCIONAR </option> 
                @foreach ($resultado as $item)
                <option value="{{ $item->id }}"> 
                    {{ $item->nombre}}
                </option> 
                @endforeach                 
            </select>  
            {!! $errors->first('resultado_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        </div>
    <div id="form">
      <?php
      use Carbon\Carbon;
      $fechaActual = Carbon::now()->translatedFormat('d \\d\\e F \\d\\e Y')
      ?>
  <div id="cabecera">
    <div class="informe">
    <div>
      <h2>GOBIERNO AUTÓNOMO MUNICIPAL DE EL ALTO</h2>
    <div >
      <h2>INFORME</h2>
      <p class="centrado">CITE: SMAF/DA/UASI/ <input type="text" class=" text-uppercase input3" id="cite" name="cite" placeholder="Ej.: LLU/031" required>/{{ date('Y'); }}</p>

      <table class="tabla-informe">
        <tr>
          <td class="etiqueta">A:</td>
          <td>
          <input type="text" class="input" id="aquien" name="aquien" required placeholder="INTRODUZCA NOMBRE" style="text-transform: uppercase;"><br>
          <input type="text" class="input" id="cargoUnidad" name="cargo1" placeholder="ESCRIBA EL CARGO"  required style="text-transform: uppercase;"><br>
            GOBIERNO AUTÓNOMO MUNICIPAL DE EL ALTO
          </td>
        </tr>
        <tr>
          <td class="etiqueta">VÍA:</td>
          <td>
            <input class="input" type="text" id="via1" name="via1" value="{{ $responsable?->first()->nombre }}" readonly><br>
            <input class="input" type="text" id="via2" name="cargo2" value="{{ $responsable->first()->cargo ?? 'Valor predeterminado' }}" readonly><br>
            UNIDAD DE ADMINISTRACIÓN DE SISTEMAS DE INFORMACIÓN<br>
            GOBIERNO AUTÓNOMO MUNICIPAL DE EL ALTO
          </td>
        </tr>

        <tr>
          <td></td>
          <td>
            <input class="input" type="text" id="via2" name="via2" value="{{ $responsable->skip(1)->first()->nombre ?? 'Valor predeterminado' }}" readonly><br>
            <input class="input" type="text" class="text-uppercase" id="cargo3" name="cargo3" value="{{ $responsable->skip(1)->first()->cargo ?? 'Valor predeterminado' }}" readonly><br>
            UNIDAD DE ADMINISTRACIÓN DE SISTEMAS DE INFORMACIÓN<br>
            GOBIERNO AUTÓNOMO MUNICIPAL DE EL ALTO
          </td>
        </tr>

        <tr>
          <td class="etiqueta">DE:</td>
          <td>
            <input class="input" type="text" value="{{ ucfirst(strtolower($user?->name)) }} {{ ucfirst(strtolower($user?->paterno)) }} {{ ucfirst(strtolower($user?->materno)) }}" name="user" id="user" readonly><br>
            TÉCNICO EN SOPORTE<br>
            UNIDAD DE ADMINISTRACIÓN DE SISTEMAS DE INFORMACIÓN<br>
            GOBIERNO AUTÓNOMO MUNICIPAL DE EL ALTO
          </td>
        </tr>

        <tr>
          <td class="etiqueta">REF.:</td>
          <td>INFORME TÉCNICO</td>
        </tr>

        <tr>
          <td class="etiqueta">FECHA:</td>
          <td>El Alto, {{ $fechaActual }}</td>
        </tr>
      </table>
    </div>

    <hr>
    {{-- -----------ANTECEDENTES-------------}}
      <P>
      I. ANTECEDENTES.
      </P>
        <div id="antecedentesDevolucion">
            <p>
            En atención a la nota con CITE: <input type="text" class="input2" id="cite_antecedentes" name="cite_antecedentes" style="text-transform: uppercase;" required> con Ref.: <input type="text" class="input text-uppercase" id="referencia" name="referencia" style="text-transform: uppercase;" required>, 
            que llego a nuestra unidad, por lo que me remito a informar lo siguiente.
            </p>
        </div>
        <div id="antecedentesReposicion">
          <p>
          En atención a la nota en fecha de recepción por la unidad {{ Carbon::parse($teclado?->fecha)->translatedFormat('d \\d\\e F \\d\\e Y')}} con Ref. <input type="text" class="input text-uppercase" id="referencia" name="referencia" style="text-transform: uppercase;" required>, 
          que llego a nuestra Unidad, por lo que me remito a informar lo siguiente.
          </p>
        </div>
        <div id="antecedentesRepliegue">
          <p>
            En atención a nota con CITE: <input type="text" class="input2" id="cite_antecedentes" name="cite_antecedentes" style="text-transform: uppercase;" required>  en fecha de recepción {{ Carbon::parse($teclado?->fecha)->translatedFormat('d \\d\\e F \\d\\e Y')}}, con Ref.: <input type="text" class="input text-uppercase" id="referencia" name="referencia" required>,
            que llego a nuestra Unidad en el que describe en su nota “<input class="input" type="text" name="desc_nota" id="desc_nota">”, el cual me remito a informar lo siguiente.
          </p>
        </div>
        <div id="antecedentesCustodioBaja">
          <p>
            En atención a la nota con CITE: <input type="text" class="input2" id="cite_antecedentes" name="cite_antecedentes" style="text-transform: uppercase;" required>, con Ref.: <input type="text" class="input text-uppercase" id="referencia" name="referencia" style="text-transform: uppercase;" required>, que llego a nuestra Unidad para la revisión en cual detalla en su nota 
            “<input class="input" type="text" name="desc_nota" id="desc_nota">”, por lo que me remito a informar lo siguiente.

          </p>
        </div>

        {{-- -----------DESARROLLO-------------}}
      <P>
      II. DESARROLLO.
      </P>
        <div id="desarrolloDevolucion">
            <p>
            Se procedió a la revisión técnica en general del equipo, el cual se detalla en la siguiente tabla comparativa.
            </p>
        </div>
        <div id="desarrolloReposicion">
            <p>
            Se procedió a la revisión técnica del teclado y su funcionabilidad, el cual se detalla en la siguiente tabla comparativa.
            </p>
        </div>
        <div id="desarrolloRepliegue">
            <p>
            Se procedió a la revisión técnica del activo teclado el cual se detalla en la siguiente tabla comparativa.
            </p>
        </div>
        <div id="desarrolloCustodioBaja">
            <p>
            Se procedió a la revisión técnica del activo debido que presenta <input type="text" class="input" id="falla_antecedentes" name="falla_antecedentes">, 
            por lo cual se detalla en la siguiente tabla comparativa.
            </p>
        </div>
        <P>Se tiene el siguiente diagnóstico:</p>

        <div class="fila-2">
            <div class=" title">
                <label for="" class="form-label">CARACTERISTICAS TÉCNICAS ACTUALES DEL ACTIVO</label>
                <textarea class="form-control" style="height: 300px" readonly name="datosactivo">
                MARCA: {{ old('marca', $teclado?->marca) }}
                MODELO: {{ old('modelo', $teclado?->modelo) }}
                </textarea>
            </div>
            <div class=" title">
                  <label for="caract_sicaf" class="form-label">CARACTERISTICAS DEL ACTIVO SEGUN SISTEMA SICAF</label>
                  <div class="editor2 " id="editor2" style="height:300px;"><textarea id="caract_sicaf" name="caract_sicaf" class="form-control" style="height: 300px"> </textarea></div>
            </div>
            <div class=" title">
                  <label for="desc_trabajo" class="form-label" id="desc_trabajoR">DESCRIPCIÓN DEL TRABAJO<br> REALIZADO</label>
                  
                  <div class="editor3" id="editor3" style="height:300px;"><textarea id="desc_trabajo" name="desc_trabajo" class="form-control" style="height: 300px"></textarea></div> 
                  <div id="caracteristicas">
                      <label for="tipo_informe" class="form-label">{{ __('CUMPLE CON LAS CARACTERISTICAS ?:') }}<span class="required">*</span></label>
                      <select name="cumplecaract" id="cumplecaracteristicas" class="form-control" required>
                          <option value="" {{ 'selected' }}>SELECCIONE OPCIÓN</option>
                          <option value="CUMPLE">CUMPLE</option>
                          <option value="NO CUMPLE">NO CUMPLE</option>
                      </select>
                  </div>
            </div>
        </div>
      <p>
      III. CONCLUSIÓN. 
      </p>
    <div id="conclusionDevolucion">
      <p>    
        Por todo lo detallado anteriormente se informa que el activo mencionado en la tabla comparativa con su respectivo código que ingreso
        a nuestra unidad por parte de <input class="input2" type="text" name="nombre_func" value="{{ old('grado_academico', $teclado?->funcionario->grado_academico)}} {{ old('nombre', $teclado?->funcionario->nombre) }}  {{ old('paterno', $teclado?->funcionario->paterno) }} {{ old('materno', $teclado?->funcionario->materno) }}" id="nombre_func" readonly>
        <input class="input3" type="text" name="cargo_func" value="{{ old('cargo', $teclado?->funcionario->cargo) }}" id="cargo_func" readonly>, 
        el cual llego con el detalle de "<input class="input2" type="text" id="detalle" name="detalle"></input>", donde se realizó la revisión y la reparación
        del mismo como se indica en el cuadro descriptivo, además de un mantenimiento preventivo y correctivo en general el teclado se encuentra en funcionamiento por
        lo cual se hace la DEVOLUCIÓN de dicho activo al custodio para su uso correspondiente.
      </p>
    </div>
    <div id="conclusionReposicion">
      <p>    
        La Unidad de Administración de Sistemas de Información informa que se verificó el teclado de reposición mencionado en la tabla comparativa y tiene características técnicas similares y/o superiores, además se encuentra en funcionamiento correcto y fue presentado en calidad de REPOSICIÓN 
          por parte de <input class="input2" type="text" name="nombre_func" value="{{ old('grado_academico', $teclado?->funcionario->grado_academico)}} {{ old('nombre', $teclado?->funcionario->nombre) }}  {{ old('paterno', $teclado?->funcionario->paterno) }} {{ old('materno', $teclado?->funcionario->materno) }}" id="nombre_func" readonly>
           con C.I. <input class="input3" type="text" name="ci" value="{{ old('cargo', $teclado?->funcionario->ci) }} {{ old('expedido', $teclado?->funcionario->expedido) }}" id="ci">, ( <input class="input3" type="text" name="cargo_func" value="{{ old('cargo', $teclado?->funcionario->cargo) }}" id="cargo_func" readonly>), como se puede observar en la tabla comparativa el teclado 
          presentado <input class="input3" type="text" id="cumpleTexto" readonly> con las características técnicas requeridas por la Unidad de Activos Fijos, por lo que se sugiere proseguir con el trámite administrativo correspondiente.
      </p>
      

        <script>
          document.getElementById('cumplecaracteristicas').addEventListener('change', function() {
            document.getElementById('cumpleTexto').value = this.options[this.selectedIndex].text;
          });
        </script>
    </div>
    <div id="conclusionRepliegue">
      <p>    
      Por todo lo detallado anteriormente se informa que el activo mencionado en la tabla comparativa con su respectivo código que ingreso a nuestra unidad para su REPLIEGUE O BAJA 
      por parte de <input class="input2" type="text" name="nombre_func" value="{{ old('grado_academico', $teclado?->funcionario->grado_academico)}} {{ old('nombre', $teclado?->funcionario->nombre) }}  {{ old('paterno', $teclado?->funcionario->paterno) }} {{ old('materno', $teclado?->funcionario->materno) }}" id="nombre_func" readonly> 
      ( <input class="input3" type="text" name="cargo_func" value="{{ old('cargo', $teclado?->funcionario->cargo) }}" id="cargo_func" readonly>), equipo se encuentra en funcionamiento correcto, por lo que se sugiere el REPLIEGUE de dicho equipo a la Unidad de Activos Fijos.
      </p>
    </div>
    <div id="conclusionCustodio">
      <p>    
      Por todo lo detallado anteriormente se informa que el activo mencionado en la tabla comparativa con su respectivo código que ingreso a nuestra unidad, 
      el cual llego con el detalle de “<input type="text" class="input" id="detalle" name="detalle">”, donde se realizó la revisión del activo y presenta <input type="text" class="input" id="falla_encontrada" name="falla_encontrada"> como se describe en dicha tabla, 
      por el momento la Unidad de Administración de Sistemas de Información no cuenta con las piezas o repuestos de reemplazo requerido para la reparación del mismo por lo que se sugiere que el responsable del activo lo tenga en CUSTODIO la impresora hasta que se tengan los repuestos o piezas de reemplazo requeridos.
      </p>
    </div>
    <div id="conclusionBaja">
      <p>    
        Por todo lo detallado anteriormente se informa que los activos mencionados en la tabla comparativa con sus respectivos códigos, que ingreso a nuestra unidad por parte del 
        <input class="input2" type="text" name="nombre_func" value="{{ old('grado_academico', $teclado?->funcionario->grado_academico)}} {{ old('nombre', $teclado?->funcionario->nombre) }}  {{ old('paterno', $teclado?->funcionario->paterno) }} {{ old('materno', $teclado?->funcionario->materno) }}" id="nombre_func" readonly> 
        ( <input class="input3" type="text" name="cargo_func" value="{{ old('cargo', $teclado?->cargo) }}" id="cargo_func" readonly>) los equipos presentan fallas en sus componentes interno como se describe en la tabla mencionada, por lo cual su reparación y el cambio o actualización de sus piezas implicaría el costo de uno nuevo, 
        razón por la cual la Unidad de administración de Sistemas de Información, sugiere la BAJA del activo debido a que ya cumplió con su tiempo de vida útil.
        <p>• En estricto cumplimiento a la disposición legal de la Norma Básica para la Administración de bienes y Servicios D.S. Nº 181, en donde el Sub Sistema disposición de bienes señala:
        <br>  • Que el art. 235 en el punto (causales), la baja de bienes procederá a las siguientes causales en sus incisos.
        </p>
        <p>e) Señala Inutilización<br>f) Señala “obsolescencia”</p>
      </p>
    </div>
    <p>
    Es cuanto se puede informar para fines consiguientes.
    </p>
        <input type="hidden" name="fecha_recepcion" class="form-control" value="{{ old('fecha', $teclado?->fecha) }}" id="fecha"> 
        <input type="hidden" name="cod_gamea" class="form-control" value="{{ old('cod_gamea', $teclado?->cod_gamea) }}" id="cod_gamea"> 
        <input type="hidden" class="form-control" id="activo" name="activo" value="teclado">
        <input type="hidden" class="form-control" id="valor" name="valor" value="el">
        <div>
        <button type="submit" class="btn btn-primary btn-block">GENERAR INFORME</button>
        </div>
    </div>