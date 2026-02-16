<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Projeto - PDF e texto
    |--------------------------------------------------------------------------
    */
    'project' => [
        'pdf_url' => env('CONEXAO_PROJECT_PDF_URL', '/documents/projeto-conexao-missionaria.pdf'),
        'description' => 'O Conexão Missionária é uma plataforma que aproxima campos missionários e equipes de voluntários, facilitando o encontro entre quem precisa de apoio e quem deseja servir. Aqui você pode cadastrar seu campo ou sua equipe, buscar parceiros e acompanhar as conexões realizadas.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Links - Projetos APMT
    |--------------------------------------------------------------------------
    */
    'apmt_links' => [
        ['label' => 'Site APMT', 'url' => 'https://apmt.org.br', 'icon' => 'bi-globe'],
        ['label' => 'Projetos Missionários', 'url' => '#', 'icon' => 'bi-briefcase'],
        ['label' => 'Documentação', 'url' => '#', 'icon' => 'bi-file-earmark-text'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Links - Formulários e arquivos obrigatórios (voluntários)
    |--------------------------------------------------------------------------
    */
    'volunteer_links' => [
        ['label' => 'Termo de compromisso', 'url' => '#', 'icon' => 'bi-file-signature'],
        ['label' => 'Formulário de inscrição', 'url' => '#', 'icon' => 'bi-person-lines-fill'],
        ['label' => 'Documentos obrigatórios', 'url' => '#', 'icon' => 'bi-folder-check'],
    ],
];
