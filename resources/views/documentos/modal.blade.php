<div class="modal fade"
     id="modalDocumentos"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-fullscreen-md-down custom-modal-width">

        <div class="modal-content overflow-hidden border-0 rounded-2xl shadow-2xl">

            <!-- CONTENEDOR HORIZONTAL -->
            <div class="flex flex-col md:flex-row min-h-[500px]">


                <!-- ============================= -->
                <!-- PANEL IZQUIERDO INSTITUCIONAL -->
                <!-- ============================= -->

                <div class="w-full md:w-1/2
                            bg-gradient-to-br from-slate-800 via-sky-800 to-blue-900
                            text-white p-8 flex flex-col justify-between">

                    <aside class="hidden md:flex flex-col justify-center items-center
                                  bg-gradient-to-br from-slate-800 via-sky-800 to-blue-900
                                  text-white p-10 animate-slide-left">

                        <img
                            src="{{ asset('assets/assets/img/gamea.png') }}"
                            alt="Logo Gobierno Autónomo Municipal de El Alto"
                            class="w-32 mb-6"
                            style="height: 250px; object-fit: contain;"
                        >

                        <h2 class="text-xl font-bold text-center">

                            UNIDAD DE ADMINISTRACIÓN
                            DE SISTEMAS DE INFORMACIÓN

                        </h2>

                        <p class="text-sm text-center mt-2 text-white">

                            Área de Soporte Técnico

                        </p>

                        <p class="text-xs text-center mt-6 text-gray-200">

                            Documentos y modelos oficiales
                            para trámites de soporte técnico.

                        </p>


                        <!-- INFORMACIÓN -->

                        <div class="flex gap-3 mt-6">

                            <div class="bg-white/10 p-3 rounded-lg text-center">

                                <p class="text-2xl font-bold">

                                    {{ $documentos->count() }}

                                </p>

                                <p class="text-xs">

                                    Documentos

                                </p>

                            </div>

                            <div class="bg-white/10 p-3 rounded-lg text-center">

                                <i class="fas fa-file-download text-2xl"></i>

                                <p class="text-xs mt-1">

                                    Descarga

                                </p>

                            </div>

                        </div>

                    </aside>

                </div>



                <!-- ============================= -->
                <!-- PANEL DERECHO -->
                <!-- ============================= -->

                <div class="w-full md:w-1/2 bg-white p-8 flex flex-col">


                    <!-- TITULO -->

                    <header class="text-center mb-6">

                        <h1 class="text-2xl font-bold text-gray-800">

                            MODELOS DE CARTAS

                        </h1>

                        <p class="text-gray-600 text-sm">

                            Seleccione el documento que desea descargar

                        </p>

                    </header>



                    <!-- DOCUMENTOS -->

                    <div class="flex-1 overflow-y-auto">

                        @forelse($documentos as $documento)

                            <div class="flex items-center
                                        border border-gray-200
                                        rounded-xl
                                        p-4 mb-3
                                        hover:shadow-md
                                        transition-all duration-300">


                                <!-- ICONO -->

                                <div class="mr-4">

                                    @if($documento->tipo === 'application/pdf')

                                        <div class="w-12 h-12 rounded-lg
                                                    bg-red-100
                                                    flex items-center justify-center">

                                            <i class="fas fa-file-pdf
                                                      text-red-600 text-xl"></i>

                                        </div>

                                    @elseif(
                                        in_array(
                                            $documento->tipo,
                                            [
                                                'application/msword',
                                                'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                                            ]
                                        )
                                    )

                                        <div class="w-12 h-12 rounded-lg
                                                    bg-blue-100
                                                    flex items-center justify-center">

                                            <i class="fas fa-file-word
                                                      text-blue-600 text-xl"></i>

                                        </div>

                                    @else

                                        <div class="w-12 h-12 rounded-lg
                                                    bg-gray-100
                                                    flex items-center justify-center">

                                            <i class="fas fa-file
                                                      text-gray-600 text-xl"></i>

                                        </div>

                                    @endif

                                </div>



                                <!-- INFORMACIÓN -->

                                <div class="flex-1 min-w-0">

                                    <h3 class="font-semibold text-gray-800">

                                        {{ $documento->titulo }}

                                    </h3>

                                    <p class="text-xs text-gray-500 truncate">

                                        {{ $documento->nombre_original }}

                                    </p>

                                    <p class="text-xs text-gray-400 mt-1">

                                        {{ $documento->created_at->format('d/m/Y') }}

                                    </p>

                                </div>



                                <!-- DESCARGAR -->

                                <div class="ml-3">

                                    <a
                                        href="{{ route('documentos.descargar', $documento) }}"
                                        class="inline-flex items-center
                                               bg-gradient-to-r
                                               from-sky-700
                                               to-blue-800
                                               hover:from-sky-800
                                               hover:to-blue-900
                                               text-white
                                               px-4 py-2
                                               rounded-lg
                                               font-semibold
                                               text-sm
                                               shadow-md
                                               hover:shadow-lg
                                               transition-all duration-300"
                                    >

                                        <i class="fas fa-download mr-2"></i>

                                        DESCARGAR

                                    </a>

                                </div>

                            </div>

                        @empty

                            <!-- SIN DOCUMENTOS -->

                            <div class="text-center py-12">

                                <i class="fas fa-folder-open
                                          text-gray-300 text-5xl mb-4"></i>

                                <h3 class="text-gray-600 font-semibold">

                                    No hay documentos disponibles

                                </h3>

                                <p class="text-gray-400 text-sm mt-2">

                                    Actualmente no existen modelos de cartas
                                    registrados.

                                </p>

                            </div>

                        @endforelse

                    </div>



                    <!-- CERRAR -->

                    <div class="mt-6">

                        <button
                            type="button"
                            data-bs-dismiss="modal"
                            class="w-full
                                   bg-white
                                   border border-gray-300
                                   hover:bg-gray-100
                                   text-gray-700
                                   py-3
                                   rounded-lg
                                   font-semibold
                                   shadow-md
                                   transition-all duration-300"
                        >

                            <i class="bi bi-box-arrow-left me-2"></i>

                            CERRAR

                        </button>

                    </div>



                    <!-- FOOTER -->

                    <div class="mt-6 text-center
                                text-xs text-gray-500
                                border-t pt-4">

                        GAMEA | {{ date('Y') }} © S@mmy

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>