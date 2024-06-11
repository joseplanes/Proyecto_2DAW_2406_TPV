<div id="gestion" class="h-screen flex flex-col"
    x-data="{
        showInventario: true,
        showEmpleados: false,
        showCajas: false,
        showCategorias: false,
        showIvas: false,
        ventanaNuevoProducto: false,
        ventanaEditarProducto: false,
        ventanaNuevaCategoria: false,
        ventanaEditarCategoria: false,
        ventanaNuevoIva: false,
        ventanaEditarIva: false,
        ventanaNuevaCaja: false,
        ventanaEditarCaja: false,
        productos: @entangle('productos'),
        categorias: @entangle('categorias'),
        ivas: @entangle('iva'),
        cajas: @entangle('caja'),
        productoFiltrado: @entangle('productoFiltrado'),
        idProd: '',
        nombreProd: '',
        precioProd: '',
        imagenProd: '',
        iva_idProd: '',
        categoria_idProd: '',
        stockProd: '',
        estadoProd: '',
        idCategoria: '',
        nombreCategoria: '',
        imagenCategoria: '',
        idIva: '',
        qtyIva: '',
        idCaja: '',
        nameCaja: '',
        search: '',
        searchCategory: '',
        searchIva: '',
        searchBox: '',
        buscarPorNombre(){
            let clientsWithOrders = Object.values(this.productos);

            const normalize = (string) => string.trim().toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '')
            const normalizeNumber = (string) => string.toString().trim().toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '')
            const categoria_name = Object.values(this.categorias);
            if(this.search) {
                let search = normalize(this.search)

                clientsWithOrders = clientsWithOrders.filter((producto) => normalize(producto.nombre).includes(search) || normalizeNumber(producto.categoria_id).includes(search))
            }
            
            return clientsWithOrders;
        },
        buscarPorNombreCategoria(){
            let clientsWithOrders = Object.values(this.categorias);

            const normalize = (string) => string.trim().toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '')
            const normalizeNumber = (string) => string.toString().trim().toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '')
            if(this.searchCategory) {
                let searchCategory = normalize(this.searchCategory)

                clientsWithOrders = clientsWithOrders.filter((categoria) => normalize(categoria.nombre).includes(searchCategory))
            }
            
            return clientsWithOrders;
        },
        buscarPorNombreIva(){
            let clientsWithOrders = Object.values(this.ivas);

            const normalize = (string) => string.trim().toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '')
            const normalizeNumber = (string) => string.toString().trim().toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '')
            if(this.searchIva) {
                let searchIva = normalizeNumber(this.searchIva)

                clientsWithOrders = clientsWithOrders.filter((iva) => normalizeNumber(iva.qty).includes(searchIva))
            }
            
            return clientsWithOrders;
        },
        buscarPorNombreCaja(){
            let clientsWithOrders = Object.values(this.cajas);

            const normalize = (string) => string.trim().toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '')
            const normalizeNumber = (string) => string.toString().trim().toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '')
            if(this.searchBox) {
                let searchBox = normalize(this.searchBox)

                clientsWithOrders = clientsWithOrders.filter((caja) => normalize(caja.name).includes(searchBox))
            }
            
            return clientsWithOrders;
        },
        getIvaProd(ivaId) {
            let ivaProd = 0;

                ivaProd = this.ivas[ivaId].qty;

            return ivaProd;
        },
        updateProductoFiltrado(id, nombre, precio, imagen_url, iva_id, categoria_id, stock, estado){
            this.idProd = id;
            this.nombreProd = nombre;
            this.precioProd = precio;
            this.imagenProd = imagen_url;
            this.iva_idProd = iva_id;
            this.categoria_idProd = categoria_id;
            this.stockProd = stock;
            this.estadoProd = estado;
        },
        updateCategoriaFiltrada(id, nombre, imagen_url){
            this.idCategoria = id;
            this.nombreCategoria = nombre;
            this.imagenCategoria = imagen_url;
        },
        updateIvaFiltrado(id, qty){
            this.idIva = id;
            this.qtyIva = qty;
        },
        updateCajaFiltrada(id, name){
            this.idCaja = id;
            this.nameCaja = name;
        },
    }">

    {{-- NAVEGADOR --}}
    <div class="w-full bg-gray-100 flex justify-around fixed top-0 left-0 z-10">
        <div class="my-2 text-center cursor-pointer"
            @click="showInventario = true; showEmpleados = false; showCategorias = false; showCajas = false; showIvas = false;">
            <p class="mx-2">Inventario</p>
        </div>
        <div class="my-2 text-center cursor-pointer"
            @click="showInventario = false; showEmpleados = true; showCategorias = false; showCajas = false; showIvas = false;">
            <p class="mx-2">Empleados</p>
        </div>
        <div class="my-2 text-center cursor-pointer"
            @click="showInventario = false; showEmpleados = false; showCategorias = true; showCajas = false; showIvas = false;">
            <p class="mx-2">Categorias</p>
        </div>
        <div class="my-2 text-center cursor-pointer"
            @click="showInventario = false; showEmpleados = false; showCategorias = false; showCajas = false; showIvas = true;">
            <p class="mx-2">Ivas</p>
        </div>
        <div class="my-2 text-center cursor-pointer"
            @click="showInventario = false; showEmpleados = false; showCategorias = false; showCajas = true; showIvas = false;">
            <p class="mx-2">Cajas</p>
        </div>
    </div>

    {{-- SECCION PRODUCTOS --}}
    <div class="flex-1 pt-16 w-full overflow-y-auto px-4 md:px-8">

        <div x-show="showInventario">
            <div class="container mx-auto py-4"> 
            <div class="bg-gray-600 text-white p-4 h-20 flex items-center">
                <input x-ref="inputCB" id="navegador" name="navegador" type="text" x-model="search"
                    class="rounded-full px-4 py-2 w-full bg-white text-black border border-gray-300 focus:outline-none focus:border-blue-500">
            </div>
                <div>
                    <button @click="ventanaNuevoProducto = true">
                        <i class="fa-solid fa-pen-to-square fa-3x px-4 pb-2 pt-4 mb-3 bg-blue-400"></i>
                    </button>
                </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border">
                    <thead>
                        <tr>
                        <th class="py-2 px-4 border-b">Imagen</th>
                            <th class="py-2 px-4 border-b">Nombre</th>
                            <th class="py-2 px-4 border-b">Precio</th>
                            <th class="py-2 px-4 border-b">IVA</th>
                            <th class="py-2 px-4 border-b">Categoria</th>
                            <th class="py-2 px-4 border-b">Stock</th>
                            <th class="py-2 px-4 border-b">Estado</th>
                            <th class="py-2 px-4 border-b"></th>
                            <th class="py-2 px-4 border-b"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="producto in buscarPorNombre()" :key="producto.id">
                            <tr>
                                <td class="py-2 px-4 border-b">
                                    <img :src="producto.imagen_url" alt="Foto del producto" class="h-12 w-12 object-cover">
                                </td>
                                <td class="py-2 px-4 border-b" x-text="producto.nombre"></td>
                                <td class="py-2 px-4 border-b" x-text="producto.precio.toFixed(2) + '€'"></td>
                                <td class="py-2 px-4 border-b" x-text="getIvaProd(producto.iva_id) + '%'"></td>
                                <td class="py-2 px-4 border-b" x-text="categorias[producto.categoria_id].nombre"></td>
                                <td class="py-2 px-4 border-b" x-text="producto.stock"></td>
                                <td class="py-2 px-4 border-b">
                                    <span class="inline-block h-4 w-4 rounded-full"
                                        :class="producto.se_vende ? 'bg-green-500' : 'bg-red-500'"></span>
                                </td>
                                <td class="py-2 px-4 border-b">
                                    <button @click=" updateProductoFiltrado(producto.id, producto.nombre, producto.precio, producto.imagen_url, producto.iva_id, producto.categoria_id, producto.stock, producto.se_vende); ventanaEditarProducto= true;" class="text-blue-500">Editar</button>
                                </td>
                                <td class="py-2 px-4 border-b">
                                    <button @click="$wire.dropProducto(producto.id);" class="text-blue-500">Borrar</button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
        {{-- VENTANA EDITAR PRODUCTO --}}
        <div x-show="ventanaEditarProducto" x-data="{
        }" class="fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 flex justify-center items-center">
            <div class="bg-white p-8 rounded-lg flex flex-col">
                <div class="uppercase text-xl font-bold mb-4">
                    Edición Producto
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" id="nombreProd" name="nombreProd" x-model="nombreProd" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" x-text="nombreProd">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Precio</label>
                        <input type="text" id="precioProd" name="precioProd" x-model="precioProd" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">IVA</label>
                        <select x-model="iva_idProd" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <option value="" disabled selected>Seleccione IVA</option>
                            <template x-for="iva in ivas" :key="iva.id">
                                <option :value="iva.id" x-text="iva.qty + '%'"></option>
                            </template>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Categoría</label>
                        <select x-model="categoria_idProd" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <option value="" disabled selected>Seleccione Categoría</option>
                            <template x-for="categoria in categorias" :key="categoria.id">
                                <option :value="categoria.id" x-text="categoria.nombre"></option>
                            </template>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Stock</label>
                        <input type="text" id="stockProd" name="stockProd" x-model="stockProd" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Estado</label>
                        <select x-model="estadoProd" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <option value="" disabled selected>Seleccione Estado</option>
                            <option value="1">Habilitado</option>
                            <option value="0">Deshabilitado</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Imagen</label>
                        <input type="file" id="imagenProd" name="imagenProd" x-model="imagenProd" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                </div>
                <div class="flex justify-end">
                    <button class="boton" @click=" console.log('Datos enviados:', idProd, nombreProd, precioProd, iva_idProd, categoria_idProd, stockProd, estadoProd, imagenProd);
                        $wire.actualizarProducto(idProd, nombreProd, precioProd, iva_idProd, categoria_idProd, stockProd, estadoProd, imagenProd);
                        ventanaEditarProducto = false;">Guardar</button>
                </div>
            </div>
        </div>
        {{-- VENTANA NUEVO PRODUCTO --}}
        <div x-show="ventanaNuevoProducto" x-data="{
                nombre: '',
                precio: '',
                imagen: '',
                iva_id: '',
                categoria_id: '',
                stock: '',
                estado: '',
                getProductoData() {
                    return {
                        nombre: this.nombre,
                        precio: parseFloat(this.precio),
                        iva_id: parseInt(this.iva_id),
                        categoria_id: parseInt(this.categoria_id),
                        stock: parseInt(this.stock),
                        estado: parseInt(this.estado),
                        imagen: this.imagen,
                        tipoNombre: typeof this.nombre,
                        tipoPrecio: typeof parseFloat(this.precio),
                        tipoIvaId: typeof parseInt(this.iva_id),
                        tipoCategoriaId: typeof parseInt(this.categoria_id),
                        tipoStock: typeof parseInt(this.stock),
                        tipoEstado: typeof parseInt(this.estado),
                        tipoImagen: typeof this.imagen
                    };
                }
                }" class="fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 flex justify-center items-center">
                <div class="bg-white p-8 rounded-lg flex flex-col">
                    <div class="uppercase text-xl font-bold mb-4">
                        Nuevo Producto
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nombre*</label>
                            <input type="text" id="nombre" name="nombre" x-model="nombre" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Precio*</label>
                            <input type="text" id="precio" name="precio" x-model="precio" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">IVA</label>
                            <select x-model="iva_id" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <option value="" disabled selected>Seleccione IVA</option>
                                <template x-for="iva in ivas" :key="iva.id">
                                    <option :value="iva.id" x-text="iva.qty + '%'"></option>
                                </template>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Categoría</label>
                            <select x-model="categoria_id" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <option value="" disabled selected>Seleccione Categoría</option>
                                <template x-for="categoria in categorias" :key="categoria.id">
                                    <option :value="categoria.id" x-text="categoria.nombre"></option>
                                </template>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Stock</label>
                            <input type="text" id="stock" name="stock" x-model="stock" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Estado</label>
                            <select x-model="estado" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <option value="">Seleccione Estado</option>    
                                <option value="1">Habilitado</option>
                                <option value="0">Deshabilitado</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Imagen</label>
                            <form action="" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" id="imagen" name="imagen" x-model="imagen" accept="image/*" 
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <button type="submit">Subir Imagen</button>
                            </form>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button class="boton" @click="
                            $wire.crearProducto(nombre, precio, iva_id, categoria_id, stock, estado, imagen);
                            ventanaNuevoProducto = false;">Guardar</button>
                    </div>
                </div>
            </div>   
    </div>
    
    {{-- SECCION EMPLEADOS --}}
    <div x-show="showEmpleados">
            
    </div>
    {{-- SECCION CAJAS --}}
    <div x-show="showCajas">
    <div class="bg-gray-600 text-white p-4 h-20 flex items-center">
            <input x-ref="inputCB" id="navegador" name="navegador" type="text" x-model="searchBox"
                class="rounded-full px-4 py-2 w-full bg-white text-black border border-gray-300 focus:outline-none focus:border-blue-500">
        </div>
        <div>
            <button @click="ventanaNuevaCaja = true">
                <i class="fa-solid fa-pen-to-square fa-3x px-4 pb-2 pt-4 mb-3 bg-blue-400"></i>
            </button>
        </div>
        <table class="min-w-full bg-white border">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Nombre</th>
                        <th class="py-2 px-4 border-b"></th>
                        <th class="py-2 px-4 border-b"></th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="caja in buscarPorNombreCaja()" :key="caja.id">
                        <tr>
                            <td class="py-2 px-4 border-b">
                                <img :src="categoria.imagen_url" alt="Foto del producto" class="h-12 w-12 object-cover">
                            </td>
                            <td class="py-2 px-4 border-b" x-text="caja.name"></td>
                            <td class="py-2 px-4 border-b">
                                <button @click="updateCajaFiltrada(caja.id, caja.name); ventanaEditarCaja= true" class="text-blue-500">Editar</button>
                            </td>
                            <td class="py-2 px-4 border-b">
                                <button @click="$wire.dropCaja(caja.id);" class="text-blue-500">Borrar</button>
                            </td>
                        </tr>
                    </template>
                </tbody>
        </table>
        {{-- VENTANA EDITAR CAJA --}}
        <div x-show="ventanaEditarCaja" x-data="{}" 
        class="fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 flex justify-center items-center">
            <div class="bg-white p-8 rounded-lg flex flex-col">
                <div class="uppercase text-xl font-bold mb-4">
                    Edición Caja
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" id="nameCaja" name="nameCaja" x-model="nameCaja" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                </div>
                <div class="flex justify-end">
                    <button class="boton" @click="
                        $wire.actualizarCaja(idCaja, nameCaja);
                        ventanaEditarCaja = false;">Guardar</button>
                </div>
            </div>
        </div>
        {{-- VENTANA NUEVA CAJA --}}
        <div x-show="ventanaNuevaCaja" x-data="{
            nombre: '',
            imagen: ''}" 
            class="fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 flex justify-center items-center">
            <div class="bg-white p-8 rounded-lg flex flex-col">
                <div class="uppercase text-xl font-bold mb-4">
                    Nueva Caja
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nombre*</label>
                        <input type="text" id="nombre" name="nombre" x-model="nombre" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                </div>
                <div class="flex justify-end">
                    <button class="boton" @click="
                        $wire.crearCaja(nombre, imagen);
                        ventanaNuevaCaja = false;">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    {{-- SECCION CATEGORIA --}}
    <div x-show="showCategorias">
        <div class="bg-gray-600 text-white p-4 h-20 flex items-center">
            <input x-ref="inputCB" id="navegador" name="navegador" type="text" x-model="searchCategory"
                class="rounded-full px-4 py-2 w-full bg-white text-black border border-gray-300 focus:outline-none focus:border-blue-500">
        </div>
        <div>
            <button @click="ventanaNuevaCategoria = true">
                <i class="fa-solid fa-pen-to-square fa-3x px-4 pb-2 pt-4 mb-3 bg-blue-400"></i>
            </button>
        </div>
        <table class="min-w-full bg-white border">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Imagen</th>
                        <th class="py-2 px-4 border-b">Nombre</th>
                        <th class="py-2 px-4 border-b"></th>
                        <th class="py-2 px-4 border-b"></th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="categoria in buscarPorNombreCategoria" :key="categoria.id">
                        <tr>
                            <td class="py-2 px-4 border-b">
                                <img :src="categoria.imagen_url" alt="Foto del producto" class="h-12 w-12 object-cover">
                            </td>
                            <td class="py-2 px-4 border-b" x-text="categoria.nombre"></td>
                            <td class="py-2 px-4 border-b">
                                <button @click="updateCategoriaFiltrada(categoria.id, categoria.nombre, categoria.imagen_url); ventanaEditarCategoria= true" class="text-blue-500">Editar</button>
                            </td>
                            <td class="py-2 px-4 border-b">
                                <button @click="$wire.dropCategoria(categoria.id);" class="text-blue-500">Borrar</button>
                            </td>
                        </tr>
                    </template>
                </tbody>
        </table>
        {{-- VENTANA EDITAR CATEGORIA --}}
        <div x-show="ventanaEditarCategoria" x-data="{}" 
        class="fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 flex justify-center items-center">
            <div class="bg-white p-8 rounded-lg flex flex-col">
                <div class="uppercase text-xl font-bold mb-4">
                    Edición Categoria
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" id="nombreCategoria" name="nombreCategoria" x-model="nombreCategoria" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Imagen</label>
                        <input type="text" id="imagenCategoria" name="imagenCategoria" x-model="imagenCategoria" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                </div>
                <div class="flex justify-end">
                    <button class="boton" @click="
                        $wire.actualizarCategoria(idCategoria, nombreCategoria, imagenCategoria);
                        ventanaEditarCategoria = false;">Guardar</button>
                </div>
            </div>
        </div>
        {{-- VENTANA NUEVA CATEGORIA --}}
        <div x-show="ventanaNuevaCategoria" x-data="{
            nombre: '',
            imagen: ''}" 
            class="fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 flex justify-center items-center">
            <div class="bg-white p-8 rounded-lg flex flex-col">
                <div class="uppercase text-xl font-bold mb-4">
                    Nueva Categoria
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nombre*</label>
                        <input type="text" id="nombre" name="nombre" x-model="nombre" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Imagen</label>
                        <input type="text" id="imagen" name="imagen" x-model="imagen" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                </div>
                <div class="flex justify-end">
                    <button class="boton" @click="
                        $wire.crearCategoria(nombre, imagen);
                        ventanaNuevaCategoria = false;">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    {{-- SECCION IVAS --}}
    <div x-show="showIvas">
        <div class="bg-gray-600 text-white p-4 h-20 flex items-center">
            <input x-ref="inputCB" id="navegador" name="navegador" type="text" x-model="searchIva"
                class="rounded-full px-4 py-2 w-full bg-white text-black border border-gray-300 focus:outline-none focus:border-blue-500">
        </div>
        <div> 
            <button @click="ventanaNuevoIva = true">
                <i class="fa-solid fa-pen-to-square fa-3x px-4 pb-2 pt-4 mb-3 bg-blue-400"></i>
            </button>
        </div>
        <table class="min-w-full bg-white border">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">QTY</th>
                        <th class="py-2 px-4 border-b"></th>
                        <th class="py-2 px-4 border-b"></th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="iva in buscarPorNombreIva()" :key="iva.id">
                        <tr>
                            <td class="py-2 px-4 border-b" x-text="iva.qty + '%'"></td>
                            <td class="py-2 px-4 border-b">
                                <button @click="updateIvaFiltrado(iva.id, iva.qty); ventanaEditarIva= true" class="text-blue-500">Editar</button>
                            </td>
                            <td class="py-2 px-4 border-b">
                                <button @click="$wire.dropIva(iva.id);" class="text-blue-500">Borrar</button>
                            </td>
                        </tr>
                    </template>
                </tbody>
        </table>
        {{-- VENTANA NUEVO IVA --}}
        <div x-show="ventanaNuevoIva" x-data="{
            qty: '',
            imagen: '',
            }" class="fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 flex justify-center items-center">
            <div class="bg-white p-8 rounded-lg flex flex-col">
                <div class="uppercase text-xl font-bold mb-4">
                    Nuevo IVA
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">QTY*</label>
                        <input type="text" id="qty" name="qty" x-model="qty" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                </div>
                <div class="flex justify-end">
                    <button class="boton" @click="
                        $wire.crearIva(qty);
                        ventanaNuevoIva = false;">Guardar</button>
                </div>
            </div>
        </div>
        {{-- VENTANA EDITAR IVA --}}
        <div x-show="ventanaEditarIva" class="fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 flex justify-center items-center">
            <div class="bg-white p-8 rounded-lg flex flex-col">
                <div class="uppercase text-xl font-bold mb-4">
                    Nuevo IVA
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">QTY*</label>
                        <input type="text" id="qtyIva" name="qtyIva" x-model="qtyIva" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                </div>
                <div class="flex justify-end">
                    <button class="boton" @click="
                        $wire.actualizarIva(idIva, qtyIva);
                        ventanaEditarIva = false;">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>