📚 Documentação do Projeto Vuejxy 🚀

   

📋 Pré-requisitos

PHP ≥ 8.2

Composer 2.x

Node.js ≥ 18.x

Banco de dados (MySQL/PostgreSQL recomendado)

🛠️ Configuração Inicial

1. Clone o repositório

git clone https://github.com/seu-usuario/vuejxy.git  
cd vuejxy  

2. Instalação de dependências

# Dependências PHP  
composer install  

# Dependências JavaScript  
npm install  

3. Configuração do ambiente

cp .env.example .env  
php artisan key:generate  

⚙️ Configuração Avançada

Banco de Dados

Edite seu arquivo .env:

DB_CONNECTION=mysql  
DB_HOST=127.0.0.1  
DB_PORT=3306  
DB_DATABASE=vuejxy  
DB_USERNAME=root  
DB_PASSWORD=  

Execute as migrações:

php artisan migrate --seed  

🔥 Compilação de Assets

Comando

Descrição

npm run dev

Compilação para desenvolvimento

npm run watch

Hot-reload automático

npm run build

Compilação para produção

🏗️ Estrutura do Projeto

vuejxy/  
├── app/  
│   ├── Components/       # Componentes Vue  
│   └── Models/           # Eloquent Models  
├── config/  
│   └── vuejxy.php        # Config customizada  
├── public/  
│   └── dist/             # Assets compilados  
└── resources/  
    ├── js/               # Vue + Inertia  
    └── scss/             # Estilos globais  

🚀 Comandos Úteis

# Criar novo componente  
php artisan make:component Button --vue  

# Rodar servidor local  
php artisan serve  

# Limpar caches  
php artisan optimize:clear  

🆘 Troubleshooting

Erro de permissão:

chmod -R 775 storage bootstrap/cache  

Dependências faltando:

rm -rf vendor node_modules && composer install && npm install  

Problemas com mix:

npm install laravel-mix@latest  

📄 Licença

MIT License © 2023 Vuejxy Team

✨ Dica: Configure seus aliases no vite.config.js para imports mais limpos!

resolve: {  
  alias: {  
    '@': '/resources/js',  
    '~': '/resources/scss'  
  }  
}  






laravel passpot

Execute este comando para instalar a versão mais recente compatível com PHP 8.1:

        // Configuração básica do Passport para MVC
  

        // Tempo de expiração dos tokens (opcional)
        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));


php artisan jwt:secret


$ php artisan jetstream:install inertia
