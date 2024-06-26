<div id="gestion" class="h-screen flex flex-col"
    x-data="{
        showInventario: true,
        showEmpleados: false,
        showCajas: false,
        showCategorias: false,
        showIvas: false,
        showEmpresas: false,
        ventanaNuevoProducto: false,
        ventanaEditarProducto: false,
        ventanaNuevaCategoria: false,
        ventanaEditarCategoria: false,
        ventanaNuevoIva: false,
        ventanaEditarIva: false,
        ventanaNuevaCaja: false,
        ventanaEditarCaja: false,
        ventanaNuevoEmpleado: false,
        ventanaEditarEmpleado: false,
        ventanaNuevoEmpresa: false,
        ventanaEditarEmpresa: false,
        productos: @entangle('productos'),
        categorias: @entangle('categorias'),
        ivas: @entangle('iva'),
        cajas: @entangle('caja'),
        users: @entangle('user'),
        empresas: @entangle('empresa'),
        terceros: @entangle('tercero'),
        idProd: '',
        nombreProd: '',
        precioProd: '',
        imagenProd: '',
        iva_idProd: '',
        categoria_idProd: '',
        stockProd: '',
        estadoProd: '',
        privilegiosEmpleado: '',
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
        searchEmpleado: '',
        searchEmpresa: '',

        buscarPorNombreEmpresa(){
            let clientsWithOrders = Object.values(this.empresas);

            const normalize = (string) => string.trim().toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '')
            const normalizeNumber = (string) => string.toString().trim().toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '')
            if(this.searchEmpresa) {
                let searchEmpresa = normalize(this.searchEmpresa)

                clientsWithOrders = clientsWithOrders.filter((empresa) => normalize(empresa.name).includes(searchEmpresa))
            }
            
            return clientsWithOrders;
        
        
        },
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
        
        buscarPorNombreEmpleado(){
        
            let clientsWithOrders = Object.values(this.users);

            const normalize = (string) => string.trim().toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '')
            const normalizeNumber = (string) => string.toString().trim().toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '')
            if(this.searchBox) {
                let searchBox = normalize(this.searchBox)

                clientsWithOrders = clientsWithOrders.filter((users) => normalize(users.name).includes(searchBox))
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
        updateEmpleadoFiltrado(id, name, email, privilegios,puesto_empresa, imagen_url, password){
            this.idEmpleado = id;
            this.nameEmpleado = name;
            this.emailEmpleado = email;
            this.privilegiosEmpleado = privilegios;
            this.puestoEmpleado = puesto_empresa;
            this.imagenEmpleado = imagen_url;
            this.passwordEmpleado = password;
        }
    }">

    {{-- NAVEGADOR --}}
    <div class="w-full bg-gray-100 flex justify-around fixed top-0 left-0 z-10">
        <div class="my-2 text-center cursor-pointer">
            <a href="{{ route('tpv') }}" class="text-blue-500 fa-solid fa-cash-register fa-2x "></a>
        </div>
        
        <div class="my-2 text-center cursor-pointer"
            :class="{ 'border-b-2 border-black': showInventario }"
            @click="showInventario = true; showEmpleados = false; showCategorias = false; showCajas = false; showIvas = false; showEmpresas=false;">
            <p class="mx-2">Inventario</p>
        </div>
        <div class="my-2 text-center cursor-pointer"
            :class="{ 'border-b-2 border-black': showEmpleados }"
            @click="showInventario = false; showEmpleados = true; showCategorias = false; showCajas = false; showIvas = false; showEmpresas=false;">
            <p class="mx-2">Empleados</p>
        </div>
        <div class="my-2 text-center cursor-pointer"
            :class="{ 'border-b-2 border-black': showCategorias }"
            @click="showInventario = false; showEmpleados = false; showCategorias = true; showCajas = false; showIvas = false; showEmpresas=false;">
            <p class="mx-2">Categorias</p>
        </div>
        <div class="my-2 text-center cursor-pointer"
            :class="{ 'border-b-2 border-black': showIvas }"
            @click="showInventario = false; showEmpleados = false; showCategorias = false; showCajas = false; showIvas = true; showEmpresas=false;">
            <p class="mx-2">Ivas</p>
        </div>
        <div class="my-2 text-center cursor-pointer"
            :class="{ 'border-b-2 border-black': showCajas }"
            @click="showInventario = false; showEmpleados = false; showCategorias = false; showCajas = true; showIvas = false; showEmpresas=false;">
            <p class="mx-2">Cajas</p>
        </div>
        <div class="my-2 text-center cursor-pointer"
            :class="{ 'border-b-2 border-black': showEmpresas }"
            @click="showInventario = false; showEmpleados = false; showCategorias = false; showCajas = false; showIvas = false; showEmpresas=true;">
            <p class="mx-2">Empresas</p>
        </div>
    </div>

    {{-- SECCION PRODUCTOS --}}
    <div class="flex-1 pt-16 w-full overflow-y-auto px-4 md:px-8">
        <div x-show="showInventario">
            <x-success-message/>
            <x-error-message/>
            <div class="container mx-auto py-4">
            <div class=" text-white p-4 h-20 flex items-center w-full">
                <div class="bg-blue-400 rounded-full ">
                    <button @click="ventanaNuevoProducto = true">
                        <span class="uppercase text-md">Nuevo Producto</span>
                    </button>
                </div>
                <div class="w-full ml-3">
                <input x-ref="inputCB" id="navegador" name="navegador" type="text" x-model="search"
                    class="rounded-full px-4 py-2 w-full bg-white text-black border border-gray-300 focus:outline-none focus:border-blue-500"> 
                </div>    
            </div>

            <div class="overflow-x-auto">
            <table class="min-w-full bg-white border text-left">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Imagen</th>
                        <th class="py-2 px-4 border-b">Nombre</th>
                        <th class="py-2 px-4 border-b">Precio</th>
                        <th class="py-2 px-4 border-b">IVA</th>
                        <th class="py-2 px-4 border-b">Categoria</th>
                        <th class="py-2 px-4 border-b">Stock</th>
                        <th class="py-2 px-4 border-b">Estado</th>
                        <th class="py-2 px-4 border-b">Editar</th>
                        <th class="py-2 px-4 border-b">Borrar</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="producto in buscarPorNombre()" :key="producto.id">
                        <tr>
                            <td class="py-2 px-4 border-b text-right">
                                <img :src="'{{ asset('storage/') }}' + '/' + producto.imagen_url" alt="Foto del producto" class="h-12 w-12 object-cover">
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
                                <button @click="updateProductoFiltrado(producto.id, producto.nombre, producto.precio, producto.imagen_url, producto.iva_id, producto.categoria_id, producto.stock, producto.se_vende); ventanaEditarProducto = true;" class="text-blue-500">Editar</button>
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
                <div class="flex items-center mb-4">
                    <button class="text-xl font-bold mr-2" @click="ventanaEditarProducto = false;">
                        <i class="fa-solid fa-angle-left fa-2x px-4 pb-2 pt-4 mb-3"></i>
                    </button>
                    <div class="uppercase text-xl font-bold">
                        Edición Producto
                    </div>
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
                    <input type="file" wire:model="imagen" accept="image/*" class="mt-1 block w-full">
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
        <div x-show="ventanaNuevoProducto">
            <div x-show="ventanaNuevoProducto" class="fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 flex justify-center items-center">
                <div class="bg-white p-8 rounded-lg flex flex-col">
                    <div class="flex items-center mb-4">
                        <button class="text-xl font-bold mr-2" @click="ventanaNuevoProducto = false;">
                            <i class="fa-solid fa-angle-left fa-2x px-4 pb-2 pt-4 mb-3"></i>
                        </button>
                        <div class="uppercase text-xl font-bold">
                            Nuevo Producto
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nombre*</label>
                            <input type="text" x-model="$wire.nombre" class="mt-1 block w-full">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Precio*</label>
                            <input type="text" x-model="$wire.precio" class="mt-1 block w-full">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">IVA</label>
                            <select x-model="$wire.iva_id" class="mt-1 block w-full">
                                <option value="" disabled selected>Seleccione IVA</option>
                                <template x-for="iva in ivas" :key="iva.id">
                                    <option :value="iva.id" x-text="iva.qty + '%'"></option>
                                </template>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Categoría</label>
                            <select x-model="$wire.categoria_id" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <option value="" disabled selected>Seleccione Categoría</option>
                                <template x-for="categoria in categorias" :key="categoria.id">
                                    <option :value="categoria.id" x-text="categoria.nombre"></option>
                                </template>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Stock</label>
                            <input type="text" x-model="$wire.stock" class="mt-1 block w-full">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Estado</label>
                            <select x-model="$wire.estado" class="mt-1 block w-full">
                                <option value="">Seleccione Estado</option>
                                <option value="1">Habilitado</option>
                                <option value="0">Deshabilitado</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Imagen</label>
                            <input type="file" wire:model="imagen" accept="image/*" class="mt-1 block w-full">
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button class="btn" @click="$wire.crearProducto(); ventanaNuevoProducto=false;">Guardar</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- SECCION EMPLEADOS --}}
    <div x-show="showEmpleados">
        <x-success-message/>
        <x-error-message/>
        <div class=" text-white p-4 h-20 flex items-center w-full">
            <div class="bg-blue-400 rounded-full">
                <button @click="ventanaNuevoEmpleado = true">
                    <span class="uppercase text-md">Nuevo Empleado</span>
                </button>
            </div>

            <div class="w-full ml-3">
                <input x-ref="inputCB" id="navegador" name="navegador" type="text" x-model="searchBox"
                    class="rounded-full px-4 py-2 w-full bg-white text-black border border-gray-300 focus:outline-none focus:border-blue-500"
                    @input="buscarPorNombreEmpleado()">
            </div>

        </div>        
        <table class="min-w-full bg-white border text-left">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Imagen</th>
                        <th class="py-2 px-4 border-b">Nombre</th>
                        <th class="py-2 px-4 border-b">Correo</th>
                        <th class="py-2 px-4 border-b">Privilegios</th>
                        <th class="py-2 px-4 border-b">Puesto</th>
                        <th class="py-2 px-4 border-b">Editar</th>
                        <th class="py-2 px-4 border-b">Borrar</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="users in buscarPorNombreEmpleado()" :key="users.id">
                        <tr>
                            <td class="py-2 px-4 border-b">
                                <img :src="'{{ asset('storage/') }}' + '/' + users.imagen_url" alt="Foto del empleado" class="h-12 w-12 object-cover">
                            </td>
                            <td class="py-2 px-4 border-b" x-text="users.name"></td>
                            <td class="py-2 px-4 border-b" x-text="users.email"></td>
                            <td class="py-2 px-4 border-b" x-text="users.privilegios === 0 ? 'Empleado' : 'Manager'"></td>
                            <td class="py-2 px-4 border-b" x-text="users.puesto_empresa"></td>
                            <td class="py-2 px-4 border-b">
                                <button @click="updateEmpleadoFiltrado(users.id, users.name, users.email, users.privilegios, users.puesto_empresa, users.imagen_url, users.password); ventanaEditarEmpleado= true" class="text-blue-500">Editar</button>
                            <td class="py-2 px-4 border-b">
                                <button @click="$wire.dropEmpleado(users.id);" class="text-blue-500">Borrar</button>
                            </td>
                        </tr>
                    </template>
                </tbody>
        </table>

        {{-- VENTANA EDITAR EMPLEADO --}}
        <div x-show="ventanaEditarEmpleado" x-data="{}" 
            class="fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 flex justify-center items-center">
            <div class="bg-white p-8 rounded-lg flex flex-col">
                <div class="flex items-center mb-4">
                    <button class="text-xl font-bold mr-2" @click="ventanaEditarEmpleado = false;">
                        <i class="fa-solid fa-angle-left fa-2x px-4 pb-2 pt-4 mb-3"></i>
                    </button>
                    <div class="uppercase text-xl font-bold">
                        Edición Empleado
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" id="nameEmpleado" name="nameEmpleado" x-model="nameEmpleado" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Correo</label>
                        <input type="text" id="emailEmpleado" name="emailEmpleado" x-model="emailEmpleado" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Permisos</label>
                            <select x-model="privilegiosEmpleado" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <option value="" disabled selected></option>
                                <option value="1">Admin</option>
                                <option value="0">Usuario</option>
                            </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Puesto</label>
                        <input type="text" id="puestoEmpleado" name="puestoEmpleado" x-model="puestoEmpleado" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Imagen</label>
                        <input type="file" wire:model="imagen_empleado" accept="image/*" class="mt-1 block w-full">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Contraseña</label>
                        <input type="text" id="passwordEmpleado" name="passwordEmpleado" x-model="passwordEmpleado" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                </div>
                <div class="flex justify-end">
                    <button class="boton" @click="
                        $wire.actualizarEmpleado(idEmpleado, nameEmpleado, emailEmpleado, passwordEmpleado,privilegiosEmpleado,imagenEmpleado,puestoEmpleado);
                        ventanaEditarEmpleado = false;">Guardar</button>
                </div>
            </div>
        </div>

        {{-- VENTANA NUEVO EMPLEADO --}}
        <div x-show="ventanaNuevoEmpleado">
            <div x-show="ventanaNuevoEmpleado" class="fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 flex justify-center items-center">
                    <div class="bg-white p-8 rounded-lg flex flex-col">
                        <div class="flex items-center mb-4">
                            <button class="text-xl font-bold mr-2" @click="ventanaNuevoEmpleado = false;">
                                <i class="fa-solid fa-angle-left fa-2x px-4 pb-2 pt-4 mb-3"></i>
                            </button>
                            <div class="uppercase text-xl font-bold">
                                Nuevo Empleado
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nombre*</label>
                                <input type="text" x-model="$wire.name" class="mt-1 block w-full">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email*</label>
                                <input type="text" x-model="$wire.email" class="mt-1 block w-full">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Privilegios*</label>
                                <input type="number" x-model="$wire.privilegios" class="mt-1 block w-full">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Puesto*</label>
                                <input type="text" x-model="$wire.puesto_empresa" class="mt-1 block w-full">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Imagen</label>
                                <input type="file" wire:model="imagen_empleado" accept="image/*" class="mt-1 block w-full">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Contraseña*</label>
                                <input type="text" x-model="$wire.password" class="mt-1 block w-full">
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button class="btn" @click="$wire.crearEmpleado(); ventanaNuevoEmpleado=false;">Guardar</button>

                        </div>
                    </div>
                </div>

        </div>


    </div>    
    {{-- SECCION CAJAS --}}
    <div x-show="showCajas">
        <x-success-message/>
        <x-error-message/>

        
        <div class=" text-white p-4 h-20 flex items-center w-full">
                <div class="bg-blue-400 rounded-full">
                    <button @click="ventanaNuevaCaja = true">
                        <span class="uppercase text-md">Nueva Caja</span>
                    </button>
                </div>

                <div class="w-full ml-3">
                    <input x-ref="inputCB" id="navegador" name="navegador" type="text" x-model="searchBox"
                    class="rounded-full px-4 py-2 w-full bg-white text-black border border-gray-300 focus:outline-none focus:border-blue-500">
                
                </div>
        </div>

        <table class="min-w-full bg-white border text-left">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Nombre</th>
                        <th class="py-2 px-4 border-b">Editar</th>
                        <th class="py-2 px-4 border-b">Borrar</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="caja in buscarPorNombreCaja()" :key="caja.id">
                        <tr>
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
                <div class="flex items-center mb-4">
                    <button class="text-xl font-bold mr-2" @click="ventanaEditarCaja = false;">
                        <i class="fa-solid fa-angle-left fa-2x px-4 pb-2 pt-4 mb-3"></i>
                    </button>
                    <div class="uppercase text-xl font-bold">
                        Edición Caja
                    </div>
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
        <div x-show="ventanaNuevaCaja"
                class="fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 flex justify-center items-center">
                <div class="bg-white p-8 rounded-lg flex flex-col">
                  <div class="flex items-center mb-4">
                    <button class="text-xl font-bold mr-2" @click="ventanaNuevaCaja = false;">
                          <i class="fa-solid fa-angle-left fa-2x px-4 pb-2 pt-4 mb-3"></i>
                     </button>
                      <div class="uppercase text-xl font-bold">
                        nueva Caja
                      </div>
                  </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nombre*</label>
                            <input type="text" x-model="$wire.cajaName" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button class="boton" @click="$wire.crearCaja(); ventanaNuevaCaja = false;">Guardar</button>
                    </div>
                </div>
         </div>
    </div>
    {{-- SECCION CATEGORIA --}}
    <div x-show="showCategorias">
            <x-success-message/>
            <x-error-message/>
            <div class=" text-white p-4 h-20 flex items-center w-full">
                        <div class="bg-blue-400 rounded-full">
                            <button @click="ventanaNuevaCategoria = true">
                                <span class="uppercase text-md">Nueva Categoria</span>
                            </button>
                        </div>

                        <div class="w-full ml-3">
                            <input x-ref="inputCB" id="navegador" name="navegador" type="text" x-model="searchCategory"
                                class="rounded-full px-4 py-2 w-full bg-white text-black border border-gray-300 focus:outline-none focus:border-blue-500">
                        </div>
            </div>
            <table class="min-w-full bg-white border text-left">
                    <thead>
                        <tr>
                        {{-- <th class="py-2 px-4 border-b">Imagen</th> --}}
                            <th class="py-2 px-4 border-b">Nombre</th>
                            <th class="py-2 px-4 border-b">Editar</th>
                            <th class="py-2 px-4 border-b">Borrar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="categoria in buscarPorNombreCategoria" :key="categoria.id">
                            <tr>
                            {{-- <td class="py-2 px-4 border-b">
                                    <img :src="'{{ asset('storage/') }}' + '/' + categoria.imagen_url" alt="Foto del producto" class="h-12 w-12 object-cover">
                                </td> --}}
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
                    <div class="flex items-center mb-4">
                        <button class="text-xl font-bold mr-2" @click="ventanaEditarCategoria = false;">
                            <i class="fa-solid fa-angle-left fa-2x px-4 pb-2 pt-4 mb-3"></i>
                        </button>
                        <div class="uppercase text-xl font-bold">
                            Edición Categoria
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nombre</label>
                            <input type="text" id="nombreCategoria" name="nombreCategoria" x-model="nombreCategoria" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        {{-- <div>
                            <label class="block text-sm font-medium text-gray-700">Imagen</label>
                            <input type="text" id="imagenCategoria" name="imagenCategoria" x-model="imagenCategoria" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div> --}}
                    </div>
                    <div class="flex justify-end">
                        <button class="boton" @click="
                            $wire.actualizarCategoria(idCategoria, nombreCategoria, imagenCategoria);
                            ventanaEditarCategoria = false;">Guardar</button>
                    </div>
                </div>
            </div>
            {{-- VENTANA NUEVA CATEGORIA --}}
            <div x-show="ventanaNuevaCategoria" x-data="{ nombre: '', imagen: '' }" class="fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 flex justify-center items-center">
                <div class="bg-white p-8 rounded-lg flex flex-col">
                    <div class="flex items-center mb-4">
                        <button class="text-xl font-bold mr-2" @click="ventanaNuevaCategoria = false;">
                            <i class="fa-solid fa-angle-left fa-2x px-4 pb-2 pt-4 mb-3"></i>
                        </button>
                        <div class="uppercase text-xl font-bold">
                            Nueva Categoria
                        </div>
                    </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nombre*</label>
                        <input type="text" wire:model="nombreCategoria" class="mt-1 block w-full">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Imagen</label>
                        <input type="file" wire:model="imagenCategoria" accept="image/*" class="mt-1 block w-full">
                    </div>  
                </div>
                <div class="flex justify-end">
                    <button class="boton" @click="$wire.crearCategoria(); ventanaNuevaCategoria = false;">Guardar</button>
                </div>
                </div>
            </div>
        </div>
        

    {{-- SECCION EMPRESAS --}}
    <div x-show="showEmpresas">
        <x-success-message/>
        <x-error-message/>
        <div class=" text-white p-4 h-20 flex items-center w-full">
            <div class="rounded-full bg-blue-400">
                <button @click="ventanaNuevoEmpresa = true">
                    <span class="uppercase text-md">Nueva Empresa</span>
                </button>
            </div>
            <div class="w-full ml-3">
            <input x-ref="inputCB" id="navegador" name="navegador" type="text" x-model="searchEmpresa"
                class="rounded-full px-4 py-2 w-full bg-white text-black border border-gray-300 focus:outline-none focus:border-blue-500">
            </div>
        </div>
        <table class="min-w-full bg-white border text-left">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">ID</th>
                    <th class="py-2 px-4 border-b">Nombre</th>
                    <th class="py-2 px-4 border-b">Dirección</th>
                    <th class="py-2 px-4 border-b">Teléfono</th>
                    <th class="py-2 px-4 border-b">Editar</th>
                    <th class="py-2 px-4 border-b">Borrar</th>

                </tr>
            </thead>
            <tbody>
                <template x-for="empresa in buscarPorNombreEmpresa()" :key="empresa.id">
                    <tr>
                        <td class="py-2 px-4 border-b" x-text="empresa.id"></td>
                        <td class="py-2 px-4 border-b" x-text="empresa.nombre"></td>
                        <td class="py-2 px-4 border-b" x-text="empresa.direccion"></td>
                        <td class="py-2 px-4 border-b" x-text="empresa.telefono"></td>
                        <td class="py-2 px-4 border-b">
                            <button @click="updateEmpresaFiltrada(empresa.id, empresa.nombre, empresa.direccion, empresa.telefono); ventanaEditarEmpresa= true" class="text-blue-500">Editar</button>
                        </td>
                        <td class="py-2 px-4 border-b">
                        <button @click="$wire.dropEmpresa(empresa.id);" class="text-blue-500">Borrar</button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>


        {{-- VENTANA EDITAR EMPRESA --}}
        <div x-show="ventanaEditarEmpresa" x-data="{}" 
            class="fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 flex justify-center items-center">
            <div class="bg-white p-8 rounded-lg flex flex-col">
                <h2 class="text-2xl font-bold mb-4">Editar Empresa</h2>
                <div class="mb-4">
                    <label for="nombreEmpresa" class="block text-gray-700 text-sm font-bold mb-2">Nombre:</label>
                    <input type="text" id="nombreEmpresa" name="nombreEmpresa" x-model="nombreEmpresa"
                        class="rounded-full px-4 py-2 w-full bg-white text-black border border-gray-300 focus:outline-none focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="direccionEmpresa" class="block text-gray-700 text-sm font-bold mb-2">Dirección:</label>
                    <input type="text" id="direccionEmpresa" name="direccionEmpresa" x-model="direccionEmpresa"
                        class="rounded-full px-4 py-2 w-full bg-white text-black border border-gray-300 focus:outline-none focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="telefonoEmpresa" class="block text-gray-700 text-sm font-bold mb-2">Teléfono:</label>
                    <input type="text" id="telefonoEmpresa" name="telefonoEmpresa" x-model="telefonoEmpresa"
                        class="rounded-full px-4 py-2 w-full bg-white text-black border border-gray-300 focus:outline-none focus:border-blue-500">
                </div>
                <div class="flex justify-end">
                    <button class="boton" @click="guardarEmpresa()">Guardar</button>
                </div>
            </div>
        </div> 


        {{-- VENTANA NUEVA EMPRESA --}}
        
        <div x-show="ventanaNuevoEmpresa" class="fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 flex justify-center items-center">
            <div class="bg-white p-8 rounded-lg flex flex-col">
                <div class="flex items mb-4">
                    <button class="text-xl font-bold mr-2" @click="ventanaNuevoEmpresa = false;">
                        <i class="fa-solid fa-angle-left fa-2x px-4 pb-2 pt-4 mb-3"></i>
                    </button>
                    <div class="uppercase text-xl font-bold">
                        Nueva Empresa
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nombre*</label>
                        <input type="text" x-model="$wire.nombreEmpresa" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Dirección*</label>
                        <input type="text" x-model="$wire.direccion" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Provincia*</label>
                        <input type="text" x-model="$wire.provincia" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tercero ID</label>
                        <select x-model="$wire.terceroid" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        <option value="" selected>Seleccione Tercero</option>
                                <template x-for="tercero in terceros" :key="tercero.id">
                                    <option :value="tercero.id" x-text="tercero.nombre"></option>
                                </template>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Teléfono*</label>
                        <input type="text" x-model="$wire.telefono" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email*</label>
                        <input type="text" x-model="$wire.emailEmpresa" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Ruc*</label>
                        <input type="text" x-model="$wire.ruc" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tipo empresa*</label>
                        <input type="text" x-model="$wire.tipoEmpresa" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Actividad económica*</label>
                        <input type="text" x-model="$wire.actividadEconomica" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Ciudad*</label>
                        <input type="text" x-model="$wire.ciudad" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Código Postal*</label>
                        <input type="text" x-model="$wire.codigoPostal" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">CIF*</label>
                        <input type="text" x-model="$wire.nif" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                </div>


                <div class="flex justify-end">
                    <button class="boton" @click="$wire.crearEmpresa(); ventanaNuevoEmpresa = false;">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    {{-- SECCION IVAS --}}
    <div x-show="showIvas">
        <x-success-message/>
        <x-error-message/>
        <div class=" text-white p-4 h-20 flex items-center w-full">
            <div class="bg-blue-400 rounded-full"> 
                <button @click="ventanaNuevoIva = true">
                    <span class="uppercase text-md">Nuevo IVA</span>
                </button>
            </div>

            <div class="w-full ml-3">
                <input x-ref="inputCB" id="navegador" name="navegador" type="text" x-model="searchIva"
                    class="rounded-full px-4 py-2 w-full bg-white text-black border border-gray-300 focus:outline-none focus:border-blue-500">
            </div>
        </div>
        <table class="min-w-full bg-white border text-left">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">QTY</th>
                        <th class="py-2 px-4 border-b">Editar</th>
                        <th class="py-2 px-4 border-b">Borrar</th>
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
        <div x-show="ventanaNuevoIva" class="fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 flex justify-center items-center">
            <div class="bg-white p-8 rounded-lg flex flex-col">
                <div class="flex items-center mb-4">
                    <button class="text-xl font-bold mr-2" @click="ventanaNuevoIva = false;">
                        <i class="fa-solid fa-angle-left fa-2x px-4 pb-2 pt-4 mb-3"></i>
                    </button>
                    <div class="uppercase text-xl font-bold">
                        Nuevo IVA
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">QTY*</label>
                        <input type="text" x-model="$wire.qty" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                </div>
                <div class="flex justify-end">
                    <button class="boton" @click="
                        $wire.crearIva();
                        ventanaNuevoIva = false;">Guardar</button>
                </div>
            </div>
        </div>
        {{-- VENTANA EDITAR IVA --}}
        <div x-show="ventanaEditarIva" class="fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 flex justify-center items-center">
            <div class="bg-white p-8 rounded-lg flex flex-col">
                <div class="flex items-center mb-4">
                    <button class="text-xl font-bold mr-2" @click="ventanaEditarIva = false;">
                        <i class="fa-solid fa-angle-left fa-2x px-4 pb-2 pt-4 mb-3"></i>
                    </button>
                    <div class="uppercase text-xl font-bold">
                        Edición IVA
                    </div>
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
