<h1>Comedor</h1>
<table class="table" id="">
      <tr>
        <td>
        <select class="custom-select" name="comedor_id" id="comedor_id"></select>
        </td>  
      </tr>
      <tr>
        <td><select class="custom-select dia_compra" name="dia_compra" id="dia_compra"></select></td>
      </tr>
      <!-- <tr>
        <td>
        <select class="custom-select" name="compra_id" id="compra_id"></select>
        </td>  
      </tr> -->
  </table>
  <div  style="text-align:center; float:center;margin-bottom: 30px;"><button type="button" class="btn btn-primary" onclick="generarReporteComedor()">Generar</button></div>
  
  <table class="table" id="reporte" style="display:none;">
    <thead class="thead-dark"">
      <tr>
        <th scope="col" >Producto</th>
        <th scope="col" >Categoria</th>
        <th scope="col" >Cantidad Por Persona</th>
        <th scope="col">Eventos</th>
        <th scope="col">Total en Cantidad</th>
        <th scope="col">Comensales</th>
        <th scope="col">Total Compra</th>
        <th scope="col">Costos</th>
      </tr>
    </thead>
  </table>