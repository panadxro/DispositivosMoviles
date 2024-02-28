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
  })
  .catch(error => console.error('Error al cargar los datos:', error));

/* DOM */
document.addEventListener('DOMContentLoaded', function() {
  const pagCategoria = d.querySelector('#pag-categorias');
  const pagInicio = d.querySelector('#pag-inicio');
  const products = d.querySelector('#productos');
  const listaCarrito = d.getElementById('lista-carrito');
  const categoriaTitulo = d.getElementById('tit-categoria');
  const cantidadesElement = d.querySelectorAll('.cantidades-carrito');
  const totalElement = d.getElementById('total-carrito');
  const reset = d.querySelector('#reset');
  const urlParams = new URLSearchParams(window.location.search);
  const categoriaSelect = urlParams.get('cat');
  const productId = urlParams.get('id')

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
    const imagen = d.createElement('img');
    imagen.src = producto.imagen;
    imagen.alt = producto.nombre;
    figura.appendChild(imagen);
    anchor.appendChild(figura);

    const titulo = document.createElement('h3');
    titulo.textContent = producto.nombre;
    anchor.appendChild(titulo);

    const descripcion = document.createElement('p');
    descripcion.textContent = producto.descripcion;
    anchor.appendChild(descripcion);

    const precio = document.createElement('p');
    precio.classList.add('price');
    precio.textContent = `$${producto.precio}`
    anchor.appendChild(precio)

    card.appendChild(anchor);

    const addBtn = d.createElement('button');
    addBtn.classList.add('add');
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

      const listItem = d.createElement('li');
      listItem.classList.add('item-producto');
      listaCarrito.appendChild(listItem);

      const descripCar = d.createElement('div');
      descripCar.classList.add('descrip-car');
      listItem.appendChild(descripCar);

      const miniportada = d.createElement('img');
      miniportada.classList.add('miniportada');
      miniportada.src = producto.imagen;
      miniportada.alt = producto.nombre;
      descripCar.appendChild(miniportada);

      const tituloCar = d.createElement('h3');
      tituloCar.classList.add('titulo-car');
      const nombreProducto = d.createTextNode(producto.nombre);
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
      delBtn.innerHTML = 'x';
      listItem.appendChild(delBtn);

      delBtn.addEventListener('click', () => eliminarDelCarrito(listItem));
    })
  };

  /* Mostrar producto al detalle */
  function mostrarProducto(productosId) {
    
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
  console.log(categoriaSelect);
  mostrarCarrito();
});