<!DOCTYPE html>
<html>
<head>
	<title>ADMINISTRATOR</title>
	<style>
        body{
            margin-top: 20px;
            margin-left: 20px;
        }
		td, th {
		  	border: 1px solid #dddddd;
		  	text-align: left;
		  	padding: 10px;
		}
		th{
			
			background-color: green;
		}
		img{
			width: 150px;
			height: 100px;
		}
		.action{
			display: flex;
		}
	</style>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>
<body>
	<a href="admin/insert">
		<button class="btn btn-info">
			<i class="fas fa-plus-circle"> Add new product</i>
		</button>
	</a>
		<table>
			<tr>
				<th>ID</th>
                <th class="image">Image</th>
				<th>Name Product</th>
				<th>Description</th>
				<th>Unit Price</th>
				<th>Promotion Price</th>
				<th>Unit</th>
				<th>Action</th>
			</tr>
			@foreach ( $product as $products)
				<tr>
					<td>{!! $products['id'] !!}</td>
                    <td><img src="source/image/product/{{$products->image}}"></td>
					<td>{!! $products['name'] !!}</td>
					<td>{!! $products['description'] !!}</td>
					<td>{!! $products['unit_price'] !!}</td>
					<td>{!! $products['promotion_price'] !!}</td>
					<td>{!! $products['unit'] !!}</td>
					<td class="action">
						<a href="admin/edit/{!! $products['id'] !!}">
							<button class="btn btn-warning" name="edit" value="{!! $products['id'] !!}"><i class="fas fa-edit"></i></button>
						</a>
						<a href="admin/delete/{!! $products['id'] !!}">
							<button class="btn btn-danger" name="delete" value="{!! $products['id'] !!}"><i class="fas fa-trash"></i></button>
						</a>
					</td>
				</tr>	
			@endforeach
		</table>
</body>
</html>
