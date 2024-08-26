## Instruções

-   Instalar o docker
-   Na pasta raiz criar um diretorio com o nome frontend
-   Baixar o projeto https://github.com/andersonfelixds/sorteio-time-react nesse diretorio
-   Executar o comando docker-compose up -d
-   Backend esta rodando no http://localhost:8989
-   FrontEnd esta rodando no http://localhost:3000

## Rotas backend

-   POST http://localhost:8989/api/players
    {
    "name":"Anderson",
    "level" : 2,
    "goalkeeper" : false
    }
-   PUT http://localhost:8989/api/players/{id}
    {
    "id": 1
    "name":"Anderson",
    "level" : 2,
    "goalkeeper" : false
    }
-   PATH http://localhost:8989/api/players/{id}/confirmar-presenca
    {
    "present": true
    }
-   POST http://localhost:8989/api/sortear-times
    {
    "numero_de_jogadores_por_time": 12
    }
