<style type="text/css">	
legend {
    color: #0092e8;
	font-family: Verdana,Geneva,sans-serif;
    font-size: 12px;
    font-weight: bold;   
}
.capa-100{
	border: 1px solid #999999;
    height: 650px;
    margin: 0 auto;
    width: 99.4%;
    float: left;
	}
.capa-50{
	border: 1px solid #999999;
    height: 243px;
    margin: 0 auto;
    width: 49.7%;
    float: left;
	}
	h1.cab{background: url("../../../../../res/icons/activos/cab.png") repeat scroll 0 0 rgba(0, 0, 0, 0);
    border-bottom: 1px dashed #999999;
    color: #333;
    font-size: 13px;
    margin: auto;
    padding: 0.1em;
    text-align: lefth;
	font-family: Verdana,Geneva,sans-serif;}


.cuerpo-form {
  display: inline-block;
  padding-top: 10px;
  margin: 0;
  padding-bottom: 10px;
}
.cuerpo-form-2 {
  display: inline-block;
  padding-top: 10px;
  margin: 0;
  float: left;

}
.tam-100{

display: inline-flex;
}
.tam-95{
	width: 95%;
}
.tam-90{
	width: 90%;
}
.tam-80{
	width: 80%;
}
.tam-70{
	width: 70%;
}
.tam-60{
	width: 60%;
}
.tam-50{
	width: 49.5%;
}
.tam-40{
	width: 40%;
}
.tam-30{
	width: 30%;
}
.tam-20{
	width: 20%;
}
.tam-10{
	width: 10%;
}
.titulo{
	font-family: Verdana,Geneva,sans-serif;
    font-size: 11px;
	font-weight:bold;
	vertical-align:middle;
	color: #0092E8;
}
.pad-left-10{
	padding-left: 10px;
}
.pad-left-20{
	padding-left: 20px;
}
.pad-right-20{
	padding-right:20px;
}
.pad-right-10{
	padding-right:10px;
}
.marg-left-10{
	margin-left: 10px;

}


.texto{  
    height: 22px;
    padding: 3px;
    vertical-align: middle;
    width: 170px;

}
.texto-select{
	height: 27px;
font-family: Verdana, Geneva, sans-serif;
width: 90%;

}
.ui-corner-all{
	margin-left: 10px;
}
.ocultar{display: none;}
.seleccion{
 
/* border:1px solid #000;*/
 padding: 0px;
 width: 100%;
 height: 28px;
}
.seleccion p {
  text-align: left;
  padding-left: 10px;
  margin: 0;
  padding: 0;
  padding-left: 10px;
  padding-top:4px;
}
.dat{
cursor:pointer;
}
.dat:hover{ background:#169F85; color: white; }
}

</style>

<script type="text/javascript">
 $(document).ready(function(){     
    $('.dat').click(function(){
    $('#mostrar_cuentas').modal();
    $('#mostrar_cuentas').find('#codbal').val('0015'); 
    $('#mostrar_cuentas').find('#campo').val($(this).attr('campo')); 
    table('0015',$(this).attr('campo'));
    });
 });    
</script>

<div class="container">
<h1 class="cab">CAPITAL NETO DE TRABAJO</h1>
<div class="tam-100">
 <div  campo="campo1" class="seleccion dat" >
	<p style="width:120px;">Activo Corriente -</p>
 </div>
 <div campo="campo2" class="seleccion dat" >
	<p style="width:430px;">Pasivo Corriente</p>
 </div>
  <div >
	<p style="width:350px; margin-left:50px; margin-top:0px;">Es el capital con el cual cuenta LA COMPAÑIA, para cubrir sus gastos operativos, una vez deducidas sus obligaciones a corto plazo.</p>
 </div>
 </div>
 
 <h1 class="cab">RAZON CORRIENTE</h1>
<div class="tam-100">
 <div  campo="campo1" class="seleccion dat" >
	<p style="width:120px;">Activo Corriente /</p>
 </div>
 <div campo="campo2" class="seleccion dat" >
	<p style="width:430px;">Pasivo Corriente</p>
 </div>
  <div >
	<p style="width:350px; margin-left:50px; margin-top:0px;">Mide la capacidad de LA COMPAÑIA para pagar en el corto plazo lo que debe(Menos de un año).</p>
 </div>
 </div>
 
  <h1 class="cab">RAZON DE ENDEUDAMIENTO ( % )</h1>
