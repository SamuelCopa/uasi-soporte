<!-- ventana para Update -->
<div class="modal fade" id="eTecnico{{ $monitor->id }}" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

            <div class="modal-header bg-primary text-white border-0 py-3">

                <h4>
                    ASIGNAR
                    <span class="ml-2">
                        - {{ $monitor->tipoEquipo?->nombre ?? 'EQUIPO' }}
                    </span>
                </h4>

                <button type="button"
                        class="btn-close bg-primary"
                        data-dismiss="modal"
                        aria-label="Cerrar">
                    <i class="fas fa-times"></i>
                </button>

            </div>

            <section class="content container-fluid">

                <div class="col-md-12">

                    <div class="card">

                        <form method="POST"
                              action="{{ route('equipo.tecnico', ['id' => $monitor->id]) }}"
                              role="form">

                            @method('PATCH')
                            @csrf

                            {{-- TIPO DE EQUIPO --}}
                            <div class="div title mb-3">

                                <label class="form-label">
                                    TIPO DE EQUIPO
                                </label>

                                <input type="text"
                                       class="form-control"
                                       value="{{ $monitor->tipoEquipo?->nombre ?? 'NO DEFINIDO' }}"
                                       readonly>

                            </div>

                            {{-- TÉCNICO --}}
                            <div class="div title">

                                <label for="user_id{{ $monitor->id }}"
                                       class="form-label">
                                    ASIGNAR TECNICO
                                </label>

                                <select name="user_id"
                                        id="user_id{{ $monitor->id }}"
                                        class="form-control @error('user_id') is-invalid @enderror"
                                        required>

                                    <option value="" disabled selected>
                                        SELECCIONE UN TECNICO
                                    </option>

                                    @foreach($users as $user)

                                        <option value="{{ $user->id }}">
                                            {{ $user->name }}
                                            {{ $user->paterno }}
                                            {{ $user->materno }}
                                        </option>

                                    @endforeach

                                </select>

                                @error('user_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- FECHA --}}
                            <input type="hidden"
                                   name="fecha_asignacion"
                                   value="{{ date('Y-m-d\TH:i:s') }}">

                            <div class="modal-footer">

                                <button type="submit"
                                        class="btn btn-primary rounded-pill px-4 shadow-sm">
                                    <i class="fas fa-save"></i>
                                    GUARDAR
                                </button>

                                <button type="button"
                                        class="btn btn-danger rounded-pill px-4 shadow-sm"
                                        data-dismiss="modal">
                                    <i class="fas fa-times"></i>
                                    CANCELAR
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </section>

        </div>

    </div>

</div>