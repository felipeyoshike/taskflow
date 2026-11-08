/* projetos.js - comportamentos da página Projetos */
ligarLimpar($('formProjeto'), 'Novo projeto');
ligarBusca('pBusca', 'corpoProjetos');

// A conclusão prevista não pode ser antes da data de início
$('formProjeto').addEventListener('submit', e => {
  if ($('pFim').value && $('pInicio').value && $('pFim').value < $('pInicio').value) {
    e.preventDefault();
    toast('A conclusão prevista não pode ser antes do início.', true);
    $('pFim').focus();
  }
});
