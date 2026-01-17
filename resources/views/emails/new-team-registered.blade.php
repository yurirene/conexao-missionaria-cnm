<!DOCTYPE html>
<html>
<head>
    <title>Nova Equipe Cadastrada</title>
</head>
<body>
    <h2>Nova Equipe de Voluntários Cadastrada</h2>
    <p>Uma nova equipe de voluntários foi cadastrada no sistema:</p>
    <ul>
        <li><strong>Nome:</strong> {{ $teamOwner->name }}</li>
        <li><strong>Email:</strong> {{ $teamOwner->email }}</li>
    </ul>
</body>
</html>
