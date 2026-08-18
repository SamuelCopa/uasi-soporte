<!--ventana para Update--->
<div class="modal fade" id="eTecnico{{ $teclado->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
        <div class="modal-header modal-header bg-primary text-white border-0 py-3">
            <h4>ASIGNAR</h4>
        <button type="button" class="btn-close bg-primary" data-dismiss="modal" aria-label="Cerrar"><i class="fas fa-times"></i></button>
        </div>
        <section class="content container-fluid">
        <div class="">
            <div class="">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card">
                            <form method="POST" action="{{ route('teclado.tecnico',['id'=>$teclado->id]) }}" role="form" enctype="multipart/form-data">
                                {{ method_field('PATCH') }}
                                @csrf
                                <div class="div title">
                                    <label for="user_id" class="form-label">ASIGNAR TECNICO</label>
                                    <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror " title="Selecciona un tecnico" required>
                                        <option value="" disabled {{ 'selected' }}>SELECCIONE UN TECNICO </option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">
                                            {{ $user->name }} {{ $user->paterno }} {{ $user->materno }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                    <input type="hidden" name="fecha_asignacion" class="form-control @error('fecha_asignacion') is-invalid @enderror" value="{{ old('fecha_hora', date('Y-m-d\TH:i:s')) }}" id="fecha_asignacion" readonly>
                                    @error('fecha_asignacion')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">GUARDAR</button>
                                <button type="button" class="btn btn-danger rounded-pill px-4 shadow-sm" data-dismiss="modal">CANCELAR</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
<!---fin ventana Update --->