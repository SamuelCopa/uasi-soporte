<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar --}}
<div class="sidebar">

    {{-- =====================================================
         MENÚ DEL SIDEBAR
         ===================================================== --}}
    <div class="sidebar-menu-scroll">

        <nav class="pt-2">

            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview"
                role="menu"
                @if(config('adminlte.sidebar_nav_animation_speed') != 300)
                    data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}"
                @endif
                @if(!config('adminlte.sidebar_nav_accordion'))
                    data-accordion="false"
                @endif>

                @each(
                    'adminlte::partials.sidebar.menu-item',
                    $adminlte->menu('sidebar'),
                    'item'
                )

            </ul>

        </nav>

    </div>


    {{-- =====================================================
         USUARIO - SIEMPRE FIJO ABAJO
         ===================================================== --}}
    @if(Auth::check())

        <div class="sidebar-user-bottom">

            <button type="button"
                    class="sidebar-user-toggle"
                    onclick="toggleSidebarUser()">

                <div class="sidebar-user-avatar">
                    <i class="fas fa-user"></i>
                </div>

                    <div class="sidebar-user-data">

                        <div class="sidebar-user-name">
                            {{ Auth::user()->name }}
                            {{ Auth::user()->paterno }}
                            <!-- {{ Auth::user()->materno }} -->
                        </div>

                    <div class="usuario-info">
                        @if(Auth::user()->especialidad)
                            <div class="usuario-especialidad">
                                {{ Auth::user()->especialidad->nombre }}
                            </div>
                        @endif
                    </div>

                    </div>

                <i id="sidebar-user-arrow"
                   class="fas fa-chevron-up sidebar-user-arrow"></i>

            </button>


            {{-- OPCIONES --}}
            <div id="sidebar-user-options"
                 class="sidebar-user-options">

                <a href="{{ route('perfil') }}"
                   class="btn-footer">

                    <i class="fas fa-user-circle"></i>
                    <span>Mi perfil</span>

                </a>

                <form method="POST"
                      action="{{ route('logout') }}">

                    @csrf

                    <button type="submit"
                            class="btn-footer logout-btn">

                        <i class="fas fa-sign-out-alt"></i>
                        <span>Cerrar sesión</span>

                    </button>

                </form>

            </div>

        </div>

    @endif

</div>

</aside>
<style>
/* =====================================================
   SIDEBAR
   MENÚ CON SCROLL + USUARIO FIJO
   ===================================================== */

/* =====================================================
   SIDEBAR PRINCIPAL
   ===================================================== */
.usuario-info {
    line-height: 1.3;
}

.usuario-email {
    font-size: 13px;
    color: #d5dbe1;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.usuario-especialidad {
    font-size: 11px;
    color: #9da8b3;
    margin-top: 2px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.main-sidebar .sidebar {
    position: relative !important;

    height: calc(100vh - 57px) !important;
    min-height: calc(100vh - 57px) !important;

    padding: 0 !important;

    overflow: hidden !important;
}


/* =====================================================
   SOLO EL MENÚ TIENE SCROLL
   ===================================================== */

.main-sidebar .sidebar-menu-scroll {

    position: absolute;

    top: 0;
    left: 0;
    right: 0;
    bottom: 76px;

    overflow-y: auto !important;
    overflow-x: hidden !important;

    padding: 8px 10px 20px 10px;

    width: 100%;
}


/* =====================================================
   SCROLLBAR
   ===================================================== */

.main-sidebar .sidebar-menu-scroll::-webkit-scrollbar {
    width: 5px;
}

.main-sidebar .sidebar-menu-scroll::-webkit-scrollbar-track {
    background: transparent;
}

.main-sidebar .sidebar-menu-scroll::-webkit-scrollbar-thumb {
    background: rgba(255,255,255,.20);
    border-radius: 10px;
}

.main-sidebar .sidebar-menu-scroll::-webkit-scrollbar-thumb:hover {
    background: rgba(255,255,255,.35);
}

.main-sidebar .sidebar-menu-scroll {
    scrollbar-width: thin;
}


/* =====================================================
   USUARIO
   FIJO EN LA PARTE INFERIOR
   ===================================================== */

.main-sidebar .sidebar-user-bottom {

    position: absolute !important;

    left: 0;
    right: 0;
    bottom: 0;

    width: 100%;

    padding: 10px;

    border-top: 1px solid rgba(255,255,255,.15);

    background: #1e2a38;

    z-index: 2000 !important;
}


/* =====================================================
   BOTÓN USUARIO
   ===================================================== */

.sidebar-user-toggle {

    width: 100%;

    display: flex;

    align-items: center;

    border: none;

    background: transparent;

    color: #fff;

    padding: 7px;

    cursor: pointer;

    text-align: left;

    border-radius: 6px;

    transition: background .2s ease;
}

.sidebar-user-toggle:hover {
    background: rgba(255,255,255,.08);
}


/* =====================================================
   AVATAR
   ===================================================== */

.sidebar-user-avatar {

    width: 38px;
    height: 38px;

    min-width: 38px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: linear-gradient(
        135deg,
        #0052cc,
        #2684ff
    );

    color: #fff;

    font-size: 16px;
}


/* =====================================================
   DATOS DEL USUARIO
   ===================================================== */

.sidebar-user-data {

    margin-left: 10px;

    min-width: 0;

    flex: 1;
}

.sidebar-user-name {

    color: #fff;

    font-size: 13px;

    font-weight: 600;

    white-space: nowrap;

    overflow: hidden;

    text-overflow: ellipsis;
}

.sidebar-user-role {

    color: rgba(255,255,255,.60);

    font-size: 11px;

    white-space: nowrap;

    overflow: hidden;

    text-overflow: ellipsis;
}


/* =====================================================
   FLECHA
   ===================================================== */

.sidebar-user-arrow {

    font-size: 11px;

    color: rgba(255,255,255,.60);

    transition: transform .25s ease;
}


/* =====================================================
   OPCIONES
   ===================================================== */

.sidebar-user-options {

    display: none;

    margin-top: 7px;
}

.sidebar-user-options.show {
    display: block;
}


/* =====================================================
   BOTONES INFERIORES
   ===================================================== */

.btn-footer {

    width: 100%;

    display: flex;

    align-items: center;

    padding: 8px 10px;

    margin-top: 4px;

    border: none;

    border-radius: 5px;

    background: rgba(255,255,255,.05);

    color: rgba(255,255,255,.85);

    text-decoration: none;

    transition: all .2s ease;
}

.btn-footer i {

    width: 22px;

    margin-right: 8px;

    text-align: center;
}

.btn-footer:hover {

    background: rgba(255,255,255,.12);

    color: #fff;

    text-decoration: none;
}


/* =====================================================
   ICONOS
   ===================================================== */

.btn-footer .fa-user-circle {
    color: #80b3ff;
}

.btn-footer .fa-sign-out-alt {
    color: #ff8a8a;
}


/* =====================================================
   LOGOUT
   ===================================================== */

.logout-btn {

    cursor: pointer;

    font-family: inherit;

    font-size: inherit;

    text-align: left;
}
</style>

<script>

function toggleSidebarUser() {

    const options = document.getElementById('sidebar-user-options');
    const arrow = document.getElementById('sidebar-user-arrow');

    options.classList.toggle('show');

    if (options.classList.contains('show')) {

        arrow.style.transform = 'rotate(180deg)';

    } else {

        arrow.style.transform = 'rotate(0deg)';

    }
}

</script>
