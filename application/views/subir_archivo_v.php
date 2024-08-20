<?php
$this->session->set_userdata('id_exa_hist',$id_exa_hist);
$this->session->set_userdata('id_consentimiento',$id_consentimiento);
$this->session->set_userdata('id_examen',$id_examen);
?>
<form action="/laboratorio/Clinicos_c/Subir/" method="post" enctype="multipart/form-data">  
<div>
<label for="upload">Selecciona un Examen</label>  
<input name="archivo" type="file" id="archivo" />  
<p>
<input type="submit" name="submit" value="Enviar" />  
</p>
</div>  
</form>