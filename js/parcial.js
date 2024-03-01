'use strict';
/* PANADERO LUCAS DWT2AP TP2 - Ecommerce */
document.addEventListener('DOMContentLoaded', function() {
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
    
  /* DOM */
  const pagCategoria = d.querySelector('#pag-categorias');
  const pagInicio = d.querySelector('#pag-inicio');
  const pagProducto = d.querySelector('#pag-producto');
  const products = d.querySelector('#productos');
  const listaCarrito = d.getElementById('lista-carrito');
  const categoriaTitulo = d.getElementById('tit-categoria');
  const cantidadesElement = d.querySelectorAll('.cantidades-carrito');
  const totalElement = d.getElementById('total-carrito');
  const reset = d.querySelector('#reset');
  const urlParams = new URLSearchParams(window.location.search);
  const categoriaSelect = urlParams.get('cat');
  // Producto detalle
  const productId = urlParams.get('id');
  const figureProducto = document.getElementById('galeria-productos');
  const ulProducto = document.getElementById('indicador-productos');
  const infoProducto = document.getElementById('infoProducto')
  const nombreProducto = document.getElementById('nombre-producto');
  const categoriaProducto = document.getElementById('cat-producto');
  const subtituloProducto = document.getElementById('subtitulo-producto');
  const descripcionProducto = document.getElementById('descripcion-producto');
  const precioProducto = document.getElementById('precio-producto');
  const botonAgregar = document.getElementById('boton-agregar');

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

    const figura = document.createElement('figure');
    const imagen = document.createElement('img');
    imagen.src = producto.imagen;
    imagen.alt = producto.titulo;
    figura.appendChild(imagen);
    anchor.appendChild(figura);

    const titulo = document.createElement('h3');
    titulo.textContent = producto.titulo;
    anchor.appendChild(titulo);

    const descripcion = document.createElement('p');
    descripcion.textContent = producto.subtitulo;
    anchor.appendChild(descripcion);

    const precio = document.createElement('p');
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
    console.log(carrito)
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
    mostrarCarrito();
  }

  for (let btn of d.querySelectorAll('.del')) {
    btn.addEventListener('click', (e) => {
      const item = e.target.closest('.item-producto');
      eliminarDelCarrito(item);
    });
  }

  /* Mostrar carrito en interfaz */
  const mostrarCarrito = () => {
    const total = carrito.cantidades.reduce((acum, cantidad, indice) => {
      const producto = productos.find(p => p.id === carrito.productosIds[indice]);
      return acum + (producto ? cantidad * producto.precio : 0);
    }, 0);

    if (total > 0) {
      // Si hay elemento mostrar span cantidad 
      cantidadesElement.forEach(element => {
        element.textContent = carrito.cantidades.reduce((acum, n) => acum + n, 0);
        element.style.display = 'inline-block'
      });
    } else {
      // Si no hay elementos ocultar span cantidad
      cantidadesElement.forEach(element => {
        element.textContent = ''
        element.style.display = 'none'
      });
    }

    totalElement.textContent = `$${total}`;

    while (listaCarrito.hasChildNodes()) {
      listaCarrito.removeChild(listaCarrito.firstChild);
    }

    carrito.productosIds.forEach((productosId) => {
      const producto = productos.find(p => p.id === productosId);
      let productoCarpeta = producto.titulo.replace(/\s/g, '');
      productoCarpeta = productoCarpeta.replace(/[^\w\s]/gi, '');
      const listItem = d.createElement('li');
      listItem.classList.add('item-producto');
      listaCarrito.appendChild(listItem);

      const descripCar = d.createElement('div');
      descripCar.classList.add('descrip-car');
      listItem.appendChild(descripCar);

      const imagen = document.createElement('img');
      imagen.classList.add('miniportada');
      imagen.src = `assets/product/${productoCarpeta}/sm${productoCarpeta}3.png`;
      imagen.alt = producto.titulo;
      // descripCar.appendChild(miniportada);
      descripCar.appendChild(imagen);


      const tituloCar = d.createElement('h3');
      tituloCar.classList.add('titulo-car');
      const nombreProducto = d.createTextNode(producto.titulo);
      const precioProcucto = d.createTextNode(` $${producto.precio}`);
      const spanPrecio = d.createElement('span');
      spanPrecio.appendChild(precioProcucto);
      const cantidadProducto = d.createElement('span');
      cantidadProducto.classList.add('cantidad-prod');
      cantidadProducto.textContent = `x${carrito.cantidades[carrito.productosIds.indexOf(producto.id)] || 0}`;
      tituloCar.appendChild(nombreProducto);
      tituloCar.appendChild(d.createElement('br'));
      tituloCar.appendChild(spanPrecio);
      tituloCar.appendChild(cantidadProducto);
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
    console.log(child.length)
    for (let i = 0; i < child.length-1; i++) {
      if (child[i].nodeType === 1) {
        child[i].textContent = '';
      }
    }
  }
  /* Mostrar producto al detalle */
  function mostrarProductoId(producto) {
    // Nombre de carpeta de producto
    let productoCarpeta = producto.titulo.replace(/\s/g, '');
    productoCarpeta = productoCarpeta.replace(/[^\w\s]/gi, '');
    // Mostrar galeria de productos
    for (let i = 1; i <= 5; i++) {
      // Galeria indicadores
      const liIndicador = document.createElement('li');
      liIndicador.dataset.bsTarget = '#carouselExampleIndicators';
      liIndicador.dataset.bsSlideTo = `${i - 1}`;
      liIndicador.setAttribute('aria-label', `Slide ${i + 1}`);
      
      // Imagen seleccionada
      const galeriaProducto = document.createElement('picture');
      galeriaProducto.classList.add('carousel-item');
      
      // Primer elemento active
      if(i === 1) {
        liIndicador.classList.add('active');
        liIndicador.setAttribute('aria-current', 'true');
        galeriaProducto.classList.add('active');
      }
      
      const imagensm = document.createElement('img');
      imagensm.src = `assets/product/${productoCarpeta}/sm${productoCarpeta}${i}.png`;
      imagensm.alt = `${productoCarpeta}`;
      
      const imagen = document.createElement('img');
      imagen.src = `assets/product/${productoCarpeta}/${productoCarpeta}${i}.png`;
      imagen.alt = `${productoCarpeta}`;

      const source = document.createElement('source');
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
  } 
  
  /* Filtrar productos por categoría */
  function filtrarCat(categoriaSelect) {
    const productosFiltrados = categoriaSelect ? productos.filter(producto => producto.categoria === categoriaSelect) : productos;
    
    if (pagCategoria || pagInicio) {
      while (products.hasChildNodes()) {
        products.removeChild(products.firstChild);
      }    
      if (categoriaSelect) {
        categoriaTitulo.textContent = categoriaSelect;
      } 
  
      productosFiltrados.forEach(producto => {
        const card = crearProductosCards(producto);
        products.append(card);
      });
    }
  }
  /* Inicializar: Mostrar productos */
  filtrarCat(categoriaSelect);
  mostrarCarrito();
});