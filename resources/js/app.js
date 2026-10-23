//// Funciones de Loading
function mostrarCargando(mensaje = "Cargando . . .") {
    const mensajeCargando = document.getElementById("mensajeCargando");
    if (mensajeCargando) mensajeCargando.textContent = mensaje;
    const elementoAnimacionCargando = document.querySelector("#elemento-animacioncargando");
    if (elementoAnimacionCargando) elementoAnimacionCargando.classList.remove("hidden");
    document.body.style.overflow = 'hidden';
}

function ocultarCargando() {
    const elementoAnimacionCargando = document.querySelector("#elemento-animacioncargando");
    if (elementoAnimacionCargando) elementoAnimacionCargando.classList.add("hidden");
    document.body.style.overflow = '';
}

window.addEventListener("load", () => ocultarCargando());

// Listeners globales para animación cargando
document.addEventListener("DOMContentLoaded", () => {
    const listaLinksDocumento = document.querySelectorAll('a[href*="/"]:not([target="_blank"]):not([href*="#"]):not([data-target="noBlank"]), button:not([data-target="noBlank"])');
    if (listaLinksDocumento) {
        listaLinksDocumento.forEach(link => link.addEventListener('click', () => mostrarCargando()));
    }
    const listaFormsDocumento = document.querySelectorAll("form");
    if (listaFormsDocumento) {
        listaFormsDocumento.forEach(form => form.addEventListener('submit', (e) => {
            if (e.defaultPrevented) {
                ocultarCargando();
                return;
            }
            mostrarCargando();
        }));
    }
});

// Lógica para el carrusel de swiper
document.addEventListener('DOMContentLoaded', function () {
    if (typeof Swiper === 'undefined') {
        return;
    }

    const carruseles = document.querySelectorAll('.swiper');
    carruseles.forEach((carrusel) => {
        const contenedorCarrusel = carrusel.querySelector('.swiper-wrapper');
        const itemsCarrusel = contenedorCarrusel ? contenedorCarrusel.querySelectorAll('.swiper-slide ') : [];
        let slidesPerViewValue = 1;
        let xxl = 1;
        let xl = 1;
        let lg = 1;
        let md = 1;
        let sm = 1;
        let xs = 1;
        let xxs = 1;
        let spaceBetweenValue = 20;
        let spaceBetweenValueXxl = 30;
        let spaceBetweenValueXl = 30;
        let spaceBetweenValueLg = 30;
        let spaceBetweenValueMd = 30;
        let spaceBetweenValueSm = 20;
        let spaceBetweenValueXs = 20;
        let spaceBetweenValueXxs = 20;
        let loopValue = true;
        let delayValue = 3000;
        let disableOnInteractionValue = false;
        let swiperPagination = ".swiperPagination";
        let nextElValue = '.swiperNext';
        let prevElValue = '.swiperPrev';
        let centeredSlidesValue = false;
        let effect = "auto";

        if (itemsCarrusel.length > 1) {
            loopValue = true;
        } else {
            loopValue = false;
        }

        if (carrusel.classList.contains('carruselPrincipal')) {
            nextElValue = ".nextPrincipal";
            prevElValue = ".prevPrincipal";
            swiperPagination = ".paginationPrincipal";
        }

        if (carrusel.classList.contains('carruselMarcoPrincipal') || carrusel.classList.contains('carruselMarcoMiniatura')) {
            return;
        }

        if (carrusel.classList.contains('swiperCuadros')) {
            slidesPerViewValue = 2;
            xxl = 2;
            xl = 2;
            lg = 2;
            md = 2;
            sm = 2;
            xs = 2;
            xxs = 2;
            spaceBetweenValue = 16;
            spaceBetweenValueXxl = 16;
            spaceBetweenValueXl = 16;
            spaceBetweenValueLg = 16;
            spaceBetweenValueMd = 16;
            spaceBetweenValueSm = 16;
            spaceBetweenValueXs = 16;
            spaceBetweenValueXxs = 16;
            centeredSlidesValue = true;
        }

        if (carrusel.classList.contains("carruselTarjetas")) {
            effect = "cards";
            slidesPerViewValue = 1;
            xxl = 1;
            xl = 1;
            lg = 1;
            md = 1;
            sm = 1;
            xs = 1;
            xxs = 1;
            swiperPagination = ".dotTarjetas";
            spaceBetweenValue = 0;
            spaceBetweenValueXxl = 0;
            spaceBetweenValueXl = 0;
            spaceBetweenValueLg = 0;
            spaceBetweenValueMd = 0;
            spaceBetweenValueSm = 0;
            spaceBetweenValueXs = 0;
            spaceBetweenValueXxs = 0;
            loopValue = false;
            delayValue = 50000;
        }

        if (itemsCarrusel.length > 0) {
            new Swiper(carrusel, {
                effect: effect,
                grabCursor: true,
                slidesPerView: slidesPerViewValue,
                spaceBetween: spaceBetweenValue,
                loop: loopValue,
                centeredSlides: centeredSlidesValue,
                autoplay: {
                    delay: delayValue,
                    disableOnInteraction: disableOnInteractionValue,
                },
                pagination: {
                    el: swiperPagination,
                    clickable: true,
                },
                navigation: {
                    nextEl: nextElValue,
                    prevEl: prevElValue,
                },
                breakpoints: {
                    1536: {
                        slidesPerView: xxl,
                        spaceBetween: spaceBetweenValueXxl,
                    },
                    1280: {
                        slidesPerView: xl,
                        spaceBetween: spaceBetweenValueXl,
                    },
                    1024: {
                        slidesPerView: lg,
                        spaceBetween: spaceBetweenValueLg,
                    },
                    768: {
                        slidesPerView: md,
                        spaceBetween: spaceBetweenValueMd,
                    },
                    640: {
                        slidesPerView: sm,
                        spaceBetween: spaceBetweenValueSm,
                    },
                    520: {
                        slidesPerView: xs,
                        spaceBetween: spaceBetweenValueXs,
                    },
                    390: {
                        slidesPerView: xxs,
                        spaceBetween: spaceBetweenValueXxs,
                    },
                },
            });
        }
    });

    // Instalaciones: thumbs + principal
    const thumbsEl = document.querySelector('.carruselMarcoMiniatura');
    const principalEl = document.querySelector('.carruselMarcoPrincipal');
    if (thumbsEl && principalEl) {
        const swiperThumbs = new Swiper(thumbsEl, {
            spaceBetween: 16,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesProgress: true,
        });
        new Swiper(principalEl, {
            spaceBetween: 0,
            loop: true,
            effect: 'fade',
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.instalacionesPaginacion',
                clickable: true,
            },
            navigation: {
                nextEl: '.prevInstalaciones',
                prevEl: '.nextInstalaciones',
            },
            thumbs: {
                swiper: swiperThumbs,
            },
        });
    }
});

