/* login.js - comportamentos simples da tela de login */
const form = document.getElementById('formLogin');
const email = document.getElementById('lEmail');
const senha = document.getElementById('lSenha');
const btnVer = document.getElementById('btnVerSenha');
const btnEntrar = document.getElementById('btnEntrar');
const msg = document.getElementById('msgErro');

function mostrarErro(texto) { msg.textContent = texto; msg.hidden = false; }
function esconderErro() { msg.hidden = true; }

// Mostrar / ocultar a senha
btnVer.addEventListener('click', () => {
  const visivel = senha.type === 'text';
  senha.type = visivel ? 'password' : 'text';
  btnVer.textContent = visivel ? 'Mostrar' : 'Ocultar';
});

// Valida os campos antes de enviar o formulário ao PHP
form.addEventListener('submit', e => {
  if (!email.value.trim() || !senha.value) {
    e.preventDefault();
    return mostrarErro('Preencha o e-mail e a senha.');
  }
  if (!email.checkValidity()) {
    e.preventDefault();
    return mostrarErro('Digite um e-mail válido.');
  }
  esconderErro();
  btnEntrar.disabled = true;          // evita clique duplo
  btnEntrar.textContent = 'Entrando...';
});

// A mensagem some quando a pessoa volta a digitar
[email, senha].forEach(campo => campo.addEventListener('input', esconderErro));

// Se a pessoa voltar para esta página pelo botão "voltar" do navegador, o botão destrava
window.addEventListener('pageshow', () => {
  btnEntrar.disabled = false;
  btnEntrar.textContent = 'Entrar';
});