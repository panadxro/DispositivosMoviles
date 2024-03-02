'use strict';
/* PANADERO LUCAS DWT2AP TP2 - Ecommerce */
document.addEventListener('DOMContentLoaded', function() {  
  /* DOM */
  const d = document;
  const pagCategoria = d.querySelector('#pag-categorias');
  const pagInicio = d.querySelector('#pag-inicio');
  const pagProducto = d.querySelector('#pag-producto');
  const pagComprar = d.querySelector('#pag-comprar');
  const products = d.querySelector('#productos');
  const listaCarrito = d.getElementById('lista-carrito');
  const listaCompra = d.getElementById('lista-compra');
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
  
  /*  */
/*   function cargarCarritoComprar() {
    if (pagComprar) {
      const clonedElement = listaCompra.cloneNode(true)
      clonedElement.childNodes.forEach(item => {

      console.log(item)
      const nuevoElemento = document.createElement('p');
      
      nuevoElemento.textContent = nombreProducto;
      listaCompra.appendChild(nuevoElemento)
      })
    }
  } */

  /* Mostrar producto seleccionado */
  function abrirProducto() {
    if (pagProducto) {
      const producto = productos.find(item => item.id === parseInt(productId));
      // Encontrar producto, vaciar y mostrar producto
      vaciarProductoId();
      mostrarProductoId(producto);
    }
  }
  
  /* Inicializar: Mostrar productos */
  mostrarCarrito();
  // cargarCarritoComprar();

  abrirProducto()
  filtrarCat(categoriaSelect);
});

