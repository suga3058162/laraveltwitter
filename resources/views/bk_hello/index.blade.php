<html>
<head>
<title>Hello/Index</title>
</head>
<body>
<p>---DB table1のname---</p>
<p>{{ $viewData['user']->name }}</p>
<p>---form test---</p>
<form action="res" method="post">
<input type="input" name="name">
<input type="submit" value="SEND">
<input type="hidden" name="_token" value="{{csrf_token()}}">
</form>
</body>
</html>
