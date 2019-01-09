<h1>Centro Costos</h1>
<table class="table" id="">
      <tr>
        <td>
        <select class="custom-select" name="categoria_id" id="categoria_id"></select>
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
  <div  style="text-align:center; float:center;margin-bottom: 30px;"><button type="button" class="btn btn-primary" onclick="generarReporteCentroCostos()">Generar</button></div>
  
  <table class="table" id="reporte_centro_costos" style="display:none;">
    
  </table>