<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Projeto - PDF e texto
    |--------------------------------------------------------------------------
    */
    'project' => [
        'pdf_url' => env('CONEXAO_PROJECT_PDF_URL', 'https://ump.org.br/images/Projetos/REGULMENTO_DO_CONEXAO_MISSIONARIA.pdf'),
        'description' => 'O Conexão Missionária é uma plataforma que aproxima campos missionários e equipes de voluntários, facilitando o encontro entre quem precisa de apoio e quem deseja servir. Aqui você pode cadastrar seu campo ou sua equipe, buscar parceiros e acompanhar as conexões realizadas.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Links - Projetos APMT
    |--------------------------------------------------------------------------
    */
    'apmt_links' => [
        ['label' => 'Site APMT', 'url' => 'https://apmt.org.br', 'icon' => 'bi-globe'],
        ['label' => 'Viagens de Curto Prazo', 'url' => 'https://apmt.org.br/vcp/', 'icon' => 'bi-briefcase'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Links - Formulários e arquivos obrigatórios (voluntários)
    |--------------------------------------------------------------------------
    */
    'volunteer_links' => [
        ['label' => 'Termo de LGPD', 'url' => 'https://docs.google.com/document/d/1Pqn9A45RIolakOcmFNPo0k1PB8E4cd6TyFL4Hfv4g9k/edit?usp=sharing', 'icon' => 'bi-file-earmark-text'],
        ['label' => 'Exemplo de Formulário de inscrição', 'url' => 'https://docs.google.com/forms/d/e/1FAIpQLScSDduiAD2XD4vpNkXngr2H75NxNP_toR0gKHA6uXw6ZT_Atw/viewform', 'icon' => 'bi-person-lines-fill'],
        ['label' => 'Exemplo de Planejamento', 'url' => 'https://docs.google.com/document/d/18B0lsShHTlYt7Gl72iay_F710KdCN90XEb9o3dS_IJs/edit?tab=t.0#heading=h.t2oly7juuump', 'icon' => 'bi-file-earmark-text'],
        ['label' => 'Carta de Recomendação', 'url' => 'https://docs.google.com/document/d/134Exxq46eemf6XFgY8BcQa8j2SdUPcwS2VbuL4OPdTc/edit?tab=t.0', 'icon' => 'bi-file-earmark-text'],
    ],
];
