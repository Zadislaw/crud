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

## Ler Profiles

Digite:
```
localhost/crud/?fn=read
```


## Criar Profile

Digite uma linha parecida com a seguinte em seu navegador para inserir um registro:
```
http://localhost/crud/?fn=create&first_name=Matheus&last_name=Costa&dbo=19800101&gender=M&email=matheus@mail.com
```

## Atualizar Profiles:

Não esqueça o ID no final.
Digite algo como:
```
http://localhost/crud/?fn=update&first_name=Matheusinho&last_name=Araujo&dbo=20000101&gender=M&email=matheusinho@mail.com&id=1
```

## Deletar Profiles:


Digite a função delete com o ID: 
```
http://localhost/crud/?fn=delete&id=2
```

## Cadastrar Reports:

```
http://localhost/crud/?fn=createReport&titleReport=PrimeiraReportGRANDE&fk_id=1
```

## Ver Reports:

```
http://localhost/crud/?fn=readReport
```

# Considerações

Este projeto foi pensado para ser executado localmente, passou por poucos testes e apresenta inoperabilidade em caso de passagem de parâmetros incorretos, pois não possui tratamento de erros.
