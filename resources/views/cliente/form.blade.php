<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nom">Cliente</label>
    <div class="col-md-9">
        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese nombre del cliente"
        required pattern="^[a-z-A-Z_áéíóúñ\s]{0,30}$">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="ced">Tipo de Documento</label>
    <div class="col-md-9">
        <select class="form-control" name="tipo_documento" id="tipo_documento">
            <option value="0" disabled> Seleccione </option>
            <option value="DNI" > DNI </option>
            <option value="CEDULA"> CEDULA </option>
        </select>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nom">Numero de Documento</label>
    <div class="col-md-9">
        <input type="text" name="num_documento" id="num_documento" class="form-control" placeholder="Ingrese numero de documento"
        required pattern="[0-9]{0,15}">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="dir">Dirección</label>
    <div class="col-md-9">
        <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Ingrese la dirección"
        required pattern="^[a-z-A-Z_áéíóúñ\s]{0,200}$">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nom">Teléfono</label>
    <div class="col-md-9">
        <input type="number" name="telefono" id="telefono" class="form-control" placeholder="Ingrese el telefono"
        required pattern="[0-9]{0,15} ">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nom">Email</label>
    <div class="col-md-9">
        <input type="email" name="email" id="email" class="form-control" placeholder="Ingrese un gmail"
        required>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times fa-2x"></i> Cerrar</button>
    <button type="submit" class="btn btn-success"><i class="fa fa-save fa-2x"></i> Guardar</button>
</div>