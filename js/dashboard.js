/* dashboard.js - comportamentos da página Dashboard */

// Mostra a data de hoje abaixo do título
$('dataHoje').textContent = new Date().toLocaleDateString('pt-BR', { weekday: 'long', day: '2-digit', month: 'long', year: 'numeric' });

// Os números, as listas e o gráfico serão preenchidos pelo PHP (veja os comentários BACK-END no HTML).
