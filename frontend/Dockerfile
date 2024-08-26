# Use a imagem oficial do Node.js como base
FROM node:18-alpine

# Define o diretório de trabalho dentro do contêiner
WORKDIR /app

# Copia o arquivo package.json e o package-lock.json para o contêiner
COPY package*.json ./

# Instala as dependências do projeto
RUN npm install

# Copia o restante dos arquivos do projeto para o contêiner
COPY . .

# Compila o aplicativo React
RUN npm run build

# Instala o servidor HTTP do Node.js para servir o app em produção
#RUN npm install -g serve

# Define o comando que será executado quando o contêiner iniciar
#CMD ["serve", "-s", "build"]
CMD ["npm", "run", "start"]

# Expõe a porta 3000 para acessar o front-end
EXPOSE 3000