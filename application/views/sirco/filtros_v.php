   <style>
        input.form-control {
            height: 27px;
        }
        .inputb{
            width: 90%;
        }

        .imgbuscar {
            padding: 2px 4px !important;
        }

        input.form-control {
            padding: 2px 4px !important;
        }
        #formularios .row .col-md-2, #formularios .row .col-md-1, #formularios .row .col-md-9 {
            height: 30px;
        }  
    </style> 

                   <div class="form-group">
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <label> Fechas: </label>
                            <input type="text" id="fecini" class="form-control fecha" name="fecini" value="<?php echo date("Y-m-d"); ?>">
                        </div>
                    </div>

                     <div class="col-md-2">
                     <div class="input-group">
					  <label> Cuentas: </label>
                     <input type="text" id="codnif" name="codnif" class="form-control">
                     <span class="input-group-btn" >
                     <button type="button" style="margin-top: 25px;" class="btn btn-primary imgbuscar" id="imgbuscar" vista="#cuentas_niif_detallea" >
					 <i class="fa fa-search" aria-hidden="true"></i></button></span>
					 </div>
					 </div>

                    <div class="col-md-2">
                     <div class="input-group">
					  <label> Terceros: </label>
                     <input type="text" id="codtrc" name="codtrc" class="form-control">
                     <span class="input-group-btn" >
                     <button type="button" style="margin-top: 25px;" class="btn btn-primary imgbuscar" id="imgbuscar" vista="#busquedatercerosa" >
					 <i class="fa fa-search" aria-hidden="true"></i></button></span>
					 </div>
					 </div>
					 
					 <div class="col-md-2">
                     <div class="input-group">
					  <label> Centro Costos: </label>
                     <input type="text" id="codcts" name="codcts" class="form-control">
                     <span class="input-group-btn" >
                     <button type="button" style="margin-top: 25px;" class="btn btn-primary imgbuscar" id="imgbuscar" vista="#centros_costosa" >
					 <i class="fa fa-search" aria-hidden="true"></i></button></span>
					 </div>
					 </div>
					 
					 <div class="col-md-2">
                     <div class="input-group">
					 <label> Auxiliares: </label>
                     <input type="text" id="codaux" name="codaux" class="form-control">
                     <span class="input-group-btn" >
                     <button type="button" style="margin-top: 25px;" class="btn btn-primary imgbuscar" id="imgbuscar" vista="#auxiliaresa" >
					 <i class="fa fa-search" aria-hidden="true"></i></button></span>
					 </div>
					 </div>
					 
					  <div class="col-md-2">
                     <div class="input-group">
					 <label> Rp: </label>
                     <input type="text" id="codirp" name="codirp" class="form-control">
                     <span class="input-group-btn" >
                     <button type="button" style="margin-top: 25px;" class="btn btn-primary imgbuscar" id="imgbuscar" vista="#" >
					 <i class="fa fa-search" aria-hidden="true"></i></button></span>
					 </div>
					 </div>
					 
					 <div class="form-group">
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <input type="text" id="fecfin" class="form-control fecha" name="fecfin" value="<?php echo date("Y-m-d"); ?>">
                        </div>
                    </div>

                     <div class="col-md-2">
                     <div class="input-group">
                     <input type="text" id="codnifb" name="codnifb" class="form-control">
                     <span class="input-group-btn" >
                     <button type="button" class="btn btn-primary imgbuscar" id="imgbuscar" vista="#cuentas_niif_detalleb" >
					 <i class="fa fa-search" aria-hidden="true"></i></button></span>
					 </div>
					 </div>

                    <div class="col-md-2">
                     <div class="input-group">
                     <input type="text" id="codtrcb" name="codtrcb" class="form-control">
                     <span class="input-group-btn" >
                     <button type="button" class="btn btn-primary imgbuscar" id="imgbuscar" vista="#busquedatercerosb" >
					 <i class="fa fa-search" aria-hidden="true"></i></button></span>
					 </div>
					 </div>
					 
					 <div class="col-md-2">
                     <div class="input-group">
                     <input type="text" id="codctsb" name="codctsb" class="form-control">
                     <span class="input-group-btn" >
                     <button type="button" class="btn btn-primary imgbuscar" id="imgbuscar" vista="#centros_costosb" >
					 <i class="fa fa-search" aria-hidden="true"></i></button></span>
					 </div>
					 </div>
					 
					 <div class="col-md-2">
                     <div class="input-group">
                     <input type="text" id="codauxb" name="codauxb" class="form-control">
                     <span class="input-group-btn" >
                     <button type="button" class="btn btn-primary imgbuscar" id="imgbuscar" vista="#auxiliaresb" >
					 <i class="fa fa-search" aria-hidden="true"></i></button></span>
					 </div>
					 </div>
					 
					  <div class="col-md-2">
                     <div class="input-group">
                     <input type="text" id="codirpb" name="codirpb" class="form-control">
                     <span class="input-group-btn" >
                     <button type="button" class="btn btn-primary imgbuscar" id="imgbuscar" vista="#" >
					 <i class="fa fa-search" aria-hidden="true"></i></button></span>
					 </div>
					 </div>