const productos = [
  { 
    "id": 1,
    "titulo": "TNSH",
    "subtitulo": "Washed Black Hoodie",
    "descripcion": "Te presentamos TNSH, la personificación de Hardcore Feelings. Esta sudadera negra lavada va más allá de lo ordinario, con meticulosos desgastes en los dobladillos y gráficos serigrafiados agrietados para una estética vintage sin esfuerzo, mientras que el efecto de salpicaduras de pintura inspirado en el bricolaje le da un toque auténtico y personalizado.",
    "precio": 120,
    "imagen": "assets/product/TNSH/TNSH1.png",
    "categoria": "Buzos"
  },
  {
    "id": 2,
    "titulo": "Squeaky Clean",
    "subtitulo": "White T-Shirt",
    "descripcion": "Presentamos Squeaky Clean, una camiseta blanca oversize serigrafiada en nuestra sede de Sheffield con un gráfico no tan limpio de @bl00dina_.",
    "precio": 50,
    "imagen": "assets/product/SqueakyClean/SqueakyClean1.png",
    "categoria": "Remeras" 
  },
  {
    "id": 3,
    "titulo": "28 Days",
    "subtitulo": "Ring",
    "descripcion": "Te presentamos a 28 Days, un amenazador conejo de aspecto demoníaco. En este anillo de acero inoxidable está grabado nuestro clásico logotipo Drop Dead.",
    "precio": 20,
    "imagen": "assets/product/28Days/28Days1.png",
    "categoria": "Accesorios"
  },
  {
    "id": 4,
    "titulo": "Around The Fur",
    "subtitulo": "Faux fur Jacket",
    "descripcion": "Around The Fur es la chaqueta de Drop Dead con la que no querrás dormir. Fabricada en piel sintética, tiene un estampado de gritos en tonos apagados, cierre de cremallera y bolsillos. Es la prenda perfecta para el invierno.",
    "precio": 200,
    "imagen": "assets/product/AroundTheFur/AroundTheFur1.png",
    "categoria": "Camperas" 
  },
  {
    "id": 5,
    "titulo": "Angel Soup",
    "subtitulo": "Blue Longsleeve",
    "descripcion": "Presentamos Angel Soup, nuestra nueva camiseta de mangas superpuestas. Esta camiseta azul marino viene en nuestro clásico corte oversize y tiene unas llamativas mangas a rayas rojas y blancas. En la parte delantera y central encontrarás un atrevido gráfico serigrafiado en nuestra sede de Sheffield.",
    "precio": 70,
    "imagen": "assets/product/AngelSoup/AngelSoup1.png",
    "categoria": "Remeras" 
  },
  {
    "id": 6,
    "titulo": "Hollowed Soul",
    "subtitulo": "Washed Black Hoodie",
    "descripcion": "Aprende a controlar el hueco con nuestra sudadera con capucha Hollowed Soul. Esta sudadera con capucha, de corte cuadrado, es única y está cubierta de gráficos serigrafiados en nuestra sede de Sheffield.",
    "precio": 120,
    "imagen": "assets/product/HollowedSoul/HollowedSoul1.png",
    "categoria": "Buzos" 
  },
  {
    "id": 7,
    "titulo": "Glow Bottoms",
    "subtitulo": "Black Sweatpants",
    "descripcion": "Ya puedes dejar de buscar; has encontrado el pantalón perfecto. Confeccionados con una meticulosa atención al detalle, nuestros 'Glow Bottoms' presentan un diseño de pernera ancha que ofrece comodidad y estilo.",
    "precio": 120,
    "imagen": "assets/product/GlowBottoms/GlowBottoms1.png",
    "categoria": "Pantalones" 
  },
  {
    "id": 8,
    "titulo": "Blade",
    "subtitulo": "Necklace",
    "descripcion": "Una declaración audaz que exige atención, Blade es un collar vanguardista que cuenta con una estrella de la mañana y el encanto de la hoja de afeitar, elaborado a partir de acero inoxidable de alta calidad.",
    "precio": 35,
    "imagen": "assets/product/Blade/Blade1.png",
    "categoria": "Accesorios" 
  },
  {
    "id": 9,
    "titulo": "Blessings",
    "subtitulo": "Longsleeve",
    "descripcion": "Lleva tu historia en la manga, literalmente, y cuenta tus bendiciones con esta camiseta de manga larga. Inspirada en el cautivador mundo del arte del tatuaje, esta exclusiva prenda de color beige muestra una serie de gráficos de intrincado diseño que celebran la esencia de las bendiciones.",
    "precio": 70,
    "imagen": "assets/product/Blessings/Blessings1.png",
    "categoria": "Remeras" 
  },
  {
    "id": 10,
    "titulo": "Lure",
    "subtitulo": "Distressed Hoodie",
    "descripcion": "Confeccionada en suave algodón gris marengo, es la mezcla perfecta de comodidad y diseño contemporáneo. Lure tiene un corte relajado, una cómoda capucha y un práctico bolsillo canguro.",
    "precio": 120,
    "imagen": "assets/product/Lure/Lure1.png",
    "categoria": "Buzos" 
  },
  {
    "id": 11,
    "titulo": "Makeover",
    "subtitulo": "Washed Black T-Shirt",
    "descripcion": "Makeover es un lienzo atemporal para el arte ponible. Esta camiseta oversize se presenta en un color negro lavado que le da un toque vintage, mientras que la característica más destacada es el gráfico frontal, que grita de la estética Drop Dead y ha sido meticulosamente diseñado por @kittysophie.art.",
    "precio": 50,
    "imagen": "assets/product/Makeover/Makeover1.png",
    "categoria": "Remeras" 
  },
  {
    "id": 12,
    "titulo": "Runes",
    "subtitulo": "Belt",
    "descripcion": "Fabricado en acero inoxidable, Runes es un cinturón de cadena con colgantes metálicos en 3D.  Tanto si prefieres llevarlo ceñido a la cintura como drapeado alrededor de las caderas, este cinturón tiene un cierre de hebilla y una cadena extendida que se ajusta sin esfuerzo a tu estilo y tamaño preferidos. Se entrega en un estuche de regalo de la marca.",
    "precio": 50,
    "imagen": "assets/product/Runes/Runes1.png",
    "categoria": "Accesorios" 
  },
  {
    "id": 13,
    "titulo": "Hollowfication",
    "subtitulo": "Washed Black Hoodie",
    "descripcion": "Abraza el lado oscuro con Hollowfication. Esta sudadera con capucha oversize es más que un básico de armario, con su bolsillo canguro para mayor practicidad,",
    "precio": 120,
    "imagen": "assets/product/Hollowfication/Hollowfication1.png",
    "categoria": "Buzos" 
  },
  {
    "id": 14,
    "titulo": "Max Pain",
    "subtitulo": "Racer Jacket",
    "descripcion": "Un estilo cuadrado con cremallera que se completa con un cuello falso con doble botón a presión, mangas largas, bolsillos laterales y atrevidos parches y bordados moteros por toda la prenda.",
    "precio": 250,
    "imagen": "assets/product/MaxPain/MaxPain1.png",
    "categoria": "Camperas" 
  },
  {
    "id": 15,
    "titulo": "Rot 'N' Roll",
    "subtitulo": "Washed Black T-Shirt",
    "descripcion": "Es hora de Rot n Roll. Esta camiseta lavada de gran tamaño ha sido desgastada como ninguna otra, con un estampado horripilante, es una prenda única para cualquier armario Drop Dead.",
    "precio": 60,
    "imagen": "assets/product/RotNRoll/RotNRoll1.png",
    "categoria": "Remeras" 
  },
  {
    "id": 16,
    "titulo": "Razor's Edge",
    "subtitulo": "Earrings",
    "descripcion": "Un par de pendientes de aro de acero inoxidable con colgantes de navaja a juego. Pendiente de aro con bisagra y opción de colgante intercambiable.",
    "precio": 20,
    "imagen": "assets/product/RazorsEdge/RazorsEdge1.png",
    "categoria": "Accesorios" 
  },
  {
    "id": 17,
    "titulo": "Seek & Destroy",
    "subtitulo": "Denim Jeans",
    "descripcion": "Corre hacia el abismo con los vaqueros Seek & Destroy. Con un denim negro lavado, puedes encontrar capas de rotos y desgastes por todo este par de vaqueros de pierna ancha. Debajo de los rotos hay un tejido interior que te protege.",
    "precio": 120,
    "imagen": "assets/product/SeekDestroy/SeekDestroy1.png",
    "categoria": "Pantalones" 
  },
  {
    "id": 18,
    "titulo": "J'adore Hardcore",
    "subtitulo": "2 in 1 Jacket",
    "descripcion": "Presentamos J'adore Hardcore, la personificación de los sentimientos Hardcore. Esta poderosa prenda 2 en 1 se inspira directamente en la multitud de un concierto: es una versión de la clásica chaqueta de batalla corta, con una sudadera con capucha desmontable y tachuelas.",
    "precio": 200,
    "imagen": "assets/product/JadoreHardcore/JadoreHardcore1.png",
    "categoria": "Camperas" 
  },
  {
    "id": 19,
    "titulo": "Spiritual",
    "subtitulo": "Socks (Pack of 2)",
    "descripcion": "Los clásicos calcetines Drop Dead 'Spiritual' en naranja/verde son de longitud media, con un grueso punto elástico alrededor del tobillo y los exclusivos gráficos DD spiritual hardcore en los laterales y la base.",
    "precio": 20,
    "imagen": "assets/product/Spiritual/Spiritual1.png",
    "categoria": "Accesorios" 
  },
  {
    "id": 20,
    "titulo": "Violence",
    "subtitulo": "Elasticated Shorts",
    "descripcion": "Entra en la arena con nuestros pantalones cortos Violence. Confeccionados con un tejido de peso medio, estos suaves pantalones cortos de satén destacan por su durabilidad con intrincados bordados y parches de calavera cosidos en la parte delantera y en los laterales.",
    "precio": 60,
    "imagen": "assets/product/Violence/Violence1.png",
    "categoria": "Pantalones" 
  },
  {
    "id": 21,
    "titulo": "Dead Cell",
    "subtitulo": "Puffer Jacket",
    "descripcion": "Presentamos Dead Cell, la chaqueta vanguardista que desafía las convenciones y supera los límites de la moda contemporánea.",
    "precio": 250,
    "imagen": "assets/product/DeadCell/DeadCell1.png",
    "categoria": "Camperas" 
  },
  {
    "id": 22,
    "titulo": "Split Head",
    "subtitulo": "Knitted Beanie",
    "descripcion": "Este es el gorro de punto que lleva la moda para la cabeza a un nuevo nivel de estilo e intriga. Adornado con dinámicas rayas verdes y negras, este gorro es toda una declaración de intenciones.",
    "precio": 40,
    "imagen": "assets/product/SplitHead/SplitHead1.png",
    "categoria": "Accesorios" 
  },
  {
    "id": 23,
    "titulo": "Want You",
    "subtitulo": "Ringer T-Shirt",
    "descripcion": "Esta camiseta, en nuestro color crudo personalizado, es un homenaje a nuestro estilo clásico DD. Esta camiseta entallada se ha impreso internamente en nuestra sede de Sheffield.",
    "precio": 50,
    "imagen": "assets/product/WantYou/WantYou1.png",
    "categoria": "Remeras" 
  },
  {
    "id": 24,
    "titulo": "Hardcore",
    "subtitulo": "Socks (Pack of 2)",
    "descripcion": "Los calcetines clásicos Drop Dead 'Hardcore' en blanco/negro son de longitud media, con un grueso punto elástico alrededor del tobillo y gráficos exclusivos DD spiritual hardcore en los laterales y la base.",
    "precio": 20,
    "imagen": "assets/product/Hardcore/Hardcore1.png",
    "categoria": "Accesorios" 
  },
  {
    "id": 25,
    "titulo": "Orion Skirt",
    "subtitulo": "Wrap Skirt",
    "descripcion": "Eleva tu vestuario con la falda de Orion. Confeccionada en franela marrón tonal. Esta falda escocesa cuenta con nuestro clásico diseño envolvente con una correa ajustable en la cintura, parches espirituales y un dobladillo asimétrico con un acabado de borde crudo.",
    "precio": 50,
    "imagen": "assets/product/OrionSkirt/OrionSkirt1.png",
    "categoria": "Pantalones" 
  }
]
