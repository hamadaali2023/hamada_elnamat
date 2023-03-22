<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<table>
	<tr>
		<th>sl</th>
		<th>revr</th>
		<th>vdv</th>
		<th>vdf</th>
		<th>vfd</th>
		<th>vfd</th>

	</tr>
	@foreach($file as $key=>$data)

	<tr>
		<td></td>
		<td>{{$data->title}}</td>
		<td>{{$data->title}}</td>
		<td></td>
		<td><a href="/files/{{$data->id}}">view</a></td>
		<td><a href="file/download/{{$data->file}}">download</a></td>

	</tr>
	@endforeach
</table>
</body>
</html>