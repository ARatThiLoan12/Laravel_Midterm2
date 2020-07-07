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
		<form method="post" enctype="multipart/form-data">
			@csrf
		    <br>
		    <input type="" class="form-control" placeholder="Name Product" name="name">
		    <br>
		    <select name="type">
		    	@foreach($type as $types)
		    	<option  value="{!! $types->id!!}">{!! $types->name!!}</option>
		    	@endforeach
		    </select>
		    <br>
		     <input type="" class="form-control" placeholder="Description" name="description">
		    <br>
		     <input type="" class="form-control" placeholder="Price" name="unit_price">
		    <br>
		     <input type="" class="form-control" placeholder="Discount" name="promotion_price">
		    <br>
		    <input type="file" name="myFile" id="myFile">
	    	<br>
	    	<input type="" class="form-control" placeholder="Unit" name="unit">
		    <br>
		    <input type="" class="form-control" placeholder="New " name="new">
		    <br>
		    <button type="submit" class="btn btn-success" name="sub">Submit</button>
		</form>
		
</body>
</html>