/* cadastro.js - validação simples da tela de cadastro */
const form = document.getElementById('formCadastro');
const nome = document.getElementById('cNome');
const email = document.getElementById('cEmail');
const senha = document.getElementById('cSenha');
const btnCadastrar = document.getElementById('btnCadastrar');
const msg = document.getElementById('msgErro');

function mostrarErro(texto, campo) {
  msg.textContent = texto;
  msg.hidden = false;
  campo.focus();
}
function esconderErro() { msg.hidden = true; }

// Botões Mostrar/Ocultar: cada um controla o campo indicado em data-alvo
document.querySelectorAll('.ver-senha').forEach(btn => {
  btn.addEventListener('click', () => {
    const campo = document.getElementById(btn.dataset.alvo);
    const visivel = campo.type === 'text';
    campo.type = visivel ? 'password' : 'text';
    btn.textContent = visivel ? 'Mostrar' : 'Ocultar';
  });
});

// Valida os campos antes de enviar o formulário ao PHP
form.addEventListener('submit', e => {
  let erro = '', campo = null;

  if (!nome.value.trim()) { erro = 'Informe o nome completo.'; campo = nome; }
  else if (!email.value.trim() || !email.checkValidity()) { erro = 'Digite um e-mail válido.'; campo = email; }
  else if (senha.value.length < 6) { erro = 'A senha precisa ter pelo menos 6 caracteres.'; campo = senha; }

  if (erro) {
    e.preventDefault();
    return mostrarErro(erro, campo);
  }
  esconderErro();
  btnCadastrar.disabled = true;       // evita clique duplo
  btnCadastrar.textContent = 'Cadastrando...';
});

// A mensagem some quando a pessoa volta a digitar
[nome, email, senha].forEach(c => c.addEventListener('input', esconderErro));

// Se a pessoa voltar para esta página pelo botão "voltar" do navegador, o botão destrava
window.addEventListener('pageshow', () => {
  btnCadastrar.disabled = false;
  btnCadastrar.textContent = 'Cadastrar';
});