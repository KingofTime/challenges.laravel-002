# Como rodar o projeto
## Usando o laravel sail
`./vendor/bin/sail up -d`

## Usando o Makefile
`make up`

# Rodando os testes
## Usando o laravel sail
`./vendor/bin/sail artisan test --env=testing`

## Usando o Makefile
`make test`

# O que ficou de fora
Ficou para implementação futura a separação das responsabilidades da query num repository ou ajuste dessa responsabilidade na model
além da criação dos outros endpoints de produtos e autenticação/autorização
