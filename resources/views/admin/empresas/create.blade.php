
@extends('adminlte::master')

@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home') )

@if (config('adminlte.use_route_url', false))
    @php( $dashboard_url = $dashboard_url ? route($dashboard_url) : '' )
@else
    @php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body'){{ ($auth_type ?? 'login') . '-page' }}@stop

@section('body')
    <div class="container">

        {{-- Logo --}}
        <div class="{{ $auth_type ?? 'login' }}-logo">
            <a href="{{ $dashboard_url }}">

                {{-- Logo Image --}}
                @if (config('adminlte.auth_logo.enabled', false))
                    <img src="{{ asset(config('adminlte.auth_logo.img.path')) }}"
                         alt="{{ config('adminlte.auth_logo.img.alt') }}"
                         @if (config('adminlte.auth_logo.img.class', null))
                            class="{{ config('adminlte.auth_logo.img.class') }}"
                         @endif
                         @if (config('adminlte.auth_logo.img.width', null))
                            width="{{ config('adminlte.auth_logo.img.width') }}"
                         @endif
                         @if (config('adminlte.auth_logo.img.height', null))
                            height="{{ config('adminlte.auth_logo.img.height') }}"
                         @endif>
                @else
                    <img src="{{ asset(config('adminlte.logo_img')) }}"
                         alt="{{ config('adminlte.logo_img_alt') }}" height="50">
                @endif

                {{-- Logo Label --}}
                {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}

            </a>
        </div>

    <div class="row">
        <div class="col-md-12">
        {{-- Card Box --}}
        <div class="card {{ config('adminlte.classes_auth_card', 'card-outline card-primary') }}" style="Box-Shadow: 5px 0px 30px 0px #6600A1ff">

            
            <div class="card-header {{ config('adminlte.classes_auth_header', '') }}">
                <h3 class="card-title float-none text-center">
                    <b>Registro de una nueva empresa<b>
                </h3>
            </div>
            

            {{-- Card Body --}}
            <div class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }}">
                <form action="">
                    <div class="row"> 
                        <div class="col-md-3">
                            <div class="form-group">
                                <label name="logo">Logo</label>
                                <input type="file" id="file" name="logo" class="form-control">

                                <br>

                                <center><output id="list"></output></center>

                                <script>
                                    function archivo(evt){
                                        var files = evt.target.files; //file List objet
                                        //Obtenemos la imagen del campo "file"
                                            for(var i = 0, f; f = files[i]; i++ ){
                                                //solo admitimos imagenes
                                                if(!f.type.match('image.*')){
                                                    continue;
                                                }
                                                var reader = new FileReader();
                                                reader.onload = (function (theFile){
                                                return function (e) {
                                                //insertamos la imagen
                                                document.getElementById("list").innerHTML = ['<img class="thumb thumbail" src="',e.target.result,'" widtch="30%" title="',escape(theFile.name),'"/>'].join('');
                                                };
                                                })(f);
                                                reader.readAsDataURL(f);

                                            }

                                            }
                                        document.getElementById('file').addEventListener('change', archivo, false);
                                    </script>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="row"> <!-- Inicio Fila 1 -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="select_pais">País</label>
                                            <select name="select_pais" id="select_pais" class="form-control">
                                                @foreach($paises as $paise)
                                                    <option value="{{ $paise->name }}">{{ $paise->name }}</option>
                                                @endforeach
                                            </select>

                                            <div id="respuesta_pais">

                                            </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="departamento">Provincia/Estado</label>
                                        <select name="estado" id="" class="form-control">
                                            @foreach($estados as $estado)
                                                <option value="{{ $estado->name }}">{{ $estado->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="ciudad">Ciudad</label>
                                        <select name="ciudad" id="" class="form-control">
                                            {{-- @foreach($ciudades as $ciudade)
                                                <option value="{{ $ciudade->name }}">{{ $ciudade->name }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>

                            </div> <!-- Fin Fila 1 -->

                            <div class="row"> <!-- Inicio Fila 2 -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nombre_empresa">Nombre de la empresa</label>
                                        <input type="text" name="nombre_empresa" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tipo_empresa">Tipo de la empresa</label>
                                        <input type="text" name="nombre_empresa" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nit">NIT</label>
                                        <input type="text" name="nit" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="moneda">Moneda</label>
                                        <select name="moneda" id="" class="form-control">
                                            @foreach($monedas as $moneda)
                                                <option value="{{ $moneda->symbol.' ['.$moneda->code. ']'}}">{{ $moneda->symbol.' ['.$moneda->code . ']' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div> <!-- Fin Fila 2 -->

                            <div class="row"> <!-- Inicio Fila 3 -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nombre_impuesto">Nombre del impuesto</label>
                                        <input type="text" name="nombre_impuesto" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="cantidad_impuesto">Cant. imp. (%)</label>
                                        <input type="number" name="cantidad_impuesto" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="telefono">Teléfonos de la empresa</label>
                                        <input type="text" name="telefono" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="correo">Correo de la empresa</label>
                                        <input type="email" name="correo" class="form-control">
                                    </div>
                                </div>

                            </div> <!-- Fin Fila 3 -->

                            <div class="row"> <!-- Inicio Fila 4 -->
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="direccion">Dirección</label>
                                        <input id="pac-input" class="form-control" name="direccion" type="text" placeholder="Buscar..." required>
                                        <br>
                                        <div id="map" style="width: 100%;height: 400px"></div>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="codigo">Codigo telefonico</label>
                                            <select name="codigo" id="" class="form-control">
                                                @foreach($paises as $paise)
                                                    <option value="{{ $paise->phone_code }}">{{ $paise->phone_code }}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                </div>                                

                            </div> <!-- Fin Fila 4 -->

                        </div>

                    </div> 

                </form>
            </div>

            {{-- Card Footer --}}
            @hasSection('auth_footer')
                <div class="card-footer {{ config('adminlte.classes_auth_footer', '') }}">
                    @yield('auth_footer')
                </div>
            @endif

        </div>
        </div>
    </div>

        

    </div>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
    <script src="https://maps.googleapis.com/maps/api/js?key={{env('MAP_KEY')}}&libraries=places&callback=initAutocomplete"
        async defer></script>

        <script>
            // This example adds a search box to a map, using the Google Place Autocomplete
            // feature. People can enter geographical searches. The search box will return a
            // pick list containing a mix of places and predicted search terms.
        
            // This example requires the Places library. Include the libraries=places
            // parameter when you first load the API. For example:
            // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
        
            function initAutocomplete() {
                var map = new google.maps.Map(document.getElementById('map'), {
                    // Coordenadas de Monterrey, N.L., México
                    center: {lat: 25.685088, lng:-100.327482}, //{lat: -33.8688, lng: 151.2195},
                    zoom: 13,
                    mapTypeId: 'roadmap'
                });
        
                // Create the search box and link it to the UI element.
                var input = document.getElementById('pac-input');
                var searchBox = new google.maps.places.SearchBox(input);
                // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input); // determina la posicion
        
                // Bias the SearchBox results towards current map's viewport.
                map.addListener('bounds_changed', function() {
                    searchBox.setBounds(map.getBounds());
                });
        
                var markers = [];
                // Listen for the event fired when the user selects a prediction and retrieve
                // more details for that place.
                searchBox.addListener('places_changed', function() {
                    var places = searchBox.getPlaces();
        
                    if (places.length == 0) {
                        return;
                    }
        
                    // Clear out the old markers.
                    markers.forEach(function(marker) {
                        marker.setMap(null);
                    });
                    markers = [];
        
                    // For each place, get the icon, name and location.
                    var bounds = new google.maps.LatLngBounds();
                    /*
                     * Para fines de minimizar las adecuaciones debido a que es este una demostración de adaptación mínima de código, se reemplaza forEach por some.
                     */
                    // places.forEach(function(place) {
                    places.some(function(place) {
                        if (!place.geometry) {
                            console.log("Returned place contains no geometry");
                            return;
                        }
                        var icon = {
                            url: place.icon,
                            size: new google.maps.Size(71, 71),
                            origin: new google.maps.Point(0, 0),
                            anchor: new google.maps.Point(17, 34),
                            scaledSize: new google.maps.Size(25, 25)
                        };
        
                        // Create a marker for each place.
                        markers.push(new google.maps.Marker({
                            map: map,
                            icon: icon,
                            title: place.name,
                            position: place.geometry.location
                        }));
        
                        if (place.geometry.viewport) {
                            // Only geocodes have viewport.
                            bounds.union(place.geometry.viewport);
                        } else {
                            bounds.extend(place.geometry.location);
                        }
                        // some interrumpe su ejecución en cuanto devuelve un valor verdadero (true)
                        return true;
                    });
                    map.fitBounds(bounds);
                });
            }
        </script>

    <script>
        $('#select_pais').on('change', function() {
            //alert("hola");
            var pais = $('#select_pais').val();
            //console.log(pais);
            //alert(pais);
            if(pais) {
                
                $.ajax({
                    url: "{{url('/crear-empresa/')}}" + '/' + pais,    
                    type: "GET",
                    
                    success: function(data) {
                        $('#respuesta_pais').html(data);
                    }
                });
                } else {
                alert('Selecciona un pais');
            }

        });
        
    </script>
@stop
