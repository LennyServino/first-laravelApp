    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre:</label>
        <input
            type="text"
            class="form-control"
            name="nombre"
            id="nombre"
            value="{{ isset($libro->nombre)?$libro->nombre:old('nombre') }}"
            aria-describedby="helpId"
            placeholder="Nombre del juego"
        />
    </div>
    
    
    <div class="mb-3">
        <label for="url" class="form-label">URL:</label>
        <input
            type="text"
            class="form-control"
            name="url"
            id="url"
            value="{{ isset($libro->url)?$libro->url:old('url') }}"
            aria-describedby="helpId"
            placeholder="URL del juego"
        />
    </div>
    
    <div class="mb-3">
        <label for="imagen" class="form-label">Imagen:</label>
        @if(isset($libro->imagen))
            <br/>
            <img class="img-fluid img-thumbnail" src="{{ asset('storage/'.$libro->imagen) }}" alt="" width="200">
            <br><br>
        @endif
        <input
            type="file"
            class="form-control"
            name="imagen"
            id="imagen"
            placeholder="Seleccione una imagen"
            aria-describedby="fileHelpId"
        />
    </div>
    
    <br/>
    <input class="btn btn-success" type="submit" value="{{ $modo }}">
    <a class="btn btn-primary" href="{{ route('libro.index') }}">Regresar</a>