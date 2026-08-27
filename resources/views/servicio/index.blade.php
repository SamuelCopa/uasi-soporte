@extends('layouts.app')

@section('template_title')
    Servicios
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-header card-header--custom">
                </div>
                    <div class="header-panel">
                        <div class="header-left">
                            <h1 class="header-title">Requerimientos de Servicios</h1>
                        </div>
                    </div>

                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="table-responsive">
                            <table id="mitabla" class="table table-modern align-middle">
                                <thead>
                                    <tr>
                                    <th>No</th>                                        
									<th >Fecha</th>
									<th >Nombre</th>
									<th >ci</th>
									<th >Dependencia</th>
									<th >Equipo</th>
									<th >Falla</th>
									<th >Tipo de Servicio</th>
									<th >tecnico</th>
                                    <th >FECHA DE ASIGNACIÓN</th>
                                    <th >FECHA DE ATENCION</th>
									<th >Estado</th>
									<th >Puntaje</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($servicios as $servicio)
                                        <tr>
                                        <td>{{ ++$i }}</td>                                            
										<td >{{date('d-m-Y H:i',strtotime($servicio->created_at ?? ''))}}</td>
                                         <td >{{ $servicio->funcionario?->nombre }} {{ $servicio->funcionario?->paterno }} {{ $servicio->funcionario?->materno }}</td>
                                         <td >{{ $servicio->funcionario?->ci }}</td>
										<td >{{ $servicio->Dependencia?->dependencias }}</td>
										<td >{{ $servicio->equipo ?? '' }}</td>
										<td >{{ $servicio->falla ?? '' }}</td>
										<td >{{ $servicio->servicio ?? '' }}</td>
                                        <td class="{{ empty($servicio->user_id) ? 'color1' : '' }}">
                                            @if($servicio->user_id)
                                            {{ $servicio->user->name ?? ''}} {{ $servicio->user->paterno}} {{ $servicio->user->materno}}
                                            @elseif(! $servicio->user_id)	
                                            <button type="button" class="btn btn-sm btn-outline-light" data-toggle="modal" data-target="#eTecnico{{ $servicio->id }}">{{ __('ASIGNAR TECNICO') }}</button>
                                            @endif
                                        </td>
                                        <td class="{{ empty($servicio->fecha_asignacion) ? 'color1' : '' }}"  align="center">
                                                @if($servicio->fecha_asignacion)
                                                {{ date('d-m-Y H:i',strtotime($servicio->fecha_asignacion ))}}
                                                @elseif(! $servicio->fecha_asignacion)	
                                                <button type="button" class="btn btn-sm btn-outline-light" onclick="Swal.fire({ title: 'Error', text: 'DEBES ASIGNAR UN TECNICO', icon: 'error', confirmButtonText: 'ACEPTAR' });">{{ __('FECHA DE ASIGNACIÓN') }}</button>
                                                @endif	
                                        </td>
                                        <td class="{{ empty($servicio->fecha_atencion) ? 'color1' : '' }}"  align="center">
                                                @if($servicio->fecha_atencion)
                                                {{ date('d-m-Y H:i',strtotime($servicio->fecha_atencion ))}}
                                                @elseif(! $servicio->fecha_atencion)	
                                                <button type="button" class="btn btn-sm btn-outline-light" >{{ __('FECHA DE ATENCIÓN') }}</button>
                                                @endif	
                                        </td>
                                        <td>
                                            @if(!empty($servicio->user_id))
                                                <button
                                                    class="btn btn-visto {{ $servicio->visto ? 'btn-primary' : 'btn-danger' }}"
                                                    data-id="{{ $servicio->id }}">
                                                    {{ $servicio->visto ? 'ATENDIDO' : 'PENDIENTE' }}
                                                </button>
                                            @elseif(empty($servicio->user_id))
                                                <button type="submit" class="btn btn-danger btn-raised" onclick="Swal.fire({ title: 'Error', text: 'DEBES ASIGNAR UN TECNICO', icon: 'error', confirmButtonText: 'ACEPTAR' });">PENDIENTE</button>
                                            @endif
                                        </td>
                                                                                <td class="text-center">
                                            @switch($servicio->puntuacion)

                                                @case(1)
                                                    <span class="evaluacion">
                                                        <span class="emoji">😡</span>
                                                        <span>Muy malo</span>
                                                    </span>
                                                    @break

                                                @case(2)
                                                    <span class="evaluacion">
                                                        <span class="emoji">😞</span>
                                                        <span>Malo</span>
                                                    </span>
                                                    @break

                                                @case(3)
                                                    <span class="evaluacion">
                                                        <span class="emoji">😐</span>
                                                        <span>Regular</span>
                                                    </span>
                                                    @break

                                                @case(4)
                                                    <span class="evaluacion">
                                                        <span class="emoji">🙂</span>
                                                        <span>Bueno</span>
                                                    </span>
                                                    @break

                                                @case(5)
                                                    <span class="evaluacion">
                                                        <span class="emoji">😄</span>
                                                        <span>Excelente</span>
                                                    </span>
                                                    @break

                                                @default
                                                    <span class="text-muted">Sin evaluar</span>

                                            @endswitch

                                        </td>	
                                        </tr>
                                        @include('servicio.registroTecnico')
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                    <th>No</th>                                        
									<th >Fecha</th>
									<th >Nombre</th>
									<th >ci</th>
									<th >Dependencia</th>
									<th >Equipo</th>
									<th >Falla</th>
									<th >Tipo de Servicio</th>
									<th >tecnico</th>
                                    <th >FECHA DE ASIGNACIÓN</th>
                                    <th >FECHA DE ATENCION</th>
									<th >Estado</th>
									<th >Puntaje</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $servicios->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
$(document).on('click', '.btn-visto', function () {

    let boton = $(this);

    // Verificar el estado actual del botón
    let atendido = boton.hasClass('btn-primary');

    let titulo = atendido
        ? '¿Marcar como pendiente?'
        : '¿Marcar como atendido?';

    let texto = atendido
        ? 'La solicitud volverá al estado pendiente.'
        : 'La solicitud será marcada como atendida.';

    Swal.fire({
        title: titulo,
        text: texto,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Sí, continuar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33'
    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({

                url: "{{ route('servicio.marcarVisto') }}",
                type: "POST",

                data: {
                    _token: "{{ csrf_token() }}",
                    id: boton.data("id")
                },

                success: function (respuesta) {

                    if (respuesta.visto == 1) {

                        boton.removeClass("btn-danger")
                             .addClass("btn-primary")
                             .text("ATENDIDO");

                    } else {

                        boton.removeClass("btn-primary")
                             .addClass("btn-danger")
                             .text("PENDIENTE");

                    }

                    Swal.fire({
                        icon: 'success',
                        title: 'Actualizado',
                        text: 'La solicitud fue actualizada correctamente.',
                        timer: 2500,
                        showConfirmButton: false
                    });

                }

            });

        }

    });

});
</script>

@stop