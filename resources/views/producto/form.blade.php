<div class="form-group row">
    <label class="col-md-3 form-control-label" for="titulo">Categoría</label>
    <div class="col-md-9">
        <select class="form-control" id="id" name="id" required>
            <option value="0" disabled>Seleccione</option>
            @foreach($categorias as $cat)
                <option value="{{$cat->id}}">{{$cat->nombre}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="codigo">Codigo</label>
    <div class="col-md-9">
    <input type="number" name="codigo" id="codigo" class="form-control" 
    pattern="[0,9]{0,15}" required placeholder="Ingrese el codigo">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Nombre</label>
    <div class="col-md-9">
    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese el nombre"
    required pattern="^[a-zA-Z_áéíóúñ\s]{*,100}$">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="precio_venta">Precio de venta</label>
    <div class="col-md-9">
    <input type="number" name="precio_venta" id="precio_venta" class="form-control" placeholder="Ingrese el precio de venta">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="stock">Stock</label>
    <div class="col-md-9">
    <input type="text" name="stock" id="stock" class="form-control" placeholder="Ingrese el Stock" disabled>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="imagen">Imagen</label>
    <div class="col-md-9">
    <input type="file" name="imagen" id="imagen" class="form-control">
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times fa-2x"></i> Cerrar</button>
    <button type="submit" class="btn btn-success"><i class="fa fa-save fa-2x"></i> Guardar</button>
</div>