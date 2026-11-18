/* comentarios.js - janela de comentários da página Minhas tarefas
 *
 * Esta parte é só o front-end. Quem grava no banco é o PHP:
 *   - formulário #formComentario  -> inputComentarioId (vazio = novo, preenchido = editar),
 *                                    inputComentarioTarefaId e inputComentarioTexto
 *   - formulário de excluir       -> inputExcluirComentarioId (+ inputComentarioTarefaId)
 * Todos enviam para ../processamento/processamentoComentarios.php (a criar).
 *
 * Dica: depois de salvar, redirecione para "minhas-tarefas.php?comentarios=ID_DA_TAREFA"
 * e a janela volta a abrir sozinha nessa tarefa.
 */
const dlgComentarios = $('dlgComentarios');
const formComentario = $('formComentario');

// Abre a janela de uma tarefa: mostra só a lista dela
function abrirComentarios(tarefaId, titulo) {
  $('dlgTitulo').textContent = 'Comentários: ' + titulo;
  $('cTarefaId').value = tarefaId;
  sairEdicaoComentario();

  let temLista = false;
  dlgComentarios.querySelectorAll('ul.comentarios').forEach(ul => {
    const mostrar = ul.dataset.tarefa === String(tarefaId);
    ul.hidden = !mostrar;
    if (mostrar) temLista = true;
  });
  $('semComentarios').hidden = temLista;

  dlgComentarios.showModal();
  $('cTexto').focus();
}

// Volta o formulário para o modo "novo comentário"
function sairEdicaoComentario() {
  formComentario.reset();
  $('cId').value = '';
  $('rotuloComentario').textContent = 'Novo comentário';
  $('cSalvar').textContent = 'Adicionar comentário';
  $('cCancelar').hidden = true;
}

// Botão "💬 n" na linha da tarefa
document.querySelectorAll('[data-comentarios]').forEach(btn => {
  btn.addEventListener('click', () => abrirComentarios(btn.dataset.comentarios, btn.dataset.titulo));
});

// Botão "Editar" de um comentário: coloca o texto no formulário e entra no modo edição
dlgComentarios.addEventListener('click', e => {
  const btn = e.target.closest('[data-editar-comentario]');
  if (!btn) return;
  $('cId').value = btn.dataset.editarComentario;
  $('cTexto').value = btn.dataset.texto;
  $('rotuloComentario').textContent = 'Editar comentário';
  $('cSalvar').textContent = 'Salvar alteração';
  $('cCancelar').hidden = false;
  $('cTexto').focus();
});

$('cCancelar').addEventListener('click', sairEdicaoComentario);
$('dlgFechar').addEventListener('click', () => dlgComentarios.close());
dlgComentarios.addEventListener('close', sairEdicaoComentario);

// Se a URL tiver ?comentarios=ID, abre a janela dessa tarefa (útil após salvar/excluir)
const idNaUrl = new URLSearchParams(location.search).get('comentarios');
if (idNaUrl) {
  const btn = document.querySelector(`[data-comentarios="${CSS.escape(idNaUrl)}"]`);
  if (btn) abrirComentarios(btn.dataset.comentarios, btn.dataset.titulo);
}