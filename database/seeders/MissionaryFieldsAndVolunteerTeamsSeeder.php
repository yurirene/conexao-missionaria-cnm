<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\MissionaryField;
use App\Models\VolunteerTeam;
use App\Models\TeamMember;
use App\Enums\ProfileType;
use App\Enums\ActivityType;
use App\Enums\MemberStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MissionaryFieldsAndVolunteerTeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criar 10 campos missionários
        $missionaryFields = [
            [
                'user' => [
                    'name' => 'Pastor João Silva',
                    'email' => 'joao.silva@missionario.com',
                    'password' => Hash::make('123456'),
                    'profile_type' => ProfileType::MISSIONARY,
                ],
                'field' => [
                    'name' => 'Igreja Batista do Centro',
                    'phone' => '(11) 98765-4321',
                    'location_data' => [
                        'address' => 'Rua das Flores, 123',
                        'city' => 'São Paulo',
                        'state' => 'SP',
                        'zip_code' => '01234-567',
                        'country' => 'Brasil',
                    ],
                    'description' => 'Igreja localizada no centro da cidade, com grande necessidade de evangelismo e educação cristã. Atendemos crianças, jovens e adultos da comunidade.',
                    'structure' => [
                        'rooms' => 5,
                        'temple_capacity' => 150,
                        'bathrooms' => 3,
                        'parking_spaces' => 10,
                        'kitchen' => true,
                        'library' => false,
                        'playground' => true,
                    ],
                    'office_hours' => 'Segunda a Sexta: 8h às 18h',
                    'activity_types' => ['evangelism', 'education', 'children', 'youth'],
                    'is_active' => true,
                ],
            ],
            [
                'user' => [
                    'name' => 'Missionária Maria Santos',
                    'email' => 'maria.santos@missionario.com',
                    'password' => Hash::make('123456'),
                    'profile_type' => ProfileType::MISSIONARY,
                ],
                'field' => [
                    'name' => 'Comunidade Evangélica do Bairro Novo',
                    'phone' => '(21) 97654-3210',
                    'location_data' => [
                        'address' => 'Avenida Principal, 456',
                        'city' => 'Rio de Janeiro',
                        'state' => 'RJ',
                        'zip_code' => '20000-000',
                        'country' => 'Brasil',
                    ],
                    'description' => 'Comunidade em área periférica, focada em trabalho social e evangelismo. Necessitamos de apoio em atividades com crianças e idosos.',
                    'structure' => [
                        'rooms' => 3,
                        'temple_capacity' => 80,
                        'bathrooms' => 2,
                        'parking_spaces' => 5,
                        'kitchen' => true,
                        'library' => false,
                        'playground' => false,
                    ],
                    'office_hours' => 'Terça a Sábado: 9h às 17h',
                    'activity_types' => ['evangelism', 'social', 'children', 'elderly'],
                    'is_active' => true,
                ],
            ],
            [
                'user' => [
                    'name' => 'Pastor Carlos Oliveira',
                    'email' => 'carlos.oliveira@missionario.com',
                    'password' => Hash::make('123456'),
                    'profile_type' => ProfileType::MISSIONARY,
                ],
                'field' => [
                    'name' => 'Igreja Presbiteriana da Paz',
                    'phone' => '(85) 91234-5678',
                    'location_data' => [
                        'address' => 'Rua da Paz, 789',
                        'city' => 'Fortaleza',
                        'state' => 'CE',
                        'zip_code' => '60000-000',
                        'country' => 'Brasil',
                    ],
                    'description' => 'Igreja com foco em educação cristã e música. Temos um coral e ministério de jovens muito ativo.',
                    'structure' => [
                        'rooms' => 6,
                        'temple_capacity' => 200,
                        'bathrooms' => 4,
                        'parking_spaces' => 15,
                        'kitchen' => true,
                        'library' => true,
                        'playground' => true,
                    ],
                    'office_hours' => 'Segunda a Sexta: 7h às 19h',
                    'activity_types' => ['education', 'music', 'youth', 'adults'],
                    'is_active' => true,
                ],
            ],
            [
                'user' => [
                    'name' => 'Missionário Pedro Costa',
                    'email' => 'pedro.costa@missionario.com',
                    'password' => Hash::make('123456'),
                    'profile_type' => ProfileType::MISSIONARY,
                ],
                'field' => [
                    'name' => 'Templo Evangélico Renovado',
                    'phone' => '(31) 99876-5432',
                    'location_data' => [
                        'address' => 'Rua das Palmeiras, 321',
                        'city' => 'Belo Horizonte',
                        'state' => 'MG',
                        'zip_code' => '30000-000',
                        'country' => 'Brasil',
                    ],
                    'description' => 'Igreja com necessidade de reformas e melhorias estruturais. Buscamos equipes para construção e também para evangelismo.',
                    'structure' => [
                        'rooms' => 4,
                        'temple_capacity' => 120,
                        'bathrooms' => 2,
                        'parking_spaces' => 8,
                        'kitchen' => false,
                        'library' => false,
                        'playground' => false,
                    ],
                    'office_hours' => 'Terça a Domingo: 8h às 20h',
                    'activity_types' => ['construction', 'evangelism', 'adults'],
                    'is_active' => true,
                ],
            ],
            [
                'user' => [
                    'name' => 'Pastora Ana Paula',
                    'email' => 'ana.paula@missionario.com',
                    'password' => Hash::make('123456'),
                    'profile_type' => ProfileType::MISSIONARY,
                ],
                'field' => [
                    'name' => 'Igreja do Evangelho Pleno',
                    'phone' => '(41) 98765-4321',
                    'location_data' => [
                        'address' => 'Avenida Central, 654',
                        'city' => 'Curitiba',
                        'state' => 'PR',
                        'zip_code' => '80000-000',
                        'country' => 'Brasil',
                    ],
                    'description' => 'Igreja com ministério forte em saúde e assistência social. Oferecemos atendimento médico básico e distribuição de alimentos.',
                    'structure' => [
                        'rooms' => 7,
                        'temple_capacity' => 180,
                        'bathrooms' => 5,
                        'parking_spaces' => 20,
                        'kitchen' => true,
                        'library' => true,
                        'playground' => true,
                    ],
                    'office_hours' => 'Segunda a Sexta: 8h às 18h | Sábado: 8h às 12h',
                    'activity_types' => ['health', 'social', 'evangelism', 'children', 'elderly'],
                    'is_active' => true,
                ],
            ],
            [
                'user' => [
                    'name' => 'Missionário Roberto Alves',
                    'email' => 'roberto.alves@missionario.com',
                    'password' => Hash::make('123456'),
                    'profile_type' => ProfileType::MISSIONARY,
                ],
                'field' => [
                    'name' => 'Comunidade Cristã do Interior',
                    'phone' => '(47) 91234-5678',
                    'location_data' => [
                        'address' => 'Estrada Rural, Km 12',
                        'city' => 'Blumenau',
                        'state' => 'SC',
                        'zip_code' => '89000-000',
                        'country' => 'Brasil',
                    ],
                    'description' => 'Comunidade rural com foco em evangelismo e educação. Atendemos famílias da zona rural.',
                    'structure' => [
                        'rooms' => 2,
                        'temple_capacity' => 60,
                        'bathrooms' => 1,
                        'parking_spaces' => 10,
                        'kitchen' => true,
                        'library' => false,
                        'playground' => true,
                    ],
                    'office_hours' => 'Domingo: 9h às 12h | Quarta: 19h às 21h',
                    'activity_types' => ['evangelism', 'education', 'children', 'adults'],
                    'is_active' => true,
                ],
            ],
            [
                'user' => [
                    'name' => 'Pastor Fernando Lima',
                    'email' => 'fernando.lima@missionario.com',
                    'password' => Hash::make('123456'),
                    'profile_type' => ProfileType::MISSIONARY,
                ],
                'field' => [
                    'name' => 'Igreja Pentecostal Avivada',
                    'phone' => '(51) 97654-3210',
                    'location_data' => [
                        'address' => 'Rua dos Missionários, 147',
                        'city' => 'Porto Alegre',
                        'state' => 'RS',
                        'zip_code' => '90000-000',
                        'country' => 'Brasil',
                    ],
                    'description' => 'Igreja com ministério de música e teatro muito ativo. Realizamos apresentações evangelísticas na comunidade.',
                    'structure' => [
                        'rooms' => 5,
                        'temple_capacity' => 160,
                        'bathrooms' => 3,
                        'parking_spaces' => 12,
                        'kitchen' => true,
                        'library' => false,
                        'playground' => false,
                    ],
                    'office_hours' => 'Segunda a Sexta: 9h às 18h',
                    'activity_types' => ['music', 'teather', 'evangelism', 'youth'],
                    'is_active' => true,
                ],
            ],
            [
                'user' => [
                    'name' => 'Missionária Juliana Ferreira',
                    'email' => 'juliana.ferreira@missionario.com',
                    'password' => Hash::make('123456'),
                    'profile_type' => ProfileType::MISSIONARY,
                ],
                'field' => [
                    'name' => 'Igreja Metodista da Esperança',
                    'phone' => '(61) 99876-5432',
                    'location_data' => [
                        'address' => 'Quadra 205, Conjunto A, Lote 5',
                        'city' => 'Brasília',
                        'state' => 'DF',
                        'zip_code' => '70000-000',
                        'country' => 'Brasil',
                    ],
                    'description' => 'Igreja com foco em esportes e atividades com jovens. Temos quadra esportiva e espaço para eventos.',
                    'structure' => [
                        'rooms' => 4,
                        'temple_capacity' => 140,
                        'bathrooms' => 3,
                        'parking_spaces' => 18,
                        'kitchen' => true,
                        'library' => false,
                        'playground' => true,
                    ],
                    'office_hours' => 'Terça a Domingo: 8h às 20h',
                    'activity_types' => ['sports', 'youth', 'evangelism', 'children'],
                    'is_active' => true,
                ],
            ],
            [
                'user' => [
                    'name' => 'Pastor Marcos Rocha',
                    'email' => 'marcos.rocha@missionario.com',
                    'password' => Hash::make('123456'),
                    'profile_type' => ProfileType::MISSIONARY,
                ],
                'field' => [
                    'name' => 'Templo da Fé Cristã',
                    'phone' => '(81) 91234-5678',
                    'location_data' => [
                        'address' => 'Rua do Comércio, 258',
                        'city' => 'Recife',
                        'state' => 'PE',
                        'zip_code' => '50000-000',
                        'country' => 'Brasil',
                    ],
                    'description' => 'Igreja com ministério completo: evangelismo, educação, saúde e assistência social. Atendemos todas as faixas etárias.',
                    'structure' => [
                        'rooms' => 8,
                        'temple_capacity' => 220,
                        'bathrooms' => 6,
                        'parking_spaces' => 25,
                        'kitchen' => true,
                        'library' => true,
                        'playground' => true,
                    ],
                    'office_hours' => 'Segunda a Sábado: 7h às 21h',
                    'activity_types' => ['evangelism', 'education', 'health', 'social', 'children', 'youth', 'adults', 'elderly'],
                    'is_active' => true,
                ],
            ],
            [
                'user' => [
                    'name' => 'Missionário Lucas Barbosa',
                    'email' => 'lucas.barbosa@missionario.com',
                    'password' => Hash::make('123456'),
                    'profile_type' => ProfileType::MISSIONARY,
                ],
                'field' => [
                    'name' => 'Igreja Batista do Sertão',
                    'phone' => '(88) 98765-4321',
                    'location_data' => [
                        'address' => 'Rua Principal, 369',
                        'city' => 'Juazeiro do Norte',
                        'state' => 'CE',
                        'zip_code' => '63000-000',
                        'country' => 'Brasil',
                    ],
                    'description' => 'Igreja no sertão nordestino com grande necessidade de evangelismo e construção. Buscamos equipes para ajudar na expansão do templo.',
                    'structure' => [
                        'rooms' => 3,
                        'temple_capacity' => 100,
                        'bathrooms' => 2,
                        'parking_spaces' => 8,
                        'kitchen' => true,
                        'library' => false,
                        'playground' => false,
                    ],
                    'office_hours' => 'Domingo: 8h às 12h | Quinta: 19h às 21h',
                    'activity_types' => ['construction', 'evangelism', 'education', 'adults'],
                    'is_active' => true,
                ],
            ],
        ];

        foreach ($missionaryFields as $data) {
            if (User::where('email', $data['user']['email'])->exists()) {
                continue;
            }
            $user = User::create($data['user']);
            MissionaryField::create(array_merge($data['field'], ['user_id' => $user->id]));
        }

        // Criar 10 equipes de voluntários
        $volunteerTeams = [
            [
                'user' => [
                    'name' => 'Pastor Eduardo Martins',
                    'email' => 'eduardo.martins@voluntario.com',
                    'password' => Hash::make('123456'),
                    'profile_type' => ProfileType::VOLUNTEER,
                ],
                'team' => [
                    'church_name' => 'Igreja Batista Central de Campinas',
                    'responsible_officer' => 'Pastor Eduardo Martins',
                    'responsible_officer_phone' => '(19) 98765-4321',
                    'activities' => ['evangelism', 'education', 'children', 'youth'],
                    'available_start' => now()->addDays(30),
                    'available_end' => now()->addDays(60),
                    'is_available' => true,
                ],
                'members' => [
                    [
                        'name' => 'Carlos Mendes',
                        'phone' => '(19) 91234-5678',
                        'church' => 'Igreja Batista Central de Campinas',
                        'pastor_name' => 'Pastor Eduardo Martins',
                        'pastor_phone' => '(19) 98765-4321',
                        'role' => 'Líder de Evangelismo',
                        'description' => 'Experiente em evangelismo de rua e discipulado.',
                        'specialty' => 'Evangelismo',
                        'status' => MemberStatus::PAID,
                    ],
                    [
                        'name' => 'Ana Beatriz',
                        'phone' => '(19) 92345-6789',
                        'church' => 'Igreja Batista Central de Campinas',
                        'pastor_name' => 'Pastor Eduardo Martins',
                        'pastor_phone' => '(19) 98765-4321',
                        'role' => 'Professora',
                        'description' => 'Especialista em educação infantil e ensino bíblico.',
                        'specialty' => 'Educação',
                        'status' => MemberStatus::PAID,
                    ],
                ],
            ],
            [
                'user' => [
                    'name' => 'Pastora Sandra Costa',
                    'email' => 'sandra.costa@voluntario.com',
                    'password' => Hash::make('123456'),
                    'profile_type' => ProfileType::VOLUNTEER,
                ],
                'team' => [
                    'church_name' => 'Igreja Presbiteriana Renovada',
                    'responsible_officer' => 'Pastora Sandra Costa',
                    'responsible_officer_phone' => '(21) 97654-3210',
                    'activities' => ['social', 'health', 'elderly'],
                    'available_start' => now()->addDays(45),
                    'available_end' => now()->addDays(75),
                    'is_available' => true,
                ],
                'members' => [
                    [
                        'name' => 'Dr. Paulo Henrique',
                        'phone' => '(21) 93456-7890',
                        'church' => 'Igreja Presbiteriana Renovada',
                        'pastor_name' => 'Pastora Sandra Costa',
                        'pastor_phone' => '(21) 97654-3210',
                        'role' => 'Médico',
                        'description' => 'Médico com experiência em atendimento comunitário.',
                        'specialty' => 'Saúde',
                        'status' => MemberStatus::PAID,
                    ],
                ],
            ],
            [
                'user' => [
                    'name' => 'Pastor Rafael Souza',
                    'email' => 'rafael.souza@voluntario.com',
                    'password' => Hash::make('123456'),
                    'profile_type' => ProfileType::VOLUNTEER,
                ],
                'team' => [
                    'church_name' => 'Igreja Assembleia de Deus - Ministério Construção',
                    'responsible_officer' => 'Pastor Rafael Souza',
                    'responsible_officer_phone' => '(85) 91234-5678',
                    'activities' => ['construction', 'evangelism'],
                    'available_start' => now()->addDays(20),
                    'available_end' => now()->addDays(50),
                    'is_available' => true,
                ],
                'members' => [
                    [
                        'name' => 'José da Silva',
                        'phone' => '(85) 94567-8901',
                        'church' => 'Igreja Assembleia de Deus',
                        'pastor_name' => 'Pastor Rafael Souza',
                        'pastor_phone' => '(85) 91234-5678',
                        'role' => 'Pedreiro',
                        'description' => 'Pedreiro experiente em construção e reformas.',
                        'specialty' => 'Construção',
                        'status' => MemberStatus::PAID,
                    ],
                    [
                        'name' => 'Roberto Almeida',
                        'phone' => '(85) 95678-9012',
                        'church' => 'Igreja Assembleia de Deus',
                        'pastor_name' => 'Pastor Rafael Souza',
                        'pastor_phone' => '(85) 91234-5678',
                        'role' => 'Eletricista',
                        'description' => 'Eletricista com experiência em instalações elétricas.',
                        'specialty' => 'Construção',
                        'status' => MemberStatus::PAID,
                    ],
                ],
            ],
            [
                'user' => [
                    'name' => 'Pastora Fernanda Lima',
                    'email' => 'fernanda.lima@voluntario.com',
                    'password' => Hash::make('123456'),
                    'profile_type' => ProfileType::VOLUNTEER,
                ],
                'team' => [
                    'church_name' => 'Igreja do Evangelho Quadrangular',
                    'responsible_officer' => 'Pastora Fernanda Lima',
                    'responsible_officer_phone' => '(31) 99876-5432',
                    'activities' => ['music', 'teather', 'youth'],
                    'available_start' => now()->addDays(60),
                    'available_end' => now()->addDays(90),
                    'is_available' => true,
                ],
                'members' => [
                    [
                        'name' => 'Maria Clara',
                        'phone' => '(31) 96789-0123',
                        'church' => 'Igreja do Evangelho Quadrangular',
                        'pastor_name' => 'Pastora Fernanda Lima',
                        'pastor_phone' => '(31) 99876-5432',
                        'role' => 'Regente',
                        'description' => 'Regente de coral e ministério de música.',
                        'specialty' => 'Música',
                        'status' => MemberStatus::PAID,
                    ],
                    [
                        'name' => 'João Pedro',
                        'phone' => '(31) 97890-1234',
                        'church' => 'Igreja do Evangelho Quadrangular',
                        'pastor_name' => 'Pastora Fernanda Lima',
                        'pastor_phone' => '(31) 99876-5432',
                        'role' => 'Ator',
                        'description' => 'Ator e diretor de peças teatrais evangelísticas.',
                        'specialty' => 'Teatro',
                        'status' => MemberStatus::PAID,
                    ],
                ],
            ],
            [
                'user' => [
                    'name' => 'Pastor André Pereira',
                    'email' => 'andre.pereira@voluntario.com',
                    'password' => Hash::make('123456'),
                    'profile_type' => ProfileType::VOLUNTEER,
                ],
                'team' => [
                    'church_name' => 'Igreja Batista do Norte',
                    'responsible_officer' => 'Pastor André Pereira',
                    'responsible_officer_phone' => '(41) 98765-4321',
                    'activities' => ['sports', 'youth', 'children'],
                    'available_start' => now()->addDays(15),
                    'available_end' => now()->addDays(45),
                    'is_available' => true,
                ],
                'members' => [
                    [
                        'name' => 'Felipe Santos',
                        'phone' => '(41) 98901-2345',
                        'church' => 'Igreja Batista do Norte',
                        'pastor_name' => 'Pastor André Pereira',
                        'pastor_phone' => '(41) 98765-4321',
                        'role' => 'Educador Físico',
                        'description' => 'Educador físico especializado em esportes com crianças e jovens.',
                        'specialty' => 'Esportes',
                        'status' => MemberStatus::PAID,
                    ],
                ],
            ],
            [
                'user' => [
                    'name' => 'Pastora Patrícia Alves',
                    'email' => 'patricia.alves@voluntario.com',
                    'password' => Hash::make('123456'),
                    'profile_type' => ProfileType::VOLUNTEER,
                ],
                'team' => [
                    'church_name' => 'Igreja Metodista Unida',
                    'responsible_officer' => 'Pastora Patrícia Alves',
                    'responsible_officer_phone' => '(47) 91234-5678',
                    'activities' => ['education', 'children', 'evangelism'],
                    'available_start' => now()->addDays(30),
                    'available_end' => now()->addDays(60),
                    'is_available' => true,
                ],
                'members' => [
                    [
                        'name' => 'Lucia Maria',
                        'phone' => '(47) 99012-3456',
                        'church' => 'Igreja Metodista Unida',
                        'pastor_name' => 'Pastora Patrícia Alves',
                        'pastor_phone' => '(47) 91234-5678',
                        'role' => 'Professora',
                        'description' => 'Professora com experiência em educação infantil e ensino bíblico.',
                        'specialty' => 'Educação',
                        'status' => MemberStatus::PAID,
                    ],
                ],
            ],
            [
                'user' => [
                    'name' => 'Pastor Bruno Rodrigues',
                    'email' => 'bruno.rodrigues@voluntario.com',
                    'password' => Hash::make('123456'),
                    'profile_type' => ProfileType::VOLUNTEER,
                ],
                'team' => [
                    'church_name' => 'Igreja Pentecostal Fogo',
                    'responsible_officer' => 'Pastor Bruno Rodrigues',
                    'responsible_officer_phone' => '(51) 97654-3210',
                    'activities' => ['evangelism', 'music', 'youth', 'adults'],
                    'available_start' => now()->addDays(40),
                    'available_end' => now()->addDays(70),
                    'is_available' => true,
                ],
                'members' => [
                    [
                        'name' => 'Gabriel Oliveira',
                        'phone' => '(51) 90123-4567',
                        'church' => 'Igreja Pentecostal Fogo',
                        'pastor_name' => 'Pastor Bruno Rodrigues',
                        'pastor_phone' => '(51) 97654-3210',
                        'role' => 'Evangelista',
                        'description' => 'Evangelista com experiência em pregação e discipulado.',
                        'specialty' => 'Evangelismo',
                        'status' => MemberStatus::PAID,
                    ],
                    [
                        'name' => 'Thiago Nunes',
                        'phone' => '(51) 91234-5678',
                        'church' => 'Igreja Pentecostal Fogo',
                        'pastor_name' => 'Pastor Bruno Rodrigues',
                        'pastor_phone' => '(51) 97654-3210',
                        'role' => 'Músico',
                        'description' => 'Músico e compositor de louvores.',
                        'specialty' => 'Música',
                        'status' => MemberStatus::PAID,
                    ],
                ],
            ],
            [
                'user' => [
                    'name' => 'Pastora Renata Ferreira',
                    'email' => 'renata.ferreira@voluntario.com',
                    'password' => Hash::make('123456'),
                    'profile_type' => ProfileType::VOLUNTEER,
                ],
                'team' => [
                    'church_name' => 'Igreja Batista da Graça',
                    'responsible_officer' => 'Pastora Renata Ferreira',
                    'responsible_officer_phone' => '(61) 99876-5432',
                    'activities' => ['social', 'health', 'elderly', 'children'],
                    'available_start' => now()->addDays(25),
                    'available_end' => now()->addDays(55),
                    'is_available' => true,
                ],
                'members' => [
                    [
                        'name' => 'Enfermeira Juliana',
                        'phone' => '(61) 92345-6789',
                        'church' => 'Igreja Batista da Graça',
                        'pastor_name' => 'Pastora Renata Ferreira',
                        'pastor_phone' => '(61) 99876-5432',
                        'role' => 'Enfermeira',
                        'description' => 'Enfermeira com experiência em atendimento comunitário e saúde preventiva.',
                        'specialty' => 'Saúde',
                        'status' => MemberStatus::PAID,
                    ],
                ],
            ],
            [
                'user' => [
                    'name' => 'Pastor Gustavo Rocha',
                    'email' => 'gustavo.rocha@voluntario.com',
                    'password' => Hash::make('123456'),
                    'profile_type' => ProfileType::VOLUNTEER,
                ],
                'team' => [
                    'church_name' => 'Igreja Presbiteriana do Sul',
                    'responsible_officer' => 'Pastor Gustavo Rocha',
                    'responsible_officer_phone' => '(81) 91234-5678',
                    'activities' => ['construction', 'evangelism', 'education'],
                    'available_start' => now()->addDays(50),
                    'available_end' => now()->addDays(80),
                    'is_available' => true,
                ],
                'members' => [
                    [
                        'name' => 'Marcos Antônio',
                        'phone' => '(81) 93456-7890',
                        'church' => 'Igreja Presbiteriana do Sul',
                        'pastor_name' => 'Pastor Gustavo Rocha',
                        'pastor_phone' => '(81) 91234-5678',
                        'role' => 'Engenheiro',
                        'description' => 'Engenheiro civil com experiência em projetos e construção.',
                        'specialty' => 'Construção',
                        'status' => MemberStatus::PAID,
                    ],
                    [
                        'name' => 'Ricardo Barbosa',
                        'phone' => '(81) 94567-8901',
                        'church' => 'Igreja Presbiteriana do Sul',
                        'pastor_name' => 'Pastor Gustavo Rocha',
                        'pastor_phone' => '(81) 91234-5678',
                        'role' => 'Carpinteiro',
                        'description' => 'Carpinteiro especializado em móveis e estruturas.',
                        'specialty' => 'Construção',
                        'status' => MemberStatus::PAID,
                    ],
                ],
            ],
            [
                'user' => [
                    'name' => 'Pastora Camila Dias',
                    'email' => 'camila.dias@voluntario.com',
                    'password' => Hash::make('123456'),
                    'profile_type' => ProfileType::VOLUNTEER,
                ],
                'team' => [
                    'church_name' => 'Igreja Batista Esperança',
                    'responsible_officer' => 'Pastora Camila Dias',
                    'responsible_officer_phone' => '(88) 98765-4321',
                    'activities' => ['evangelism', 'social', 'children', 'youth', 'adults'],
                    'available_start' => now()->addDays(35),
                    'available_end' => now()->addDays(65),
                    'is_available' => true,
                ],
                'members' => [
                    [
                        'name' => 'Isabela Costa',
                        'phone' => '(88) 95678-9012',
                        'church' => 'Igreja Batista Esperança',
                        'pastor_name' => 'Pastora Camila Dias',
                        'pastor_phone' => '(88) 98765-4321',
                        'role' => 'Assistente Social',
                        'description' => 'Assistente social com experiência em projetos comunitários.',
                        'specialty' => 'Social',
                        'status' => MemberStatus::PAID,
                    ],
                    [
                        'name' => 'Paulo César',
                        'phone' => '(88) 96789-0123',
                        'church' => 'Igreja Batista Esperança',
                        'pastor_name' => 'Pastora Camila Dias',
                        'pastor_phone' => '(88) 98765-4321',
                        'role' => 'Evangelista',
                        'description' => 'Evangelista com foco em jovens e adultos.',
                        'specialty' => 'Evangelismo',
                        'status' => MemberStatus::PAID,
                    ],
                ],
            ],
        ];

        foreach ($volunteerTeams as $data) {
            $user = User::create($data['user']);
            $team = VolunteerTeam::create(array_merge($data['team'], ['user_id' => $user->id]));

            // Criar membros da equipe
            foreach ($data['members'] as $memberData) {
                TeamMember::create(array_merge($memberData, ['team_id' => $team->id]));
            }
        }

        $this->command->info('✅ 10 campos missionários criados com sucesso!');
        $this->command->info('✅ 10 equipes de voluntários criadas com sucesso!');
    }
}
