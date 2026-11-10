/* usuarios.js - comportamentos da página Usuários */
ligarLimpar($('formUsuario'), 'Novo usuário');
ligarBusca('uBusca', 'corpoUsuarios');

// Valida a senha: obrigatória em usuário novo; ao editar, vazio mantém a senha atual
$('formUsuario').addEventListener('submit', e => {
  const editando = $('uId').value !== '';
  const senha = $('uSenha').value;
  let erro = '';
  if (!(editando && !senha) && senha.length < 6) erro = 'A senha precisa ter pelo menos 6 caracteres.';
  if (erro) { e.preventDefault(); toast(erro, true); }
});