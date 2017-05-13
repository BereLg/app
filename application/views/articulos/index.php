<!DOCTYPE html>
<html>
<head>
<title>aplicacion-ejemplo</title>

</head>
<body>
<h1>Aplicacion dinamica con codeIgniter</h1>
 <table class="table table-bordered">
	            	<thead>
	            		<tr>
	            		    <th >id_articulo</th>
	            			<th >nombre_articulo</th>
	            			            		
	            		</tr>
	            	</thead>
	                        	
    <tbody>
       <?php foreach($articulos as $item): ?>
          <tr>
             <td style="width: 35%"> <?php echo $item->id_articulo ?> </td>
             <td style="width: 35%"> <?php echo $item->nombre_articulo ?> </td>
             <td> 
               
       <?php endforeach; ?>
    </tbody>
 </table>
	            	   
	                 
<hr>
</body>
</html>