'use strict';
/* PANADERO LUCAS DWT2AP TP2 - Ecommerce */
const d = document;

  // Obtener la cadena JSON del localStorage
  const productosJSON = localStorage.getItem('productos');

  // Convertir la cadena JSON a un array de objetos
  const productos = JSON.parse(productosJSON);

  // Cargar los datos del archivo JSON utilizando fetch
  fetch('productos.json')
    .then(response => response.json())
    .then(data => {
      // Guardar los datos en localStorage
      localStorage.setItem('productos', JSON.stringify(data));
      // Buscar el producto con el id correspondiente
      const producto = data.find(item => item.id === parseInt(productId));
      if(pagProducto) {
        if (producto) {
          vaciarProductoId()
          mostrarProductoId(producto);
        } else {
          console.error('Producto no encontrado');
        }
      }
    })
    .catch(error => console.error('Error al cargar los datos:', error));

d.addEventListener('DOMContentLoaded', function() {  
  // HTML
  const pagInicio = d.querySelector('#pag-inicio');
  const pagCategoria = d.querySelector('#pag-categorias');
  const pagProducto = d.querySelector('#pag-producto');
  const pagComprar = d.querySelector('#pag-comprar');
  const pagComprobante = d.querySelector('#pag-comprobante')
  const products = d.querySelector('#productos');
  const listaCarrito = d.getElementById('lista-carrito');
  const categoriaTitulo = d.getElementById('tit-categoria');
  const cantidadesElement = d.querySelectorAll('.cantidades-carrito');
  const totalElement = d.getElementById('total-carrito');
  const botonCompra = d.getElementById('botonCompra');
  const reset = d.querySelector('#reset');
  const banner = d.getElementById('banner');
  const urlParams = new URLSearchParams(window.location.search);
  const categoriaSelect = urlParams.get('cat');
  // Producto detalle
  const productId = urlParams.get('id');
  const figureProducto = d.getElementById('galeria-productos');
  const ulProducto = d.getElementById('indicador-productos');
  const infoProducto = d.getElementById('infoProducto')
  const nombreProducto = d.getElementById('nombre-producto');
  const categoriaProducto = d.getElementById('cat-producto');
  const subtituloProducto = d.getElementById('subtitulo-producto');
  const descripcionProducto = d.getElementById('descripcion-producto');
  const precioProducto = d.getElementById('precio-producto');
  const botonAgregar = d.getElementById('boton-agregar');

  // Tabla formulario
  const tablaContacto = d.getElementById('tabla-contacto');
  const tablaDireccion = d.getElementById('tabla-direccion');
  let carrito = JSON.parse(localStorage.getItem('carrito')) || { productosIds: [], cantidades: [], total: 0 };

  /* Guardar carrito en localStorage */
  const guardarCarritoLocalStorage = () => {
    localStorage.setItem('carrito', JSON.stringify(carrito));
  }

  /* Crear elemento producto */
  function crearProductosCards(producto) {
    const card = d.createElement('article');
    card.classList.add('card');

    const anchor = d.createElement('a');
    anchor.href = `producto.html?id=${producto.id}`;

    const figura = d.createElement('figure');
    const imagen = d.createElement('img');
    imagen.src = producto.imagen;
    imagen.alt = producto.titulo;
    figura.appendChild(imagen);
    anchor.appendChild(figura);

    const titulo = d.createElement('h3');
    titulo.textContent = producto.titulo;
    anchor.appendChild(titulo);

    const descripcion = d.createElement('p');
    descripcion.textContent = producto.subtitulo;
    anchor.appendChild(descripcion);

    const precio = d.createElement('p');
    precio.classList.add('price');
    precio.textContent = `$${producto.precio}`
    anchor.appendChild(precio)

    card.appendChild(anchor);

    const addBtn = d.createElement('button');
    addBtn.classList.add('add', 'boton');
    addBtn.dataset.id = producto.id;
    addBtn.dataset.val = producto.precio;
    addBtn.dataset.cat = producto.categoria;
    addBtn.innerHTML = 'Agregar al carrito';
    addBtn.addEventListener('click', () => agregarAlCarrito(producto));
    card.appendChild(addBtn);

    return card;
  }

  /* Vaciar carrito */
  reset.addEventListener('click', () => {
    // Limpiar el carrito en memoria
    carrito = { productosIds: [], cantidades: [], total: 0 };
    // Limpiar en localStorage
    localStorage.removeItem('carrito');
    while (listaCarrito.hasChildNodes()) {
      listaCarrito.removeChild(listaCarrito.firstChild);
    }
    mostrarCarrito();
    
    console.log(carrito)
  });

  function carritoVacio() {
    if (carrito.productosIds.length === 0) {
      const total = carrito.cantidades.reduce((acum, cantidad, indice) => {
        const producto = productos.find(p => p.id === carrito.productosIds[indice]);
        return acum + (producto ? cantidad * producto.precio : 0);
      }, 0);

      botonCompra.classList.add('desabilitado')
      botonCompra.addEventListener('click', handleClickCompra)
      const mensajeCarritoVacio = d.createElement('li');
      mensajeCarritoVacio.classList.add('no-productos')
      mensajeCarritoVacio.textContent = 'No hay elementos en el carrito';
      listaCarrito.appendChild(mensajeCarritoVacio);
      // Si no hay elementos ocultar span cantidad
      cantidadesElement.forEach(element => {
        element.textContent = ''
        element.style.display = 'none'
      });
      totalElement.textContent = `$${total}`;
    } else {
      botonCompra.classList.remove('desabilitado');
      botonCompra.removeEventListener('click', handleClickCompra)
      while (listaCarrito.hasChildNodes()) {
        listaCarrito.removeChild(listaCarrito.firstChild);
      }
      totalElement.textContent = `$${carrito.total}`;

      cantidadesElement.forEach(element => {
        element.textContent = carrito.cantidades.reduce((acum, n) => acum + n, 0);
        element.style.display = 'inline-block'
      });
    }
  }
  /* Agregar producto al carrito */
  function agregarAlCarrito(producto) {
    const id = producto.id;
    const val = producto.precio;
    const indiceId = carrito.productosIds.indexOf(id);

    if (indiceId !== -1) {
      carrito.cantidades[indiceId]++;
    } else {
      carrito.productosIds.push(id);
      carrito.cantidades.push(1);
    }
    carrito.total += val;

    guardarCarritoLocalStorage();
    mostrarCarrito();
  }


  /* Eliminar producto del carrito */
  function eliminarDelCarrito(item) {
    const id = parseInt(item.querySelector('.del').dataset.id);
    const val = parseInt(item.querySelector('.del').dataset.val);
    const indiceId = carrito.productosIds.indexOf(id);

    if (indiceId !== -1) {
      carrito.total -= carrito.cantidades[indiceId] * val;
      carrito.productosIds.splice(indiceId, 1);
      carrito.cantidades.splice(indiceId, 1);
      listaCarrito.removeChild(item);
      mostrarCarrito();
    }

    guardarCarritoLocalStorage();
    console.log(carrito)
  }

  for (let btn of d.querySelectorAll('.del')) {
    btn.addEventListener('click', (e) => {
      const item = e.target.closest('.item-producto');
      eliminarDelCarrito(item);
    });
  }

  function handleClickCompra(event) {
    event.preventDefault();
  }

  /* Mostrar carrito en interfaz */
  const mostrarCarrito = () => {
    carritoVacio()
    carrito.productosIds.forEach((productosId) => {
      const producto = productos.find(p => p.id === productosId);
      let productoCarpeta = producto.titulo.replace(/\s/g, '');
      productoCarpeta = productoCarpeta.replace(/[^\w\s]/gi, '');

      const listItem = d.createElement('li');
      listItem.classList.add('item-producto');
      listaCarrito.appendChild(listItem);

      const descripCar = d.createElement('figure');
      descripCar.classList.add('descrip-car');
      listItem.appendChild(descripCar);

      const imagen = d.createElement('img');
      imagen.classList.add('miniportada');
      imagen.src = `assets/product/${productoCarpeta}/sm${productoCarpeta}3.png`;
      imagen.alt = producto.titulo;
      descripCar.appendChild(imagen);


      const tituloCar = d.createElement('figcaption');
      tituloCar.classList.add('titulo-car');
      const nombreProducto = d.createTextNode(producto.titulo);
      const precioProcucto = d.createTextNode(` $${producto.precio}`);
      const spanPrecio = d.createElement('p');
      spanPrecio.appendChild(precioProcucto);
      const cantidadProducto = d.createElement('span');
      cantidadProducto.classList.add('cantidad-prod');
      cantidadProducto.textContent = `x${carrito.cantidades[carrito.productosIds.indexOf(producto.id)] || 0}`;
      tituloCar.appendChild(nombreProducto);
      tituloCar.appendChild(spanPrecio);
      spanPrecio.appendChild(cantidadProducto);
      descripCar.appendChild(tituloCar);

      const delBtn = d.createElement('button');
      delBtn.classList.add('del');
      delBtn.dataset.id = producto.id;
      delBtn.dataset.val = producto.precio;
      delBtn.dataset.cat = producto.categoria;
      delBtn.innerHTML = 'Eliminar';
      listItem.appendChild(delBtn);

      delBtn.addEventListener('click', () => eliminarDelCarrito(listItem));
    })
  };
  /* Vaciar producto */
  function vaciarProductoId() {
    // Limpiar galeria
    while (figureProducto.firstChild) {
      figureProducto.removeChild(figureProducto.firstChild);
    }
    while (ulProducto.firstChild) {
      ulProducto.removeChild(ulProducto.firstChild);
    }
    // Limpiar informacion
    const child = infoProducto.children;
    for (let i = 0; i < child.length-1; i++) {
      if (child[i].nodeType === 1) {
        child[i].textContent = '';
      }
    }
  }
  /* Mostrar interfaz de producto al detalle */
  function mostrarProductoId(producto) {
    // Nombre de carpeta de producto
    let productoCarpeta = producto.titulo.replace(/\s/g, '');
    productoCarpeta = productoCarpeta.replace(/[^\w\s]/gi, '');
    // Mostrar galeria de productos
    for (let i = 1; i <= 5; i++) {
      // Galeria indicadores
      const liIndicador = d.createElement('li');
      liIndicador.dataset.bsTarget = '#carouselExampleIndicators';
      liIndicador.dataset.bsSlideTo = `${i - 1}`;
      liIndicador.setAttribute('aria-label', `Slide ${i + 1}`);
      
      // Imagen seleccionada
      const galeriaProducto = d.createElement('picture');
      galeriaProducto.classList.add('carousel-item');
      
      // Primer elemento active
      if(i === 1) {
        liIndicador.classList.add('active');
        liIndicador.setAttribute('aria-current', 'true');
        galeriaProducto.classList.add('active');
      }
      
      const imagensm = d.createElement('img');
      imagensm.src = `assets/product/${productoCarpeta}/sm${productoCarpeta}${i}.png`;
      imagensm.alt = `${productoCarpeta}`;
      
      const imagen = d.createElement('img');
      imagen.src = `assets/product/${productoCarpeta}/${productoCarpeta}${i}.png`;
      imagen.alt = `${productoCarpeta}`;

      const source = d.createElement('source');
      source.media = '(max-width: 1024px)';
      source.srcset = `assets/product/${productoCarpeta}/md${productoCarpeta}${i}.png`;

      galeriaProducto.appendChild(source);
      galeriaProducto.appendChild(imagen);
      liIndicador.appendChild(imagensm);

      ulProducto.appendChild(liIndicador);
      figureProducto.appendChild(galeriaProducto)
    }
    
    // Mostrar los datos del producto
    nombreProducto.textContent = producto.titulo;
    categoriaProducto.textContent = producto.categoria;
    subtituloProducto.textContent = producto.subtitulo;
    descripcionProducto.textContent = producto.descripcion;
    precioProducto.textContent = `$${producto.precio}`;
    botonAgregar.classList.add('add');
    botonAgregar.dataset.id = producto.id;
    botonAgregar.dataset.val = producto.precio;
    botonAgregar.dataset.cat = producto.categoria;
    botonAgregar.addEventListener('click', () => agregarAlCarrito(producto));

    document.addEventListener('keydown', function(event) {
      if (event.key === 'ArrowLeft') {
        document.querySelector('.carousel-control-prev').click();
      } else if (event.key === 'ArrowRight') {
        document.querySelector('.carousel-control-next').click();
      }
    });
  } 
  
  /* Filtrar productos por categoría */
  function filtrarCat(categoriaSelect) {
    const productosFiltrados = categoriaSelect ? productos.filter(producto => producto.categoria === categoriaSelect) : productos;

    if (pagCategoria || pagInicio) {
      while (products.hasChildNodes()) {
        products.removeChild(products.firstChild);
      }

      productosFiltrados.forEach(producto => {
        const card = crearProductosCards(producto);
        products.appendChild(card);
      });

      if (categoriaSelect) {
        categoriaTitulo.textContent = categoriaSelect;
        mostrarBanner()
      }
    }
  }

  /* Mostrar banner publicitario */
  function bannerClickHandler() {
    const id = bannerVisible()
    let fotoId;
    switch (id) {
      case 'banner-squeaky-clean':
        fotoId = 2;
        break;
      case 'banner-hollowfication':
        fotoId = 13;
        break;
      default:
        fotoId = 21;
        break;
    }
    window.location.href = 'producto.html?id=' + fotoId;
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

  /* Mostrar producto seleccionado */
  function abrirProducto() {
    if (pagProducto) {
      const producto = productos.find(item => item.id === parseInt(productId));

      vaciarProductoId();
      mostrarProductoId(producto);
    }
  }
  function completarFormulario() {
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

    if (carrito.cantidades.length === 0) {
      formularioDatosPersonales.style.display = 'none';
      formularioDatosPago.style.display = 'none';
      const totalCarrito = d.getElementById('info')
      totalCarrito.style.display = 'none';
      d.querySelector('.sect-comprar').style.alignItems = 'center'
      
      botonCompra.classList.remove('desabilitado');
      botonCompra.removeEventListener('click', handleClickCompra)
    } else {
      botonCompra.classList.add('desabilitado');
      botonCompra.addEventListener('click', handleClickCompra)
    }
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
  }

  /* Scroll Nav */
  window.addEventListener('scroll', function() {    
    const navbar = document.querySelector('.navt');
    const dropdown = document.querySelector('#dropdown-menu');
    const carritoDesplegable = document.querySelector('.carrito-section')

    // Obtener la posición actual de desplazamiento
    const scrollTop = window.scrollY || document.documentElement.scrollTop;

    // Altura del navbar
    const navbarHeight = navbar.offsetHeight;

    // Condición para cambiar el color del navbar
    if (scrollTop > navbarHeight) {
      navbar.style.backgroundColor = '#dfdfdf';
      navbar.style.filter = 'invert(100%)';
      dropdown.style.background = '#none';
      dropdown.style.filter = 'invert(0%)';
      carritoDesplegable.style.filter = 'invert(100%)'
    } else {
      navbar.style.filter = 'invert(0%)';
      navbar.style.background = 'none';
      dropdown.style.background = '#dfdfdf';
      dropdown.style.filter = 'invert(100%)';
      carritoDesplegable.style.filter = 'invert(0%)'
    }
  });

  /* Inicializar: Mostrar productos */
  mostrarCarrito();
  abrirProducto()
  if (pagComprar) {
    completarFormulario()
  }
  if (pagCategoria || pagInicio) {
    filtrarCat(categoriaSelect);
  }
  if (pagCategoria) {
    banner.addEventListener('click', bannerClickHandler)
  }
});