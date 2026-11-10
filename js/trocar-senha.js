/* troca-senha.js - validação simples da tela de troca de senha */
const form = document.getElementById('formTrocaSenha');
const email = document.getElementById('tEmail');
const nova = document.getElementById('tNova');
const btnSalvar = document.getElementById('btnSalvar');
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

  if (!email.value.trim() || !email.checkValidity()) { erro = 'Digite o e-mail cadastrado.'; campo = email; }
  else if (nova.value.length < 6) { erro = 'A nova senha precisa ter pelo menos 6 caracteres.'; campo = nova; }

  if (erro) {
    e.preventDefault();
    return mostrarErro(erro, campo);
  }
  esconderErro();
  btnSalvar.disabled = true;          // evita clique duplo
  btnSalvar.textContent = 'Salvando...';
});

// A mensagem some quando a pessoa volta a digitar
[email, nova].forEach(c => c.addEventListener('input', esconderErro));

// Se a pessoa voltar para esta página pelo botão "voltar" do navegador, o botão destrava
window.addEventListener('pageshow', () => {
  btnSalvar.disabled = false;
  btnSalvar.textContent = 'Salvar nova senha';
});