<div class="modal fade" id="modalPuntuacion{{ $asignacion->id }}" abindex="-1" role="dialog" 
     aria-labelledby="modalPuntuacionLabel{{ $asignacion->id }}"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content modal-evaluacion">

            {{-- ENCABEZADO --}}
            <div class="modal-header modal-header-evaluacion">

                <div class="titulo-modal">
                    <div class="icono-evaluacion">
                        <i class="fas fa-star"></i>
                    </div>

                    <div>
                        <h5 class="modal-title"
                            id="modalPuntuacionLabel{{ $asignacion->id }}">
                            Evaluar atención
                        </h5>

                        <small>
                            Califique la atención recibida
                        </small>
                    </div>
                </div>

                <button type="button"
                        class="close btn-cerrar"
                        data-dismiss="modal"
                        aria-label="Cerrar">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>


            {{-- FORMULARIO --}}
            <form action="{{ route('asignacion.atender', $asignacion->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="modal-body modal-body-evaluacion">

                    {{-- DETALLE DE LA ASISTENCIA --}}
                    <div class="campo-asistencia">

                        <label for="servicio{{ $asignacion->id }}"
                               class="label-evaluacion">

                            <i class="fas fa-tools"></i>
                            Breve detalle de la asistencia técnica

                        </label>

                        <textarea
                            name="servicio"
                            id="servicio{{ $asignacion->id }}"
                            placeholder="Describa brevemente el trabajo realizado..."
                            required
                            class="textarea-evaluacion"></textarea>

                        <small class="ayuda-texto">
                            Indique brevemente qué trabajo fue realizado.
                        </small>

                    </div>


                    {{-- PUNTUACIÓN --}}
                    <div class="seccion-puntuacion">

                        <h6 class="titulo-puntuacion">

                            <i class="fas fa-comment-alt"></i>

                            ¿Cómo califica la atención recibida?

                        </h6>

                        <p class="subtitulo-puntuacion">
                            Seleccione una de las siguientes opciones
                        </p>


                        <div class="emojis">

                            {{-- 1 --}}
                            <input type="radio"
                                   name="puntuacion"
                                   id="emoji1-{{ $asignacion->id }}"
                                   value="1"
                                   required>

                            <label for="emoji1-{{ $asignacion->id }}"
                                   class="emoji-card">

                                <span>😡</span>
                                <strong>Muy malo</strong>

                            </label>


                            {{-- 2 --}}
                            <input type="radio"
                                   name="puntuacion"
                                   id="emoji2-{{ $asignacion->id }}"
                                   value="2">

                            <label for="emoji2-{{ $asignacion->id }}"
                                   class="emoji-card">

                                <span>😞</span>
                                <strong>Malo</strong>

                            </label>


                            {{-- 3 --}}
                            <input type="radio"
                                   name="puntuacion"
                                   id="emoji3-{{ $asignacion->id }}"
                                   value="3">

                            <label for="emoji3-{{ $asignacion->id }}"
                                   class="emoji-card">

                                <span>😐</span>
                                <strong>Regular</strong>

                            </label>


                            {{-- 4 --}}
                            <input type="radio"
                                   name="puntuacion"
                                   id="emoji4-{{ $asignacion->id }}"
                                   value="4">

                            <label for="emoji4-{{ $asignacion->id }}"
                                   class="emoji-card">

                                <span>🙂</span>
                                <strong>Bueno</strong>

                            </label>


                            {{-- 5 --}}
                            <input type="radio"
                                   name="puntuacion"
                                   id="emoji5-{{ $asignacion->id }}"
                                   value="5">

                            <label for="emoji5-{{ $asignacion->id }}"
                                   class="emoji-card">

                                <span>😄</span>
                                <strong>Excelente</strong>

                            </label>

                        </div>


                        {{-- MENSAJE --}}
                        <div id="mensajePuntuacion{{ $asignacion->id }}"
                             class="mensaje-puntuacion">

                            <i class="fas fa-hand-pointer"></i>

                            Seleccione una carita para evaluar la atención

                        </div>

                    </div>

                </div>


                {{-- FOOTER --}}
                <div class="modal-footer footer-evaluacion">

                    <button type="button"
                            class="btn btn-cancelar"
                            data-dismiss="modal">

                        <i class="fas fa-times"></i>

                        Cancelar

                    </button>

                    <button type="submit"
                            class="btn btn-confirmar">

                        <i class="fas fa-check-circle"></i>

                        Confirmar atención

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

