# Instalação

Feito utilizando Windows 10 e a versão 8.0.18 / PHP 8.0.18 do XAMPP. Pode fazer o download [aqui](https://www.apachefriends.org/xampp-files/8.0.18/xampp-windows-x64-8.0.18-0-VS16-installer.exe), ou no [site da Apache](https://www.apachefriends.org/xampp-files/8.0.18/xampp-windows-x64-8.0.18-0-VS16-installer.exe).

## Passo a passo

Baixe o [XAMPP](https://www.apachefriends.org/xampp-files/8.0.18/xampp-windows-x64-8.0.18-0-VS16-installer.exe).

Instale o Xampp.

Vá para o diretório htdocs do Xampp:

```
cd C:\xampp\htdocs
```

Clone o repositório:

```
git clone https://github.com/Zadislaw/crud
```

Inicie o Apache e o MySql no Xampp.

Clique no botão Admin do MySql.

Importe o arquivo db_crud.sql para criar o banco de dados.



# Utilização


Você pode utilizar a página [Home](http://localhost/crud/index.html). Ela contém algumas descrições de funcionalidades da API.

## Ler contatos

Digite:
```
localhost/crud/?fn=read
```


## Criar Contato

Digite uma linha parecida com a seguinte em seu navegador para inserir um registro:
```
localhost/crud/?fn=create&nome=Matheus&sobrenome=Costa&dtnascimento=30121999&telefone=2125554444&celular=21955554444&email=matheus@mail.com
```

## Atualizar contatos:

Não esqueça o ID no final.
Digite algo como:
```
http://localhost/crud/?fn=update&nome=Matheusinho&sobrenome=Araujo&dtnascimento=29121999&telefone=8225554444&celular=82955554444&email=matheusinho@mail.com&id=4
```

## Deletar Contatos:


Digite a função delete com o ID: 
```
http://localhost/crud/?fn=delete&id=3
```

## Cadastrar Empresas:

```
http://localhost/crud/?fn=createEmp&nomeEmp=PrimeiraEmpresaGRANDE&fk_id=1
```

## Ver Empresas:

```
http://localhost/crud/?fn=readEmp
```

# Considerações

Este projeto foi pensado para ser executado localmente, passou por poucos testes e apresenta inoperabilidade em caso de passagem de parâmetros incorretos, pois não possui tratamento de erros.
