<!DOCTYPE html>
<html>
<head>
	<title>The Recover mail </title>
</head>
<body>
		<h1>Hi, Mr {{ $user->name }}.</h1>
		<p>
			 We have received a request to recover your password, please click this link to complete the recovery process.
			<a href="{{ url('admin/auth/change-password') . '/' . $recover_hash }}"> Recover my password</a>
		</p>
</body>
</html>