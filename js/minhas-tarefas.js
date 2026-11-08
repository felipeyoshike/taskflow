/* minhas-tarefas.js - comportamentos da página Minhas tarefas */
const corpo = $('corpoTarefas');

ligarLimpar($('formTarefa'), 'Nova tarefa');

// Filtros: busca por título, status e categoria (usam os atributos data-* das linhas)
function aplicarFiltros() {
  const busca = $('fBusca').value.toLowerCase(), status = $('fStatus').value, cat = $('fCategoria').value;
  filtrarLinhas(corpo, tr =>
    tr.textContent.toLowerCase().includes(busca) &&
    (!status || tr.dataset.status === status) &&
    (!cat || tr.dataset.categoria === cat));
}
['fBusca', 'fStatus', 'fCategoria'].forEach(id => $(id).addEventListener('input', aplicarFiltros));

// Ordenação por prazo: cada clique alterna entre crescente e decrescente (usa data-vencimento)
let crescente = false;
$('btnOrdem').addEventListener('click', () => {
  crescente = !crescente;
  const linhas = [...corpo.querySelectorAll('tr:not(.sem-registros)')];
  linhas.sort((a, b) => (a.dataset.vencimento || '').localeCompare(b.dataset.vencimento || '') * (crescente ? 1 : -1));
  linhas.forEach(tr => corpo.appendChild(tr));
  $('btnOrdem').textContent = 'Prazo ' + (crescente ? '↑' : '↓');
});
