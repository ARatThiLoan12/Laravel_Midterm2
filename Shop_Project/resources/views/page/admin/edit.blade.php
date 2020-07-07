<!DOCTYPE html>
<html>
<head>
	<title>insert</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<style type="text/css">
		form{
			width: 500px;
		}
	</style>
</head>
<body>
	<center>
		<form method="post" enctype="multipart/form-data">
			@csrf
		    <br>
		    <input type="" class="form-control" placeholder="Name Product" name="name" value="{{$product->name}}">
		    <br>
		    
			<input type="" class="form-control" placeholder="id type" name="type" value="{{$product->id_type}}">
		    <br>
		     <input type="" class="form-control" placeholder="Description" name="description" value="{{$product->description}}">
		    <br>
		     <input type="" class="form-control" value="{{$product->unit_price}}" placeholder="Unit Price" name="unit_price">
		    <br>
		     <input type="" class="form-control" value="{{$product->promotion_price}}" placeholder="Promotion Price" name="promotion_price">
		    <br>
		    <input type="file" name="myFile" id="myFile">
	    	<br>
	    	<input type="" class="form-control" value="{{$product->unit}}" placeholder="Unit" name="unit">
		    <br>
		    <input type="" class="form-control" value="{{$product->new}}"placeholder="New " name="new">
		    <br>
		    <button type="submit" class="btn btn-success" name="sub">Submit</button>
		</form>
		
	</center>
</body>
</html>