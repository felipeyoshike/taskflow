/* base.js - comportamentos comuns a todas as páginas internas */
const $ = id => document.getElementById(id);

// Menu lateral no celular
const btnMenu = $('btnMenu');
if (btnMenu) btnMenu.addEventListener('click', () => $('sidebar').classList.toggle('aberta'));

// "Sair": pede confirmação antes de ir para a tela de login
const btnSair = $('btnSair');
if (btnSair) btnSair.addEventListener('click', e => { if (!confirm('Deseja sair?')) e.preventDefault(); });

// Qualquer elemento com data-confirmar pede confirmação antes de agir (ex.: botão Excluir).
// Exemplo: <button data-confirmar="Excluir esta tarefa?">Excluir</button>
document.addEventListener('click', e => {
  const el = e.target.closest('[data-confirmar]');
  if (el && !confirm(el.dataset.confirmar)) e.preventDefault();
});

// Mensagem rápida no canto da tela
function toast(msg, erro) {
  let t = $('toast');
  if (!t) { t = document.createElement('div'); t.id = 'toast'; document.body.appendChild(t); }
  t.textContent = msg;
  t.className = 'mostra' + (erro ? ' erro' : '');
  clearTimeout(t._h); t._h = setTimeout(() => t.className = '', 2500);
}

// Impede o envio de formulário com campo obrigatório vazio ou só com espaços
document.querySelectorAll('form.form').forEach(form => {
  form.addEventListener('submit', e => {
    const vazio = [...form.querySelectorAll('[required]')].find(c => !c.value.trim());
    if (vazio) { e.preventDefault(); toast('Preencha os campos obrigatórios (*).', true); vazio.focus(); }
  });
});

// Ao clicar em "Limpar", o título do formulário volta ao texto de "novo cadastro"
function ligarLimpar(form, tituloPadrao) {
  form.addEventListener('reset', () => {
    $('tituloForm').textContent = tituloPadrao;
    form.querySelector('input[type=hidden]').value = '';   // sai do modo edição
  });
}

// Mostra só as linhas da tabela que passam no teste "aceita(tr)".
// A linha .sem-registros (mensagem de tabela vazia) aparece quando nenhuma linha passa.
function filtrarLinhas(corpo, aceita) {
  let visiveis = 0;
  corpo.querySelectorAll('tr:not(.sem-registros)').forEach(tr => {
    const ok = aceita(tr);
    tr.hidden = !ok;
    if (ok) visiveis++;
  });
  const vazio = corpo.querySelector('.sem-registros');
  if (vazio) vazio.hidden = visiveis > 0;
}

// Liga uma caixa de busca a uma tabela: filtra pelo texto da linha
function ligarBusca(inputId, corpoId) {
  $(inputId).addEventListener('input', () => {
    const termo = $(inputId).value.toLowerCase();
    filtrarLinhas($(corpoId), tr => tr.textContent.toLowerCase().includes(termo));
  });
}