<div class="tam-100">
 <div  campo="campo3" class="seleccion dat" >
	<p style="width:133px;">Pasivo Total * 100 /</p>
 </div>
 <div campo="campo4" class="seleccion dat" >
	<p style="width:417px;">Activo Total</p>
 </div>
  <div >
	<p style="width:350px; margin-left:50px; margin-top:0px;">Mide la proporción del total de activos aportados por los acreedores de la COMPAÑIA.</p>
 </div>
 </div>
 
 <h1 class="cab">FONDOS COMUNES ACTIVO ( % )</h1>
<div class="tam-100">
 <div  campo="campo5" class="seleccion dat" >
	<p style="width:165px;">Fondos Comunes * 100 /</p>
 </div>
 <div campo="campo4" class="seleccion dat" >
	<p style="width:385px;">Activo Total</p>
 </div>
  <div >
	<p style="width:350px; margin-left:50px; margin-top:0px;">Mide la proporción del total de los activos aportados por fondos comunes.</p>
 </div>
 </div>
 
  <h1 class="cab">RAZON ACIDA</h1>
<div class="tam-100">

 <div  campo="campo1" class="seleccion dat" >
	<p style="width:125px;">(Activo Corriente  -</p>
 </div>
 <div campo="campo6" class="seleccion dat" >
	<p style="width:85px;">Inventarios  -</p>
 </div>
 <div campo="campo7" class="seleccion dat" >
	<p style="width:220px;">Gastos Pagados por anticipado) /</p>
 </div>
 <div campo="campo2" class="seleccion dat" >
	<p style="width:115px;">Pasivo Corriente</p>
 </div>
  <div >
	<p style="width:350px; margin-left:35px; margin-top:0px;">Mide la capacidad de pago inmediato que tiene la COMPAÑIA para cubir sus obligaciones corrientes. </p>
 </div>
 </div>
 
  <h1 class="cab">RAZON COMPOSICION DEUDA A CORTO PLAZO ( % )</h1>
<div class="tam-100">
 <div  campo="campo2" class="seleccion dat" >
	<p style="width:165px;">(Pasivo Corriente * 100 /</p>
 </div>
 <div campo="campo3" class="seleccion dat" >
	<p style="width:385px;">Pasivo Total)</p>
 </div>
  <div >
	<p style="width:350px; margin-left:50px; margin-top:0px;">Determina que porcentaje de la deuda de LA COMPAÑIA debe ser cancelada en un periodo inferior a un año.</p>
 </div>
 </div>
 
   <h1 class="cab">RAZON COMPOSICION DEUDA A LARGO PLAZO ( % )</h1>
<div class="tam-100">
 <div  campo="campo8" class="seleccion dat" >
	<p style="width:180px;">(Pasivo Largo Plazo * 100 / </p>
 </div>
 <div campo="campo3" class="seleccion dat" >
	<p style="width:370px;">Pasivo Total)</p>
 </div>
  <div >
	<p style="width:350px; margin-left:50px; margin-top:0px;">Determina que porcentaje de la deuda de LA COMPAÑIA debe ser cancelada en un periodo superior a un año.</p>
 </div>
 </div>
 
 <h1 class="cab">INDICE DE SOLIDEZ</h1>
<div class="tam-100">
 <div  campo="campo4" class="seleccion dat" >
	<p style="width:100px;">(Activo Total /</p>
 </div>
 <div campo="campo3" class="seleccion dat" >
	<p style="width:450px;">Pasivo Total)</p>
 </div>
  <div >
	<p style="width:350px; margin-left:50px; margin-top:0px;">La consistencia financiera de LA COMPAÑIA, es de $,,,, por cada peso adeudado.</p>
 </div>
 </div>
 
 <h1 class="cab">RENTABILIDAD SOBRE LOS INGRESOS ( % )</h1>
<div class="tam-100">
 <div  campo="campo9" class="seleccion dat" >
	<p style="width:235px;">(Excedentes de la Operacion * 100 /</p>
 </div>
 <div campo="campo10" class="seleccion dat" >
	<p style="width:315px;">Ingresos Totales)</p>
 </div>
  <div >
	<p style="width:350px; margin-left:50px; margin-top:0px;">Porcentaje de los excedentes sobre cada peso de ingreso.</p>
 </div>
 </div>
 
 <h1 class="cab">RENTABILIDAD SOBRE LOS ACTIVOS ( % )</h1>
<div class="tam-100">
 <div  campo="campo9" class="seleccion dat" >
	<p style="width:235px;">(Excedentes de la Operacion * 100 /</p>
 </div>
 <div campo="campo4" class="seleccion dat" >
	<p style="width:315px;">Activo Total)</p>
 </div>
  <div >
	<p style="width:350px; margin-left:50px; margin-top:0px;">Porcentaje de los excedentes que genera LA COMPAÑIA sobre su activo total.</p>
 </div>
 </div>

</div>

<?php include('buscarCuentas_v.php'); ?>