// Mensaje flotante sobre
function verMensajeUno() {
    const verMensaje = document.getElementById("verMensaje");
    if (verMensaje) {
        verMensaje.classList.remove("hidden");
        verMensaje.classList.add("block");
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const verMensaje = document.getElementById("verMensaje");
    if (verMensaje) {
        setTimeout(() => {
            verMensajeUno();
        }, 5000);
    }
});

// Mostrar/Ocultar contraseña
function mostarOcultarContraseña(elemento) {
    const contenedor = elemento.closest('.inputContraseña') || elemento.closest('.relative');
    if (!contenedor) return;

    const input = contenedor.querySelector('input');
    const iconShow = contenedor.querySelector('.iconShowPassword');
    const iconHidden = contenedor.querySelector('.iconHiddenPassword');

    if (!input) return;

    if (input.type === 'password') {
        input.type = 'text';
        if (iconShow) iconShow.classList.add('hidden');
        if (iconHidden) iconHidden.classList.remove('hidden');
    } else {
        input.type = 'password';
        if (iconShow) iconShow.classList.remove('hidden');
        if (iconHidden) iconHidden.classList.add('hidden');
    }
}

// Modal Editar Familia
function AbrirModalEditarFamilia(familia) {
    const EditarFamilia = document.getElementById('ModalEditarFamilia');
    const contenidoEditarFamilia = document.getElementById('contenidoEditarFamilia');
    const formModal = document.getElementById('formModalEditarFamilia');

    if (!EditarFamilia || !contenidoEditarFamilia) return;

    if (formModal && familia.id) {
        formModal.action = '/dashboard/editar-familia/' + familia.id;
    }

    // 1. Asignar datos principales
    const inputId = document.getElementById('edit_Id');
    if (inputId) inputId.value = familia.id || '';

    const inputFamilia = document.getElementById('familia');
    if (inputFamilia) inputFamilia.value = familia.nombre_familia || familia.nombreFamilia || '';

    const inputUsername = document.getElementById('edit_Username');
    if (inputUsername) inputUsername.value = familia.username || familia.Username || '';

    const inputPass = document.getElementById('contrasenaFamilia');
    if (inputPass) inputPass.value = '';

    const inputBoletos = document.getElementById('boletos');
    if (inputBoletos) inputBoletos.value = familia.cantidad_boletos ?? familia.cantidadBoletos ?? 2;

    const inputCabana = document.getElementById('invitadoCabana');
    if (inputCabana) inputCabana.value = (familia.opcion_cabana ?? familia.opcionCabana) ? "1" : "0";

    const inputFecha = document.getElementById('editFechaLimite');
    if (inputFecha) {
        let fecha = familia.fecha_limite || familia.fechaLimite || '';
        if (typeof fecha === 'string' && fecha.includes('T')) {
            fecha = fecha.split('T')[0];
        }
        inputFecha.value = fecha;
    }

    // 2. Renderizar inputs de invitados dinámicamente
    const contenedor = document.getElementById('contenedorInvitadosModal');
    if (contenedor) {
        contenedor.innerHTML = '';
        const invitados = familia.invitados || familia.Invitados || [];

        invitados.forEach((invitado, index) => {
            const div = document.createElement('div');
            div.className = 'flex flex-col gap-1';

            div.innerHTML = `
                <label class="label">Boleto ${index + 1}</label>
                <input type="hidden" name="invitados[${index}][id]" value="${invitado.id || invitado.Id || ''}" />
                <input type="text" 
                       name="invitados[${index}][nombre_completo]" 
                       value="${invitado.nombre_completo || invitado.nombreCompleto || ''}" 
                       class="input" 
                       placeholder="Nombre del invitado" />
            `;

            contenedor.appendChild(div);
        });
    }

    // 3. Animación de apertura
    EditarFamilia.classList.remove('hidden');

    setTimeout(() => {
        contenidoEditarFamilia.classList.remove('translate-y-[100vh]');
    }, 50);

    EditarFamilia.addEventListener('click', cerrarEditarFamiliaFuera);
}

