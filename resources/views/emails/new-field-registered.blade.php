<!DOCTYPE html>
<html>
<head>
    <title>Novo Campo Missionário</title>
</head>
<body>
    <h2>Novo Campo Missionário Cadastrado</h2>
    <p>Um novo campo missionário foi cadastrado no sistema:</p>
    <ul>
        <li><strong>Nome:</strong> {{ $fieldOwner->name }}</li>
        <li><strong>Email:</strong> {{ $fieldOwner->email }}</li>
    </ul>
</body>
</html>
