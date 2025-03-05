# Controle de ponto

O Controle de Ponto online utiliza autenticação por IP, permitindo o registro eletrônico de entrada e saída dos funcionários por meio da validação de seu endereço IP na rede local. E em determinado horário, gere um arquivo CSV com os pontos registrados.

> protótipo
![protótipo](https://i.imgur.com/JPMxe0l.png)

A ideia é que o funcionário registre o ponto acessando o sistema que está na rede local. O sistema armazena o IP do dispositivo do funcionário que registrou o ponto e só libera o registro de um novo ponto utilizando a mesma matrícula no mesmo dispositivo. E no fim do dia, em um horário pré-determinado, os IPs salvos serão resetados, evitando assim problemas com IP dinâmico. Em um painel adminstrativo, um arquivo CSV com os pontos registrados no dia será gerado.

![Fluxo de auth](https://i.imgur.com/j2wrEpp.png)

## Tecnologias Utilizadas
**Backend**
* PHP 8.4 (usando minha estrutura [MVC-PHP](https://github.com/honorio-junior/MVC-PHP))
* SQLite3 
* CSV

**Frontend**
* HTML, CSS, JS
* [Bootstrap](https://getbootstrap.com/)
