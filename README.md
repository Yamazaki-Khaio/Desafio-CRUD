# Desafio-CRUD

Configuração e Instalação do Projeto
Configuração do Backend Laravel
Clone o repositório do backend Laravel:

bash
Copy code
git clone [<URL-do-repositório>](https://github.com/Yamazaki-Khaio/Desafio-CRUD/)
Instale as dependências do backend usando o Composer:

bash
Copy code
composer install
Crie um arquivo .env e configure a conexão com o banco de dados:

bash
Copy code
cp .env.example .env
Defina as variáveis DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME e DB_PASSWORD no arquivo .env de acordo com a configuração do seu banco de dados.

Gere uma chave de aplicativo:

bash
Copy code
php artisan key:generate
Execute as migrações e seeders do banco de dados:

bash
Copy code
php artisan migrate --seed
Inicie o servidor de desenvolvimento do Laravel:

bash
Copy code
php artisan serve
Configuração do Frontend Vue.js
Clone o repositório do frontend Vue.js:

bash
Copy code
git clone[ <URL-do-repositório>](https://github.com/Yamazaki-Khaio/Desafio-CRUD/)
Instale as dependências do frontend usando npm ou yarn:

bash
Copy code
npm install
# ou
yarn install
Inicie o servidor de desenvolvimento do Vue.js:

bash
Copy code
npm run serve
# Integração do Código do Backend

# Controller

O controlador (AddressController.php) é a peça central que gerencia a manipulação de endereços na aplicação Laravel. Ele contém várias funções para lidar com diversas operações relacionadas aos endereços, como busca, adição, atualização e remoção. Aqui, vou detalhar as funções presentes no controlador:

index(): Esta função retorna todos os endereços existentes no formato JSON. Ela busca todos os endereços na base de dados e os devolve como resposta.

show($id): Essa função retorna os detalhes de um endereço específico com base no seu ID. Ela pesquisa o endereço correspondente na base de dados e retorna seus detalhes no formato JSON.

store(Request $request): Essa função lida com a adição de um novo endereço. Ela valida os dados fornecidos pelo formulário (CEP, Logradouro, Bairro, Cidade e UF), cria um novo registro na base de dados e retorna o novo endereço criado em formato JSON.

update(Request $request, $id): Essa função é responsável por atualizar os dados de um endereço existente. Primeiro, ela encontra o endereço com o ID fornecido, valida os dados do formulário e, em seguida, atualiza os detalhes do endereço na base de dados. Ela retorna o endereço atualizado em formato JSON.

destroy($id): Esta função é utilizada para remover um endereço com base no ID fornecido. Ela busca o endereço correspondente na base de dados, o exclui e retorna uma mensagem indicando que o endereço foi removido com sucesso.

search($query): Essa função permite a busca de endereços com base em um termo de pesquisa (CEP ou Logradouro). Ela pesquisa os endereços na base de dados que correspondem ao termo de pesquisa e retorna os resultados no formato JSON.

# Rotas da API:

No arquivo api.php, as rotas da API do Laravel estão definidas. Cada rota corresponde a um endpoint que o frontend acessa para realizar ações específicas no backend. As rotas são mapeadas para as funções correspondentes no controlador. Por exemplo:

GET /api/: A rota inicial busca todos os endereços usando a função index() do controlador.
GET /api/{id}: Esta rota busca os detalhes de um endereço específico usando a função show($id) do controlador.
POST /api/save: A rota para adicionar um novo endereço usando a função store(Request $request) do controlador.
PUT /api/update/{id}: A rota para atualizar os detalhes de um endereço existente usando a função update(Request $request, $id) do controlador.
DELETE /api/delete/{id}: A rota para remover um endereço usando a função destroy($id) do controlador.
GET /api/search/{query}: A rota para pesquisar endereços com base em um termo de pesquisa usando a função search($query) do controlador.

# Uso do Axios e API de Busca do Google:

Para fazer requisições HTTP entre o frontend Vue.js e o backend Laravel, foi utilizado o Axios. O Axios é uma biblioteca que simplifica o processo de fazer chamadas HTTP assíncronas. Com ele, o frontend pode enviar solicitações para as rotas da API do Laravel para buscar, adicionar, atualizar ou remover endereços.

Além disso, o aplicativo faz uso da API de Geocodificação do Google para a funcionalidade de busca e adição de endereços a partir de um CEP ou Logradouro. Quando o usuário realiza uma busca, o frontend utiliza o Axios para enviar uma solicitação à API de Geocodificação do Google, passando o termo de pesquisa como parâmetro. A API retorna dados de endereços que correspondem à pesquisa, incluindo detalhes como CEP, Logradouro, Bairro, Cidade e UF. Esses dados são utilizados para adicionar um novo endereço ou para fornecer resultados de busca mais precisos.

Dessa forma, o Axios facilita a comunicação entre o frontend e o backend, enquanto a API de Geocodificação do Google enriquece a funcionalidade de busca de endereços, melhorando a experiência do usuário. Tudo isso contribui para a criação de um aplicativo completo e eficiente para gerenciamento de endereços.

# Como Usar
Acesse a API do backend Laravel em: http://localhost:8000

Acesse o frontend Vue.js em: http://localhost:8080

# Conclusão
Seguindo os passos deste guia, você terá configurado um backend Laravel e um frontend Vue.js que se comunicam entre si. O backend Laravel fornece endpoints de API para executar operações CRUD em endereços, e o frontend Vue.js usa essas APIs para exibir e gerenciar endereços usando modais.
