<!doctype html>
<html>
<head>

</head>

<body>
    <p>Hello Dear,</p>
    <p>You have new message from {{$username??''}}.</p>
    <p><strong>Subject:</strong>  {{$subject??""}}</p>
    <p><strong>Message:</strong>  {{$messageBody??""}}</p>
</body>
</html>