function cerrarEditarFamilia() {
    const EditarFamilia = document.getElementById('ModalEditarFamilia');
    const contenidoEditarFamilia = document.getElementById('contenidoEditarFamilia');

    if (!contenidoEditarFamilia || !EditarFamilia) return;

    contenidoEditarFamilia.classList.add('translate-y-[100vh]');

    setTimeout(() => {
        EditarFamilia.classList.add('hidden');
        EditarFamilia.removeEventListener('click', cerrarEditarFamiliaFuera);
    }, 300);
}

function cerrarEditarFamiliaFuera(e) {
    const contenidoEditarFamilia = document.getElementById('contenidoEditarFamilia');
    if (contenidoEditarFamilia && !contenidoEditarFamilia.contains(e.target)) {
        cerrarEditarFamilia();
    }
}

function confirmarEliminarFamilia() {
    const idFamilia = document.getElementById('edit_Id')?.value;
    const nombreFamilia = document.getElementById('familia')?.value || 'esta familia';

    if (!idFamilia) return;

    if (confirm(`¿Estás seguro de que deseas eliminar a la familia "${nombreFamilia}"? Esta acción borrará también todos sus boletos asignados.`)) {
        mostrarCargando();
        const form = document.getElementById('formEliminarFamilia');
        const deleteId = document.getElementById('delete_Id');
        if (deleteId) deleteId.value = idFamilia;
        if (form) form.submit();
    } else {
        ocultarCargando();
    }
}

// Menú móvil
function abrirMenuMovil() {
    const menuMovil = document.getElementById('menuMovil');
    const ctnMenuMovil = document.getElementById('ctnMenuMovil');
    if (!menuMovil || !ctnMenuMovil) return;

    menuMovil.classList.remove('hidden');

    setTimeout(() => {
        ctnMenuMovil.classList.remove('-translate-x-[500px]');
    }, 10);

    menuMovil.addEventListener('click', cerrarMenuMovilFuera);
}

function cerrarMenuMovil() {
    const menuMovil = document.getElementById('menuMovil');
    const ctnMenuMovil = document.getElementById('ctnMenuMovil');
    if (!menuMovil || !ctnMenuMovil) return;

    ctnMenuMovil.classList.add('-translate-x-[500px]');

    setTimeout(() => {
        menuMovil.classList.add('hidden');
        menuMovil.removeEventListener('click', cerrarMenuMovilFuera);
    }, 300);
}

function cerrarMenuMovilFuera(e) {
    const ctnMenuMovil = document.getElementById('ctnMenuMovil');
    if (ctnMenuMovil && !ctnMenuMovil.contains(e.target)) {
        cerrarMenuMovil();
    }
}

// Animación sobre invitación (tarjeta emergiendo de abajo hacia arriba)
function animarSobreInvitacion() {
    const sobre = document.getElementById('imgSobreInvitacion');
    if (sobre && !sobre.classList.contains('translate-y-0')) {
        setTimeout(() => {
            sobre.classList.remove('sm:translate-y-40', 'translate-y-[27vw]');
            sobre.classList.add('translate-y-0');
        }, 300);
    }
}

document.addEventListener('DOMContentLoaded', () => {
    animarSobreInvitacion();
});

// ==========================================
// Exposición de funciones a nivel global (window)
// REQUERIDO para módulos Vite + handlers inline (onclick, onsubmit)
// ==========================================
window.mostrarCargando = mostrarCargando;
window.ocultarCargando = ocultarCargando;
window.mostarOcultarContraseña = mostarOcultarContraseña;
window.AbrirModalEditarFamilia = AbrirModalEditarFamilia;
window.cerrarEditarFamilia = cerrarEditarFamilia;
window.cerrarEditarFamiliaFuera = cerrarEditarFamiliaFuera;
window.confirmarEliminarFamilia = confirmarEliminarFamilia;
window.abrirMenuMovil = abrirMenuMovil;
window.cerrarMenuMovil = cerrarMenuMovil;
window.cerrarMenuMovilFuera = cerrarMenuMovilFuera;
window.verMensajeUno = verMensajeUno;
window.animarSobreInvitacion = animarSobreInvitacion;
