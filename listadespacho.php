
<h1>Despachos</h1>
<form id="compraform" >
<div class="form-group">
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col" >Tools</th>
        <th scope="col">Fecha</th>
      </tr>
    </thead>
    <tbody id="lista_despacho">
      
    </tbody>
  </table>
  <div id="detalle_compra" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">  
            <h5 class="modal-title" id="exampleModalCenterTitle">Despacho</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <table class="table" id="tabla_detalle_lista" >
          </table>
          <div class="modal-footer" id="botones_modificar" style="display:none;">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" onclick="validarUpdateCompra()">Guardar</button>
          </div>
        </div>
      </div>
    <div>
  </div>
  
</div>

</form>