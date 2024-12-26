'use strict';

const d = document;

d.addEventListener('DOMContentLoaded', function() {  
  const pagInicio = d.querySelector('#pag-inicio');
  const pagCategoria = d.querySelector('#pag-categorias');
  // const pagProducto = d.querySelector('#pag-producto');
  const pagComprar = d.querySelector('#pag-comprar');
  const pagComprobante = d.querySelector('#pag-comprobante')


   // Tabla formulario
   const tablaContacto = d.getElementById('tabla-contacto');
   const tablaDireccion = d.getElementById('tabla-direccion');

/*   function completarFormulario() {
    const formularioDatosPersonales = d.getElementById('formularioDatosPersonales')
    const datosPersonalesForm = d.getElementById('datosPersonalesForm');
    const formularioDatosPago = d.getElementById('formularioDatosPago');
    const volverBoton = document.querySelectorAll('.volver');

    volverBoton.forEach((boton) => {
      boton.addEventListener('click', function() {
        formularioDatosPago.style.display = 'none';
        formularioDatosPersonales.style.display = 'block';
        
        localStorage.setItem('formularioActual', 'datosPersonales');
      })
    })

    const formularioActual = localStorage.getItem('formularioActual');

    // Mostrar el formulario adecuado según el indicador guardado
    if (formularioActual === 'datosPago') {
        formularioDatosPersonales.style.display = 'none';
        formularioDatosPago.style.display = 'block';
    } else {
        formularioDatosPersonales.style.display = 'block';
        formularioDatosPago.style.display = 'none';
    }
    
    // Manejar el envío del formulario de datos personales
    datosPersonalesForm.addEventListener('submit', function(event) {
      event.preventDefault();
      // Campos del formulario de datos personales
      const email = d.getElementById('email').value;
      const ofertas = d.getElementById('ofertas').checked;
      const pais = d.getElementById('pais').value;
      const nombre = d.getElementById('nombre').value;
      const apellido = d.getElementById('apellido').value;
      const direccion = d.getElementById('direccion').value;
      const ciudad = d.getElementById('ciudad').value;
      const postal = d.getElementById('postal').value;
      const telefono = d.getElementById('telefono').value;

      // Almacenar los datos en el localStorage
      const datosPersonales = {
        email: email,
        ofertas: ofertas,
        pais: pais,
        nombre: nombre,
        apellido: apellido,
        direccion: direccion,
        ciudad: ciudad,
        postal: postal,
        telefono: telefono
      };
      localStorage.setItem('datosPersonales', JSON.stringify(datosPersonales));

      // Ocultar formulario de datos personales y mostrar el formulario de datos de pago
      formularioDatosPersonales.style.display = 'none';
      formularioDatosPago.style.display = 'block';
      localStorage.setItem('formularioActual', 'datosPago');
      window.scrollTo(0, 0);
    });

    mostrarTabla()

    // Manejar el envío del formulario de datos de pago
    const datosPagoForm = d.getElementById('datosPagoForm');

    datosPagoForm.addEventListener('submit', function(event) {
      event.preventDefault();

      d.getElementById('formularioDatosPersonales').style.display = 'block';
      d.getElementById('formularioDatosPago').style.display = 'none';
      localStorage.setItem('formularioActual', 'datosPersonales');
      // Redirigir a la página de comprobante
      window.location.href = 'comprobante.html'; 
    });
  }

  function mostrarTabla() {
    const datosGuardados = localStorage.getItem('datosPersonales')

    if (datosGuardados) {
      const datosPersonales = JSON.parse(datosGuardados);

      tablaContacto.textContent = datosPersonales.email
      tablaDireccion.textContent = `${datosPersonales.direccion}, ${datosPersonales.postal}`
    }
  }
  if (pagComprobante) {
    mostrarTabla()
    window.addEventListener('beforeunload', function() {
      carrito = { productosIds: [], cantidades: [], total: 0 };
      // Limpiar en localStorage
      localStorage.removeItem('carrito');
    });
  } */

  /* Mostrar banner publicitario */
    function bannerClickHandler() {
      const id = bannerVisible()
      let fotoId;
      switch (id) {
        case 'banner-squeaky-clean':
          fotoId = 10;
          break;
        case 'banner-hollowfication':
          fotoId = 22;
          break;
        default:
          fotoId = 30;
          break;
      }
      window.location.href = 'index.php?sec=detalle&id=' + fotoId;
    }

    function bannerVisible() {
      if (window.matchMedia('(max-width: 576px)').matches) {
        return 'banner-squeaky-clean'
      } else if (window.matchMedia('(max-width: 1024px)').matches) {
        return 'banner-hollowfication'
      } else {
        return 'banner-dead-cell'
      }
    }

    function mostrarBanner() {
      const myModal = new bootstrap.Modal(d.getElementById('modal-publicidad'));
      setTimeout(function() {
        myModal.show();
      }, 2000);

      setTimeout(function() {
        myModal.hide();
      }, 10000);
    }
  
  /* Scroll Nav */
  window.addEventListener('scroll', function() {    
    const navbar = document.querySelector('.navt');
    const dropdown = document.querySelector('#dropdown-menu');
    // const carritoDesplegable = document.querySelector('.carrito-section')

    // Obtener la posición actual de desplazamiento
    const scrollTop = window.scrollY || document.documentElement.scrollTop;

    // Altura del navbar
    // const navbarHeight = navbar.offsetHeight;
    const navbarHeight = 10; // Altura del navbar en píxeles

    // Condición para cambiar el color del navbar
    if (scrollTop > navbarHeight) {
      navbar.style.backgroundColor = '#dfdfdf';
      navbar.style.filter = 'invert(100%)';
      dropdown.style.background = '#none';
      dropdown.style.filter = 'invert(0%)';
      // carritoDesplegable.style.filter = 'invert(100%)'
    } else {
      navbar.style.filter = 'invert(0%)';
      navbar.style.background = 'none';
      dropdown.style.background = '#dfdfdf';
      dropdown.style.filter = 'invert(100%)';
      // carritoDesplegable.style.filter = 'invert(0%)'
    }
  });

  if (pagComprar) {
    completarFormulario()
  }
  if (pagCategoria) {
    banner.addEventListener('click', bannerClickHandler)
    mostrarBanner()
  }
});