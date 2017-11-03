$(document).ready(function(){
        $('#nascimento').mask('00/00/0000');
        $('.cpf').mask('000.000.000-00', {reverse: true});
        $('#cnpj').mask('00.000.000/0000-00', {reverse: true});
        $('#telefoneC').mask('(00) 0 0000-0000');
        $('#telefoneR').mask('(00) 0000-0000');
        $('#moeda').mask('000.000.000.000.000,00', {reverse: true});
        $('#peso').mask('000,00', {reverse: true});
        $('#salario').mask('000.000.000.000.000,00', {reverse: true});
        });