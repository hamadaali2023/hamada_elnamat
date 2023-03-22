<!DOCTYPE html>
<html>
<head>
	<title>documnet</title>
</head>
<body>
	<form action="/files" method="post"  enctype="multipart/form-data">
		 @csrf
		<input type="text" name="title" placeholder="title">
		<input type="text" name="description" placeholder="description">
		<input type="file" name="file">
		<input type="submit" value="submit" >
	</form>
</body>
</html>